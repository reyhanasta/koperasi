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
        // $data = Saving::all()->sortByDesc('created_at');
        // Mendapatkan semua data anggota beserta data pinjaman yang dimilikinya
        $data = Saving::with('customer')->get()->sortByDesc('created_at');
        
      
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
        $rekeningNasabah = CustomerAccount::where('id_customer', $request->customer)->first();
        $data->id_customer = $rekeningNasabah->id;
        $data->type = $request->type;
        $data->amount = $request->amount;
        $data->desc = $request->desc;
        $rekeningNasabah->balance += $request->amount;
        $rekeningNasabah->save();
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
