<?php

use App\Http\Controllers\AdminLaporan;
use App\Http\Controllers\AdminTransaksi;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokAwalController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
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
    return view('dashboard_app');
});

Route::get('/dashboard', function () {
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified']);

Route::prefix('/account')->middleware(['auth', 'isadmin'])
    ->group(function () {
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

Route::prefix('admin')->middleware(['auth', 'isadmin'])->group(function () {
    Route::resource('barang', BarangController::class);
    Route::post('/barang/list_barang', [BarangController::class, 'getDataBarang']);

    Route::resource('/transaksi', AdminTransaksi::class);
    Route::post('/transaksi/data_transaksi', [AdminTransaksi::class, 'transactionData']);
    Route::get('/laporan', [AdminLaporan::class, 'index'])->name('admin_laporan_index');
    Route::post('/laporan/data_transaksi', [AdminLaporan::class, 'dataTransaksi']);
    Route::post('/laporan/laporan_transaksi', [AdminLaporan::class, 'laporanByTrsc'])->name('laporan_trsc');
    Route::post('/laporan/laporan_harian', [AdminLaporan::class, 'laporanHarian'])->name('laporan_harian');
    Route::post('/laporan/laporan_mingguan', [AdminLaporan::class, 'laporanMingguan'])->name('laporan_mingguan');
    Route::post('/laporan/laporan_bulanan', [AdminLaporan::class, 'laporanBulanan'])->name('laporan_bulanan');
    Route::get('/laporan_download/{file}', [AdminLaporan::class, 'download']);
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin_users');
    Route::post('/users/get_data_users', [AdminUserController::class, 'userData']);
    Route::post('/users/register', [AdminUserController::class, 'register']);
    Route::get('/users/update_password/{user}', [AdminUserController::class, 'updatePassword'])->name('admin_user_update_pwd');
    Route::put('/users/update_password/{user}', [AdminUserController::class, 'update']);
    Route::delete('/users/{user}', [AdminUserController::class, 'delete']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/app', function () {
        return view('pages.dashboard');
    })->name('pages_dashboard');
    Route::get('/sales', [PenjualanController::class, 'index'])->name('penjualan_index');
    Route::get('/sales/buat_transaksi', [PenjualanController::class, 'buatTransaksi'])->name('penjualan_buat');
    Route::post('/sales/simpan', [PenjualanController::class, 'simpan']);
    Route::get('/sales/transaksi_detail/{sales}', [PenjualanController::class, 'transaksiDetail']);
    Route::get('/sales/transaksi', [PenjualanController::class, 'lihatTransaksi'])->name('penjualan_transaksi');
    Route::post('/sales/transaksiall', [PenjualanController::class, 'transaksiAll']);
    Route::get('/sales/detail_transaksi/{sales}', [PenjualanController::class, 'detailTransaksi'])->name('detail_transaksi');
    Route::post('/sales/transaksi_item', [PenjualanController::class, 'transaksiItem']);
    Route::post('/sales/barang', [PenjualanController::class, 'barang']);
    Route::post('/sales/simpan_transaksi_detail', [PenjualanController::class, 'simpanTrDetail']);
    Route::delete('/sales/delete_item_tr/{sales}', [PenjualanController::class, 'deleteItemTr']);
    Route::get('/sales/success/{sales}', [PenjualanController::class, 'success']);
    Route::post('/sales/simpan_tr_total', [PenjualanController::class, 'submitTotal']);

    Route::resource('/stok', StokAwalController::class);
    Route::post('/stok/all', [StokAwalController::class, 'getDataStok']);
});

//modif auth route breeze
//breeze route di keluarkan dari vendor/laravel/breeze/routes/auth.php
Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

//feature breeze di off untuk custom auth
// require __DIR__ . '/auth.php';
