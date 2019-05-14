<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Pengadaan;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function pendapatanBulanan(Request $request){
        
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
 
        $tahun = $request->tahun;
       

        $semua = DB::select( DB::raw($query), array(
            'year' => $tahun,
        ));
        
        foreach($semua as $s){
            $all[$s->bulan - 1] = $s;
        }
        return view('PrintPreviews.PendapatanBulanan',compact('all','tahun'));
        
    }

    public function pendapatanTahunan(Request $request){
        
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
 
        $tahun = $request->tahun;
        

        $all = DB::select( DB::raw($query), array(
            'year' => $tahun,
            'year1' => $tahun,
            'year2' => $tahun,
        ));

        $cabang_n = DB::select(DB::raw("SELECT COUNT(*) c FROM cabang"))[0]->c;

        return view('PrintPreviews.PendapatanTahunan',compact('all', 'tahun', 'cabang_n'));
    }

    public function pengeluaranBulanan(Request $request){
        
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
            'year' => $request->tahun,
        ));
        $tahun = $request->tanggal;
        foreach($semua as $s){
            $all[$s->bulan - 1] = $s;
        }
        return view('PrintPreviews.PengeluaranBulanan',compact('all','tahun'));
    }

    public function penjualanJasa(Request $request){
        $query=<<<DATA
        SELECT
            z.tahun tahun,
            z.bulan bulan,
            z.tipe tipe,
            z.merek merek,
            Y.jenis jenis,
            IF(z.jumlah IS NULL, 0, z.jumlah) jumlah
        FROM
            (
            SELECT
                jasa.id AS id_jasa,
                YEAR(transaksi.tanggal) tahun,
                MONTH(transaksi.tanggal) bulan,
                motor.tipe AS tipe,
                merek.merek AS merek,
                detil_jasa.jumlah AS jumlah
            FROM
                motor
            LEFT JOIN merek ON motor.id_merek = merek.id
            LEFT JOIN transaksi ON transaksi.id_motor = motor.id
            LEFT JOIN detil_jasa ON transaksi.id = detil_jasa.id_transaksi
            LEFT JOIN jasa ON detil_jasa.id_jasa = jasa.id
            WHERE
                MONTH(transaksi.tanggal) = :month AND YEAR(transaksi.tanggal) = :year
            GROUP BY
                jasa.id
        ) z
        CROSS JOIN jasa Y ON
            Y.id = z.id_jasa
DATA;


        $all = DB::select( DB::raw($query), array(
            'year' => $request->tahun,
            'month' => $request->bulan,
        ));
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $cabang_n = DB::select(DB::raw("SELECT COUNT(*) c FROM jasa"))[0]->c;

        return view('PrintPreviews.PenjualanJasa',compact('all','tahun','bulan','cabang_n'));
    }

    public function sparepartTerlaris(Request $request){
        $query=<<<DATA
        SELECT
            MAX(detil_sparepart.jumlah) jumlah,
            sparepart.nama nama,
            sparepart.tipe tipe,
            MONTH(transaksi.tanggal) bulan
        FROM
            transaksi
        LEFT JOIN
            detil_sparepart ON detil_sparepart.id_transaksi = transaksi.id
        LEFT JOIN
            sparepart ON sparepart.id = detil_sparepart.id_sparepart
        WHERE YEAR(transaksi.tanggal) = :year
DATA;

        $semua = DB::select( DB::raw($query), array(
            'year' => $request->tahun,
        ));
        $tahun = $request->tahun;
        foreach($semua as $s){
            $all[$s->bulan - 1] = $s;
        }
        return view('PrintPreviews.SparepartTerlaris',compact('all','tahun'));
    }
}
