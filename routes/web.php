<?php

use App\Http\Controllers\AdminlobiController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ketuaController;
use App\Http\Controllers\OpharController;
use App\Http\Controllers\TandaTanganController;
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
    Route::get('/timlb3/detail-periode/{id_periode_laporan}', [Timlb3Controller::class, 'showDetailPeriode'])->name('timlb3.detail');
    Route::get('/timlb3/detail-periode/{id}', [Timlb3Controller::class, 'showDetailPeriode'])->name('timlb3.detailPeriode');
    Route::get('/timlb3/limbahmasuk/{id_periode_laporan}', [TimLb3Controller::class, 'limbah'])->name('limbah.masuk');
    Route::get('/timlb3/limbah-masuk/edit/{id}', [Timlb3Controller::class, 'edit'])->name('timlb3.editLimbahMasuk');
    Route::put('/timlb3/limbah-masuk/update/{id_limbah_masuk}', [Timlb3Controller::class, 'update'])->name('limbah_masuk.update');
    Route::get('/timlb3/kirim-periode/{id}', [Timlb3Controller::class, 'kirimPeriode'])->name('timlb3.kirimPeriode');

    Route::delete('/timlb3/limbah-masuk/destroy/{id_limbah_masuk}', [Timlb3Controller::class, 'destroy'])->name('timlb3.destroyLimbahMasuk');
    Route::get('/timlb3/import-form/{id_periode}', [Timlb3Controller::class, 'showImportForm'])->name('timlb3.import-form');
    Route::post('/timlb3/import', [Timlb3Controller::class, 'import'])->name('timlb3.import');
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
    Route::get('/timk3/detail-neraca/{id_status_neraca}', [TimK3Controller::class, 'showDetailneraca'])
        ->name('timk3.detailPeriode');
    Route::get('/timk3/lihat-neraca-perbulan/{id_bulan}', [TimK3Controller::class, 'lihatNeracaPerbulan'])->name('timk3.lihatNeracaPerbulan');
    Route::get('/timk3/detailBulan/{id_periode}', [TimK3Controller::class, 'detailBulan'])->name('timk3.detailBulan');
    Route::get('/timk3/edit-neraca1/{id_neraca1}', [TimK3Controller::class, 'editNeraca1'])->name('timk3.editNeraca1');
    Route::put('/timk3/update-neraca1/{id_neraca1}', [TimK3Controller::class, 'updateNeraca1'])->name('timk3.updateNeraca1');
    Route::get('/neraca2/{id_neraca_limbah_2}/edit', [TimK3Controller::class, 'editNeraca2'])->name('editNeraca2');
    Route::put('/neraca2/{id_neraca_limbah_2}/update', [TimK3Controller::class, 'updateNeraca2'])->name('updateNeraca2');
    Route::get('/timk3/kirim-neraca/{id}', [TimK3Controller::class, 'kirimNeraca'])->name('timk3.kirimneraca');
});
Route::middleware(['auth', 'role:3'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "Specialist_OpHar"
    Route::get('/ophar', [OpharController::class, 'index'])->name('ophar.dashboard');
    Route::get('/ophar/persetujuan', [OpharController::class, 'persetujuan'])->name('ophar.persetujuan');
    Route::get('ophar/{id}', [OpharController::class, 'show'])->name('ophr.show');
    Route::get('/ophar/aprovemsk/{id}', [OpharController::class, 'approveLimbahMasuk'])->name('ophar.lbmasuk');
    Route::get('/ophar/rejctmsk/{id}', [OpharController::class, 'rejectLimbahMasuk'])->name('ophar.lbmskrj');

    Route::get('/ophar/aproveklr/{id}', [OpharController::class, 'approveLimbahKeluar'])->name('ophar.lbkrl');
    Route::get('/ophar/rejctklr/{id}', [OpharController::class, 'rejectLimbahKeluar'])->name('ophar.lbmrjek');

    Route::get('/ophar/aprovenrc/{id}', [OpharController::class, 'approveLimbahNeraca'])->name('ophar.lnrcs');
    Route::get('/ophar/rejctnrc/{id}', [OpharController::class, 'rejectLimbahNeraca'])->name('ophar.lnrcr');

    Route::get('/timophar/limbahmasuk/{id_periode_laporan}', [OpharController::class, 'limbah'])->name('limbah.masukophar');
    Route::get('/timophar/limbahkeluar/{id_periode_laporan}', [OpharController::class, 'limbahkeluar'])->name('limbah.keluarophar');
    Route::get('/ophar/detailneraca/{id_periode_laporan}', [OpharController::class, 'detailBulan'])->name('ophar.detailBulanophar');
    Route::get('/ophar/lihat-neraca-perbulan/{id_bulan}', [OpharController::class, 'lihatNeracaPerbulan'])->name('ophar.lihatNeracaPerbulan');
});
Route::middleware(['auth', 'role:4'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "ketua_OpHar"

    Route::get('/ketua', [ketuaController::class, 'index'])->name('ketua.dashboard');
    Route::get('/ketua/persetujuan', [ketuaController::class, 'persetujuan'])->name('ketua.persetujuan');
    Route::get('ketua/{id}', [ketuaController::class, 'show'])->name('ketua.show');
    Route::get('/ketua/aprovemsk/{id}', [ketuaController::class, 'approveLimbahMasuk'])->name('ketua.lbmasuk');
    Route::get('/ketua/rejctmsk/{id}', [ketuaController::class, 'rejectLimbahMasuk'])->name('ketua.lbmskrj');

    Route::get('/ketua/aproveklr/{id}', [ketuaController::class, 'approveLimbahKeluar'])->name('ketua.lbkrl');
    Route::get('/ketua/rejctklr/{id}', [ketuaController::class, 'rejectLimbahKeluar'])->name('ketua.lbmrjek');

    Route::get('/ketua/aprovenrc/{id}', [ketuaController::class, 'approveLimbahNeraca'])->name('ketua.lnrcs');
    Route::get('/ketua/rejctnrc/{id}', [ketuaController::class, 'rejectLimbahNeraca'])->name('ketua.lnrcr');

    Route::get('/timketua/limbahmasuk/{id_periode_laporan}', [ketuaController::class, 'limbah'])->name('ketua.masuk');
    Route::get('/timketua/limbahkeluar/{id_periode_laporan}', [ketuaController::class, 'limbahkeluar'])->name('ketua.keluar');
    Route::get('/ketua/detailneraca/{id_periode_laporan}', [ketuaController::class, 'detailBulan'])->name('ketua.detailBulan');
    Route::get('/ketua/lihat-neraca-perbulan/{id_bulan}', [ketuaController::class, 'lihatNeracaPerbulan'])->name('ketua.lihatNeracaPerbulan');

    Route::get('/historilimbah', [ketuaController::class, 'historilimbah'])->name('historilimbah');
});
Route::middleware(['auth', 'role:5'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "admin_lobby"
    Route::get('/adminloby', [AdminlobiController::class, 'index'])->name('adminlobi');

    Route::get('/adminloby/dokumen', [AdminlobiController::class, 'persetujuan'])->name('admin.persetujuan');

    Route::get('/adminloby/aprovemsk/{id}', [AdminlobiController::class, 'approveLimbahMasuk'])->name('admin.lbmasuk');
    Route::get('/adminloby/rejctmsk/{id}', [AdminlobiController::class, 'rejectLimbahMasuk'])->name('admin.lbmskrj');

    Route::get('/adminloby/aproveklr/{id}', [AdminlobiController::class, 'approveLimbahKeluar'])->name('admin.lbkrl');
    Route::get('/adminloby/rejctklr/{id}', [AdminlobiController::class, 'rejectLimbahKeluar'])->name('admin.lbmrjek');

    Route::get('/adminloby/aprovenrc/{id}', [AdminlobiController::class, 'approveLimbahNeraca'])->name('admin.lnrcs');
    Route::get('/adminloby/rejctnrc/{id}', [AdminlobiController::class, 'rejectLimbahNeraca'])->name('admin.lnrcr');


    Route::post('/admin/tambahDokumen/{id_periode_laporan}', [AdminlobiController::class, 'storeDokumenTambahan'])->name('admin.tambahDokumen');
});
// Rute yang akan dilindungi oleh middleware role "administrator"
Route::middleware(['auth', 'role:6'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "administrator"
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});


