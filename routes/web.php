<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TimK3Controller;
use App\Http\Controllers\TimLb3Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('homee');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rute untuk registrasi
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('registerform');
Route::post('/store', [AuthController::class, 'store'])->name('store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/redirect', [AuthController::class, 'redirectToProvider']);
Route::get('/google/callback', [AuthController::class, 'handleProviderCallback']);
Route::get('/mctn', [DashboardController::class, 'index'])->middleware('auth');



Route::middleware(['auth', 'role:1'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Tim LB 3"
    Route::get('/timlb3', [TimLb3Controller::class, 'index'])->name('timlb3.index');
    Route::get('/timlb3/form-kuartal-tahun', [TimLb3Controller::class, 'showFormLimbahMasuk'])->name('timlb3.showFormKuartalTahun');
    Route::post('/timlb3/submit-form-kuartal-tahun', [TimLb3Controller::class, 'submitFormKuartalTahun'])->name('timlb3.submitFormKuartalTahun');
    Route::get('/timlb3/form-limbah-masuk/{id_periode_laporan?}', [TimLb3Controller::class, 'showFormLimbahMasuk2'])->name('timlb3.showFormLimbahMasuk');
    Route::post('/timlb3/submit-limbah-masuk', [TimLb3Controller::class, 'submitFormLimbahMasuk'])->name('timlb3.submitFormLimbahMasuk');
    Route::get('/status', [TimLb3Controller::class, 'status'])->name('status.index');
    Route::get('/status/{id}', [TimLb3Controller::class, 'lihatstatus'])->name('status.show');
    Route::get('/timlb3/detail-periode/{id}', [Timlb3Controller::class, 'showDetailPeriode'])->name('timlb3.detailPeriode');
    Route::get('/timlb3/limbahmasuk/{id_periode_laporan}', [TimLb3Controller::class, 'limbah'])->name('limbah.masuk');
    Route::get('/timlb3/limbah-masuk/edit/{id}', [Timlb3Controller::class, 'edit'])->name('timlb3.editLimbahMasuk');
    Route::put('/timlb3/limbah-masuk/update/{id_limbah_masuk}', [Timlb3Controller::class, 'update'])->name('limbah_masuk.update');
    Route::get('/timlb3/kirim-periode/{id}', [Timlb3Controller::class, 'kirimPeriode'])->name('timlb3.kirimPeriode');

    Route::delete('/timlb3/limbah-masuk/destroy/{id_limbah_masuk}', [Timlb3Controller::class, 'destroy'])->name('timlb3.destroyLimbahMasuk');
});


Route::middleware(['auth', 'role:2'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "TIm k3"
    Route::get('/timk3', [TimK3Controller::class, 'index'])->name('admin.dashboard');
    Route::get('/timk3/formperiode', [TimK3Controller::class, 'showFormLimbahKeluar'])->name('timk3.showFormLimbahKeluar');
    Route::get('/timk3/form-limbah-masuk/{id_periode_laporan?}', [TimK3Controller::class, 'showFormLimbahkeluar2'])->name('timk3.showFormLimbahKeluar2');
    // Rute untuk menangani pengiriman formulir kuartal dan tahun
    Route::post('/timk3/submit-form-kuartal-tahun', [TimK3Controller::class, 'submitFormKuartalTahun'])->name('timk3.submitFormKuartalTahun');
    Route::post('/timk3/submit-limbah-keluar', [TimK3Controller::class, 'submitFormLimbahkeluar'])->name('timlb3.submitFormLimbahkeluar');
    Route::get('/timk3/status', [TimK3Controller::class, 'statuskeluar'])->name('statuskeluar.index');
    Route::get('/status/{id}', [TimK3Controller::class, 'lihatstatus'])->name('status.keluar');
    Route::get('/timk3/detail-periode/{id}', [TimK3Controller::class, 'showDetailPeriode'])->name('timk3.detailPeriodelkeluar');
    Route::get('/timk3/limbahkeluar/{id_periode_laporan}', [TimK3Controller::class, 'limbahkeluar'])->name('limbah.keluar');
    Route::get('/timlb3/limbah-keluar/edit/{id}', [TimK3Controller::class, 'editlimbah'])->name('timk3.editLimbahkeluar');
    Route::put('/timlb3/limbah-keluar/update/{id_limbah_keluar}', [TimK3Controller::class, 'updatelimbah'])->name('limbah_keluar.update');
    Route::get('/timlb3/kirim-periodekeluar/{id}', [TimK3Controller::class, 'kirimPeriode'])->name('timlb3.kirimPeriodekeluar');

    Route::delete('/timlb3/limbah-keluar/destroy/{id_limbah_keluar}', [TimK3Controller::class, 'destroy'])->name('timlb3.destroyLimbahkeluar');
    Route::get('/timk3/formneraca', [TimK3Controller::class, 'showFormNeraca'])->name('timk3.showFormNeraca');
    Route::post('/timk3/submit-neraca', [TimK3Controller::class, 'submitFormNeraca'])->name('timk3.submitFormNeraca');
    Route::get('/timk3/showFormNeraca1/{id_bulan}', [TimK3Controller::class, 'showFormNeraca1'])->name('timk3.showFormNeraca1');
    Route::post('/timk3/submit-neraca1/{id_bulan}', [TimK3Controller::class, 'submitFormNeraca1'])
        ->name('timk3.submitFormNeraca1');
    Route::get('/timk3/neraca2/{id_bulan}', [TimK3Controller::class, 'showFormNeraca2'])->name('timk3.showFormNeraca2');
    Route::post('/timk3/neraca2/{id_bulan}', [TimK3Controller::class, 'submitFormNeraca2'])->name('timk3.submitFormNeraca2');

    Route::get('/timk3/statusneraca', [TimK3Controller::class, 'showStatusNeraca'])
        ->name('timk3.status');

    // Route untuk melihat detail periode neraca
    Route::get('/timk3/detail-periode/{id_status_neraca}', [TimK3Controller::class, 'showDetailneraca'])
        ->name('timk3.detailPeriode');
});
Route::middleware(['auth', 'role:3'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Specialist_OpHar"
    Route::get('/tuanrumah', [TimLb3Controller::class, 'index'])->name('tuanrumah.home');
});
Route::middleware(['auth', 'role:4'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "ketua_OpHar"
    Route::get('/phr', [TimLb3Controller::class, 'index'])->name('phr.home');
});
Route::middleware(['auth', 'role:5'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "admin_lobby"
    Route::get('/admin_duri', [TimLb3Controller::class, 'index'])->name('admin_duri.dashboard');
});
Route::middleware(['auth', 'role:6'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "administrator"
    Route::get('/admin_duri', [TimLb3Controller::class, 'index'])->name('admin_duri.dashboard');
});
