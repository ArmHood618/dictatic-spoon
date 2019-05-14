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
        $alimsucks = 'alimoek';
        $$alimsucks=<<<DATA
        SELECT
            t.bulan bulan,
            SUM(IF(t.subtotal_sparepart IS NULL,0,t.subtotal_sparepart)) subtotal_sparepart,
            SUM(IF(t.subtotal_jasa IS NULL,0,t.subtotal_jasa)) subtotal_jasa,
            SUM(IF(t.subtotal_sparepart IS NULL,0,t.subtotal_sparepart) + IF(t.subtotal_jasa IS NULL,0,t.subtotal_jasa)) total
        FROM (
            SELECT
                transaksi.id,
                MONTH(transaksi.tanggal) as bulan,
                SUM(detil_sparepart.jumlah * sparepart.harga_jual) as subtotal_sparepart,
                SUM(detil_jasa.jumlah * jasa.harga) as subtotal_jasa
            FROM transaksi
                LEFT JOIN detil_sparepart ON transaksi.id = detil_sparepart.id_transaksi
                LEFT JOIN detil_jasa ON transaksi.id = detil_jasa.id_transaksi
                LEFT JOIN sparepart ON detil_sparepart.id_sparepart = sparepart.id
                LEFT JOIN jasa ON detil_jasa.id_jasa = jasa.id
            WHERE YEAR(transaksi.tanggal) = :year
            GROUP BY transaksi.id
        ) t
        GROUP BY t.bulan
DATA;

        $alimsucksverymuchlalalalalalala = $tahun;

        $semua = DB::select( DB::raw($alimoek), array(
            'year' => $alimsucksverymuchlalalalalalala,
        ));
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

        return view('PrintPreviews.grafik',compact('chart'));
    }

    public function pengeluaranBulanan($tahun){

        $alimsucks = 'alimoek';
        $$alimsucks=<<<DATA
        SELECT
            t.bulan bulan,
            SUM(IF(t.subtotal IS NULL,0,t.subtotal)) subtotal
        FROM (
            SELECT
                pengadaan.id,
                MONTH(pengadaan.tanggal) as bulan,
                SUM(detil_pengadaan.jumlah * sparepart.harga_jual) as subtotal
            FROM pengadaan
                LEFT JOIN detil_pengadaan ON pengadaan.id = detil_pengadaan.id_pengadaan
                LEFT JOIN sparepart ON detil_pengadaan.id_sparepart = sparepart.id
            WHERE YEAR(pengadaan.tanggal) = :year
            GROUP BY pengadaan.id
        ) t
        GROUP BY t.bulan
DATA;

        

        $semua = DB::select( DB::raw($alimoek), array(
            'year' => $tahun,
        ));

        for($i=0;$i<12;$i++){
            $all[$i]=0;
            $sparepart[$i]=0;
        }

        foreach($semua as $s){
            $sparepart[$s->bulan - 1]=$s->subtotal;
        }

        $chart = new PendapatanBulananChart;
        $labels = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $chart->labels($labels);
        $chart->title('PENDAPATAN BULANAN');
        $chart->dataset('Pengeluaran','bar',$sparepart)->backgroundColor('#ff0000');

        return view('PrintPreviews.grafik',compact('chart'));
    }
}
