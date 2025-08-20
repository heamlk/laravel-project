<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

Route::get('/', [PagesController::class, 'homepage']);
Route::get('/about', [PagesController::class, 'about']);
