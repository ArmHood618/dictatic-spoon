<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pegawai::all();

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
        $data = new Pegawai;
        $data ->id_cabang = $request->id_cabang;
        $data ->id_role = $request->id_role;
        $data ->nama = $request->nama;
        $data ->alamat = $request->alamat;
        $data ->no_telp = $request->no_telp;
        $data ->gaji = $request->gaji;
        $data ->username = $request->username;
        $data ->password = $request->password;
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
        $data = Pegawai::find($id);

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
        $data = Pegawai::find($id);

        if(!is_null($request->id_cabang)){
            $data->id_cabang = $request->id_cabang;
        }

        if(!is_null($request->id_role)){
            $data ->id_role = $request->id_role;
        }

        if(!is_null($request->nama)){
            $data ->nama = $request->nama;
        }
        
        if(!is_null($request->alamat)){
            $data ->alamat = $request->alamat;
        }
        
        if(!is_null($request->no_telp)){
            $data ->no_telp = $request->no_telp;
        }

        if(!is_null($request->gaji)){
            $data ->gaji = $request->gaji;
        }

        if(!is_null($request->usename)){
            $data ->username = $request->username;
        }

        if(!is_null($request->password)){
            $data ->password = $request->password;
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
        $data = Pegawai::find($id);

        if(is_null($data)){
            return response()->json('Not Found',404);
        }

        $success = $data->delete();

        if(!$success){
            return response()->json('Error Deleting', 500);
        }else
            return response()->json('Success',201);
    }

    public function login(Request $request){

        $data = Pegawai::where([['username', '=', $request->username ],['password','=',$request->password]])->first();
        if(is_null($data)){
            return response()->json('Not Found',404);
        } else {
            return response()->json($data,200);
        }
        
    }
}
