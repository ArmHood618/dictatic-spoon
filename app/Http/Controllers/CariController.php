<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Sparepart;
use App\TransaksiPegawai;
use App\Pegawai;

class CariController extends Controller
{
    //
    public function cariSparepart(Request $request){
        
    }

    //
    public function cariTransaksi(Request $request){
        $data = Transaksi::where('no_plat','LIKE',$request->cari)->orWhere('no_telp','LIKE',$request->cari)->get();
        $transaksi_pegawai= TransaksiPegawai::all();
        $montir = Pegawai::where('role','MN');
        return view('tampilTransaksi',compact('data','transaksi_pegawai','montir'));
    }
}
