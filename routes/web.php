<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AyamKeluarController;
use App\Http\Controllers\AyamMasukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\PakanKeluarController;
use App\Http\Controllers\PakanMasukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\Register;
use App\Http\Controllers\StokAyamController;
use App\Http\Controllers\StokPakanController;

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


Route::get('/index', function () {
    return view('index');
});

Route::get('index', function () {
    return view('index');
});

Route::get('masuk', function () {
    return view('masuk');
});

Route::get('keluar', function () {
    return view('keluar');
});

Route::get('admin', function () {
    return view('admin');
});

Route::get('reset', function () {
    return view('daftar');
});

Route::get('/daftar', function () {
    return view('daftar');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'postLogin']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->middleware('userAccess:admin');
    Route::get('/pelanggan', [AdminController::class, 'pelanggan'])->middleware('userAccess:pelanggan');
    Route::get('/owner', [AdminController::class, 'owner'])->middleware('userAccess:owner');
    Route::get('/logout', [LoginController::class, 'postLogout']);
});

Route::post('forget-password', [LupaPasswordController::class, 'submitForgetPasswordForm'])->middleware('guest')->name('forget.password.post');
Route::get('reset-password/{token}', [LupaPasswordController::class, 'showResetPasswordForm'])->middleware('guest')->name('password.reset');
Route::post('reset-password', [LupaPasswordController::class, 'submitResetPasswordForm'])->middleware('guest')->name('reset.password.post');
Route::post('/register', [Register::class, 'create']);

Route::get('/stok', [StokAyamController::class, 'index'])->middleware('userAccess:admin')->name('stok.ayam');
Route::post('stok/tambah', [StokAyamController::class, 'inputStock'])->name('tambah.stok.post');
Route::post('/stok/edit', [StokAyamController::class, 'editStock'])->name('edit.stok.post');
Route::post('/stok/hapus', [StokAyamController::class, 'hapusStock'])->name('hapus.stok.post');
Route::get('/stok/export', [StokAyamController::class, 'exportStock'])->middleware('userAccess:admin')->name('export.stok.ayam');

Route::get('/masuk', [AyamMasukController::class, 'index'])->middleware('userAccess:admin')->name('ayam.masuk');
Route::post('masuk/tambah', [AyamMasukController::class, 'inputAyamMasuk'])->name('tambah.ayam.masuk');
Route::post('masuk/edit', [AyamMasukController::class, 'editAyamMasuk'])->name('edit.ayam.masuk');
Route::post('masuk/hapus', [AyamMasukController::class, 'hapusAyamMasuk'])->name('hapus.ayam.masuk');

Route::get('/keluar', [AyamKeluarController::class, 'index'])->middleware('userAccess:admin')->name('ayam.keluar');
Route::post('keluar/tambah', [AyamKeluarController::class, 'inputAyamKeluar'])->name('tambah.ayam.keluar');
Route::post('keluar/edit', [AyamKeluarController::class, 'editAyamKeluar'])->name('edit.ayam.keluar');
Route::post('keluar/hapus', [AyamKeluarController::class, 'hapusAyamKeluar'])->name('hapus.ayam.keluar');

Route::get('/pakan', [StokPakanController::class, 'index'])->middleware('userAccess:admin')->name('stok.pakan');
Route::post('pakan/tambah', [StokPakanController::class, 'inputStockPakan'])->name('tambah.stok.pakan');
Route::post('pakan/edit', [StokPakanController::class, 'editStockPakan'])->name('edit.stok.pakan');
Route::post('pakan/hapus', [StokPakanController::class, 'hapusStockPakan'])->name('hapus.stok.pakan');

Route::get('/pakanMasuk', [PakanMasukController::class, 'index'])->middleware('userAccess:admin')->name('pakan.masuk');
Route::post('/pakanMasuk/tambah', [PakanMasukController::class, 'inputPakanMasuk'])->middleware('userAccess:admin')->name('tambah.pakan.masuk');
Route::post('/pakanMasuk/edit', [PakanMasukController::class, 'editPakanMasuk'])->middleware('userAccess:admin')->name('edit.pakan.masuk');
Route::post('/pakanMasuk/hapus', [PakanMasukController::class, 'hapusPakanMasuk'])->middleware('userAccess:admin')->name('hapus.pakan.masuk');

Route::get('/pakanKeluar', [PakanKeluarController::class, 'index'])->middleware('userAccess:admin')->name('pakan.keluar');
Route::post('/pakanKeluar/tambah', [PakanKeluarController::class, 'inputPakanKeluar'])->middleware('userAccess:admin')->name('tambah.pakan.keluar');
Route::post('/pakanKeluar/edit', [PakanKeluarController::class, 'editPakanKeluar'])->middleware('userAccess:admin')->name('edit.pakan.keluar');
Route::post('/pakanKeluar/hapus', [PakanKeluarController::class, 'hapusPakanKeluar'])->middleware('userAccess:admin')->name('hapus.pakan.keluar');

Route::get('/pesananAdmin', [PelangganController::class, 'pesananAdmin'])->middleware('userAccess:admin')->name('pesanan.admin');
Route::post('/pesananAdmin/konfirmasi', [PelangganController::class, 'konfirmasiPesanan'])->middleware('userAccess:admin')->name('konfirmasi.pesanan.admin');
Route::post('/pesananAdmin/ubah', [PelangganController::class, 'ubahPesanan'])->middleware('userAccess:admin')->name('ubah.pesanan.admin');
Route::post('/pesananAdmin/batal', [PelangganController::class, 'batalPesananAdmin'])->middleware('userAccess:admin')->name('batal.pesanan.admin');


Route::get('/kelola', [Register::class, 'index'])->middleware('userAccess:owner')->name('kelola.admin');
Route::post('kelola/tambah', [Register::class, 'inputAdmin'])->name('tambah.kelola.admin');
Route::post('kelola/edit', [Register::class, 'editAdmin'])->name('edit.kelola.admin');
Route::post('kelola/hapus', [Register::class, 'hapusAdmin'])->name('hapus.kelola.admin');

Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.home');
Route::get('/produk', [PelangganController::class, 'produk'])->middleware('userAccess:pelanggan')->name('pelanggan.produk');
Route::get('/pesanan', [PelangganController::class, 'pesanan'])->middleware('userAccess:pelanggan')->name('pelanggan.pesanan');
Route::post('/produk/beli', [PelangganController::class, 'buatPesanan'])->middleware('userAccess:pelanggan')->name('pelanggan.buat.pesanan');
Route::post('/produk/batal', [PelangganController::class, 'batalPesanan'])->middleware('userAccess:pelanggan')->name('pelanggan.batal.pesanan');

Route::get('/tentang', function () {
    return view('pelanggan.tentang');
})->middleware('userAccess:pelanggan');
Route::get('/kontak', function () {
    return view('pelanggan.kontak');
})->middleware('userAccess:pelanggan');
