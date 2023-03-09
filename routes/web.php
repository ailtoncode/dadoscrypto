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
Route::get('/register', [UserController::class, 'create'])->name('login.create')->middleware('logged.user');

Route::prefix('exchange')->group(function () {
    Route::get('/symbols', [ExchangeController::class, 'symbols'])->name('exchange.symbols');
    Route::get('/store', [ExchangeController::class, 'store'])->name('exchange.store');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');
Route::get('/currency/search', [DashboardController::class, 'searchCurrency'])->name('currency.search')->middleware('auth');
Route::get('/{broker}/currency/{symbol}', [DashboardController::class, 'show'])->name('history.show')->middleware('auth');
Route::post('/currency/store', [DashboardController::class, 'store'])->name('currency.store')->middleware('auth');

Route::View('/symbol/add', 'dashboard.add-symbol')->name('symbol.add')->middleware('auth');
