<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\Frozen\FrozenAppcastController;
use App\Http\Controllers\Frozen\FrozenReleaseAssetController;
use App\Http\Controllers\GivenTalksController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Strip\StripAppcastController;
use App\Http\Controllers\Strip\StripReleaseAssetController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/feed', FeedController::class)->name('feed');
Route::get('/given-talks', GivenTalksController::class)->name('given-talks');
Route::get('/strip/appcast.rss', StripAppcastController::class)->name('strip.appcast');
Route::get('/strip/Strip-{release:version}.zip', [StripReleaseAssetController::class, 'archive'])
    ->where('release', '[0-9]+\.[0-9]+\.[0-9]+')
    ->name('strip.release.archive');
Route::get('/strip/Strip-{release:version}.md', [StripReleaseAssetController::class, 'notes'])
    ->where('release', '[0-9]+\.[0-9]+\.[0-9]+')
    ->name('strip.release.notes');
Route::get('/frozen/appcast.rss', FrozenAppcastController::class)->name('frozen.appcast');
Route::get('/frozen/Frozen-{release:version}.zip', [FrozenReleaseAssetController::class, 'archive'])
    ->where('release', '[0-9]+\.[0-9]+\.[0-9]+')
    ->name('frozen.release.archive');
Route::get('/frozen/Frozen-{release:version}.md', [FrozenReleaseAssetController::class, 'notes'])
    ->where('release', '[0-9]+\.[0-9]+\.[0-9]+')
    ->name('frozen.release.notes');
Route::get('/{post:slug}', PostController::class)->name('post.detail');
