<?php

use App\Http\Controllers\ApplicationCheckController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserApplicationController;



Auth::routes();
//user login,register,logout panal

Route::post('/register', [HomeController::class, 'register'])->name('register');
Route::get('/register', [HomeController::class, 'registerIndex'])->name('register.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    //user application panal
    Route::resource('/userapplication', UserApplicationController::class);
    Route::get('/check-application-index', [ApplicationCheckController::class, 'index'])->name('check-application-index');

    Route::get('/update-status-panding/{id}', [ApplicationCheckController::class, 'updateStatusPanding'])->name('update.status.panding');
    Route::get('/update-status-accept/{id}', [ApplicationCheckController::class, 'updateStatusAccept'])->name('update.status.accept');
    Route::get('/update-status-reject/{id}', [ApplicationCheckController::class, 'updateStatusReject'])->name('update.status.reject');
    Route::get('/doc-open/{id}', [ApplicationCheckController::class, 'docOpen'])->name('doc.open');
});


