<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Motor;
use App\Merek;

class MotorController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Motor::all();

        return view('Owner.tampilMotor',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $merek = Merek::pluck('merek','id');
        } catch (ModelNotFoundException $e) {
            return back()->withError('alert',$e->getMessage());
        }
        return view('Owner.tambahMotor',compact('merek'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['id_merek' => 'required', 'tipe' => 'required']);
        Motor::create($request->all());
        return redirect()->route('owner.motor.index')->with('success','Item created successfully');
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
        $data = Motor::find($id);

        try{
            $merek = Merek::pluck('merek','id');
        } catch (ModelNotFoundException $e) {
            return back()->withError('alert',$e->getMessage());
        }

        return view('Owner.editMotor',compact('data','merek'));
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
        Motor::find($id)->update($request->all());

        return redirect()->route('owner.motor.index')->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Motor::find($id)->delete();
        return redirect()->route('owner.motor.index')->with('success','Item deleted successfully');
    }
}
