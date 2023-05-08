<?php

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

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/profile/{user}', [ProfileController::class, 'updateProfile'])->name('profile.update');

});


Route::middleware(['auth', 'auth.type:Admin'])->group(function(){
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{user}', [UserController::class, 'show'])->name('user.show');
    Route::put('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
});