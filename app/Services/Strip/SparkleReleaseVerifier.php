<?php

namespace App\Services\Strip;

use DateTimeImmutable;
use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;
use Throwable;

class SparkleReleaseVerifier
{
    private const SPARKLE_NAMESPACE = 'http://www.andymatuschak.org/xml-namespaces/sparkle';

    public function verify(
        string $version,
        int $build,
        string $archive,
        string $notes,
        string $appcast,
    ): VerifiedStripRelease {
        if (! preg_match('/^[0-9]+\.[0-9]+\.[0-9]+$/', $version) || $build < 1) {
            throw new InvalidStripRelease('The release version or build is invalid.');
        }

        $publicKey = $this->decodePublicKey((string) config('strip.public_key'));
        [$feedSignature, $signedLength] = $this->verifyFeedSignature($appcast, $publicKey);
        $xpath = $this->loadAppcast($appcast);

        if (str_contains(strtolower($appcast), 'github.com/xico2k/strip')) {
            throw new InvalidStripRelease('The appcast exposes the private source repository.');
        }

        $items = $xpath->query('/rss/channel/item');
        $maximumItems = (int) config('strip.maximum_feed_items', 3);
        if ($items === false || $items->count() < 1 || $items->count() > $maximumItems) {
            throw new InvalidStripRelease("The appcast must contain between one and {$maximumItems} releases.");
        }

        $item = $items->item(0);
        if (! $item instanceof DOMElement) {
            throw new InvalidStripRelease('The appcast does not have a latest release.');
        }

        $feedVersion = $this->elementText($xpath, './sparkle:shortVersionString', $item);
        $feedBuild = $this->elementText($xpath, './sparkle:version', $item);
        if ($feedVersion !== $version || $feedBuild !== (string) $build) {
            throw new InvalidStripRelease('The uploaded release must be the first item in the appcast.');
        }

        $expectedBaseUrl = rtrim((string) config('strip.base_url'), '/');
        $expectedArchiveUrl = "{$expectedBaseUrl}/Strip-{$version}.zip";
        $expectedNotesUrl = "{$expectedBaseUrl}/Strip-{$version}.md";

        $enclosure = $this->element($xpath, './enclosure', $item);
        if ($enclosure->getAttribute('url') !== $expectedArchiveUrl) {
            throw new InvalidStripRelease('The archive URL is not the stable Strip download URL.');
        }

        $archiveSize = $this->positiveInteger($enclosure->getAttribute('length'), 'archive length');
        if ($archiveSize !== strlen($archive)) {
            throw new InvalidStripRelease('The archive length in the appcast does not match the upload.');
        }

        $archiveSignature = $enclosure->getAttributeNS(self::SPARKLE_NAMESPACE, 'edSignature');
        $this->verifyDetachedSignature($archiveSignature, $archive, $publicKey, 'archive');

        $notesLink = $this->element($xpath, './sparkle:releaseNotesLink', $item);
        if (trim($notesLink->textContent) !== $expectedNotesUrl) {
            throw new InvalidStripRelease('The release notes URL is not the stable Strip notes URL.');
        }

        $notesSize = $this->positiveInteger(
            $notesLink->getAttributeNS(self::SPARKLE_NAMESPACE, 'length'),
            'release notes length',
        );
        if ($notesSize !== strlen($notes)) {
            throw new InvalidStripRelease('The release notes length in the appcast does not match the upload.');
        }

        $notesSignature = $notesLink->getAttributeNS(self::SPARKLE_NAMESPACE, 'edSignature');
        $this->verifyDetachedSignature($notesSignature, $notes, $publicKey, 'release notes');

        try {
            $publishedAt = new DateTimeImmutable($this->elementText($xpath, './pubDate', $item));
        } catch (Throwable) {
            throw new InvalidStripRelease('The appcast publication date is invalid.');
        }

        $hardwareRequirements = $this->optionalElementText(
            $xpath,
            './sparkle:hardwareRequirements',
            $item,
        );

        return new VerifiedStripRelease(
            version: $version,
            build: $build,
            minimumSystemVersion: $this->elementText($xpath, './sparkle:minimumSystemVersion', $item),
            hardwareRequirements: $hardwareRequirements,
            archiveSize: $archiveSize,
            archiveSha256: hash('sha256', $archive),
            archiveSignature: $archiveSignature,
            notesSize: $notesSize,
            notesSha256: hash('sha256', $notes),
            notesSignature: $notesSignature,
            feedSha256: hash('sha256', $appcast),
            feedSignedLength: $signedLength,
            feedSignature: $feedSignature,
            publishedAt: $publishedAt,
        );
    }

