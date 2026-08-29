<?php

namespace App\Services\Strip;

use App\Models\StripFeed;
use App\Models\StripRelease;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StripReleasePublisher
{
    public function __construct(private SparkleReleaseVerifier $verifier) {}

    public function publish(
        string $version,
        int $build,
        string $archive,
        string $notes,
        string $appcast,
    ): PublishResult {
        $verified = $this->verifier->verify($version, $build, $archive, $notes, $appcast);
        $archivePath = "strip/releases/{$build}/Strip-{$version}.zip";
        $notesPath = "strip/releases/{$build}/Strip-{$version}.md";

        $existing = StripRelease::query()
            ->where('version', $version)
            ->orWhere('build', $build)
            ->first();

        if ($existing !== null) {
            $this->assertIdempotent($existing, $verified, $archivePath, $notesPath, $appcast);
        }

        $disk = Storage::disk((string) config('strip.storage_disk'));
        $this->putImmutable(
            $disk,
            $archivePath,
            $archive,
            $verified->archiveSha256,
            'application/zip',
        );
        $this->putImmutable(
            $disk,
            $notesPath,
            $notes,
            $verified->notesSha256,
            'text/markdown; charset=utf-8',
        );

        if ($existing !== null) {
            return new PublishResult($existing, false);
        }

        return DB::transaction(function () use (
            $verified,
            $archivePath,
            $notesPath,
            $appcast,
        ): PublishResult {
            $latest = StripRelease::query()->lockForUpdate()->orderByDesc('build')->first();
            if ($latest !== null && $verified->build <= $latest->build) {
                throw new StripReleaseConflict(
                    "Build {$verified->build} is not newer than published build {$latest->build}.",
                );
            }

            $collision = StripRelease::query()
                ->where('version', $verified->version)
                ->orWhere('build', $verified->build)
                ->first();
            if ($collision !== null) {
                throw new StripReleaseConflict('The release version or build is already registered.');
            }

            $release = StripRelease::query()->create([
                'version' => $verified->version,
                'build' => $verified->build,
                'minimum_system_version' => $verified->minimumSystemVersion,
                'hardware_requirements' => $verified->hardwareRequirements,
                'archive_path' => $archivePath,
                'archive_size' => $verified->archiveSize,
                'archive_sha256' => $verified->archiveSha256,
                'archive_signature' => $verified->archiveSignature,
                'notes_path' => $notesPath,
                'notes_size' => $verified->notesSize,
                'notes_sha256' => $verified->notesSha256,
                'notes_signature' => $verified->notesSignature,
                'published_at' => $verified->publishedAt,
            ]);

            StripFeed::query()->create([
                'latest_release_id' => $release->id,
                'xml' => $appcast,
                'sha256' => $verified->feedSha256,
                'signed_length' => $verified->feedSignedLength,
                'signature' => $verified->feedSignature,
                'published_at' => $verified->publishedAt,
            ]);

            return new PublishResult($release, true);
        });
    }

    private function assertIdempotent(
        StripRelease $release,
        VerifiedStripRelease $verified,
        string $archivePath,
        string $notesPath,
        string $appcast,
    ): void {
        $sameRelease = $release->version === $verified->version
            && $release->build === $verified->build
            && $release->archive_path === $archivePath
            && $release->archive_size === $verified->archiveSize
            && hash_equals($release->archive_sha256, $verified->archiveSha256)
            && hash_equals($release->archive_signature, $verified->archiveSignature)
            && $release->notes_path === $notesPath
            && $release->notes_size === $verified->notesSize
            && hash_equals($release->notes_sha256, $verified->notesSha256)
            && hash_equals($release->notes_signature, $verified->notesSignature);

        $feed = $release->feed()->first();
        $sameFeed = $feed !== null
            && hash_equals($feed->sha256, $verified->feedSha256)
            && hash_equals($feed->xml, $appcast);

        if (! $sameRelease || ! $sameFeed) {
            throw new StripReleaseConflict('A different release already uses this version or build.');
        }
    }

    private function putImmutable(
        FilesystemAdapter $disk,
        string $path,
        string $content,
        string $sha256,
        string $contentType,
    ): void {
        if ($disk->exists($path)) {
            $existing = $disk->get($path);
            if (! hash_equals($sha256, hash('sha256', $existing))) {
                throw new StripReleaseConflict("Storage already contains different bytes at {$path}.");
            }

            return;
        }

        $written = $disk->put($path, $content, [
            'visibility' => 'private',
            'ContentType' => $contentType,
            'CacheControl' => 'public, max-age=31536000, immutable',
        ]);

        if (! $written) {
            throw new InvalidStripRelease("Unable to store {$path}.");
        }
    }
}
