<?php

namespace App\Services\Strip;

use App\Models\StripRelease;

final readonly class PublishResult
{
    public function __construct(
        public StripRelease $release,
        public bool $created,
    ) {}
}
