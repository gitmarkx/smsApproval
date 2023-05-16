<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication related routes
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function(){
    // Dashboard related routes
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');
    
    // Application related routes
    Route::get('/application', [ApplicationController::class, 'index'])->name('application');
    Route::get('/application/create', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('/application/create', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('/searchCustomer/{term}', [ApplicationController::class, 'searchCustomer'])->name('application.searchCustomer');

    // Profile related routes
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/profile/{user}', [ProfileController::class, 'updateProfile'])->name('profile.update');

});


Route::middleware(['auth', 'auth.type:Admin'])->group(function(){
    // User related routes
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/edit/{user}', [UserController::class, 'update'])->name('user.update');
    
    // Branch related routes
    Route::get('/branch', [BranchController::class, 'index'])->name('branch');
    Route::get('/branch/create', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch/create', [BranchController::class, 'store'])->name('branch.store');
    Route::get('/branch/edit/{branch}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::put('/branch/update/{branch}', [BranchController::class, 'update'])->name('branch.update');
});