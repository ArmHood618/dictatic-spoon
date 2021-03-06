<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sparepart;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sparepart::all();

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
        $data = new Sparepart;
        $data ->id_letak = $request->id_letak;
        $data ->id_ruang = $request->id_ruang;
        $data ->nama = $request->nama;
        $data ->tipe = $request->tipe;
        $data ->stok_min = $request->stok_min;
        $data ->harga_beli = $request->harga_beli;
        $data ->harga_jual = $request->harga_jual;
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
        $data = Sparepart::find($id);

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
        $data = Sparepart::find($id);

        if(!is_null($request->id_letak)){
            $data->id_letak = $request->id_letak;
        }
        
        if(!is_null($request->nama)){
            $data->nama = $request->nama;
        }

        if(!is_null($request->tipe)){
            $data->tipe = $request->tipe;
        }

        if(!is_null($request->stok)){
            $data->stok = $request->stok;
        }

        if(!is_null($request->stok_min)){
            $data->stok_min = $request->stok_min;
        }

        if(!is_null($request->harga_beli)){
            $data->harga_beli = $request->harga_beli;
        }

        if(!is_null($request->harga_jual)){
            $data->harga_jual = $request->harga_jual;
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
        $data = Sparepart::find($id);

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
