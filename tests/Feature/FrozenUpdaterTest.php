<?php

use Carbon\CarbonImmutable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $keyPair = sodium_crypto_sign_seed_keypair(str_repeat("\x0b", SODIUM_CRYPTO_SIGN_SEEDBYTES));

    config([
        'frozen.public_key' => base64_encode(sodium_crypto_sign_publickey($keyPair)),
        'frozen.publisher_token' => 'test-publisher-token',
        'frozen.storage_disk' => 'frozen_releases',
        'frozen.temporary_urls' => false,
    ]);

    Storage::fake('frozen_releases');
});

function frozenReleasePayload(
    string $version = '0.6.14',
    int $build = 14,
    string $salt = '',
    string $publishedAt = 'Sat, 29 Aug 2026 14:00:00 +0100',
): array {
    $keyPair = sodium_crypto_sign_seed_keypair(str_repeat("\x0b", SODIUM_CRYPTO_SIGN_SEEDBYTES));
    $secretKey = sodium_crypto_sign_secretkey($keyPair);
    $archive = "signed Frozen archive {$version} {$salt}";
    $notes = "## What's new in {$version}\n\nA signed test update. {$salt}\n";
    $archiveSignature = base64_encode(sodium_crypto_sign_detached($archive, $secretKey));
    $notesSignature = base64_encode(sodium_crypto_sign_detached($notes, $secretKey));
    $baseUrl = rtrim((string) config('frozen.base_url'), '/');
    $notesLength = strlen($notes);
    $archiveLength = strlen($archive);

    $body = <<<XML
<?xml version="1.0" standalone="yes"?>
<rss xmlns:sparkle="http://www.andymatuschak.org/xml-namespaces/sparkle" version="2.0">
    <channel>
        <title>Frozen</title>
        <item>
            <title>{$version}</title>
            <pubDate>{$publishedAt}</pubDate>
            <link>https://franciscomadeira.com</link>
            <sparkle:version>{$build}</sparkle:version>
            <sparkle:shortVersionString>{$version}</sparkle:shortVersionString>
            <sparkle:minimumSystemVersion>15.0</sparkle:minimumSystemVersion>
            <sparkle:hardwareRequirements>arm64</sparkle:hardwareRequirements>
            <sparkle:releaseNotesLink sparkle:edSignature="{$notesSignature}" sparkle:length="{$notesLength}">{$baseUrl}/Frozen-{$version}.md</sparkle:releaseNotesLink>
            <enclosure url="{$baseUrl}/Frozen-{$version}.zip" length="{$archiveLength}" type="application/octet-stream" sparkle:edSignature="{$archiveSignature}"/>
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
        'archive' => UploadedFile::fake()->createWithContent("Frozen-{$version}.zip", $archive),
        'notes' => UploadedFile::fake()->createWithContent("Frozen-{$version}.md", $notes),
        'appcast' => UploadedFile::fake()->createWithContent('appcast.rss', $appcast),
        '_archive' => $archive,
        '_notes' => $notes,
        '_appcast' => $appcast,
    ];
}

function publishFrozenRelease(array $payload)
{
    return test()->withToken('test-publisher-token')->post('/api/frozen/releases', [
        'version' => $payload['version'],
        'build' => $payload['build'],
        'archive' => $payload['archive'],
        'notes' => $payload['notes'],
        'appcast' => $payload['appcast'],
    ]);
}

it('requires the private publisher token', function () {
    $payload = frozenReleasePayload();

    $this->post('/api/frozen/releases', $payload)->assertUnauthorized();
});

