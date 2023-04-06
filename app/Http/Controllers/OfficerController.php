<?php

namespace App\Http\Controllers;

use App\Models\MasterJabatan;
use App\Models\Officer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listPegawai= Officer::all();
        return view('pegawai.list',compact('listPegawai'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        //
        $dataPegawai = New Officer;
        $jabatan = MasterJabatan::all();
        return view('pegawai.add',compact('dataPegawai','jabatan'));
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
        $newPegawai = new Officer;
        $newUser = new User;
        $newPegawai->name = $request->name;
        $newPegawai->gender = $request->gender;
        $newPegawai->email = $request->email;
        $newPegawai->position = $request->position;
        //
        $newUser->username = $request->email;
        $newUser->level = 'admin';
        // $newUser->password = Hash::make('btm'.rand(2,100));
        $newUser->password = Hash::make('btm100');
        //
     
        if($request->file('profile_pict')){
            $file=$request->file('profile_pict');
            $nama_file = time().str_replace(" ","",$file->getClientOriginalName());
            $file->move('picture',$nama_file);
            $newPegawai->profile_pict = $nama_file;
        }
        $newPegawai->save();
        $newUser->save();
        return redirect('/officer')->with('success','Data Berhasil di Simpan');
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
        $dataPegawai = Officer::findorFail($id);
        $data = [
            'dataPegawai' => $dataPegawai,
            'joindate' => date('d-m-Y', strtotime($dataPegawai->created_at)),
            'salary' => 'Rp. ' . number_format($dataPegawai->gaji),
            'gender' => ($dataPegawai->gender == 'female') ? 'Perempuan' : 'Laki-laki',
            'desc' => $dataPegawai->desc ?? '-'
        ];
       
        return view('pegawai.show',$data );
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
        $dataPegawai = Officer::find($id);
        $jabatan = MasterJabatan::all();
        return view('pegawai.edit',compact('dataPegawai','jabatan'));
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
        $data = Officer::find($id);
        $data->name = $request->name;
        $data->gender = $request->gender;
        $data->email = $request->email;
        $data->position = $request->position;
        if($request->file('profile_pict')){
            $file=$request->file('profile_pict');
            $nama_file = time().str_replace(" ","",$file->getClientOriginalName());
            $file->move('picture',$nama_file);

            File::delete('foto',$data->profile_pict);
            $data->profile_pict = $nama_file;
        }
        $data->save();
        return redirect('/officer')->with('success','Data berhasil diubah');
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
        $data = Officer::find($id);
        User::where('username',$data->email)->delete();
        $data->delete();
 
        return redirect('/officer')->with('success','Data berhasil dihapus');
    }
   
}