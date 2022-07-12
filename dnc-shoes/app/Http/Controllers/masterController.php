<?php

namespace App\Http\Controllers;

use App\tb_login;
use App\tb_kategori;
use App\tb_produk;
use App\tb_stok;
use App\tb_pembelian;
use App\tb_penjualan;
use App\tb_pengeluaran;
use App\tb_pengeluaran_lain;
use App\tb_pengeluaran_lainnya;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class masterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardOwner()
    {
        if(!Session::get('login1')){
            return redirect('/')->with('alert','You Must Login First');
        }
        else{

            $count = tb_login::where('bagian','Owner')->count();
            $count2 = tb_login::where('bagian','Admin Toko')->count();
            $count3 = tb_login::where('bagian','Admin Gudang')->count();
            $count4 = tb_login::where('bagian','Admin Web')->count();
            $count5 = tb_login::where('bagian','Admin Instagram')->count();
            $count6 = tb_login::where('bagian','Admin Marketplace')->count();
            $count7 = tb_kategori::count();
            $count8 = tb_produk::count();
            $count9 = tb_stok::sum('stok_gudang');
            $count10 = tb_stok::sum('stok_toko');

            $count11 = tb_pengeluaran::sum('jumlah_pengeluaran');
            $count12 = tb_pembelian::sum('total_barang');
            $count13 = $count12 - $count11;
            $count14 = tb_pengeluaran_lainnya::sum('jml_pengeluaran_lainnya');


            return view('dashboard.dashboardOwner',compact('count','count2','count3','count4','count5','count6','count7','count8','count9','count10','count11','count12','count13','count14'));
        }
        
    }
    public function dashboardAdminToko()
    {
        if(!Session::get('login2')){
            return redirect('/')->with('alert','You Must Login First');
        }
        else{

            $count = tb_login::where('bagian','Admin Toko')->count();
            $count2 = tb_kategori::count();
            $count3 = tb_produk::count();
            $count4 = tb_stok::sum('stok_toko');
            return view('dashboard.dashboardAdminToko',compact('count','count2','count3','count4'));
        }
        
    }
    public function dashboardAdminGudang()
    {
        if(!Session::get('login3')){
            return redirect('/')->with('alert','You Must Login First');
        }
        else{

            $count = tb_login::where('bagian','Admin Gudang')->count();
            $count2 = tb_kategori::count();
            $count3 = tb_produk::count();
            $count4 = tb_stok::sum('stok_gudang');
            return view('dashboard.dashboardAdminGudang',compact('count','count2','count3','count4'));
        }
    }
    public function dashboardAdminWeb()
    {
        if(!Session::get('login4')){
            return redirect('/')->with('alert','You Must Login First');
        }
        else{

            $count = tb_login::where('bagian','Admin Web')->count();
            $count2 = tb_kategori::count();
            $count3 = tb_produk::count();
            $count4 = tb_stok::sum('stok_gudang');
            return view('dashboard.dashboardAdminWeb',compact('count','count2','count3','count4'));
        }
        
    }
    public function dashboardAdminMarketplace()
    {
        if(!Session::get('login5')){
            return redirect('/')->with('alert','You Must Login First');
        }
        else{

            $count = tb_login::where('bagian','Admin Marketplace')->count();
            $count2 = tb_kategori::count();
            $count3 = tb_produk::count();
            $count4 = tb_stok::sum('stok_gudang');

            return view('dashboard.dashboardAdminMarketplace',compact('count','count2','count3','count4'));
        }
        
    }
    public function dashboardAdminInstagram()
    {
        if(!Session::get('login6')){
            return redirect('/')->with('alert','You Must Login First');
        }
        else{

            $count = tb_login::where('bagian','Admin Instagram')->count();
            $count2 = tb_kategori::count();
            $count3 = tb_produk::count();
            $count4 = tb_stok::sum('stok_gudang');

            return view('dashboard.dashboardAdminInstagram',compact('count','count2','count3','count4'));
        }
        
    }

    public function dashboardAdminEvent()
    {
        if(!Session::get('login7')){
            return redirect('/')->with('alert','You Must Login First');
        }
        else{

            $count = tb_login::where('bagian','Admin Event')->count();
            $count2 = tb_kategori::count();
            $count3 = tb_produk::count();
            $count4 = tb_stok::sum('stok_gudang');

            return view('dashboard.dashboardAdminEvent',compact('count','count2','count3','count4'));
        }
        
    }

    public function dashboardAdminKeuangan()
    {
        if(!Session::get('login8')){
            return redirect('/')->with('alert','You Must Login First');
        }
        else{

            $count = tb_login::where('bagian','Admin Keuangan')->count();
            $count1 = tb_pengeluaran::sum('jumlah_pengeluaran');

            return view('dashboard.dashboardAdminKeuangan',compact('count','count1'));
        }
        
    }
    
}
