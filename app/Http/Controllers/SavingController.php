<?php

namespace App\Http\Controllers;

use App\Models\CustomerAccount;
use App\Models\Saving;
use App\Models\Customer;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Saving::all();
        return view('transaksi.simpanan.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = new Saving;
        $customer = Customer::all();
       
        return view('transaksi.simpanan.add',compact('data','customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = new Saving();
        //$id_rekening = CustomerAccount::findBy('id_customer',$request->customer);
        $id_rekening = CustomerAccount::where('id_customer', 1)->first();
        $data->id_customer = $id_rekening->id;
        $data->type = $request->type;
        $data->amount = $request->amount;
        $data->desc = $request->desc;
        $data->save();

        return redirect('/tr-savings')->with('success','Data Berhasil di Tambahkan !');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
