<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class);

Route::get('/', [SiteController::class, 'index'])->name('site.index')->middleware('logged.user');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('logged.user');
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth')->middleware('logged.user');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::get('/register', [LoginController::class, 'create'])->name('login.create')->middleware('logged.user');

Route::prefix('exchange')->group(function () {
    Route::get('/symbols', [ExchangeController::class, 'symbols'])->name('exchange.symbols');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');
Route::get('/dashboard/get/tokens', [DashboardController::class, 'searchTokens'])->name('dashboard.get.tokens')->middleware('auth');

Route::View('/dashboard/add/symbol', 'dashboard.add-symbol')->name('dashboard.add.symbol')->middleware('auth');
