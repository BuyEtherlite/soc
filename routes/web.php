<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoccerController;

Route::get('/', function () {
    return view('welcome');
});

// Soccer routes
Route::get('/soccer', [SoccerController::class, 'index'])->name('soccer.index');
Route::get('/soccer/ball', [SoccerController::class, 'ball'])->name('soccer.ball');
