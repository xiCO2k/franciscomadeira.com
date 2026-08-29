<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $keyPair = sodium_crypto_sign_seed_keypair(str_repeat("\x07", SODIUM_CRYPTO_SIGN_SEEDBYTES));

    config([
        'strip.public_key' => base64_encode(sodium_crypto_sign_publickey($keyPair)),
        'strip.publisher_token' => 'test-publisher-token',
        'strip.storage_disk' => 'strip_releases',
        'strip.temporary_urls' => false,
    ]);

    Storage::fake('strip_releases');
});

function stripReleasePayload(string $version = '0.6.14', int $build = 14, string $salt = ''): array
{
    $keyPair = sodium_crypto_sign_seed_keypair(str_repeat("\x07", SODIUM_CRYPTO_SIGN_SEEDBYTES));
    $secretKey = sodium_crypto_sign_secretkey($keyPair);
    $archive = "signed Strip archive {$version} {$salt}";
    $notes = "## What's new in {$version}\n\nA signed test update. {$salt}\n";
    $archiveSignature = base64_encode(sodium_crypto_sign_detached($archive, $secretKey));
    $notesSignature = base64_encode(sodium_crypto_sign_detached($notes, $secretKey));
    $baseUrl = rtrim((string) config('strip.base_url'), '/');
    $notesLength = strlen($notes);
    $archiveLength = strlen($archive);

    $body = <<<XML
<?xml version="1.0" standalone="yes"?>
<rss xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" version="2.0">
    <channel>
        <title>Strip</title>
        <item>
            <title>{$version}</title>
            <pubDate>Sat, 29 Aug 2026 14:00:00 +0100</pubDate>
            <link>https://franciscomadeira.com</link>
            <sparkle:version>{$build}</sparkle:version>
            <sparkle:shortVersionString>{$version}</sparkle:shortVersionString>
            <sparkle:minimumSystemVersion>15.0</sparkle:minimumSystemVersion>
            <sparkle:hardwareRequirements>arm64</sparkle:hardwareRequirements>
            <sparkle:releaseNotesLink sparkle:edSignature="{$notesSignature}" sparkle:length="{$notesLength}">{$baseUrl}/Strip-{$version}.md</sparkle:releaseNotesLink>
            <enclosure url="{$baseUrl}/Strip-{$version}.zip" length="{$archiveLength}" type="application/octet-stream" sparkle:edSignature="{$archiveSignature}"/>
        </item>
    </channel>
</rss>
XML;

    $feedSignature = base64_encode(sodium_crypto_sign_detached($body, $secretKey));
    $appcast = $body."<!-- sparkle-signatures:\n"
        ."edSignature: {$feedSignature}\n"
        .'length: '.strlen($body)."\n"
        ."-->\n";

    return [
        'version' => $version,
        'build' => (string) $build,
        'archive' => UploadedFile::fake()->createWithContent("Strip-{$version}.zip", $archive),
        'notes' => UploadedFile::fake()->createWithContent("Strip-{$version}.md", $notes),
        'appcast' => UploadedFile::fake()->createWithContent('appcast.rss', $appcast),
        '_archive' => $archive,
        '_notes' => $notes,
        '_appcast' => $appcast,
    ];
}

function publishStripRelease(array $payload)
{
    return test()->withToken('test-publisher-token')->post('/api/strip/releases', [
        'version' => $payload['version'],
        'build' => $payload['build'],
        'archive' => $payload['archive'],
        'notes' => $payload['notes'],
        'appcast' => $payload['appcast'],
    ]);
}

it('requires the private publisher token', function () {
    $payload = stripReleasePayload();

    $this->post('/api/strip/releases', $payload)->assertUnauthorized();
});

it('publishes a cryptographically verified release and signed feed', function () {
    $payload = stripReleasePayload();

    publishStripRelease($payload)
        ->assertCreated()
        ->assertJsonPath('data.version', '0.6.14')
        ->assertJsonPath('data.build', 14)
        ->assertJsonPath('data.archive_sha256', hash('sha256', $payload['_archive']));

    $this->assertDatabaseHas('strip_releases', [
        'version' => '0.6.14',
        'build' => 14,
        'archive_sha256' => hash('sha256', $payload['_archive']),
        'notes_sha256' => hash('sha256', $payload['_notes']),
    ]);
    $this->assertDatabaseHas('strip_feeds', [
        'sha256' => hash('sha256', $payload['_appcast']),
    ]);
    Storage::disk('strip_releases')->assertExists([
        'strip/releases/14/Strip-0.6.14.zip',
        'strip/releases/14/Strip-0.6.14.md',
    ]);

    $this->get('/strip/appcast.rss')
        ->assertOk()
        ->assertHeader('Content-Type', 'application/rss+xml; charset=utf-8')
        ->assertHeader('Cache-Control', 'max-age=300, must-revalidate, public')
        ->assertContent($payload['_appcast']);

    $archive = $this->get('/strip/Strip-0.6.14.zip');
    $archive->assertOk()
        ->assertHeader('Content-Type', 'application/octet-stream')
        ->assertHeader('Cache-Control', 'immutable, max-age=31536000, public');
    expect($archive->streamedContent())->toBe($payload['_archive']);

    $notes = $this->get('/strip/Strip-0.6.14.md');
    $notes->assertOk()->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
    expect($notes->streamedContent())->toBe($payload['_notes']);
});

it('is idempotent for byte-identical releases', function () {
    $first = stripReleasePayload();
    publishStripRelease($first)->assertCreated();

    $second = stripReleasePayload();
    publishStripRelease($second)->assertOk();

    $this->assertDatabaseCount('strip_releases', 1);
    $this->assertDatabaseCount('strip_feeds', 1);
});

it('rejects an archive whose Sparkle signature does not match', function () {
    $payload = stripReleasePayload();
    $payload['archive'] = UploadedFile::fake()->createWithContent('Strip-0.6.14.zip', 'tampered');

    publishStripRelease($payload)
        ->assertUnprocessable()
        ->assertJsonPath('message', 'The archive length in the appcast does not match the upload.');

    $this->assertDatabaseCount('strip_releases', 0);
});

it('rejects a modified signed appcast', function () {
    $payload = stripReleasePayload();
    $tampered = str_replace('15.0', '14.0', $payload['_appcast']);
    $payload['appcast'] = UploadedFile::fake()->createWithContent('appcast.rss', $tampered);

    publishStripRelease($payload)
        ->assertUnprocessable()
        ->assertJsonPath('message', 'The appcast signature is invalid.');
});

it('rejects version and build reuse with different signed bytes', function () {
    publishStripRelease(stripReleasePayload())->assertCreated();

    publishStripRelease(stripReleasePayload(salt: 'different'))
        ->assertConflict()
        ->assertJsonPath('message', 'A different release already uses this version or build.');
});

it('serves only registered release assets', function () {
    $this->get('/strip/Strip-9.9.9.zip')->assertNotFound();
    $this->get('/strip/Strip-9.9.9.md')->assertNotFound();
});
