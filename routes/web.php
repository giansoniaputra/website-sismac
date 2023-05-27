<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\KreditController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\MaintenanceController;

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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [Dashboard::class, 'index'])->middleware('auth');
Route::get('/home', [Dashboard::class, 'index'])->middleware('auth');

Route::resource('/auth', AuthController::class)->middleware('guest');
Route::get('/auth/create', [AuthController::class, 'register'])->middleware('auth');
Route::get('/auth', [AuthController::class, 'index'])->name('login')->middleware('guest');

// PEMBELIAN
Route::resource('/pembelian', PembelianController::class)->middleware('auth');
// Cek apakah konsumen sudah terdaftar
Route::get('/cekNIK', [PembelianController::class, 'cek_nik'])->middleware('auth');
// Edit Data
Route::get('/edit-transaksi/{buy:unique}', [PembelianController::class, 'page_edit'])->middleware('auth');
//Ambil Data Transaksi
Route::get('/getDataTransaksi', [PembelianController::class, 'get_transaksi'])->middleware('auth');
//Load Individu
// Route::get('/loadIndividu', [PembelianController::class, 'load_individu'])->middleware('auth');

// DATA MOTOR
Route::resource('/motor', BikeController::class)->middleware('auth');
//Ambil Data Motor
Route::get('/getDataMotor', [BikeController::class, 'get_motor'])->middleware('auth');

// PROFILE
Route::resource('/profile', ProfileController::class)->middleware('auth');

// MODAL
Route::resource('/modal', ModalController::class)->middleware('auth');
//refresh page modal
Route::get('/refreshPage', [ModalController::class, 'refresh_page'])->middleware('auth');

// LAPORAN
Route::resource('/laporan', LaporanController::class)->middleware('auth');

// DATA KONSUMEN
Route::resource('/consumer', ConsumerController::class)->middleware('auth');

// PENJUALAN
Route::resource('/penjualan', PenjualanController::class)->middleware('auth');
//Rules
Route::resource('/penjualan', PenjualanController::class)->middleware('auth');
//Rules Penjualan
Route::post('/rulesPenjualan', [PenjualanController::class, 'rules_penjualan'])->middleware('auth');
//Tambah Penjualan Cash
Route::post('/tambahPenjualan', [PenjualanController::class, 'tambah_data'])->middleware('auth');
//Edit Penjualan
Route::get('/ambilDataPenjualan', [PenjualanController::class, 'get_data'])->middleware('auth');
//Update Penjualan
Route::post('/updatePenjualan', [PenjualanController::class, 'update_data'])->middleware('auth');
//Cek Nik Penjual
Route::get('/cekNikPembeli', [PenjualanController::class, 'cek_nik'])->middleware('auth');
//Retur Motor
Route::get('/returMotor/{sele:unique}', [PenjualanController::class, 'retur_motor'])->middleware('auth');
//Refresh No Polisi
Route::get('/refreshNoPolisi', [PenjualanController::class, 'refresh_no_polisi'])->middleware('auth');

// PENJUALAN KREDIT
Route::resource('/kredit', KreditController::class)->middleware('auth');
//Ambil data kkredit
Route::get('/getDataKredit', [KreditController::class, 'get_data_kredit'])->middleware('auth');


// SETTING
Route::resource('/setting', SettingController::class)->middleware('auth');

// MAINTENANCE
Route::resource('/maintenance', MaintenanceController::class)->middleware('auth');
Route::get('/getDataMaintenance', [MaintenanceController::class, 'get_maintenance'])->middleware('auth');

// AUTHENTIKASI
// Login
Route::post('/authenticate', [AuthController::class, 'authenticate']);
// Logout
Route::get('/logout', [AuthController::class, 'logout']);
// Register
Route::get('/register', [AuthController::class, 'index']);
Route::post('/register', [AuthController::class, 'store']);

// DATATABLES
Route::get('/datatablesPembelian', [PembelianController::class, 'dataTables'])->middleware('auth');
Route::get('/datatablesMotor', [BikeController::class, 'dataTables'])->middleware('auth');
Route::get('/datatablesIndividu', [ConsumerController::class, 'dataTables'])->middleware('auth');
Route::get('/datatablesDealer', [ConsumerController::class, 'dataTables2'])->middleware('auth');
Route::get('/dataTablesMotor', [ConsumerController::class, 'dataTablesMotor'])->middleware('auth');
Route::get('/dataTablesReady', [BikeController::class, 'dataTablesReady'])->middleware('auth');
Route::get('/dataTablesTerjual', [BikeController::class, 'dataTablesTerjual'])->middleware('auth');
Route::get('/dataTablesPenjualan', [PenjualanController::class, 'dataTables'])->middleware('auth');
Route::get('//dataTablesPenjualanKredit', [KreditController::class, 'dataTables'])->middleware('auth');
Route::get('/dataTablesMaintenance', [MaintenanceController::class, 'dataTables'])->middleware('auth');