it('publishes a cryptographically verified release and signed feed', function () {
    $payload = frozenReleasePayload();

    publishFrozenRelease($payload)
        ->assertCreated()
        ->assertJsonPath('data.version', '0.6.14')
        ->assertJsonPath('data.build', 14)
        ->assertJsonPath('data.archive_sha256', hash('sha256', $payload['_archive']));

    $this->assertDatabaseHas('frozen_releases', [
        'version' => '0.6.14',
        'build' => 14,
        'archive_sha256' => hash('sha256', $payload['_archive']),
        'notes_sha256' => hash('sha256', $payload['_notes']),
    ]);
    $this->assertDatabaseHas('frozen_feeds', [
        'sha256' => hash('sha256', $payload['_appcast']),
    ]);
    Storage::disk('frozen_releases')->assertExists([
        'frozen/releases/14/Frozen-0.6.14.zip',
        'frozen/releases/14/Frozen-0.6.14.md',
    ]);

    $this->get('/frozen/appcast.rss')
        ->assertOk()
        ->assertHeader('Content-Type', 'application/rss+xml; charset=utf-8')
        ->assertHeader('Cache-Control', 'max-age=300, must-revalidate, public')
        ->assertContent($payload['_appcast']);

    $archive = $this->get('/frozen/Frozen-0.6.14.zip');
    $archive->assertOk()
        ->assertHeader('Content-Type', 'application/octet-stream')
        ->assertHeader('Cache-Control', 'immutable, max-age=31536000, public');
    expect($archive->streamedContent())->toBe($payload['_archive']);

    $notes = $this->get('/frozen/Frozen-0.6.14.md');
    $notes->assertOk()->assertHeader('Content-Type', 'text/markdown; charset=utf-8');
    expect($notes->streamedContent())->toBe($payload['_notes']);
});

it('normalizes offset publication dates to UTC before persistence', function () {
    CarbonImmutable::setTestNow('2026-08-29T17:00:01+00:00');

    try {
        $payload = frozenReleasePayload(
            publishedAt: 'Sat, 29 Aug 2026 18:00:00 +0100',
        );

        publishFrozenRelease($payload)->assertCreated();

        $this->assertDatabaseHas('frozen_releases', [
            'version' => '0.6.14',
            'published_at' => '2026-08-29 17:00:00',
        ]);
        $this->get('/frozen/Frozen-0.6.14.zip')->assertOk();
    } finally {
        CarbonImmutable::setTestNow();
    }
});

it('is idempotent for byte-identical releases', function () {
    $first = frozenReleasePayload();
    publishFrozenRelease($first)->assertCreated();

    $second = frozenReleasePayload();
    publishFrozenRelease($second)->assertOk();

    $this->assertDatabaseCount('frozen_releases', 1);
    $this->assertDatabaseCount('frozen_feeds', 1);
});

it('rejects an archive whose Sparkle signature does not match', function () {
    $payload = frozenReleasePayload();
    $payload['archive'] = UploadedFile::fake()->createWithContent('Frozen-0.6.14.zip', 'tampered');

    publishFrozenRelease($payload)
        ->assertUnprocessable()
        ->assertJsonPath('message', 'The archive length in the appcast does not match the upload.');

    $this->assertDatabaseCount('frozen_releases', 0);
});

it('rejects a modified signed appcast', function () {
    $payload = frozenReleasePayload();
    $tampered = str_replace('15.0', '14.0', $payload['_appcast']);
    $payload['appcast'] = UploadedFile::fake()->createWithContent('appcast.rss', $tampered);

    publishFrozenRelease($payload)
        ->assertUnprocessable()
        ->assertJsonPath('message', 'The appcast signature is invalid.');
});

it('rejects version and build reuse with different signed bytes', function () {
    publishFrozenRelease(frozenReleasePayload())->assertCreated();

    publishFrozenRelease(frozenReleasePayload(salt: 'different'))
        ->assertConflict()
        ->assertJsonPath('message', 'A different release already uses this version or build.');
});

it('serves only registered release assets', function () {
    $this->get('/frozen/Frozen-9.9.9.zip')->assertNotFound();
    $this->get('/frozen/Frozen-9.9.9.md')->assertNotFound();
});
