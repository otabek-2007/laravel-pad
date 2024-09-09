<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DebtorController;

Route::prefix('/user')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/store', [AuthController::class, 'store'])->name('store');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/update', [AuthController::class, 'update'])->name('update');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
    Route::get('/profile', [AuthController::class, 'show'])->name('profile.show');
});

Route::post('/change-language', [LanguageController::class, 'changeLanguage'])->name('change.language');

Route::prefix('/debtor')->middleware('auth:sanctum')->group(function () {
    Route::get('/show', [DebtorController::class, 'index'])->name('debtor.index');
    Route::get('/create', [DebtorController::class, 'create'])->name('debtor.create');
    Route::post('/store', [DebtorController::class, 'store'])->name('debtors.store');
});
