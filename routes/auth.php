<?php

use App\Http\Controllers\Auth\AuthenticateSessionController;
use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware('guest')->group(function(){
    Route::get('/', [AuthenticateSessionController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthenticateSessionController::class, 'login'])->name('auth');
});

Route::middleware('auth')->group(function(){
    Route::post('/logout', [AuthenticateSessionController::class, 'logout'])->name('logout');
    Route::put('/password/{user}', [ChangePasswordController::class, 'updatePassword'])->name('password.update');
});
