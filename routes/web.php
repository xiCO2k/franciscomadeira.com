<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::get('/{post:slug}', PostController::class)->name('post.detail');
