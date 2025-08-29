<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

Route::get('/', [PagesController::class, 'homepage']);
Route::get('/exempla-post', [PagesController::class, 'single']);
