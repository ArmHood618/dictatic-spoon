<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Charts\PendapatanBulananChart;
use App\Transaksi;
use App\Pengadaan;
class ChartController extends Controller
{
    public function pendapatanBulanan($tahun){
        $semua = Transaksi::selectRaw(DB::raw('YEAR(transaksi.tanggal) as tahun, MONTH(transaksi.tanggal) as bulan, SUM(detil_sparepart.jumlah * sparepart.harga_jual) as subtotal_sparepart, SUM(detil_jasa.jumlah * jasa.harga) as subtotal_jasa, SUM(detil_sparepart.jumlah * sparepart.harga_jual) + SUM(detil_jasa.jumlah * jasa.harga) as total'))->rightJoin('detil_sparepart','transaksi.id','=','detil_sparepart.id_transaksi')->join('sparepart','detil_sparepart.id_sparepart','=','sparepart.id')->rightJoin('detil_jasa','transaksi.id','=','detil_jasa.id_transaksi')->join('jasa','detil_jasa.id_jasa','=','jasa.id')->whereRaw('YEAR(transaksi.tanggal) = ?', [$tahun])->groupBy(DB::raw('bulan, tanggal'))->get();
        for($i=0;$i<12;$i++){
            $all[$i]=0;
            $sparepart[$i]=0;
            $jasa[$i]=0;
        }
        foreach($semua as $s){
            $all[$s->bulan - 1] = $s->total;
            $sparepart[$s->bulan - 1]=$s->subtotal_sparepart;
            $jasa[$s->bulan - 1]=$s->subtotal_jasa;
        }

        $chart = new PendapatanBulananChart;
        $labels = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $chart->labels($labels);
        $chart->title('PENDAPATAN BULANAN');
        $chart->dataset('Sparepart','bar',$sparepart)->backgroundColor('#ff0000');
        $chart->dataset('Service','bar',$jasa)->backgroundColor('#00ff00');
        $chart->dataset('Total','bar',$all)->backgroundColor('#0000ff');

        return view('PrintPreviews.grafikPendapatanBulanan',compact('chart'));
    }

    public function pengeluaranBulanan($tahun){
    }
}
