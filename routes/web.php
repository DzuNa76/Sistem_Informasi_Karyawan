<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluasiKerjaController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JenisIzinController;
use App\Http\Controllers\PartisipanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PengajuanIzinController;
use App\Http\Controllers\RecordAbsenController;
use App\Http\Controllers\TunjanganController;
use App\Http\Controllers\UserController;
use App\Models\EvaluasiKerja;
use App\Models\Pegawai;
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

// router halaman dashboard admin


//route authentication
Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::get('/', 'index')->name('auth.index');
    Route::post('/login', 'login')->name('auth.login');
    Route::get('/logout', 'logout')->name('auth.logout');
});


Route::middleware(['auth.custom'])->group(function () {

    Route::get('/', function () {
        $pegawai = Pegawai::all()->count();

        $data = [
            'pegawai' => $pegawai
        ];
        return view('admin.dashboard.dashboard', $data);
    })->name('Dashboard');

    // route untuk management user
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::post('/', 'store')->name('user.store');
        Route::put('/{id}', 'update')->name('user.update');
        Route::get('/{id}', 'destroy')->name('user.destroy');
    });

    // route untuk management pegawai
    Route::controller(PegawaiController::class)->prefix('pegawai')->group(function () {
        Route::get('/', 'index')->name('pegawai.index');
        Route::get('/create', 'create')->name('pegawai.create');
        Route::post('/', 'store')->name('pegawai.store');
        Route::get('/{id}', 'edit')->name('pegawai.edit');
        Route::put('/{id}', 'update')->name('pegawai.update');
        Route::get('/delete/{id}', 'destroy')->name('pegawai.destroy');
    });

    // route untuk management pendidikan
    Route::controller(PendidikanController::class)->prefix('pendidikan')->group(function () {
        Route::get('/', 'index')->name('pendidikan.index');
        Route::get('/create', 'create')->name('pendidikan.create');
        Route::post('/', 'store')->name('pendidikan.store');
        Route::get('/{id}', 'edit')->name('pendidikan.edit');
        Route::put('/{id}', 'update')->name('pendidikan.update');
        Route::get('/delete/{id}', 'destroy')->name('pendidikan.destroy');
    });

    // route untuk management absensi
    Route::controller(AbsensiController::class)->prefix('absensi')->group(function () {
        Route::get('/', 'index')->name('absensi.index');
        Route::get('/create', 'create')->name('absensi.create');
        Route::post('/', 'store')->name('absensi.store');
        Route::get('/show/{id}', 'show')->name('absensi.show');
        Route::get('/{id}', 'edit')->name('absensi.edit');
        Route::put('/{id}', 'update')->name('absensi.update');
        Route::get('/delete/{id}', 'destroy')->name('absensi.destroy');
    });

    // route untuk management record absensi
    Route::controller(RecordAbsenController::class)->prefix('record')->group(function () {
        Route::get('/', 'index')->name('record.index');
        Route::post('/', 'store')->name('record.store');
        Route::put('/{id}', 'update')->name('record.update');
    });

    // route untuk management gaji
    Route::controller(GajiController::class)->prefix('gaji')->group(function () {
        Route::get('/', 'index')->name('gaji.index');
        Route::post('/', 'store')->name('gaji.store');
        Route::get('/cetak', 'cetak')->name('gaji.cetak');
        Route::put('/{id}', 'update')->name('gaji.update');
        Route::get('/{id}', 'destroy')->name('gaji.destroy');
    });

    // route untuk management tunjangan
    Route::controller(TunjanganController::class)->prefix('tunjangan')->group(function () {
        Route::get('/', 'index')->name('tunjangan.index');
        Route::post('/', 'store')->name('tunjangan.store');
        Route::get('/cetak', 'cetak')->name('tunjangan.cetak');
        Route::put('/{id}', 'update')->name('tunjangan.update');
        Route::get('/{id}', 'destroy')->name('tunjangan.destroy');
    });

    // route untuk management jenis izin
    Route::controller(JenisIzinController::class)->prefix('jenisIzin')->group(function () {
        Route::get('/', 'index')->name('jenis_izin.index');
        Route::post('/', 'store')->name('jenis_izin.store');
        Route::put('/{id}', 'update')->name('jenis_izin.update');
        Route::get('/{id}', 'destroy')->name('jenis_izin.destroy');
    });

    // route untuk management Pengajuan izin
    Route::controller(PengajuanIzinController::class)->prefix('pengajuan-izin')->group(function () {
        Route::get('/', 'index')->name('pengajuan_izin.index');
        Route::post('/', 'store')->name('pengajuan_izin.store');
        Route::put('/{id}', 'update')->name('pengajuan_izin.update');
        Route::get('/{id}', 'destroy')->name('pengajuan_izin.destroy');
    });

    // route untuk management Pelatihan
    Route::controller(PelatihanController::class)->prefix('pelatihan')->group(function () {
        Route::get('/', 'index')->name('pelatihan.index');
        Route::post('/', 'store')->name('pelatihan.store');
        Route::put('/{id}', 'update')->name('pelatihan.update');
        Route::get('/{id}', 'destroy')->name('pelatihan.destroy');
    });

    // route untuk management Pelatihan
    Route::controller(PartisipanController::class)->prefix('partisipan')->group(function () {
        Route::get('/', 'index')->name('partisipan.index');
        Route::post('/', 'store')->name('partisipan.store');
        Route::put('/{id}', 'update')->name('partisipan.update');
        Route::get('/{id}', 'destroy')->name('partisipan.destroy');
    });

    // route untuk management Evaluasi Kerja
    Route::controller(EvaluasiKerjaController::class)->prefix('evaluasi-kerja')->group(function () {
        Route::get('/', 'index')->name('evalusasiKerja.index');
        Route::post('/', 'store')->name('evalusasiKerja.store');
        Route::get('/cetak', 'cetak')->name('evaluasiKerja.cetak');
        Route::put('/{id}', 'update')->name('evalusasiKerja.update');
        Route::get('/{id}', 'destroy')->name('evalusasiKerja.destroy');
    });
});
