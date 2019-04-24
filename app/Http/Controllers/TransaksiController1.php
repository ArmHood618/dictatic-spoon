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
        $detil_jasa = Jasa::all();
        $detil_sparepart = Sparepart::all();

        return view('Pegawai.transaksi',compact('cabang','jasa','sparepart','motor','detil_jasa','detil_sparepart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data = Transaksi::find($id);

        if(!is_null($request->id_motor)){
            $data->id_motor = $request->id_motor;
        }
        
        if(!is_null($request->id_cabang)){
            $data->id_cabang = $request->id_cabang;
        }

        if(!is_null($request->nama)){
            $data->nama = $request->nama;
        }

        if(!is_null($request->id_jenis_transaksi)){
            $data->id_jenis_transaksi = $request->id_jenis_transaksi;
        }

        if(!is_null($request->no_telp)){
            $data->no_telp = $request->no_telp;
        }

        if(!is_null($request->no_plat)){
            $data->no_plat = $request->no_plat;
        }

        if(!is_null($request->tanggal)){
            $data->tanggal = $request->tanggal;
        }

        if(!is_null($request->tanggal_lunas)){
            $data->tanggal_lunas = $request->tanggal_lunas;
        }

        if(!is_null($request->isLunas)){
            $data->isLunas = $request->isLunas;
        }

        if(!is_null($request->isSelesai)){
            $data->isSelesai = $request->isSelesai;
        }

        $success = $data->save();

        if(!$success){
            return response()->json('Error Updating', 500);
        }else
            return response()->json('Success',201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Transaksi::find($id);

        if(is_null($data)){
            return response()->json('Not Found',404);
        }

        $success = $data->delete();

        if(!$success){
            return response()->json('Error Deleting', 500);
        }else
            return response()->json('Success',201);
    }
}
