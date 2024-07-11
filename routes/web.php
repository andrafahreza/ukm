<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('ukm', [FrontController::class, 'ukm'])->name('ukm');
Route::get('login', [FrontController::class, 'login'])->name('login')->middleware('guest');
Route::get('register', [FrontController::class, 'register'])->name('register')->middleware('guest');
