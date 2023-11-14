<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
});
Route::middleware(['auth', 'role:2'])->group(function () {
    // Rute yang akan dilindungi oleh middleware role "TIm k3"
    Route::get('/admina', [TimLb3Controller::class, 'index'])->name('admin.dashboard');
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
