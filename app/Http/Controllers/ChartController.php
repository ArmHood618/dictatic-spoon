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
        
        $query=<<<DATA
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

        $semua = DB::select( DB::raw($query), array(
            'year' => $tahun,
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

        
        $query=<<<DATA
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

        

        $semua = DB::select( DB::raw($query), array(
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
        $chart->title('PENGELUARAN BULANAN');
        $chart->dataset('Pengeluaran','bar',$sparepart)->backgroundColor('#ff0000');

        return view('PrintPreviews.grafik',compact('chart'));
    }

    public function pendapatanTahunan($tahun){
        $query=<<<DATA
        SELECT
            x.tahun tahun,
            y.daerah daerah,
            IF(z.subtotal_sparepart IS NULL,0,z.subtotal_sparepart) subtotal_sparepart,
            IF(z.subtotal_jasa IS NULL,0,z.subtotal_jasa) subtotal_jasa,
            IF(z.total IS NULL,0,z.total) total
        FROM (
            SELECT i + :year tahun FROM (
                SELECT 0 i
                UNION SELECT 1
                UNION SELECT 2
                UNION SELECT 3
                UNION SELECT 4
            ) xx
        ) x
        CROSS JOIN cabang y
        LEFT JOIN (
            SELECT
                t.tahun as tahun,
                t.id_cabang as id_cabang,
                SUM(IF(t.subtotal_sparepart IS NULL,0,t.subtotal_sparepart)) subtotal_sparepart,
                SUM(IF(t.subtotal_jasa IS NULL,0,t.subtotal_jasa)) subtotal_jasa,
                SUM(IF(t.subtotal_sparepart IS NULL,0,t.subtotal_sparepart) + IF(t.subtotal_jasa IS NULL,0,t.subtotal_jasa)) total
            FROM (
                SELECT
                    cabang.id as id_cabang,
                    YEAR(transaksi.tanggal) tahun,
                    SUM(detil_sparepart.jumlah * sparepart.harga_jual) as subtotal_sparepart,
                    SUM(detil_jasa.jumlah * jasa.harga) as subtotal_jasa
                FROM cabang
                    LEFT JOIN transaksi ON cabang.id = transaksi.id_cabang AND YEAR(transaksi.tanggal) BETWEEN :year1 AND :year2 + 4
                    LEFT JOIN detil_sparepart ON transaksi.id = detil_sparepart.id_transaksi
                    LEFT JOIN detil_jasa ON transaksi.id = detil_jasa.id_transaksi
                    LEFT JOIN sparepart ON detil_sparepart.id_sparepart = sparepart.id
                    LEFT JOIN jasa ON detil_jasa.id_jasa = jasa.id
                GROUP BY cabang.id
            ) t
            GROUP BY t.tahun
        ) z ON y.id = z.id_cabang AND x.tahun = z.tahun
DATA;
        

        $semua = DB::select( DB::raw($query), array(
            'year' => $tahun,
            'year1' => $tahun,
            'year2' => $tahun,
        ));

        $cabang_n = DB::select(DB::raw("SELECT COUNT(*) c FROM cabang"))[0]->c;

        for($i=0;$i<12;$i++){
            $all[$i]=0;
            $sparepart[$i]=0;
            $jasa[$i]=0;
        }
        $cc = 0;
        $all = array();
        foreach($semua as $one){
            if($cc == 0){
                $tahunArr[$one->tahun-$tahun] = $one->tahun;
            }
            $all[$cc][$one->tahun-$tahun]=$one->total;
            $cc = ++$cc % $cabang_n;
        }
        for($i=0;$i<$cabang_n;$i++){
            $daerah[$i]=$semua[$i]->daerah;
        }

        $chart = new PendapatanBulananChart;
        $labels = $tahunArr;
        $chart->labels($labels);
        $chart->title('PENDAPATAN TAHUNAN');
        $i = 0;
        foreach($daerah as $d){
            $chart->dataset($d,'bar',$all[$i])->backgroundColor('#ff0000');
            $i++;
        }
        
        return view('PrintPreviews.grafik',compact('chart'));
    }

    public function penjualanJasa($tahun,$bulan){

    }
}
