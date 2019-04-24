<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaksi::all();

        return response()->json($data,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Transaksi;
        $data ->id_motor = $request->id_motor;
        $data ->id_cabang = $request->id_cabang;
        $data ->nama = $request->nama;
        $data ->jenis_transaksi = $request->jenis_transaksi;
        $data ->no_telp = $request->no_telp;
        $data ->no_plat = $request->no_plat;
        $data ->tanggal = $request->tanggal;
        if(!is_null($request->tanggal_lunas)){
            $data ->tanggal_lunas = $request->tanggal_lunas;
        }
        $data ->isLunas = $request->isLunas;
        $data ->isSelesai = $request->isSelesai;
        $success = $data->save();

        if(!$success){
            return response()->json('Error Saving', 500);
        }else
            return response()->json('Success',201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaksi::find($id);

        if(is_null($data)){
            return response()->json('Not Found',404);
        }else
            return response()->json($data,200);
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
            $data->jenis_transaksi = $request->jenis_transaksi;
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
