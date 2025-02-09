<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;


//Guest Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [FormController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [FormController::class, 'register']);
Route::get('/login', [FormController::class, 'showLoginForm'])->name('login');
Route::post('/login', [FormController::class, 'login']);


//Protected Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [FormController::class, 'logout'])->name('logout');
});






