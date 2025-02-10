<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XmlFileMaker;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;


//Guest Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [FormController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [FormController::class, 'register']);
Route::get('/login', [FormController::class, 'showLoginForm'])->name('login');
Route::post('/login', [FormController::class, 'login']);
Route::get('/xml-maker', [XmlFileMaker::class, 'xmlMaker'])->name('xml');

// Email Verification Routes
Route::get('/verify-email', [FormController::class, 'showVerifyEmailForm'])->name('verify.email');
Route::post('/verify-email', [FormController::class, 'verifyEmail']);
Route::get('/verify-email/{token}/{email}', [FormController::class, 'verifyEmailWithLink'])->name('verify.email.link');


//Protected Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [FormController::class, 'logout'])->name('logout');
});






