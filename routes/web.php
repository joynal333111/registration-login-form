<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\FormMiddleware;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;


//Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [FormController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [FormController::class, 'register']);
    Route::get('/login', [FormController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [FormController::class, 'login']);
    Route::get('/verify-email', [FormController::class, 'showVerifyEmailForm'])->name('verify.email');
    Route::post('/verify-email', [FormController::class, 'verifyEmail']);
});


// Email Verification Routes
Route::get('/verify-email', [FormController::class, 'showVerifyEmailForm'])->name('verify.email');
Route::post('/verify-email', [FormController::class, 'verifyEmail']);
Route::get('/verify-email/{token}/{email}', [FormController::class, 'verifyEmailWithLink'])->name('verify.email.link');


//Protected Routes
Route::prefix('admin')->middleware([FormMiddleware::class, 'auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [FormController::class, 'logout'])->name('logout');
});






