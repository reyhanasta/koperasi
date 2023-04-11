<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Officer;
use Illuminate\Http\Request;
use App\Models\MasterJabatan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $back = url()->previous();
        return view('pegawai.add',compact('dataPegawai','jabatan','back'));
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
        $validateData = $request->validate([
            'email' => 'required|email:dns|unique:users,username',
        ]);
        if($validateData){
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
        }else{ 
            return back()->with('Somethings wrong');
        }
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
            'desc' => $dataPegawai->desc ?? '-',
            'back' => url()->previous()
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
        $back = url()->previous();
        return view('pegawai.edit',compact('dataPegawai','jabatan','back'));
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
            $image_path = public_path().'/picture/'.$data->profile_pict;
            File::delete('picture',$image_path);
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
        $image_path = public_path().'/picture/'.$data->profile_pict;
        if(File::exists($image_path))
        {
            File::delete($image_path);
            //unlink($image_path);
        }
        $data->delete(); 
        User::where('username',$data->email)->delete();
        return redirect('/officer')->with('success','Data berhasil dihapus');
    }
   
}
