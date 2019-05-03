<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\DetilSparepart;
use App\DetilJasa;
use App\Sparepart;
use App\Jasa;
use App\Cabang;
use App\Motor;

class TransaksiController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cabang = Cabang::pluck('daerah','id');
        $jasa = Jasa::pluck('jenis','id');
        $sparepart = Sparepart::pluck('nama','id');
        $motor = Motor::pluck('tipe','id');
        $semua_jasa = Jasa::all();
        $semua_sparepart = Sparepart::all();

        return view('Pegawai.transaksi',compact('cabang','jasa','sparepart','motor','semua_jasa','semua_sparepart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['id_cabang' => 'required','nama' => 'required','id_motor' => 'required','no_plat' => 'required','no_telp' => 'required','tanggal' => 'required']);
        
        $transaksi = new Transaksi;
        $transaksi ->id_cabang = $request->id_cabang;
        $transaksi ->id_motor = $request->id_motor;
        $transaksi ->nama = $request->nama;
        $transaksi ->no_plat = $request->no_plat;
        $transaksi ->no_telp = $request->no_telp;
        $transaksi ->tanggal = $request->tanggal;
        if(!empty($request->id_jasa)){
            $transaksi ->jenis_transaksi = 'SV';
            if(!empty($request->id_sparepart)){
                $transaksi ->jenis_transaksi = 'SS';
            }
        }else{
            $transaksi ->jenis_transaksi = 'SP';
        }
        $transaksi->save();

        if(!empty($request->id_jasa)){
            foreach($request->id_jasa as $id_jasa){
                $detil_jasa = new DetilJasa;
                $detil_jasa->id_jasa = $id_jasa;
                $detil_jasa->id_transaksi = $transaksi->id;
                $detil_jasa->save();
            }
        }

        if(!empty($request->id_sparepart)){
            foreach($request->id_sparepart as $id_sparepart){
                $detil_sparepart = new DetilSparepart;
                $detil_sparepart->id_motor = $id_sparepart;
                $detil_sparepart->id_transaksi = $transaksi->id;
                $detil_sparepart->save();
            }
        }
            
        return redirect()->route('owner.transaksi.index')->with('success','Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
