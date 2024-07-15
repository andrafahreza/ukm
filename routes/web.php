<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\UkmController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('list-ukm', [FrontController::class, 'ukm'])->name('list-ukm');

Route::get('login', [FrontController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'auth'])->name('authentication');
Route::get('register', [FrontController::class, 'register'])->name('register')->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->name('registered');

Route::middleware('auth')->group(function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name("logout");
    Route::get('/home', [HomeController::class, 'home'])->name("home");

    Route::prefix("ukm")->group(function() {
        Route::get('/', [UkmController::class, 'index'])->name("ukm");
        Route::get('show/{id?}', [UkmController::class, 'show'])->name("ukm-show");
        Route::post('simpan/{id?}', [UkmController::class, 'simpan'])->name("ukm-simpan");
        Route::post('hapus/{id?}', [UkmController::class, 'hapus'])->name("ukm-hapus");

        Route::prefix("pengurus")->group(function() {
            Route::get('/list/{id?}', [UkmController::class, 'pengurus'])->name("pengurus");
            Route::get('show/{id?}', [UkmController::class, 'pengurus_show'])->name("pengurus-show");
            Route::post('simpan/{id?}', [UkmController::class, 'pengurus_simpan'])->name("pengurus-simpan");
            Route::post('hapus/{id?}', [UkmController::class, 'pengurus_hapus'])->name("pengurus-hapus");
        });
    });

    Route::prefix("prodi")->group(function() {
        Route::get('/', [ProdiController::class, 'index'])->name("prodi");
        Route::get('show/{id?}', [ProdiController::class, 'show'])->name("prodi-show");
        Route::post('simpan/{id?}', [ProdiController::class, 'simpan'])->name("prodi-simpan");
        Route::post('hapus/{id?}', [ProdiController::class, 'hapus'])->name("prodi-hapus");

        Route::prefix("jurusan")->group(function() {
            Route::get('/list/{id?}', [JurusanController::class, 'index'])->name("jurusan");
            Route::get('show/{id?}', [JurusanController::class, 'show'])->name("jurusan-show");
            Route::post('simpan/{id?}', [JurusanController::class, 'simpan'])->name("jurusan-simpan");
            Route::post('hapus/{id?}', [JurusanController::class, 'hapus'])->name("jurusan-hapus");
            Route::get('get/{id?}', [JurusanController::class, 'get'])->name("jurusan-get");
        });
    });
});
