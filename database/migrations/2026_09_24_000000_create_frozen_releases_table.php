<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('frozen_releases', function (Blueprint $table): void {
            $table->id();
            $table->string('version', 32)->unique();
            $table->unsignedBigInteger('build')->unique();
            $table->string('minimum_system_version', 32);
            $table->string('hardware_requirements', 64)->nullable();
            $table->string('archive_path');
            $table->unsignedBigInteger('archive_size');
            $table->char('archive_sha256', 64);
            $table->string('archive_signature', 128);
            $table->string('notes_path');
            $table->unsignedBigInteger('notes_size');
            $table->char('notes_sha256', 64);
            $table->string('notes_signature', 128);
            $table->timestampTz('published_at')->index();
            $table->timestamps();
        });

        Schema::create('frozen_feeds', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('latest_release_id')
                ->unique()
                ->constrained('frozen_releases')
                ->restrictOnDelete();
            $table->longText('xml');
            $table->char('sha256', 64)->unique();
            $table->unsignedInteger('signed_length');
            $table->string('signature', 128);
            $table->timestampTz('published_at')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('frozen_feeds');
        Schema::dropIfExists('frozen_releases');
    }
};
