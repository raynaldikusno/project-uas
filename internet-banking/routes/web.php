<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

    Route::get('/accounts', [AccountController::class, 'index'])->name('accounts')->middleware('auth');
    Route::get('/account', [AccountController::class, 'show'])->name('account.show');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');

    Route::get('/transfer', [TransferController::class, 'create'])->name('transfer')->middleware('auth');
    Route::post('/transfer', [TransferController::class, 'store'])->middleware('auth');
    Route::post('/transfer', [TransferController::class, 'store'])->name('transfer.store');

    Route::middleware(['auth'])->group(function () {
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/topup', [ProfileController::class, 'topup'])->name('profile.topup');
        Route::post('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');

        Route::get('/transfers/create', [TransferController::class, 'create'])->name('transfers.create');




    });

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

require __DIR__.'/auth.php';
