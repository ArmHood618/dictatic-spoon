<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jasa;

class JasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jasa::all();

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
        $data = new Jasa;
        $data->jenis = $request->jenis;
        $data->harga = $request->harga;
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
        $data = Jasa::find($id);

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
        $data = Jasa::find($id);

        if(!is_null($request->jenis)){
            $data->jenis = $request->jenis;
        }
        
        if(!is_null($request->harga)){
            $data->harga = $request->harga;
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
        $data = Jasa::find($id);

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
