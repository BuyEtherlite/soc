<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoccerController;

Route::get('/', function () {
    return view('welcome');
});

// Soccer routes
Route::prefix('soccer')->group(function () {
    // Main pages
    Route::get('/', [SoccerController::class, 'index'])->name('soccer.index');
    Route::get('/teams', [SoccerController::class, 'teams'])->name('soccer.teams');
    Route::get('/players', [SoccerController::class, 'players'])->name('soccer.players');
    
    // API endpoints
    Route::get('/api/ball', [SoccerController::class, 'ball'])->name('soccer.ball');
    Route::get('/api/teams', [SoccerController::class, 'teamsData'])->name('soccer.teams.data');
    Route::get('/api/players', [SoccerController::class, 'playersData'])->name('soccer.players.data');
    Route::get('/api/stats', [SoccerController::class, 'stats'])->name('soccer.stats');
    
    // Backward compatibility
    Route::get('/ball', [SoccerController::class, 'ball']);
});
