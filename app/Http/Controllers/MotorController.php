<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Motor;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Motor::all();

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
        $data = new Motor;
        $data->id_merek = $request->id_merek;
        $data ->tipe = $request->tipe;
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
        $data = Motor::find($id);

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
        $data = Motor::find($id);

        if(!is_null($request->id_merek)){
            $data->id_merek = $request->id_merek;
        }

        if(!is_null($request->tipe)){
            $data->tipe = $request->tipe;
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
        $data = Motor::find($id);

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
