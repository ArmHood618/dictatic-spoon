<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Pengadaan;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function pendapatanBulanan(Request $request){
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
 
        $tahun = $request->tahun;
        $alimsucksverymuchlalalalalalala = $tahun;

        $semua = DB::select( DB::raw($alimoek), array(
            'year' => $alimsucksverymuchlalalalalalala,
        ));
        
        foreach($semua as $s){
            $all[$s->bulan - 1] = $s;
        }
        return view('PrintPreviews.PendapatanBulanan',compact('all','tahun'));
        
    }

    public function pendapatanTahunan(Request $request){
        $alimsucks = 'alimoek';
        $$alimsucks=<<<DATA
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
 
        $tahun = $request->tahun;
        $alimsucksverymuchlalalalalalala = $tahun;

        $all = DB::select( DB::raw($alimoek), array(
            'year' => $alimsucksverymuchlalalalalalala,
            'year1' => $alimsucksverymuchlalalalalalala,
            'year2' => $alimsucksverymuchlalalalalalala,
        ));

        $cabang_n = DB::select(DB::raw("SELECT COUNT(*) c FROM cabang"))[0]->c;

        return view('PrintPreviews.PendapatanTahunan',compact('all', 'tahun', 'cabang_n'));
    }

    public function pengeluaranBulanan(Request $request){
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

        $alimsucksverymuchlalalalalalala = $request->tahun;

        $semua = DB::select( DB::raw($alimoek), array(
            'year' => $alimsucksverymuchlalalalalalala,
        ));

        $jasa;
        $sparepart;
        $tahun = $request->tanggal;
        foreach($semua as $s){
            $all[$s->bulan - 1] = $s;
        }
        return view('PrintPreviews.PengeluaranBulanan',compact('all','tahun'));
    }

    public function penjualanJasa(Request $request){
        $query=<<<DATA
        SELECT 
        FROM motor
        LEFT JOIN transaksi ON motor.id = transaksi.id_motor
        LEFT JOIN detil_jasa ON transaksi.id = detil_jasa.id_transaksi
        LEFT JOIN jasa ON detil_jasa.id_jasa = jasa.id
        
DATA;
    }

    public function sparepartTerlaris(){
        
    }
}
