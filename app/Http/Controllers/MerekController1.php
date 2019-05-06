<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merek;

class MerekController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('role') == 'OW'){
            $data = Merek::all();

            return view('Owner.tampilMerek',compact('data'));
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
        return view('Owner.tambahMerek');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['merek' => 'required']);
        Merek::create($request->all());
        return redirect()->route('owner.merek.index')->with('success','Item created successfully');
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
        $data = Merek::find($id);
        return view('Owner.editMerek',compact('data'));
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
        Merek::find($id)->update($request->all());

        return redirect()->route('owner.merek.index')->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Merek::find($id)->delete();
        return redirect()->route('owner.merek.index')->with('success','Item deleted successfully');
    }
}
