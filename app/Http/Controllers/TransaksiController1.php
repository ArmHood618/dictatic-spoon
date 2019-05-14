<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\TransaksiPegawai;
use App\DetilSparepart;
use App\DetilJasa;
use App\Sparepart;
use App\Jasa;
use App\Cabang;
use App\Motor;
use App\Pegawai;
use App\Role;

class TransaksiController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('role') == 'OW'){
            $data = Transaksi::all();
            $transaksi_pegawai= TransaksiPegawai::all();    
            $montir = Pegawai::where('role','MN');
            return view('Owner.tampilTransaksi',compact('data','transaksi_pegawai','montir'));
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
        $cabang = Cabang::pluck('daerah','id');
        $jasa = Jasa::pluck('jenis','id');
        $sparepart = Sparepart::pluck('nama','id');
        $motor = Motor::pluck('tipe','id');
        $semua_jasa = Jasa::all();
        $semua_sparepart = Sparepart::all();
        $montir = Pegawai::where('id_role','MN')->pluck('nama','id');

        return view('Owner.tambahTransaksi',compact('cabang','jasa','sparepart','motor','semua_jasa','semua_sparepart','montir'));
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
            for($i=0;$i<count($request->id_jasa);$i++){
                $detil_jasa = new DetilJasa;
                $detil_jasa->id_jasa = $request->id_jasa[$i];
                $detil_jasa->jumlah = $request->jumlah_jasa[$i];
                $detil_jasa->id_transaksi = $transaksi->id;
                $detil_jasa->save();
            }
        }

        if(!empty($request->id_sparepart)){
            for($i=0;$i<count($request->id_sparepart);$i++){
                $detil_sparepart = new DetilSparepart;
                $detil_sparepart->id_sparepart = $request->id_sparepart[$i];
                $detil_sparepart->jumlah = $request->jumlah_sparepart[$i];
                $detil_sparepart->id_transaksi = $transaksi->id;
                $detil_sparepart->save();
            }
        }

        $transaksi_pegawai1 = new TransaksiPegawai;
        $transaksi_pegawai1->id_pegawai = $request->id_pegawai;
        $transaksi_pegawai1->id_transaksi = $transaksi->id;
        $transaksi_pegawai1->save();

        $transaksi_pegawai2 = new TransaksiPegawai;
        $transaksi_pegawai2->id_pegawai = session()->get('id');
        $transaksi_pegawai2->id_transaksi = $transaksi->id;
        $transaksi_pegawai2->save();
            
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
        $data = Transaksi::find($id);
        $cabang = Cabang::pluck('daerah','id');
        $jasa = Jasa::pluck('jenis','id');
        $sparepart = Sparepart::pluck('nama','id');
        $motor = Motor::pluck('tipe','id');
        $semua_jasa = Jasa::all();
        $semua_sparepart = Sparepart::all();
        $semua_montir = Pegawai::where('id_role','MN')->pluck('nama','id');
        $montir = $data->pegawai->where('id_role','MN');
        $detil_jasa = $data->jasa;
        $detil_sparepart = $data->sparepart;

        return view('Owner.editTransaksi',compact('data','cabang','jasa','sparepart','motor','semua_jasa','semua_sparepart','montir','semua_montir','detil_jasa','detil_sparepart'));
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
        Transaksi::find($id)->delete();
        return redirect()->route('owner.transaksi.index')->with('alert','Item deleted successfully');
    }

    public function print($id)
    {
        $data = Transaksi::find($id);
        $montir = $data->pegawai->where('id_role','MN')->first();
        $pegawai = $data->pegawai->where('id_role','!=','MN')->first();
        $sparepart = $data->sparepart;
        $jasa = $data->jasa;
        return view('PrintPreviews.SPK',compact('data','montir','pegawai','sparepart','jasa'));
    }

    public function pembayaran($id){
        $jasa = Jasa::selectRaw(DB::raw('SUM(detil_jasa.jumlah * jasa.harga) as subtotal'))->whereRaw('id_transaksi = ?',[$id]);
        $sparepart = Sparepart::selectRaw(DB::raw('SUM(detil_sparepart.jumlah * sparepart.harga_jual) as subtotal'))->whereRaw('id_transaksi = ?',[$id]);
        $tanggal = date('Y-m-d');
        $total = $jasa->subtotal + $sparepart->subtotal;

        return view('Owner.pembayaranDetail',compact('jasa','sparepart','tanggal','total'));
    }

    public function pelunasan(Request $request, $id){
        $data = Transaksi::find($id);
        $data->isLunas = 1;

        return view('Owner.pembayaran');
        
    }
}
