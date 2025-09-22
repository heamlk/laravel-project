<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// User related routes
Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login');
Route::post('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');

// Blog related routes
Route::get('/create-post', [PostController::class, 'createPostForm'])->middleware('mustBeLoggedIn');;
Route::post('/create-post', [PostController::class, 'submitNewPost'])->middleware('mustBeLoggedIn');;
Route::get('/post/{post}', [PostController::class, 'viewSinglePost']);