Route::get('/tanda_tangan/create', [TandaTanganController::class, 'create'])->name('tanda_tangan.create');
Route::post('/tanda_tangan', [TandaTanganController::class, 'store'])->name('tanda_tangan.store');
Route::get('/tanda_tangan/edit', [TandaTanganController::class, 'edit'])->name('tanda_tangan.edit');
Route::post('/tanda_tangan/update', [TandaTanganController::class, 'update'])->name('tanda_tangan.update');
Route::get('/limbah/export/{id_periode_laporan}', [ExportController::class, 'exportLimbahMasuk'])->name('limbah.export');
Route::get('/export-limbah-keluar/{id_periode_laporan}', [ExportController::class, 'exportLimbahKeluar'])->name('keluar.export');
Route::get('/export-neraca/{id_periode_laporan}', [ExportController::class, 'exportNeraca'])->name('neraca.export');
// Route::get('/export-neraca-pdf/{id_bulan}', [ExportController::class, 'exportNeracaPDF'])->name('export.neraca.pdf');
Route::get('/export-neraca-pdf/{id_periode_laporan}', [ExportController::class, 'exportNeracaPDF'])->name('export.neraca.pdf');
Route::get('/historilimbahadmin', [AdminlobiController::class, 'historilimbah'])->name('historiadmlimbah');
Route::get('adminloby/{id}', [AdminlobiController::class, 'show'])->name('admin.show');
Route::get('/timadminloby/limbahmasuk/{id_periode_laporan}', [AdminlobiController::class, 'limbah'])->name('admin.masuk');
Route::get('/timadminloby/limbahkeluar/{id_periode_laporan}', [AdminlobiController::class, 'limbahkeluar'])->name('admin.keluar');
Route::get('/adminloby/detailneraca/{id_periode_laporan}', [AdminlobiController::class, 'detailBulan'])->name('admin.detailBulan');
Route::get('/adminloby/lihat-neraca-perbulan/{id_bulan}', [AdminlobiController::class, 'lihatNeracaPerbulan'])->name('admin.lihatNeracaPerbulan');

Route::get('/home', function () {
    return redirect('/mctn');
});
