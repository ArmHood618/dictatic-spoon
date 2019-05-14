<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sparepart;
use App\Letak;
use App\Ruang;
use App\Motor;
use App\MotorSparepart;

class SparepartController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('role') == 'OW'){
            $data = Sparepart::all();

            return view('Owner.tampilSparepart',compact('data'));
        }else{
            return redirect()->route('home')->with(['alert' => 'Halaman Hanya Bisa diakses oleh pemilik']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $letak = Letak::pluck('letak','id');
            $ruang = Ruang::pluck('ruang','id');
            $motor = Motor::pluck('tipe','id');
            $motorAll = Motor::all();
        } catch (ModelNotFoundException $e) {
            return back()->withError('alert',$e->getMessage());
        }
        return view('Owner.tambahSparepart',compact('letak','ruang','motor','motorAll'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['tipe' => 'required','nama' => 'required','id_letak' => 'required','id_ruang' => 'required','stok_min' => 'required','harga_beli' => 'required','harga_jual' => 'required']);
        
        $sparepart = new Sparepart;
        $sparepart ->id_letak = $request->id_letak;
        $sparepart ->id_ruang = $request->id_ruang;
        $sparepart ->nama = $request->nama;
        $sparepart ->tipe = $request->tipe;
        $sparepart ->stok_min = $request->stok_min;
        $sparepart ->harga_beli = $request->harga_beli;
        $sparepart ->harga_jual = $request->harga_jual;
        $sparepart->save();
        if(!empty($request->id_motor)){
            foreach($request->id_motor as $id_motor){
                $motorsparepart = new MotorSparepart;
                $motorsparepart->id_motor = $id_motor;
                $motorsparepart->id_sparepart = $sparepart->id;
                $motorsparepart->save();
            }
        }
            
        return redirect()->route('owner.sparepart.index')->with('success','Item created successfully');
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
        try{
            $data = Sparepart::find($id);
            $letak = Letak::pluck('letak','id');
            $ruang = Ruang::pluck('ruang','id');
            $motor = Motor::pluck('tipe','id');
            $motorsparepart = $data->motor;
            $motorAll = Motor::all();
        } catch (ModelNotFoundException $e) {
            return back()->withError('alert',$e->getMessage());
        }
        return view('Owner.editSparepart', compact('data','letak','ruang','motorsparepart','motor','motorAll'));
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
        $sparepart = Sparepart::find($id);
        $sparepart ->id_letak = $request->id_letak;
        $sparepart ->id_ruang = $request->id_ruang;
        $sparepart ->nama = $request->nama;
        $sparepart ->tipe = $request->tipe;
        $sparepart ->stok_min = $request->stok_min;
        $sparepart ->harga_beli = $request->harga_beli;
        $sparepart ->harga_jual = $request->harga_jual;
        $sparepart->save();

        if(!empty($request->add_id_motor)){
            foreach($request->add_id_motor as $id_motor){
                $motorsparepart = new MotorSparepart;
                $motorsparepart->id_motor = $id_motor;
                $motorsparepart->id_sparepart = $sparepart->id;
                $motorsparepart->save();
            }
        }

        if(!empty($request->delete_id_motor)){
            foreach($request->delete_id_motor as $id_motor){
                MotorSparepart::find($id_motor)->delete();
            }
        }
        
        return redirect()->route('owner.sparepart.index')->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sparepart::find($id)->delete();
        return redirect()->route('owner.sparepart.index')->with('success','Item deleted successfully');
    }
}
