<?php

use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class);

Route::get('/', [SiteController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::get('/register', [LoginController::class, 'create'])->name('login.create');

Route::prefix('exchange')->group(function () {
    Route::get('/symbols', [ExchangeController::class, 'symbols'])->name('exchange.symbols');
});
