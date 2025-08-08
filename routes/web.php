<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\ClaimController;

Route::get('/', function () {
    return view('welcome');
});

// User Dashboard Routes (requires authentication and user role)
Route::middleware(['auth', 'role:user'])->prefix('dashboard')->name('user.')->group(function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('index');
    Route::get('/insurance-packages', [UserDashboardController::class, 'insurancePackages'])->name('insurance-packages');
    Route::get('/my-policies', [UserDashboardController::class, 'myPolicies'])->name('my-policies');
    Route::get('/mlm-network', [UserDashboardController::class, 'mlmNetwork'])->name('mlm-network');
    Route::get('/commissions', [UserDashboardController::class, 'commissions'])->name('commissions');
    Route::get('/ai-advisor', [UserDashboardController::class, 'aiAdvisor'])->name('ai-advisor');
    Route::post('/daily-checkin', [UserDashboardController::class, 'dailyCheckIn'])->name('daily-checkin');
});

// Admin Dashboard Routes (requires authentication and admin role)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    Route::get('/insurance-packages', [AdminDashboardController::class, 'insurancePackages'])->name('insurance-packages');
    Route::get('/claims', [AdminDashboardController::class, 'claims'])->name('claims');
    Route::post('/claims/{claim}/approve', [AdminDashboardController::class, 'approveClaim'])->name('claims.approve');
    Route::post('/claims/{claim}/reject', [AdminDashboardController::class, 'rejectClaim'])->name('claims.reject');
    Route::get('/financials', [AdminDashboardController::class, 'financials'])->name('financials');
    Route::post('/withdrawals/{commission}/approve', [AdminDashboardController::class, 'approveWithdrawal'])->name('withdrawals.approve');
    Route::get('/ranks', [AdminDashboardController::class, 'ranks'])->name('ranks');
    Route::get('/analytics', [AdminDashboardController::class, 'analytics'])->name('analytics');
    Route::get('/settings', [AdminDashboardController::class, 'settings'])->name('settings');
});

// Insurance Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/insurance/{package}', [InsuranceController::class, 'show'])->name('insurance.show');
    Route::post('/insurance/{package}/purchase', [InsuranceController::class, 'purchase'])->name('insurance.purchase');
});

// Claim Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/claims/create/{policy}', [ClaimController::class, 'create'])->name('claims.create');
    Route::post('/claims', [ClaimController::class, 'store'])->name('claims.store');
    Route::get('/claims/{claim}', [ClaimController::class, 'show'])->name('claims.show');
    Route::put('/claims/{claim}', [ClaimController::class, 'update'])->name('claims.update');
});
