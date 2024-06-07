<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\HomeController;

Auth::routes();

// Define the routes for the different pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/accounts', [AccountController::class, 'index'])->name('accounts')->middleware('auth');
Route::get('/transfer', [TransferController::class, 'create'])->name('transfer')->middleware('auth');
Route::post('/transfer', [TransferController::class, 'store'])->middleware('auth');
