<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengadaan;
use App\DetilPengadaan;
use App\Supplier;
use App\Sparepart;

class PengadaanController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengadaan::all();
        
        return view('Owner.tampilPengadaan', compact('data','supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::pluck('nama','id');
        $semua_sparepart = Sparepart::all();
        $sparepart = Sparepart::pluck('nama','id');

        return view('Owner.tambahPengadaan',compact('supplier','sparepart','semua_sparepart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['tanggal' => 'required']);
        $data = new Pengadaan;
        $data ->id_supplier = $request->id_supplier;
        $data ->tanggal = $request->tanggal;
        $data->save();

        if(!empty($request->id_sparepart)){
            for($i=0;$i<count($request->id_sparepart);$i++){
                $detil_pengadaan = new DetilPengadaan;
                $detil_pengadaan->id_sparepart = $request->id_sparepart[$i];
                $detil_pengadaan->jumlah = $request->jumlah_sparepart[$i];
                $detil_pengadaan->id_pengadaan = $data->id;
                $detil_pengadaan->save();
            }
        }

        return redirect()->route('owner.pengadaan.index')->with('success','Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pengadaan::find($id);

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
        $data = Pengadaan::find($id);

        if(!is_null($request->id_supplier)){
            $data->id_supplier = $request->id_supplier;
        }
        
        if(!is_null($request->tanggal)){
            $data->tanggal = $request->tanggal;
        }

        $success = $data->save();

        if(!empty($request->id_sparepart)){
            for($i=0;$i<count($request->id_sparepart);$i++){
                $detil_pengadaan = new DetilPengadaan;
                $detil_pengadaan->id_sparepart = $request->id_sparepart[$i];
                $detil_pengadaan->jumlah = $request->jumlah_sparepart[$i];
                $detil_pengadaan->id_pengadaan = $data->id;
                $detil_pengadaan->save();
            }
        }

        return redirect()->route('owner.pengadaan.index')->with('success','Item created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pengadaan::find($id);

        $success = $data->delete();

        return redirect()->route('owner.pengadaan.index')->with('success','Item created successfully');
        
    }
}
