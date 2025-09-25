<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/admin', function () {
    return 'Admin page - only for admins';
})->middleware('can:viewAdminPage');

// User related routes
Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login');
Route::post('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');
Route::get('/manage-avatar', [UserController::class, 'showAvatarForm'])->middleware('mustBeLoggedIn');
Route::post('/manage-avatar', [UserController::class, 'storeAvatar'])->middleware('mustBeLoggedIn');

// Blog related routes
Route::get('/create-post', [PostController::class, 'showPostForm'])->middleware('mustBeLoggedIn');
Route::post('/create-post', [PostController::class, 'submitNewPost'])->middleware('mustBeLoggedIn');
Route::get('/post/{post}', [PostController::class, 'viewSinglePost']);
Route::delete('/post/{post}', [PostController::class, 'deletePost'])->middleware('can:delete,post');
Route::get('/post/{post}/edit', [PostController::class, 'editPostForm'])->middleware('can:update,post');
Route::put('/post/{post}', [PostController::class, 'submitEditPost'])->middleware('can:update,post');

// Profile related routes
Route::get('/profile/{user:username}', [UserController::class, 'userProfile']);
