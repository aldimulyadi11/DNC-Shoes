<?php

namespace App\Http\Controllers;

use App\tb_login;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login.login');
    }
    public function register()
    {
        return view('login.register');
    }
    public function registerPost(Request $request){
        
        $this->validate($request, [
            'nama' => 'required|min:2',
            'username' => 'required|min:2',
            'bagian' => 'required',            
            'alamat' => 'required|min:4',
            'telp' => 'required|min:12|max:14',
            'password' => 'required',
            'confir' => 'required|same:password',
        ]);
        
        DB::table('tb_logins')
        ->insert([
            'nama' => $request->nama,
            'username' => $request->username,
            'bagian' => $request->bagian,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'password'=>bcrypt($request->password),            
        ]);

        return redirect('/')->with('alert-success','Register is Success !');
    }

    public function loginPost(Request $request){

        $username = $request->username;
        $password = $request->password;

        $data = tb_login::where('username',$username)->first();
        
        if($data){
            if($data->bagian == "Owner"){
                if(Hash::check($password,$data->password)){
                    Session::put('nama',$data->nama);
                    Session::put('id_owner',$data->kode_pegawai);
                    Session::put('bagian',$data->bagian);
                    Session::put('login1',TRUE);
                    return redirect('dashboardOwner');
                }
                else{
                    return redirect('/')->with('alert','Login Failed !');
                }
            }
            else if($data->bagian == "Admin Toko"){
                if(Hash::check($password,$data->password)){
                    Session::put('nama',$data->nama);
                    Session::put('id_toko',$data->kode_pegawai);
                    Session::put('bagian',$data->bagian);
                    Session::put('login2',TRUE);
                    return redirect('dashboardAdminToko');
                }
                else{
                    return redirect('/')->with('alert','Login Failed !');
                }
            }
            else if($data->bagian == "Admin Gudang"){
                if(Hash::check($password,$data->password)){
                    Session::put('nama',$data->nama);
                    Session::put('id_gudang',$data->kode_pegawai);
                    Session::put('bagian',$data->bagian);
                    Session::put('login3',TRUE);
                    return redirect('dashboardAdminGudang');
                }
                else{
                    return redirect('/')->with('alert','Login Failed !');
                }
            }
            else if($data->bagian == "Admin Web"){
                if(Hash::check($password,$data->password)){
                    Session::put('nama',$data->nama);
                    Session::put('id_web',$data->kode_pegawai);
                    Session::put('bagian',$data->bagian);
                    Session::put('login4',TRUE);
                    return redirect('dashboardAdminWeb');
                }
                else{
                    return redirect('/')->with('alert','Login Failed !');
                }
            }
            else if($data->bagian == "Admin Marketplace"){
                if(Hash::check($password,$data->password)){
                    Session::put('nama',$data->nama);
                    Session::put('id_market',$data->kode_pegawai);
                    Session::put('bagian',$data->bagian);
                    Session::put('login5',TRUE);
                    return redirect('dashboardAdminMarketplace');
                }
                else{
                    return redirect('/')->with('alert','Login Failed !');
                }
            }
            else if($data->bagian == "Admin Instagram"){
                if(Hash::check($password,$data->password)){
                    Session::put('nama',$data->nama);
                    Session::put('id_ig',$data->kode_pegawai);
                    Session::put('bagian',$data->bagian);
                    Session::put('login6',TRUE);
                    return redirect('dashboardAdminInstagram');
                }
                else{
                    return redirect('/')->with('alert','Login Failed !');
                }
            }
            else if($data->bagian == "Admin Event"){
                if(Hash::check($password,$data->password)){
                    Session::put('nama',$data->nama);
                    Session::put('id_event',$data->kode_pegawai);
                    Session::put('bagian',$data->bagian);
                    Session::put('login7',TRUE);
                    return redirect('dashboardAdminEvent');
                }
                else{
                    return redirect('/')->with('alert','Login Failed !');
                }
            }
            else if($data->bagian == "Admin Keuangan"){
                if(Hash::check($password,$data->password)){
                    Session::put('nama',$data->nama);
                    Session::put('id_keuangan',$data->kode_pegawai);
                    Session::put('bagian',$data->bagian);
                    Session::put('login8',TRUE);
                    return redirect('dashboardAdminKeuangan');
                }
                else{
                    return redirect('/')->with('alert','Login Failed !');
                }
            }
        }
        else{
            return redirect('/')->with('alert','Login Failed!');
        }
    }
    public function logout(){
        Session::flush();
        return redirect('/')->with('alert','You Were Login !');
    }
}
