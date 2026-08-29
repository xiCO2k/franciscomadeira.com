<?php

namespace App\Http\Controllers\Strip;

use App\Http\Requests\PublishStripReleaseRequest;
use App\Services\Strip\InvalidStripRelease;
use App\Services\Strip\StripReleaseConflict;
use App\Services\Strip\StripReleasePublisher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;

class PublishStripReleaseController
{
    public function __invoke(
        PublishStripReleaseRequest $request,
        StripReleasePublisher $publisher,
    ): JsonResponse {
        try {
            $result = $publisher->publish(
                version: (string) $request->validated('version'),
                build: (int) $request->validated('build'),
                archive: $this->contents($request->file('archive')),
                notes: $this->contents($request->file('notes')),
                appcast: $this->contents($request->file('appcast')),
            );
        } catch (InvalidStripRelease $exception) {
            return response()->json(['message' => $exception->getMessage()], 422);
        } catch (StripReleaseConflict $exception) {
            return response()->json(['message' => $exception->getMessage()], 409);
        }

        return response()->json([
            'data' => [
                'version' => $result->release->version,
                'build' => $result->release->build,
                'archive_sha256' => $result->release->archive_sha256,
                'notes_sha256' => $result->release->notes_sha256,
                'published_at' => $result->release->published_at->toIso8601String(),
            ],
        ], $result->created ? 201 : 200);
    }

    private function contents(UploadedFile|array|null $file): string
    {
        if (! $file instanceof UploadedFile) {
            throw new InvalidStripRelease('A release upload is missing.');
        }

        $contents = $file->get();
        if ($contents === false) {
            throw new InvalidStripRelease('A release upload could not be read.');
        }

        return $contents;
    }
}
