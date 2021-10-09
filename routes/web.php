<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserApplicationController;



Auth::routes();
//user login,register,logout panal

Route::post('/register', [HomeController::class, 'register'])->name('register');
// Route::post('/login', [HomeController::class, 'login'])->name('login.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    //user application panal
    Route::resource('/userapplication', UserApplicationController::class);
});


