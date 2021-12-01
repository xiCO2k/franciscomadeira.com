<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::get('/about', AboutController::class)->name('about');
Route::get('/{post:slug}', PostController::class)->name('post.detail');
