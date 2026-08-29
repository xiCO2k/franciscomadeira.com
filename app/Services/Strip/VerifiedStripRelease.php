<?php

namespace App\Services\Strip;

use DateTimeImmutable;

final readonly class VerifiedStripRelease
{
    public function __construct(
        public string $version,
        public int $build,
        public string $minimumSystemVersion,
        public ?string $hardwareRequirements,
        public int $archiveSize,
        public string $archiveSha256,
        public string $archiveSignature,
        public int $notesSize,
        public string $notesSha256,
        public string $notesSignature,
        public string $feedSha256,
        public int $feedSignedLength,
        public string $feedSignature,
        public DateTimeImmutable $publishedAt,
    ) {}
}
