<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('welcome');
});







Route::get('/', function () {
    return view('welcome');
});


Route::get('/', function () {
    return view('auth.dashboard');
});

Route::get('/register', [FormController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [FormController::class, 'register']);

Route::get('/login', [FormController::class, 'showLoginForm'])->name('login');
Route::post('/login', [FormController::class, 'login']);

Route::post('/logout', [FormController::class, 'logout'])->name('logout')->middleware('auth');



