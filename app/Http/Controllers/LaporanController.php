<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Pengadaan;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function pendapatanBulanan(Request $request){
        $semua = Transaksi::selectRaw(DB::raw('YEAR(transaksi.tanggal) as tahun, MONTH(transaksi.tanggal) as bulan, SUM(detil_sparepart.jumlah * sparepart.harga_jual) as subtotal_sparepart, SUM(detil_jasa.jumlah * jasa.harga) as subtotal_jasa, SUM(detil_sparepart.jumlah * sparepart.harga_jual) + SUM(detil_jasa.jumlah * jasa.harga) as total'))->rightJoin('detil_sparepart','transaksi.id','=','detil_sparepart.id_transaksi')->join('sparepart','detil_sparepart.id_sparepart','=','sparepart.id')->rightJoin('detil_jasa','transaksi.id','=','detil_jasa.id_transaksi')->join('jasa','detil_jasa.id_jasa','=','jasa.id')->whereRaw('YEAR(transaksi.tanggal) = ?', [$request->tanggal])->groupBy(DB::raw('bulan, tanggal'))->get();
        $tahun = $request->tanggal;
        
        foreach($semua as $s){
            $all[$s->bulan - 1] = $s;
        }
        return view('PrintPreviews.PendapatanBulanan',compact('all','tahun'));
        
    }

    public function pendapatanTahunan(){

        $placeholder = implode(', ', array_fill(0, count(), '?'));
        
    }

    public function pengeluaranBulanan(Request $request){

        $semua = Pengadaan::selectRaw(DB::raw('MONTH(pengadaan.tanggal) as bulan, SUM(detil_pengadaan.jumlah * sparepart.harga_beli) as subtotal, YEAR(pengadaan.tanggal) as tahun'))->join('detil_pengadaan','pengadaan.id','=','detil_pengadaan.id_pengadaan')->join('sparepart','detil_pengadaan.id_sparepart','=','sparepart.id')->whereRaw('YEAR(pengadaan.tanggal) = ?', [$request->tanggal])->groupBy(DB::raw('bulan, tanggal'))->get();
        $tahun = $request->tanggal;
        foreach($semua as $s){
            $all[$s->bulan - 1] = $s;
        }
        return view('PrintPreviews.PengeluaranBulanan',compact('all','tahun'));
    }

    public function penjualanJasa(Request $request){
        $all = Transaksi::selectRaw('')->whereRaw('YEAR(transaksi.tanggal) = ?',[$request->tahun])->whereRaw('MONTH(transaksi.tanggal) = ?',[$request->bulan]);
    }

    public function sparepartTerlaris(){
        $all = Transaksi::selectRaw('')->whereRaw('YEAR(transaksi.tanggal) = ?',[$request->tahun])->whereRaw('MONTH(transaksi.tanggal) = ?',[$request->bulan]);
    }
}
