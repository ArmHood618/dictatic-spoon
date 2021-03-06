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
use Illuminate\Support\Facades\DB;

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
        }else if(session()->get('role') == 'CS' || session()->get('role') == 'KS'){
            $data = Transaksi::all();
            $transaksi_pegawai= TransaksiPegawai::all();    
            $montir = Pegawai::where('role','MN');
            return view('Pegawai.tampilTransaksi',compact('data','transaksi_pegawai','montir'));
        }else{
            return redirect()->route('home')->with(['alert' => 'Halaman Hanya Bisa diakses oleh pegawai']);
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
        if(session()->get('role') == 'OW'){
            return view('Owner.tambahTransaksi',compact('cabang','jasa','sparepart','motor','semua_jasa','semua_sparepart','montir'));
        }else if(session()->get('role') == 'CS' || session()->get('role') == 'KS'){
            return view('Pegawai.tambahTransaksi',compact('cabang','jasa','sparepart','motor','semua_jasa','semua_sparepart','montir'));
        }
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
        if(!empty($request->delete_id_sparepart)){
            foreach($request->delete_id_sparepart as $id_sparepart){
                DetilSparepart::find($id_sparepart)->delete();
            }
        }

        if(!empty($request->delete_id_jasa)){
            foreach($request->delete_id_jasa as $id_jasa){
                DetilJasa::find($id_jasa)->delete();
            }
        }

        $data = Transaksi::find($id);
        $data ->id_cabang = $request->id_cabang;
        $data ->id_motor = $request->id_motor;
        $data ->nama = $request->nama;
        $data ->no_plat = $request->no_plat;
        $data ->no_telp = $request->no_telp;
        $data ->tanggal = $request->tanggal;
        if(!empty($request->add_id_jasa) && !empty($data->jasa)){
            $data ->jenis_transaksi = 'SV';
            if(!empty($request->add_id_sparepart) && !empty($data->sparepart)){
                $data ->jenis_transaksi = 'SS';
            }
        }else{
            $data ->jenis_transaksi = 'SP';
        }
        $data->save();

        if(!empty($request->add_id_jasa)){
            for($i=0;$i<count($request->add_id_jasa);$i++){
                $detil_jasa = new DetilJasa;
                $detil_jasa->id_jasa = $request->add_id_jasa[$i];
                $detil_jasa->jumlah = $request->jumlah_jasa[$i];
                $detil_jasa->id_transaksi = $data->id;
                $detil_jasa->save();
            }
        }

        if(!empty($request->add_id_sparepart)){
            for($i=0;$i<count($request->add_id_sparepart);$i++){
                $detil_sparepart = new DetilSparepart;
                $detil_sparepart->id_sparepart = $request->add_id_sparepart[$i];
                $detil_sparepart->jumlah = $request->jumlah_sparepart[$i];
                $detil_sparepart->id_transaksi = $data->id;
                $detil_sparepart->save();
            }
        }

        

        $transaksi_pegawai1 = new TransaksiPegawai;
        $transaksi_pegawai1->id_pegawai = $request->id_pegawai;
        $transaksi_pegawai1->id_transaksi = $transaksi->id;
        $transaksi_pegawai1->save();

        return redirect()->route('owner.transaksi.index')->with('success','Item created successfully');
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

    public function printNota($id)
    {
        $data = Transaksi::find($id);
        $montir = $data->pegawai->where('id_role','MN')->first();
        $pegawai = $data->pegawai->where('id_role','!=','MN')->first();
        $sparepart = $data->sparepart;
        $jasa = $data->jasa;
        return view('PrintPreviews.NotaLunas',compact('data','montir','pegawai','sparepart','jasa'));
    }

    public function pembayaran($id){
        $jasa = DetilJasa::selectRaw(DB::raw('SUM(detil_jasa.jumlah * jasa.harga) as subtotal, jasa.jenis as nama'))->join('jasa','detil_jasa.id_jasa','=','jasa.id')->whereRaw('detil_jasa.id_transaksi = ?',[$id])->get();
        $sparepart = DetilSparepart::selectRaw(DB::raw('SUM(detil_sparepart.jumlah * sparepart.harga_jual) as subtotal, sparepart.nama as nama, detil_sparepart.jumlah as jumlah'))->join('sparepart','detil_sparepart.id_sparepart','=','sparepart.id')->whereRaw('detil_sparepart.id_transaksi = ?',[$id])->get();
        $tanggal = date('Y-m-d');
        $total = 0;
        for($i = 0; $i < count($jasa); $i++){
            $total += $jasa[$i]->subtotal;
        }
        for($j = 0; $j < count($sparepart); $j++){
            $total += $sparepart[$j]->subtotal;
        }
        
        if(session()->get('role') == 'OW'){
            return view('Owner.pembayaranDetail',compact('jasa','sparepart','tanggal','total','id'));
        }else if(session()->get('role') == 'CS' || session()->get('role') == 'KS'){
            return view('Pegawai.pembayaranDetail',compact('jasa','sparepart','tanggal','total','id'));
        }
        
    }

    public function pelunasan(Request $request, $id){
        $data = Transaksi::find($id);
        $data->isLunas = 1;
        $data->save();

        return redirect()->route('owner.transaksi.index');
        
    }

    public function detailTransaksi($id){
        $data = Transaksi::find($id);
        $montir = $data->pegawai->where('id_role','MN');
        $detil_jasa = $data->jasa;
        $detil_sparepart = $data->sparepart;

        return view('detailTransaksi',compact('data','montir','detil_jasa','detil_sparepart'));
    }
}
