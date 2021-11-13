<?php

use App\Http\Controllers\ApplicationCheckController;
use App\Http\Controllers\ExtraController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Profilecontroller;
use App\Http\Controllers\UserApplicationController;



Auth::routes();
//user login,register,logout panal

Route::post('/register', [HomeController::class, 'register'])->name('register');
Route::get('/register', [HomeController::class, 'registerIndex'])->name('register.index');
Route::get('/code', [HomeController::class, 'codeIndex'])->name('code.index');
Route::post('/code', [HomeController::class, 'codeToLogin'])->name('code.to.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');


    //message section here
    Route::post('/set-message',[MessageController::class, 'sendMessage'])->name('set-message');
    Route::get('/get-message/{teacher_id}',[MessageController::class, 'getMessage'])->name('set-message');
    Route::get('/get-message-studentId/{student_id}',[MessageController::class, 'getMessageWithStudentId'])->name('get-message-student-message');
     // profile panel here...
     Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
     Route::post('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
     Route::post('/profile-password-change', [Profilecontroller::class, 'updatePassword'])->name('profile.update.password');
     Route::post('/profile-avater-update', [Profilecontroller::class, 'avaterUpdate'])->name('profile.avater.update');
     Route::get('/profile-delete', [Profilecontroller::class, 'delete'])->name('profile.delete');
    //user application panal
    Route::resource('/userapplication', UserApplicationController::class);
    Route::get('/check-application-index', [ApplicationCheckController::class, 'index'])->name('check-application-index');

    Route::get('/update-status-panding/{id}', [ApplicationCheckController::class, 'updateStatusPanding'])->name('update.status.panding');
    Route::get('/update-status-accept/{id}', [ApplicationCheckController::class, 'updateStatusAccept'])->name('update.status.accept');
    Route::get('/update-status-reject/{id}', [ApplicationCheckController::class, 'updateStatusReject'])->name('update.status.reject');
    Route::get('/doc-open/{id}', [ApplicationCheckController::class, 'docOpen'])->name('doc.open');
    Route::get('/pdf/{id}', [ExtraController::class, 'createPdf'])->name('make.pdf');
    Route::get('/downloadPDF',[ExtraController::class, 'downloadPDF']);
});


