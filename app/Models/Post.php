<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope(fn ($builder) => $builder->where('is_active', true));
    }

    public function views(): HasMany
    {
        return $this->hasMany(PostViews::class);
    }
}
