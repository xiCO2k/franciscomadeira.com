<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\GivenTalksController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/given-talks', GivenTalksController::class)->name('given-talks');
Route::get('/{post:slug}', PostController::class)->name('post.detail');
