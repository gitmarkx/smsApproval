<?php

use App\Http\Controllers\Auth\AuthenticateSessionController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware('guest')->group(function(){
    Route::get('/', [AuthenticateSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticateSessionController::class, 'store'])->name('auth');
    // Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    // Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    // Route::get('/reset-password/{token}', [PasswordResetLinkController::class, 'create'])->name('password.reset');
});

Route::middleware('auth')->group(function(){
    Route::post('/logout', [AuthenticateSessionController::class, 'destroy'])->name('logout');
    Route::put('/password/{user}', [ChangePasswordController::class, 'edit'])->name('password.update');
});
