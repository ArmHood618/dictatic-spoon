<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Supplier;

class SalesController1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sales::all();

        return view('Owner.tampilSales',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $supplier = Supplier::pluck('nama','id');
        } catch (ModelNotFoundException $e) {
            return back()->withError('alert',$e->getMessage());
        }
        return view('Owner.tambahSales',compact('supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['id_supplier' => 'required', 'nama' => 'required', 'no_telp' => 'required']);
        Sales::create($request->all());
        return redirect()->route('owner.sales.index')->with('success','Item created successfully');
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
        $data = Sales::find($id);
        try{
            $supplier = Supplier::pluck('nama','id');
        } catch (ModelNotFoundException $e) {
            return back()->withError('alert',$e->getMessage());
        }
        return view('Owner.editSales',compact('data', 'supplier'));
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
        Sales::find($id)->update($request->all());

        return redirect()->route('owner.sales.index')->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sales::find($id)->delete();
        return redirect()->route('owner.sales.index')->with('success','Item deleted successfully');
    }
}
