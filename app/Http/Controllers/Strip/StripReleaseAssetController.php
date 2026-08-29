<?php

namespace App\Http\Controllers\Strip;

use App\Models\StripRelease;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StripReleaseAssetController
{
    public function archive(StripRelease $release): RedirectResponse|StreamedResponse
    {
        return $this->serve(
            release: $release,
            path: $release->archive_path,
            sha256: $release->archive_sha256,
            size: $release->archive_size,
            filename: "Strip-{$release->version}.zip",
            contentType: 'application/octet-stream',
            disposition: 'attachment',
        );
    }

    public function notes(StripRelease $release): RedirectResponse|StreamedResponse
    {
        return $this->serve(
            release: $release,
            path: $release->notes_path,
            sha256: $release->notes_sha256,
            size: $release->notes_size,
            filename: "Strip-{$release->version}.md",
            contentType: 'text/markdown; charset=utf-8',
            disposition: 'inline',
        );
    }

    private function serve(
        StripRelease $release,
        string $path,
        string $sha256,
        int $size,
        string $filename,
        string $contentType,
        string $disposition,
    ): RedirectResponse|StreamedResponse {
        abort_if($release->published_at->isFuture(), 404);

        $disk = Storage::disk((string) config('strip.storage_disk'));
        abort_unless($disk->exists($path), 404);

        if ((bool) config('strip.temporary_urls', true)) {
            $url = $disk->temporaryUrl(
                $path,
                now()->addMinutes((int) config('strip.temporary_url_minutes', 5)),
                [
                    'ResponseContentType' => $contentType,
                    'ResponseContentDisposition' => "{$disposition}; filename=\"{$filename}\"",
                    'ResponseCacheControl' => 'public, max-age=31536000, immutable',
                ],
            );

            return redirect()->away($url)->withHeaders([
                'Cache-Control' => 'private, no-store',
                'X-Content-Type-Options' => 'nosniff',
            ]);
        }

        return $this->stream($disk, $path, $sha256, $size, $filename, $contentType, $disposition);
    }

    private function stream(
        FilesystemAdapter $disk,
        string $path,
        string $sha256,
        int $size,
        string $filename,
        string $contentType,
        string $disposition,
    ): StreamedResponse {
        return response()->stream(function () use ($disk, $path): void {
            $stream = $disk->readStream($path);

            try {
                fpassthru($stream);
            } finally {
                fclose($stream);
            }
        }, 200, [
            'Content-Type' => $contentType,
            'Content-Length' => (string) $size,
            'Content-Disposition' => "{$disposition}; filename=\"{$filename}\"",
            'Cache-Control' => 'public, max-age=31536000, immutable',
            'ETag' => '"'.$sha256.'"',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
