<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $version
 * @property int $build
 * @property string $minimum_system_version
 * @property string|null $hardware_requirements
 * @property string $archive_path
 * @property int $archive_size
 * @property string $archive_sha256
 * @property string $archive_signature
 * @property string $notes_path
 * @property int $notes_size
 * @property string $notes_sha256
 * @property string $notes_signature
 * @property CarbonImmutable $published_at
 */
class StripRelease extends Model
{
    /** @var list<string> */
    protected $guarded = [];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'build' => 'integer',
            'archive_size' => 'integer',
            'notes_size' => 'integer',
            'published_at' => 'immutable_datetime',
        ];
    }

    /** @return HasOne<StripFeed, $this> */
    public function feed(): HasOne
    {
        return $this->hasOne(StripFeed::class, 'latest_release_id');
    }

    public function getRouteKeyName(): string
    {
        return 'version';
    }
}
