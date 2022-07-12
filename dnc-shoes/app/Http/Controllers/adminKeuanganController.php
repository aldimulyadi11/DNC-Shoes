<?php

namespace App\Http\Controllers;

use PDF;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class adminKeuanganController extends Controller
{
    
    public function cetakLaporanPengeluaran(Request $request){

        $tamp=Session::get('data2');
        $total=Session::get('total2');
        $start=Session::get('start2');
        $end=Session::get('end2');

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakLaporanPengeluaran',compact('start','end','tamp','total'))->stream();  
    }

    public function dataAkunPengeluaran()
    {
        $tamp = DB::table('tb_akun_pengeluarans')->get();
        return view('adminKeuangan.akun.dataAkunPengeluaran',compact('tamp'));
    }
    public function tambahDataAkunPengeluaran()
    {
        return view('adminKeuangan.akun.tambahDataAkunPengeluaran');
    }
    public function registerTambahAkunPengeluaran(Request $request){

        $tamp = DB::table('tb_akun_pengeluarans')
        ->where('nama_akun_pengeluaran',$request->nama_akun)
        ->count();
        if($tamp > 0){
            return redirect('tambahDataAkunPengeluaran')->with('alert','Account Cannot Redeclar !');
        }
        $this->validate($request, [
            'nama_akun' => 'required|min:2',
            'deskripsi' => 'required',               
        ]);

        DB::table('tb_akun_pengeluarans')
        ->insert([
            'nama_akun_pengeluaran' => $request->nama_akun,
            'deskripsi_akun_pengeluaran' => $request->deskripsi,
        ]);

        return redirect('dataAkunPengeluaranKeuangan')->with('alert-success','Account Added !');

    }

    public function editAkunPengeluaran($id)
    {
        $tamp = DB::table('tb_akun_pengeluarans')
        ->where('kode_akun',$id)
        ->get();

        return view('adminKeuangan.akun.editDataAkunPengeluaran',compact('tamp'));
    }

    public function updateAkunPengeluaran(Request $request,$id){
        $this->validate($request, [
            'nama_akun_pengeluaran' => 'required',
            'deskripsi_akun_pengeluaran' => 'required',
            
        ]);
        
        DB::table('tb_akun_pengeluarans')->where('kode_akun',$id)->update([
            'nama_akun_pengeluaran' => $request->nama_akun_pengeluaran,
            'deskripsi_akun_pengeluaran' => $request->deskripsi_akun_pengeluaran,         
        ]);

        return redirect('dataAkunPengeluaranKeuangan')->with('alert-success','Edit Success !');

    }
    public function hapusAkunPengeluaran($id)
    {
        $dataakun = DB::table('tb_pengeluarans')->where('fk_kode_akun',$id)->count();
        if($dataakun > 0){
            return redirect('dataAkunPengeluaran')->with('alert','Akun Sedang Digunakan Dipengeluaran');
        }else{
            DB::table('tb_akun_pengeluarans')->where('kode_akun',$id)->delete();
        return redirect('dataAkunPengeluaranKeuangan')->with('alert-success','Account Deleted');
        }
        
    }



    public function dataPengeluaran()
    {
        $tamp = DB::table('tb_pengeluarans')
        ->join('tb_akun_pengeluarans','tb_akun_pengeluarans.kode_akun','tb_pengeluarans.fk_kode_akun')
        ->get();
        return view('adminKeuangan.pengeluaran.dataPengeluaran',compact('tamp'));
    }
    
    public function tambahPengeluaran()
    {   
        $tamp = DB::table('tb_akun_pengeluarans')->get();
        $byk = DB::table('tb_akun_pengeluarans')->count();
        if($byk == 0){
            return redirect('dataPengeluaran')->with('alert','Account Is Empty !');
        }
        return view('adminKeuangan.pengeluaran.tambahPengeluaran',compact('tamp'));
    }
    public function registerTambahPengeluaran(Request $request){

        if($request->jumlah < 0){
            return redirect('tambahPengeluaranKeuangan')->with('alert','Amount Invalid !');
        }
        $this->validate($request, [
            'tgl_pengeluaran' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
            'deskripsi' => 'required',
            'kode_akun' => 'required',
            
        ]);

        DB::table('tb_pengeluarans')
        ->insert([
            'tgl_pengeluaran' => $request->tgl_pengeluaran,
            'jumlah_pengeluaran' => $request->jumlah,
            'keterangan_pengeluaran' => $request->keterangan,
            'deskripsi_pengeluaran' => $request->deskripsi,
            'fk_kode_akun' => $request->kode_akun,
        ]);

        return redirect('dataPengeluaranKeuangan')->with('alert-success','Expenditure Success !');

    }

    public function editPengeluaran($id)
    {
        $tamp = DB::table('tb_akun_pengeluarans')
        ->get();
        $peng = DB::table('tb_pengeluarans')
        ->where('id',$id)
        ->get();
        return view('adminKeuangan.keuangan.editPengeluaran',compact('tamp','peng'));
    }
    public function updatePengeluaran(Request $request,$id){
        if($request->jumlah < 0){
            return redirect('editPengeluaran/'.$id)->with('alert','Amount Invalid !');
        }
        $this->validate($request, [
            'tgl_pengeluaran' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required',
            'deskripsi' => 'required',
            'kode_akun' => 'required',
            
        ]);
        
        DB::table('tb_pengeluarans')->where('id',$id)->update([
            'tgl_pengeluaran' => $request->tgl_pengeluaran,
            'jumlah_pengeluaran' => $request->jumlah,
            'keterangan_pengeluaran' => $request->keterangan,
            'deskripsi_pengeluaran' => $request->deskripsi,
            'fk_kode_akun' => $request->kode_akun,            
        ]);

        return redirect('dataPengeluaranKeuangan')->with('alert-success','Edit Success !');

    }
    public function hapusPengeluaran($id)
    {
        DB::table('tb_pengeluarans')->where('id',$id)->delete();
        return redirect('dataPengeluaranKeuangan')->with('alert-success','Account Deleted');
    }

    public function ubahPassKeuangan($id)
    {
        $tamp = DB::table('tb_logins')->where('kode_pegawai',$id)->get();
        return view('adminkeuangan.ubahPassKeuangan',compact('tamp'));
    }


    public function updatePassKeuangan(Request $request, $kode_pegawai)
    {

        $data = DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->first();
        if(!Hash::check($request->old_password,$data->password)){
            return redirect('changePassKeuangan/'.$kode_pegawai)->with('alert','Change Failed !');
        }

        $this->validate($request, [
        'old_password' => 'required|min:2',
        'new_password' => 'required|min:2',
        'confir' => 'required|same:new_password',          
        ]);
        
        DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->update([
            'password'=>bcrypt($request->new_password),        
        ]);

        return redirect('dashboardAdminKeuangan')->with('alert-success','Change Success !');
    }

    // public function registerLaporanPenjualan(Request $request){
        
    //     $start = date('Y-m-d', strtotime($request->start));
    //     $end  = date('Y-m-d', strtotime($request->end));

    //     $jenis = DB::table('tb_penjualans')->get();

    //     $tamp = DB::table('tb_penjualans')
    //     ->select('tb_penjualans.*','tb_pembelians.*')
    //     ->join('tb_pembelians','tb_pembelians.fk_kode_penjualan','tb_penjualans.kode_penjualan')
    //     ->whereBetween('tanggal_penjualan', array($start, $end))
    //     ->orderBy('tb_penjualans.jenis_penjualan','ASC')
    //     ->get();

    //     $total = DB::table('tb_penjualans')
    //     ->select('tb_penjualans.*','tb_pembelians.*')
    //     ->join('tb_pembelians','tb_pembelians.fk_kode_penjualan','tb_penjualans.kode_penjualan')
    //     ->whereBetween('tanggal_penjualan', array($start, $end)) 
    //     ->sum('total_barang');

    //     $startDate = date('d-m-Y', strtotime($request->start));
    //     $endDate  = date('d-m-Y', strtotime($request->end));

    //     Session::put('data',$tamp);
    //     Session::put('total',$total);
    //     Session::put('start',$startDate);
    //     Session::put('end',$endDate);


    //     return view('owner.laporan.laporanPenjualan',compact('tamp','total','jenis'));
    // }

    // public function laporanPengeluaran(Request $request){
        
    //     $start = "-1";
    //     $end  = "-1";
    //     $total = 0;
    //     $tamp = DB::table('tb_pengeluarans')
    //     ->whereBetween('tgl_pengeluaran', array($start, $end))
    //     ->get();
    //     return view('owner.laporan.laporanPengeluaran',compact('tamp','total'));

    // }
    // public function registerLaporanPengeluaran(Request $request){
    //     $start = date('Y-m-d', strtotime($request->start));
    //     $end  = date('Y-m-d', strtotime($request->end));

    //     $tamp = DB::table('tb_pengeluarans')
    //     ->select('tb_pengeluarans.*')
    //     ->whereBetween('tgl_pengeluaran', array($start, $end))
    //     ->orderBy('tb_pengeluarans.tgl_pengeluaran','ASC')
    //     ->get();

    //     $total = DB::table('tb_pengeluarans')
    //     ->whereBetween('tgl_pengeluaran', array($start, $end))
    //     ->sum('jumlah_pengeluaran');

        
        

    //     $startDate = date('d-m-Y', strtotime($request->start));
    //     $endDate  = date('d-m-Y', strtotime($request->end));

    //     Session::put('data2',$tamp);
    //     Session::put('total2',$total);
    //     Session::put('start2',$startDate);
    //     Session::put('end2',$endDate);
        


    //     return view('owner.laporan.laporanPengeluaran',compact('tamp','total'));
    // }

}
