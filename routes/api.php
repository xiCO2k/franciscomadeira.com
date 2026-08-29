<?php

use App\Http\Controllers\Strip\PublishStripReleaseController;
use App\Http\Middleware\EnsureStripPublisherToken;
use Illuminate\Support\Facades\Route;

Route::post('/strip/releases', PublishStripReleaseController::class)
    ->middleware([EnsureStripPublisherToken::class, 'throttle:strip-publisher'])
    ->name('strip.releases.publish');
