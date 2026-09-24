<?php

use App\Http\Controllers\Frozen\PublishFrozenReleaseController;
use App\Http\Controllers\Strip\PublishStripReleaseController;
use App\Http\Middleware\EnsureFrozenPublisherToken;
use App\Http\Middleware\EnsureStripPublisherToken;
use Illuminate\Support\Facades\Route;

Route::post('/strip/releases', PublishStripReleaseController::class)
    ->middleware([EnsureStripPublisherToken::class, 'throttle:strip-publisher'])
    ->name('strip.releases.publish');

Route::post('/frozen/releases', PublishFrozenReleaseController::class)
    ->middleware([EnsureFrozenPublisherToken::class, 'throttle:frozen-publisher'])
    ->name('frozen.releases.publish');
