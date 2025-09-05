<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;

Route::get('/exempla-post', [PagesController::class, 'single']);

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/', [UserController::class, 'showCorrectHomepage']);
