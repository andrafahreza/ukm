<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UkmController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('ukm', [FrontController::class, 'ukm'])->name('ukm');

Route::get('login', [FrontController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'auth'])->name('authentication');
Route::get('register', [FrontController::class, 'register'])->name('register')->middleware('guest');

Route::middleware('auth')->group(function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name("logout");
    Route::get('/home', [HomeController::class, 'home'])->name("home");

    Route::prefix("ukm")->group(function() {
        Route::get('/', [UkmController::class, 'index'])->name("ukm");
        Route::get('show/{id?}', [UkmController::class, 'show'])->name("ukm-show");
        Route::post('simpan/{id?}', [UkmController::class, 'simpan'])->name("ukm-simpan");
        Route::post('hapus/{id?}', [UkmController::class, 'hapus'])->name("ukm-hapus");
    });
});
