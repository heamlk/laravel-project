<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;

Route::get('/', [PagesController::class, 'homepage']);
Route::get('/exempla-post', [PagesController::class, 'single']);

Route::post('/register', [UserController::class, 'register']);
