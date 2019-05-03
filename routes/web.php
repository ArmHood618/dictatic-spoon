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
    Route::resource('transaksi', 'TransaksiController1',['as' => 'owner']);
    Route::resource('detil_sparepart', 'DetilSparepartController1',['as' => 'owner']);
    Route::resource('detil_jasa', 'DetilJasaController1',['as' => 'owner']);
    Route::resource('transaksi_pegawai', 'TransaksiPegawaiController1',['as' => 'owner']);
    Route::resource('detil_pengadaan', 'DetilPengadaanController1',['as' => 'owner']);
});

Route::prefix('pegawai')->group(function(){
    Route::get('/', function(){
        return view('Pegawai.welcome');
    })->name('pegawai.index');
});

Route::prefix('cs')->group(function(){});