    /** @return array{string, int} */
    private function verifyFeedSignature(string $appcast, string $publicKey): array
    {
        $matched = preg_match(
            '/<!-- sparkle-signatures:\s*edSignature:\s*([A-Za-z0-9+\/=]+)\s*length:\s*([0-9]+)\s*-->\s*\z/',
            $appcast,
            $matches,
            PREG_OFFSET_CAPTURE,
        );

        if ($matched !== 1) {
            throw new InvalidStripRelease('The appcast is not signed.');
        }

        $signature = $matches[1][0];
        $signedLength = (int) $matches[2][0];
        $commentOffset = $matches[0][1];
        if ($signedLength !== $commentOffset) {
            throw new InvalidStripRelease('The appcast signed length is invalid.');
        }

        $this->verifyDetachedSignature(
            $signature,
            substr($appcast, 0, $signedLength),
            $publicKey,
            'appcast',
        );

        return [$signature, $signedLength];
    }

    private function loadAppcast(string $appcast): DOMXPath
    {
        $previous = libxml_use_internal_errors(true);

        try {
            $document = new DOMDocument;
            $document->resolveExternals = false;
            $document->substituteEntities = false;

            if (! $document->loadXML($appcast, LIBXML_NONET) || $document->doctype !== null) {
                throw new InvalidStripRelease('The appcast XML is invalid.');
            }

            $xpath = new DOMXPath($document);
            $xpath->registerNamespace('sparkle', self::SPARKLE_NAMESPACE);

            if ($this->elementText($xpath, '/rss/channel/title') !== 'Strip') {
                throw new InvalidStripRelease('The appcast channel is not Strip.');
            }

            return $xpath;
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
        }
    }

    private function decodePublicKey(string $encoded): string
    {
        $publicKey = base64_decode($encoded, true);
        if ($publicKey === false || strlen($publicKey) !== SODIUM_CRYPTO_SIGN_PUBLICKEYBYTES) {
            throw new InvalidStripRelease('The configured Sparkle public key is invalid.');
        }

        return $publicKey;
    }

    private function verifyDetachedSignature(
        string $encodedSignature,
        string $content,
        string $publicKey,
        string $label,
    ): void {
        $signature = base64_decode($encodedSignature, true);
        if ($signature === false || strlen($signature) !== SODIUM_CRYPTO_SIGN_BYTES) {
            throw new InvalidStripRelease("The {$label} signature is malformed.");
        }

        if (! sodium_crypto_sign_verify_detached($signature, $content, $publicKey)) {
            throw new InvalidStripRelease("The {$label} signature is invalid.");
        }
    }

    private function element(DOMXPath $xpath, string $expression, ?DOMNode $context = null): DOMElement
    {
        $nodes = $xpath->query($expression, $context);
        $node = $nodes === false ? null : $nodes->item(0);
        if (! $node instanceof DOMElement) {
            throw new InvalidStripRelease("The appcast is missing {$expression}.");
        }

        return $node;
    }

    private function elementText(DOMXPath $xpath, string $expression, ?DOMNode $context = null): string
    {
        $text = trim($this->element($xpath, $expression, $context)->textContent);
        if ($text === '') {
            throw new InvalidStripRelease("The appcast has an empty {$expression}.");
        }

        return $text;
    }

    private function optionalElementText(DOMXPath $xpath, string $expression, DOMNode $context): ?string
    {
        $nodes = $xpath->query($expression, $context);
        $node = $nodes === false ? null : $nodes->item(0);
        if (! $node instanceof DOMElement) {
            return null;
        }

        $text = trim($node->textContent);

        return $text === '' ? null : $text;
    }

    private function positiveInteger(string $value, string $label): int
    {
        if (! preg_match('/^[1-9][0-9]*$/', $value)) {
            throw new InvalidStripRelease("The {$label} is invalid.");
        }

        return (int) $value;
    }
}
