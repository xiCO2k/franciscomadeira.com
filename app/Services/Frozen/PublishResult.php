<?php

namespace App\Services\Frozen;

use App\Models\FrozenRelease;

final readonly class PublishResult
{
    public function __construct(
        public FrozenRelease $release,
        public bool $created,
    ) {}
}
