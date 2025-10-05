<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

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

// Follow related routes
Route::post('/create-follow/{user:username}', [FollowController::class, 'createFollow'])->middleware('mustBeLoggedIn');
Route::post('/remove-follow/{user:username}', [FollowController::class, 'removeFollow'])->middleware('mustBeLoggedIn');

// Blog related routes
Route::get('/create-post', [PostController::class, 'showPostForm'])->middleware('mustBeLoggedIn');
Route::post('/create-post', [PostController::class, 'submitNewPost'])->middleware('mustBeLoggedIn');
Route::get('/post/{post}', [PostController::class, 'viewSinglePost']);
Route::delete('/post/{post}', [PostController::class, 'deletePost'])->middleware('can:delete,post');
Route::get('/post/{post}/edit', [PostController::class, 'editPostForm'])->middleware('can:update,post');
Route::put('/post/{post}', [PostController::class, 'submitEditPost'])->middleware('can:update,post');

// Profile related routes
Route::get('/profile/{user:username}', [UserController::class, 'userProfile'])->name('profile.posts');
Route::get('/profile/{user:username}/followers', [UserController::class, 'userProfileFollowers'])->name('profile.followers');
Route::get('/profile/{user:username}/following', [UserController::class, 'userProfileFollowing'])->name('profile.following');
