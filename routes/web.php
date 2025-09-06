<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// User related routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/', [UserController::class, 'showCorrectHomepage']);

// Blog related routes
Route::get('/create-post', [PostController::class, 'createPostForm']);
Route::post('/create-post', [PostController::class, 'submitNewPost']);
