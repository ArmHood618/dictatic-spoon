<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Role;
use App\Cabang;
use Illuminate\Support\Facades\Hash;

class PegawaiController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('role') == 'OW'){
            $data = Pegawai::all();

            return view('Owner.tampilPegawai',compact('data'));
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
            $role = Role::pluck('keterangan','id');
        } catch (ModelNotFoundException $e) {
            return back()->withError('alert',$e->getMessage());
        }

        try{
            $cabang = Cabang::pluck('daerah','id');
        } catch (ModelNotFoundException $e) {
            return back()->with('alert',$e->getMessage());
        }
        
        return view('Owner.tambahPegawai',compact('role','cabang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nama' => 'required', 'alamat' => 'required','no_telp' => 'required','gaji' => 'required','username' => 'required','password' => 'required']);
        $request->password = Hash::make($request->password);
        Pegawai::create($request->all());
        return redirect()->route('owner.pegawai.index')->with('success','Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
            $data = Pegawai::find($id);
        } catch (ModelNotFoundException $e) {
            return back()->withError('alert',$e->getMessage());
        }

        try{
            $role = Role::pluck('keterangan','id');
        } catch (ModelNotFoundException $e) {
            return back()->withError('alert',$e->getMessage());
        }

        try{
            $cabang = Cabang::pluck('daerah','id');
        } catch (ModelNotFoundException $e) {
            return back()->with('alert',$e->getMessage());
        }

        return view('Owner.editPegawai',compact('data','role','cabang'));
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
        Pegawai::find($id)->update($request->all());

        return redirect()->route('owner.pegawai.index')->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pegawai::findOrFail($id)->delete();
        return redirect()->route('owner.pegawai.index')->with('success','Item deleted successfully');
    }

    public function login(Request $request){
        $data = Pegawai::where([['username', '=', $request->username ],['password','=',$request->password]])->first();
        if(is_null($data)){
            return redirect()->route('login.view')->with(['alert' => 'Username atau password salah']);
        } else {
            session()->put('nama', $data->nama);
            session()->put('role', $data->id_role);
            session()->put('id', $data->id);
            if(session()->get('role') == 'OW')
                return redirect()->route('owner.index');
            else
                return redirect()->route('pegawai.index');
        }
        
    }

    public function logout(Request $request){

        session()->forget('nama');
        session()->forget('role');
        session()->forget('id');
        return redirect()->route('home');
    }
}
