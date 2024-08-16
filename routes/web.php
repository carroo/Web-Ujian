<?php

use App\Http\Controllers\CbtController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\RelasiController;
use App\Models\Ujian;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register' => false,
    'password' => false
]);
Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role:0'], function () {

        Route::group(['prefix' => 'master'], function () {
            Route::get('/jurusan', [HomeController::class, 'jurusan'])->name('jurusan.index');
            Route::post('/jurusan', [HomeController::class, 'jurusan_store'])->name('jurusan.store');
            Route::put('/jurusan/{id}', [HomeController::class, 'jurusan_update'])->name('jurusan.update');
            Route::get('/jurusan/{id}', [HomeController::class, 'jurusan_destroy'])->name('jurusan.destroy');

            Route::get('/kelas', [HomeController::class, 'kelas'])->name('kelas.index');
            Route::post('/kelas', [HomeController::class, 'kelas_store'])->name('kelas.store');
            Route::put('/kelas/{id}', [HomeController::class, 'kelas_update'])->name('kelas.update');
            Route::get('/kelas/{id}', [HomeController::class, 'kelas_destroy'])->name('kelas.destroy');

            Route::get('/mapel', [HomeController::class, 'mapel'])->name('mapel.index');
            Route::post('/mapel', [HomeController::class, 'mapel_store'])->name('mapel.store');
            Route::put('/mapel/{id}', [HomeController::class, 'mapel_update'])->name('mapel.update');
            Route::get('/mapel/{id}', [HomeController::class, 'mapel_destroy'])->name('mapel.destroy');

            Route::get('/guru', [HomeController::class, 'guru'])->name('guru.index');
            Route::post('/guru', [HomeController::class, 'guru_store'])->name('guru.store');
            Route::put('/guru/{id}', [HomeController::class, 'guru_update'])->name('guru.update');
            Route::get('/guru-status/{id}', [HomeController::class, 'guru_status'])->name('guru.status');
            Route::get('/guru/{id}', [HomeController::class, 'guru_destroy'])->name('guru.destroy');

            Route::get('/siswa', [HomeController::class, 'siswa'])->name('siswa.index');
            Route::post('/siswa', [HomeController::class, 'siswa_store'])->name('siswa.store');
            Route::put('/siswa/{id}', [HomeController::class, 'siswa_update'])->name('siswa.update');
            Route::get('/siswa-status/{id}', [HomeController::class, 'siswa_status'])->name('siswa.status');
            Route::get('/siswa/{id}', [HomeController::class, 'siswa_destroy'])->name('siswa.destroy');
        });

        Route::group(['prefix' => 'relasi'], function () {
            Route::get('/kelasguru', [RelasiController::class, 'kelasguru'])->name('kelasguru.index');
            Route::post('/kelasguru', [RelasiController::class, 'kelasguru_store'])->name('kelasguru.store');
            Route::put('/kelasguru/{id}', [RelasiController::class, 'kelasguru_update'])->name('kelasguru.update');
            Route::get('/kelasguru/{id}', [RelasiController::class, 'kelasguru_destroy'])->name('kelasguru.destroy');

            Route::get('/jurusanmapel', [RelasiController::class, 'jurusanmapel'])->name('jurusanmapel.index');
            Route::post('/jurusanmapel', [RelasiController::class, 'jurusanmapel_store'])->name('jurusanmapel.store');
            Route::put('/jurusanmapel/{id}', [RelasiController::class, 'jurusanmapel_update'])->name('jurusanmapel.update');
            Route::get('/jurusanmapel/{id}', [RelasiController::class, 'jurusanmapel_destroy'])->name('jurusanmapel.destroy');
        });



        Route::get('/user', [HomeController::class, 'user'])->name('user.index');
        Route::put('/user/{id}', [HomeController::class, 'user_update'])->name('user.update');
        Route::get('/user/{id}', [HomeController::class, 'user_destroy'])->name('user.destroy');
    });
    Route::group(['middleware' => 'role:1'], function () {
        // Rute-rute yang hanya dapat diakses oleh guru

        Route::get('/soal', [SoalController::class, 'soal'])->name('soal.index');
        Route::post('/soal', [SoalController::class, 'soal_store'])->name('soal.store');
        Route::get('/soal/{id}', [SoalController::class, 'soal_destroy'])->name('soal.destroy');
        Route::put('/soal/{id}', [SoalController::class, 'soal_update'])->name('soal.update');

        Route::get('/ujian', [UjianController::class, 'ujian'])->name('ujian.index');
        Route::post('/ujian', [UjianController::class, 'ujian_store'])->name('ujian.store');
        Route::get('/ujian/{id}', [UjianController::class, 'ujian_destroy'])->name('ujian.destroy');
        Route::get('/ujian-token/{id}', [UjianController::class, 'ujian_token'])->name('ujian.token');
        Route::put('/ujian/{id}', [UjianController::class, 'ujian_update'])->name('ujian.update');

        Route::get('/cbt-hasil', [CbtController::class, 'cbt_hasil'])->name('cbt.hasil');
        Route::get('/cbt-hasil-cetak/{id}', [CbtController::class, 'cbt_hasil_cetak'])->name('cbt.hasil-cetak');
    });

    Route::group(['middleware' => 'role:2'], function () {
        // Rute-rute yang hanya dapat diakses oleh siswa
        Route::get('/cbt', [CbtController::class, 'cbt'])->name('cbt.index');
        Route::post('/cbt-ikut/{id}', [CbtController::class, 'cbt_ikut'])->name('cbt.ikut');
        Route::get('/cbt-masuk/{id}/{soal}', [CbtController::class, 'cbt_masuk'])->name('cbt.masuk');
        Route::post('/cbt-masuk/{id}/{soal}', [CbtController::class, 'cbt_masuk_input'])->name('cbt.masuk-input');
        Route::get('/cbt-cetak/{id}', [CbtController::class, 'cbt_cetak'])->name('cbt.cetak');
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile.index');
    Route::post('/profile', [HomeController::class, 'profile_update'])->name('profile.update');
});
