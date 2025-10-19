<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::post('/login', [UserController::class, 'loginApi']);

Route::post('/create-post', [PostController::class, 'submitNewPostApi'])
    ->middleware('auth:sanctum');
Route::delete('/delete-post/{post}', [PostController::class, 'deletePostApi'])
    ->middleware('auth:sanctum', 'can:delete,post');
