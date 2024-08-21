<?php

use App\Http\Controllers\AgendaUkmController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PembayaranMahasiswaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\UkmController;
use App\Http\Controllers\UkmUserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('list-pengumuman/{id?}', [FrontController::class, 'pengumuman'])->name('list-pengumuman');
Route::get('list-berita/{id?}', [FrontController::class, 'berita'])->name('list-berita');
Route::get('list-agenda/{id?}', [FrontController::class, 'agenda'])->name('list-agenda');
Route::get('list-ukm/{id?}', [FrontController::class, 'ukm'])->name('list-ukm');

Route::get('login', [FrontController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'auth'])->name('authentication');
Route::get('register', [FrontController::class, 'register'])->name('register')->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->name('registered');
Route::get('get/{id?}', [JurusanController::class, 'get'])->name("jurusan-get");

Route::middleware('auth')->group(function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name("logout");
    Route::get('profil-mahasiswa', [UkmUserController::class, 'profil_mahasiswa'])->name("profil-mahasiswa");
    Route::post('profil-mahasiswa', [AuthController::class, 'update_profil_mahasiswa'])->name("update-profil-mahasiswa");
    Route::post('ganti-password-mahasiswa', [AuthController::class, 'ganti_password_mahasiswa'])->name("ganti-password-mahasiswa");
    Route::get('sertifikat-mahasiswa', [SertifikatController::class, 'sertifikat_mahasiswa'])->name("sertifikat-mahasiswa");

    Route::prefix("pendaftaran")->group(function() {
        Route::get('/', [PendaftaranController::class, 'index'])->name("pendaftaran");
        Route::post('daftar', [PendaftaranController::class, 'daftar'])->name("daftar");
    });

    Route::prefix("pembayaran")->group(function() {
        Route::get('/', [PembayaranMahasiswaController::class, 'pembayaran'])->name("pembayaran");
        Route::post('/', [PembayaranMahasiswaController::class, 'bayar'])->name("bayar");
    });

    Route::middleware('notMahasiswa')->group(function() {
        Route::get('/home', [HomeController::class, 'home'])->name("home");
        Route::get('/list-user', [AuthController::class, 'user'])->name("list-user");
        Route::post('/nonactive-user', [AuthController::class, 'nonactive_user'])->name("nonactive-user");
        Route::post('/active-user', [AuthController::class, 'active_user'])->name("active-user");
        Route::post('/reset-user', [AuthController::class, 'reset_user'])->name("reset-user");
        Route::get('/list-mahasiswa', [AuthController::class, 'mahasiswa'])->name("list-mahasiswa");

        Route::prefix("profile-setting")->group(function() {
            Route::get('/', [ProfileController::class, 'index'])->name("profil-setting");
            Route::post('/', [ProfileController::class, 'update'])->name("update-profil");
            Route::post('ganti-password', [ProfileController::class, 'ganti_password'])->name("ganti-password-profil");
        });

        Route::prefix("list-pendaftaran")->group(function() {
            Route::get('/', [PendaftaranController::class, 'list'])->name("list-pendaftaran");
            Route::post('terima-pendaftaran', [PendaftaranController::class, 'terima'])->name("terima-pendaftaran");
            Route::post('tolak-pendaftaran', [PendaftaranController::class, 'tolak'])->name("tolak-pendaftaran");
        });

        Route::prefix("ukm")->group(function() {
            Route::get('/', [UkmController::class, 'index'])->name("ukm");
            Route::get('show/{id?}', [UkmController::class, 'show'])->name("ukm-show");
            Route::post('simpan/{id?}', [UkmController::class, 'simpan'])->name("ukm-simpan");
            Route::post('hapus/{id?}', [UkmController::class, 'hapus'])->name("ukm-hapus");

            Route::prefix("admin")->group(function() {
                Route::get('/list/{id?}', [UkmController::class, 'admin'])->name("admin");
                Route::get('show/{id?}', [UkmController::class, 'admin_show'])->name("admin-show");
                Route::post('simpan/{id?}', [UkmController::class, 'admin_simpan'])->name("admin-simpan");
                Route::post('hapus/{id?}', [UkmController::class, 'admin_hapus'])->name("admin-hapus");
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
            });
        });

        // UKM
        Route::prefix("profil-ukm")->group(function() {
            Route::get('/', [UkmController::class, 'profil_ukm'])->name("profil-ukm");
            Route::post('pengurus-simpan', [UkmController::class, 'pengurus_simpan'])->name("pengurus-simpan");
        });

        Route::prefix("anggota-ukm")->group(function() {
            Route::get('/', [UkmController::class, 'anggota_ukm'])->name("anggota-ukm");
        });

        Route::prefix("validasi-pembayaran")->group(function() {
            Route::get('/', [PembayaranMahasiswaController::class, 'validasi_pembayaran'])->name("validasi-pembayaran");
            Route::post('terima-pembayaran', [PembayaranMahasiswaController::class, 'terima'])->name("terima-pembayaran");
            Route::post('tolak-pembayaran', [PembayaranMahasiswaController::class, 'tolak'])->name("tolak-pembayaran");
        });

        Route::prefix("sertifikat-admin")->group(function() {
            Route::get('/', [SertifikatController::class, 'index'])->name("sertifikat");
            Route::get('show/{id?}', [SertifikatController::class, 'show'])->name("sertifikat-show");
            Route::post('simpan/{id?}', [SertifikatController::class, 'simpan'])->name("sertifikat-simpan");
            Route::post('hapus/{id?}', [SertifikatController::class, 'hapus'])->name("sertifikat-hapus");
        });

        Route::prefix("dokumentasi-admin")->group(function() {
            Route::get('/', [DokumentasiController::class, 'index'])->name("dokumentasi");
            Route::get('show/{id?}', [DokumentasiController::class, 'show'])->name("dokumentasi-show");
            Route::post('simpan/{id?}', [DokumentasiController::class, 'simpan'])->name("dokumentasi-simpan");
            Route::post('hapus/{id?}', [DokumentasiController::class, 'hapus'])->name("dokumentasi-hapus");
        });

        Route::prefix("video-admin")->group(function() {
            Route::get('/', [VideoController::class, 'index'])->name("video");
            Route::get('show/{id?}', [VideoController::class, 'show'])->name("video-show");
            Route::post('simpan/{id?}', [VideoController::class, 'simpan'])->name("video-simpan");
            Route::post('hapus/{id?}', [VideoController::class, 'hapus'])->name("video-hapus");
            Route::post('tolak/{id?}', [VideoController::class, 'tolak'])->name("video-tolak");
            Route::post('terima/{id?}', [VideoController::class, 'terima'])->name("video-terima");
        });

        Route::prefix("pengumuman-admin")->group(function() {
            Route::get('/', [PengumumanController::class, 'index'])->name("pengumuman");
            Route::get('show/{id?}', [PengumumanController::class, 'show'])->name("pengumuman-show");
            Route::post('simpan/{id?}', [PengumumanController::class, 'simpan'])->name("pengumuman-simpan");
            Route::post('hapus/{id?}', [PengumumanController::class, 'hapus'])->name("pengumuman-hapus");
            Route::post('tolak/{id?}', [PengumumanController::class, 'tolak'])->name("pengumuman-tolak");
            Route::post('terima/{id?}', [PengumumanController::class, 'terima'])->name("pengumuman-terima");
        });

        Route::prefix("berita-admin")->group(function() {
            Route::get('/', [BeritaController::class, 'index'])->name("berita");
            Route::get('show/{id?}', [BeritaController::class, 'show'])->name("berita-show");
            Route::post('simpan/{id?}', [BeritaController::class, 'simpan'])->name("berita-simpan");
            Route::post('hapus/{id?}', [BeritaController::class, 'hapus'])->name("berita-hapus");
            Route::post('tolak/{id?}', [BeritaController::class, 'tolak'])->name("berita-tolak");
            Route::post('terima/{id?}', [BeritaController::class, 'terima'])->name("berita-terima");
        });

        Route::prefix("agenda-ukm-admin")->group(function() {
            Route::get('/', [AgendaUkmController::class, 'index'])->name("agenda");
            Route::get('show/{id?}', [AgendaUkmController::class, 'show'])->name("agenda-show");
            Route::post('simpan/{id?}', [AgendaUkmController::class, 'simpan'])->name("agenda-simpan");
            Route::post('hapus/{id?}', [AgendaUkmController::class, 'hapus'])->name("agenda-hapus");
            Route::post('tolak/{id?}', [AgendaUkmController::class, 'tolak'])->name("agenda-tolak");
            Route::post('terima/{id?}', [AgendaUkmController::class, 'terima'])->name("agenda-terima");
        });
    });
});
