<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $latest_release_id
 * @property string $xml
 * @property string $sha256
 * @property int $signed_length
 * @property string $signature
 * @property CarbonImmutable $published_at
 */
class StripFeed extends Model
{
    /** @var list<string> */
    protected $guarded = [];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'signed_length' => 'integer',
            'published_at' => 'immutable_datetime',
        ];
    }

    /** @return BelongsTo<StripRelease, $this> */
    public function latestRelease(): BelongsTo
    {
        return $this->belongsTo(StripRelease::class, 'latest_release_id');
    }
}
