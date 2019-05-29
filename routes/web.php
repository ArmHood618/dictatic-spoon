<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('rute', function() {
    $routeCollection = Route::getRoutes();

    echo "<table style='width:100%'>";
        echo "<tr>";
            echo "<td width='10%'><h4>HTTP Method</h4></td>";
            echo "<td width='10%'><h4>Route</h4></td>";
            echo "<td width='10%'><h4>Name</h4></td>";
            echo "<td width='70%'><h4>Corresponding Action</h4></td>";
        echo "</tr>";
        foreach ($routeCollection as $value) {
            echo "<tr>";
                echo "<td>" . $value->getActionMethod() . "</td>";
                echo "<td>" . $value->uri() . "</td>";
                echo "<td>" . $value->getName() . "</td>";
                echo "<td>" . $value->getActionName() . "</td>";
            echo "</tr>";
        }
    echo "</table>";
});



Route::get('/login', function () {
    return view('login');
})->name('login.view');

Route::post('/login', 'PegawaiController1@login')->name('login.process');
Route::get('/logout', 'PegawaiController1@logout')->name('logout.process');

Route::prefix('owner')->group(function () {
    Route::get('/', function(){
        return view('Owner.welcome');
    })->name('owner.index');
    Route::resource('merek', 'MerekController1',['as' => 'owner']);
    Route::resource('jenis_transaksi', 'JenisTransaksiController1',['as' => 'owner']);
    Route::resource('role', 'RoleController1',['as' => 'owner']);
    Route::resource('motor', 'MotorController1',['as' => 'owner']);
    Route::resource('jasa', 'JasaController1',['as' => 'owner']);
    Route::resource('supplier', 'SupplierController1',['as' => 'owner']);
    Route::resource('sales', 'SalesController1',['as' => 'owner']);
    Route::resource('cabang', 'CabangController1',['as' => 'owner']);
    Route::resource('pegawai', 'PegawaiController1',['as' => 'owner']);
    Route::resource('sparepart', 'SparepartController1',['as' => 'owner']);
    Route::resource('pengadaan', 'PengadaanController1',['as' => 'owner']);
    Route::resource('sisa_stok', 'SisaStokController1',['as' => 'owner']);
    Route::resource('motor_sparepart', 'MotorSparepartController1',['as' => 'owner']);
    Route::resource('detil_sparepart', 'DetilSparepartController1',['as' => 'owner']);
    Route::resource('detil_jasa', 'DetilJasaController1',['as' => 'owner']);
    Route::resource('transaksi_pegawai', 'TransaksiPegawaiController1',['as' => 'owner']);
    Route::resource('detil_pengadaan', 'DetilPengadaanController1',['as' => 'owner']);
    Route::get('/SPK/{id}', 'TransaksiController1@print')->name('owner.SPK');
    Route::get('/SPS/{id}', 'PengadaanController1@print')->name('owner.SPS');
    Route::get('/Nota/{id}', 'TransaksiController1@printNota')->name('owner.Nota');
    //
    Route::get('pengadaan/konfirmasi/{id}', 'PengadaanController1@konfirmasi')->name('owner.pengadaan.konfirmasi');
    Route::get('transaksi/bayar/{id}', 'TransaksiController1@pembayaran')->name('owner.transaksi.bayar');
    Route::post('transaksi/lunas/{id}', 'TransaksiController1@pelunasan')->name('owner.transaksi.lunas');
    //
    Route::get('/pendapatan_bulanan', function(){
        return view('Owner.pendapatanBulanan');
    })->name('owner.pendapatan_bulanan');
    Route::post('/pendapatan_bulanan', 'LaporanController@pendapatanBulanan')->name('owner.pendapatan_bulanan.create');
    Route::get('/pendapatan_bulanan/chart/{tahun}', 'ChartController@pendapatanBulanan')->name('owner.pendapatan_bulanan.graph');
    //
    Route::get('/pengeluaran_bulanan', function(){
        return view('Owner.pengeluaranBulanan');
    })->name('owner.pengeluaran_bulanan');
    Route::post('/pengeluaran_bulanan', 'LaporanController@pengeluaranBulanan')->name('owner.pengeluaran_bulanan.create');
    Route::get('/pengeluaran_bulanan/chart/{tahun}', 'ChartController@pengeluaranBulanan')->name('owner.pengeluaran_bulanan.graph');
    //
    Route::get('/pendapatan_tahunan', function(){
        return view('Owner.pendapatanTahunan');
    })->name('owner.pendapatan_tahunan');
    Route::post('/pendapatan_tahunan', 'LaporanController@pendapatanTahunan')->name('owner.pendapatan_tahunan.create');
    Route::get('/pendapatan_tahunan/chart/{tahun}', 'ChartController@pendapatanTahunan')->name('owner.pendapatan_tahunan.graph');
    //
    Route::get('/penjualan_jasa', function(){
        return view('Owner.penjualanJasa');
    })->name('owner.penjualan_jasa');
    Route::post('/penjualan_jasa', 'LaporanController@penjualanJasa')->name('owner.penjualan_jasa.create');
    //
    Route::get('/sparepart_terlaris', function(){
        return view('Owner.sparepartTerlaris');
    })->name('owner.sparepart_terlaris');
    Route::post('/sparepart_terlaris', 'LaporanController@sparepartTerlaris')->name('owner.sparepart_terlaris.create');
    Route::get('/sparepart_terlaris/chart/{tahun}', 'ChartController@sparepartTerlaris')->name('owner.sparepart_terlaris.graph');
    //
    //
    Route::get('/sisa_stok', 'LaporanController@sisaStokInput')->name('owner.sisa_stok');
    Route::post('/sisa_stok', 'LaporanController@sparepartTerlaris')->name('owner.sisa_stok.create');
    Route::post('/sisa_stok/chart/', 'ChartController@sparepartTerlaris')->name('owner.sisa_stok.graph');
    //
    Route::get('/pembayaran', function(){
        return view('Owner.pembayaran');
    })->name('owner.pembayaran');
    
});
Route::resource('transaksi', 'TransaksiController1',['as' => 'owner']);
Route::prefix('pegawai')->group(function(){
    Route::get('/', function(){
        return view('Pegawai.welcome');
    })->name('pegawai.index');
    
    Route::get('/detail_transaksi/{id}','TransaksiController1@detailTransaksi')->name('detail_transaksi');
});
Route::post('/cari','CariController@cariTransaksi')->name('cari');
Route::prefix('cs')->group(function(){});
Route::get('/test', function(){
    return view('PrintPreviews.SPK');
});