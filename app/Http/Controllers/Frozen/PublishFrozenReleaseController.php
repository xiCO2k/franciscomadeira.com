<?php

namespace App\Http\Controllers\Frozen;

use App\Http\Requests\PublishFrozenReleaseRequest;
use App\Services\Frozen\FrozenReleaseConflict;
use App\Services\Frozen\FrozenReleasePublisher;
use App\Services\Frozen\InvalidFrozenRelease;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;

class PublishFrozenReleaseController
{
    public function __invoke(
        PublishFrozenReleaseRequest $request,
        FrozenReleasePublisher $publisher,
    ): JsonResponse {
        try {
            $result = $publisher->publish(
                version: (string) $request->validated('version'),
                build: (int) $request->validated('build'),
                archive: $this->contents($request->file('archive')),
                notes: $this->contents($request->file('notes')),
                appcast: $this->contents($request->file('appcast')),
            );
        } catch (InvalidFrozenRelease $exception) {
            return response()->json(['message' => $exception->getMessage()], 422);
        } catch (FrozenReleaseConflict $exception) {
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
            throw new InvalidFrozenRelease('A release upload is missing.');
        }

        $contents = $file->get();
        if ($contents === false) {
            throw new InvalidFrozenRelease('A release upload could not be read.');
        }

        return $contents;
    }
}
