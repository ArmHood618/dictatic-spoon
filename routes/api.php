<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, enctype');
header('Access-Control-Allow-Methods: GET, PATCH, POST, DELETE');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('merek', 'MerekController');
Route::resource('jenis_transaksi', 'JenisTransaksiController');
Route::resource('role', 'RoleController');
Route::resource('motor', 'MotorController');
Route::resource('jasa', 'JasaController');
Route::resource('supplier', 'SupplierController');
Route::resource('sales', 'SalesController');
Route::resource('cabang', 'CabangController');
Route::resource('pegawai', 'PegawaiController');
Route::resource('letak', 'LetakController');
Route::resource('ruang', 'RuangController');
Route::resource('sparepart', 'SparepartController');
Route::resource('pengadaan', 'PengadaanController');
Route::resource('sisa_stok', 'SisaStokController');
Route::resource('motor_sparepart', 'MotorSparepartController');
Route::resource('transaksi', 'TransaksiController');
Route::resource('detil_sparepart', 'DetilSparepartController');
Route::resource('detil_jasa', 'DetilJasaController');
Route::resource('transaksi_pegawai', 'TransaksiPegawaiController');
Route::resource('detil_pengadaan', 'DetilPengadaanController');