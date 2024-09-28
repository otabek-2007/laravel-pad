<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DebtorController;
use App\Http\Controllers\ContactController; // Make sure to import the ContactController
use App\Http\Controllers\PaymentController;

// User routes
Route::get('/', function () {
    return redirect('/user/login');
});
Route::prefix('/user')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/store', [AuthController::class, 'store'])->name('store');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/update', [AuthController::class, 'update'])->name('update');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
    Route::get('/profile', [AuthController::class, 'show'])->name('profile.show');
});

// Language change route
Route::post('/change-language', [LanguageController::class, 'changeLanguage'])->name('change.language');

// Debtor routes
Route::prefix('/debtor')->middleware('auth:sanctum')->group(function () {
    Route::get('/show', [DebtorController::class, 'index'])->name('debtor.index');
    Route::get('/payment/{id}', [DebtorController::class, 'show'])->name('debtor.show');
    Route::post('/store', [DebtorController::class, 'store'])->name('debtor.store');
});
Route::prefix('/payment')->middleware('auth:sanctum')->group(function () {
    Route::post('/store', [PaymentController::class, 'store'])->name('payment.store');
});

