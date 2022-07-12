<?php

namespace App\Http\Controllers;

use PDF;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ownerController extends Controller
{

    public function dataAkun()
    {
        $tamp = DB::table('tb_logins')->get();
        return view('owner.akun.dataAkun',compact('tamp'));
    }
    public function registerAkunBaru()
    {
        return view('login.registerAkunBaru');
    }
    public function registerPostBaru(Request $request){
        $akun=DB::table('tb_logins')
        ->select('kode_pegawai','username','telp')
        ->where('kode_pegawai','=',$request->kode_pegawai)
        ->orwhere('username','=',$request->username)->count();

        if($akun > 0){
            return redirect('dataAkun')->with('alert','Data is Already Exist !');
        }

        $this->validate($request, [
            'nama' => 'required|min:2',
            'username' => 'required|min:2',
            'bagian' => 'required',            
            'alamat' => 'required|min:2',
            'telp' => 'required|min:11|max:14',
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

        return redirect('dataAkun')->with('alert-success','Account Added !');
    }

    public function editAkunBaru($kode_pegawai){

        $tamp = DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->get();
        return view('owner.akun.editDataAkun',compact('tamp'));
    }

    public function updateAkunBaru(Request $request, $kode_pegawai)
    {
        $akun=DB::table('tb_logins')
        ->select('kode_pegawai','username','telp')
        ->where('kode_pegawai','=',$request->kode_pegawai)
        ->orwhere('telp','=',$request->telp)
        ->orwhere('username','=',$request->username)->count();
        if($akun > 1){
            return redirect('editAkunBaru/'.$request->kode_pegawai)->with('alert','Data is Already Exist !');
        }
        else{

            $this->validate($request, [
            'nama' => 'required|min:2',
            'username' => 'required|min:2',
            'bagian' => 'required',            
            'alamat' => 'required|min:2',
            'telp' => 'required|min:12|max:14',
            
        ]);
        
        DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'bagian' => $request->bagian,
            'alamat' => $request->alamat,
            'telp' => $request->telp,        
        ]);

        return redirect('dataAkun')->with('alert-success','Edit Success !');

        }
    }
    public function hapusAkunBaru($kode_pegawai)
    {
        $byk = DB::table('tb_penjualans')->where('fk_kode_pegawai',$kode_pegawai)->count();
        $byk2 = DB::table('tb_logins')->where('bagian','Owner')->count();
        $cek = DB::table('tb_logins')->where('bagian','Owner')->first();
        
        if($byk2 == 1 && $cek->kode_pegawai == $kode_pegawai){
            return redirect('dataAkun')->with('alert','Owner Tidak Boleh Kosong !');
        }
        if($byk > 0){
            return redirect('dataAkun')->with('alert','Akun Sedang Digunakan !');
        }
        else{
            DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->delete();
            return redirect('dataAkun')->with('alert-success','Account Deleted');
        }
    }

    public function dataKategori()
    {
        $tamp = DB::table('tb_kategoris')->get();
        return view('owner.kategori.dataKategori',compact('tamp'));
    }
    public function tambahKategori()
    {
        return view('owner.kategori.tambahKategori');
    }
    public function registerKategori(Request $request){
        $kat=DB::table('tb_kategoris')->where('nama_kategori','=',$request->nama_kategori)->count();

        if($kat > 0){
            return redirect('tambahKategori')->with('alert','Name Category is Already Exist !');
        }

        $this->validate($request, [
            'nama_kategori' => 'required|min:2',
            'keterangan' => 'required|min:2',
            
        ]);
        
        DB::table('tb_kategoris')
        ->insert([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
                       
        ]);

        return redirect('dataKategori')->with('alert-success','Category Added !');
    }

    public function editKategori($kode_kategori){

        $tamp = DB::table('tb_kategoris')->where('kode_kategori',$kode_kategori)->get();
        return view('owner.kategori.editKategori',compact('tamp'));
    }

    public function updateKategori(Request $request, $kode_kategori)
    {
        $kat=DB::table('tb_kategoris')        
        ->where('kode_kategori','=',$request->kode_kategori)
        ->orwhere('nama_kategori','=',$request->nama_kategori)
        ->count();
        if($kat > 1){
            return redirect('editKategori/'.$request->kode_kategori)->with('alert','Data is Already Exist !');
        }
        else{

            $this->validate($request, [
            'nama_kategori' => 'required|min:2',
            'keterangan' => 'required|min:2',
            
        ]);
        
        DB::table('tb_kategoris')->where('kode_kategori',$kode_kategori)->update([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,            
        ]);

        return redirect('dataKategori')->with('alert-success','Edit Success !');

        }
    }
    public function hapusKategori($kode_kategori)
    {   
        $byk = DB::table('tb_produks')->where('fk_kode_kat',$kode_kategori)->count();
        if($byk > 0){
            return redirect('dataKategori')->with('alert','Kategori Sedang Digunakan !');
        }

        DB::table('tb_kategoris')->where('kode_kategori',$kode_kategori)->delete();
        return redirect('dataKategori')->with('alert-success','Category Deleted !');
    }


    public function dataProduk()
    {
        $tamp = DB::table('tb_produks')
        ->select('tb_produks.*','tb_kategoris.*')
        ->join('tb_kategoris','tb_kategoris.kode_kategori','tb_produks.fk_kode_kat')
        ->get();
        return view('owner.produk.dataProduk',compact('tamp'));
    }
    public function tambahProduk()
    {
        $tamp = DB::table('tb_kategoris')->get();
        return view('owner.produk.tambahProduk',compact('tamp'));
    }
    public function registerProduk(Request $request){


        $pro=DB::table('tb_produks')->where('nama_produk','=',$request->nama_produk)->count();

        if($pro > 0){
            return redirect('tambahProduk')->with('alert','Data is Already Exist !');
        }
        else if($request->stok_minimum < 0 ){
            return redirect('tambahProduk')->with('alert','Stok Invalid !');   
        }
        else if($request->harga_jual < 0 ){
            return redirect('tambahProduk')->with('alert','Price Invalid !');   
        }
        else{

            $this->validate($request, [
                'nama_produk' => 'required|min:2',
                'harga_jual' => 'required',
                'file' => 'file|image|mimes:jpeg,png,jpg',
                'stok_minimum' => 'required|',
                'keterangan' => 'required|min:2',
                'nama_kategori' => 'required',                
            ]);
                
            $file = $request->file('file');
            if($file == "")
            {
                $nama_file = "";  

                DB::table('tb_produks')
                ->insert([
                    'foto' => $nama_file,
                    'fk_kode_kat' => $request->nama_kategori,
                    'nama_produk' => $request->nama_produk,
                    'harga_jual' => $request->harga_jual,
                    'stok_minimum' => $request->stok_minimum,
                    'ket' => $request->keterangan,
                               
                ]);  
            }
            else{

                $nama_file = time()."_".$file->getClientOriginalName();
         
                // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'imgs';
                $file->move($tujuan_upload,$nama_file);

                DB::table('tb_produks')
                ->insert([
                    'foto' => $nama_file,
                    'fk_kode_kat' => $request->nama_kategori,
                    'nama_produk' => $request->nama_produk,
                    'harga_jual' => $request->harga_jual,
                    'stok_minimum' => $request->stok_minimum,
                    'ket' => $request->keterangan,
                               
                ]);
            }
            return redirect('dataProduk')->with('alert-success','Product Added !');
        }
        
    }

    public function editProduk($kode_produk){

        $tamp = DB::table('tb_produks')->where('kode_produk',$kode_produk)->get();
        $tamp2 = DB::table('tb_kategoris')->get();
        return view('owner.produk.editProduk',compact('tamp','tamp2'));
    }

    public function updateProduk(Request $request, $kode_produk)
    {
        $pro=DB::table('tb_produks')        
        ->where('kode_produk','=',$request->kode_produk)
        ->orwhere('nama_produk','=',$request->nama_produk)
        ->count();
        if($pro > 1){
            return redirect('editProduk/'.$request->kode_produk)->with('alert','Data is Already Exist !');
        }
        else if($request->stok_minimum < 0 ){
            return redirect('editProduk/'.$request->kode_produk)->with('alert','Stok Invalid !');   
        }
        else if($request->harga_jual < 0 ){
            return redirect('editProduk/'.$request->kode_produk)->with('alert','Price Invalid !');   
        }
        else{

            $this->validate($request, [
                'nama_produk' => 'required|min:2',
                'harga_jual' => 'required',
                'file' => 'file|image|mimes:jpeg,png,jpg',
                'stok_minimum' => 'required|',
                'keterangan' => 'required|min:2',
                'nama_kategori' => 'required',                
            ]);

            $file = $request->file('file');
            
            if($file == ""){
                $nama_file = ""; 
                    DB::table('tb_produks')->where('kode_produk',$kode_produk)->update([
                    'fk_kode_kat' => $request->nama_kategori,
                    'foto' => $nama_file,
                    'nama_produk' => $request->nama_produk,
                    'harga_jual' => $request->harga_jual,
                    'stok_minimum' => $request->stok_minimum,
                    'ket' => $request->keterangan,         
                ]);   
            }
            else{

                $nama_file = time()."_".$file->getClientOriginalName();
         
                // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'imgs';
                $file->move($tujuan_upload,$nama_file);


                DB::table('tb_produks')->where('kode_produk',$kode_produk)->update([
                    'fk_kode_kat' => $request->nama_kategori,
                    'foto' => $nama_file,
                    'nama_produk' => $request->nama_produk,
                    'harga_jual' => $request->harga_jual,
                    'stok_minimum' => $request->stok_minimum,
                    'ket' => $request->keterangan,         
                ]);
            }

            return redirect('dataProduk')->with('alert-success','Edit Success !');
        }
    }
    public function hapusProduk($kode_produk)
    {
        $byk = DB::table('tb_delivery_produks')->where('fk_kode_produk',$kode_produk)->count();
        $byk2 = DB::table('tb_pembelians')->where('fk_kode_produk',$kode_produk)->count();
        $byk3 = DB::table('tb_produksis')->where('fk_kode_produk',$kode_produk)->count();
        $byk4 = DB::table('tb_stoks')->where('fk_kode_pro',$kode_produk)->count();
        if($byk > 0){
            return redirect('dataProduk')->with('alert','Produk Sedang Digunakan !');
        }        
        else if($byk2 > 0){
            return redirect('dataProduk')->with('alert','Produk Sedang Digunakan !');
        }        
        else if($byk3 > 0){
            return redirect('dataProduk')->with('alert','Produk Sedang Digunakan !');
        }        
        else if($byk4 > 0){
            return redirect('dataProduk')->with('alert','Produk Sedang Digunakan !');
        }
        else{
            DB::table('tb_produks')->where('kode_produk',$kode_produk)->delete();
            return redirect('dataProduk')->with('alert-success','Product Deleted !');    
        }
        
    }

    public function stokProduk()
    {       
        //  $tamp = DB::table('tb_stoks')
        //  ->select('tb_produks.*','tb_stoks.*')
        // ->join('tb_produks','tb_produks.kode_produk','tb_stoks.fk_kode_pro')
        // ->orderBy('tb_stoks.stok_gudang','DESC')
        // ->get();
        
        $tamp = DB::table('tb_stoks')
         ->select('tb_produks.*','tb_stoks.*')
        ->join('tb_produks','tb_produks.kode_produk','tb_stoks.fk_kode_pro')
        ->get();

        return view('owner.stok.stokProduk',compact('tamp'));
    }
    public function stokProdukAlfabet()
    {   
            $tamp = DB::table('tb_stoks')
             ->select('tb_produks.*','tb_stoks.*')
            ->join('tb_produks','tb_produks.kode_produk','tb_stoks.fk_kode_pro')
            ->orderby('tb_produks.nama_produk','ASC')
            ->get();

        return view('owner.stok.stokProduk',compact('tamp'));
    }
     public function stokProdukTerbanyak()
    {   
            $tamp = DB::table('tb_stoks')
             ->select('tb_produks.*','tb_stoks.*')
            ->join('tb_produks','tb_produks.kode_produk','tb_stoks.fk_kode_pro')
            ->orderby('tb_stoks.stok_gudang','DESC')
            ->get();

        return view('owner.stok.stokProduk',compact('tamp'));
    }
    public function editStok($kode_stok){

        $tamp = DB::table('tb_stoks')
        ->join('tb_produks','tb_produks.kode_produk','tb_stoks.fk_kode_pro')
        ->where('tb_stoks.id',$kode_stok)->get();
        return view('owner.stok.editStok',compact('tamp'));
    }
    public function updateStok(Request $request, $kode_stok)
    {
        DB::table('tb_stoks')->where('id',$kode_stok)->update([
                    'stok_toko' => $request->stok_toko,
                    'stok_gudang' => $request->stok_gudang,
                    'tot_stok' => $request->total_stok,
                ]);
        return redirect('stokProduk')->with('alert-success','Edit Success !');
    }

    public function cetakPenjualanToko(Request $request){

        $tamp = DB::table('tb_pembelians')
        ->select('tb_pembelians.*','tb_produks.*','tb_penjualans.*')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->join('tb_penjualans','tb_penjualans.kode_penjualan','tb_pembelians.fk_kode_penjualan')        
        ->where('tb_penjualans.jenis_penjualan','Toko')
        ->get();
        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakPenjualanToko',compact('tamp'))->stream();  
    }
    public function cetakPenjualanWeb(Request $request){

        $tamp = DB::table('tb_pembelians')
        ->select('tb_pembelians.*','tb_produks.*','tb_penjualans.*')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->join('tb_penjualans','tb_penjualans.kode_penjualan','tb_pembelians.fk_kode_penjualan')
        // ->selectRaw('sum(jumlah_barang) as sum, sum(total_barang) as sums')
        // ->groupby('tb_produks.kode_produk')
        ->where('tb_penjualans.jenis_penjualan','Web')
        ->get();
        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakPenjualanWeb',compact('tamp'))->stream();  
    }
    public function cetakPenjualanMarket(Request $request){

        $tamp = DB::table('tb_pembelians')
        ->select('tb_pembelians.*','tb_produks.*','tb_penjualans.*')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->join('tb_penjualans','tb_penjualans.kode_penjualan','tb_pembelians.fk_kode_penjualan')
        // ->selectRaw('sum(jumlah_barang) as sum, sum(total_barang) as sums')
        // ->groupby('tb_produks.kode_produk')
        ->where('tb_penjualans.jenis_penjualan','Marketplace')
        ->get();
        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakPenjualanMarket',compact('tamp'))->stream();  
    }
    public function cetakPenjualanIg(Request $request){

        $tamp = DB::table('tb_pembelians')
        ->select('tb_pembelians.*','tb_produks.*','tb_penjualans.*')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->join('tb_penjualans','tb_penjualans.kode_penjualan','tb_pembelians.fk_kode_penjualan')
        // ->selectRaw('sum(jumlah_barang) as sum, sum(total_barang) as sums')
        // ->groupby('tb_produks.kode_produk')
        ->where('tb_penjualans.jenis_penjualan','Instagram')
        ->get();
        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakPenjualanIg',compact('tamp'))->stream();  
    }
    public function cetakPenjualanEvent(Request $request){

        $tamp = DB::table('tb_pembelians')
        ->select('tb_pembelians.*','tb_produks.*','tb_penjualans.*')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->join('tb_penjualans','tb_penjualans.kode_penjualan','tb_pembelians.fk_kode_penjualan')
        // ->selectRaw('sum(jumlah_barang) as sum, sum(total_barang) as sums')
        // ->groupby('tb_produks.kode_produk')
        ->where('tb_penjualans.jenis_penjualan','Event')
        ->get();
        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakPenjualanEvent',compact('tamp'))->stream();  
    }

    public function cetakStok(Request $request){

        $stok = DB::table('tb_stoks')->get();
        $total_stok = DB::table('tb_stoks')->sum('tot_stok');
        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakStok',compact('stok','total_stok'))->stream();  
    }
    public function cetakStok2(Request $request){

        $stok = DB::table('tb_stoks')->get();
        $total_stok = DB::table('tb_stoks')->sum('stok_gudang');
        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakStok2',compact('stok','total_stok'))->stream();  
    }

    public function cetakLaporanLaba(Request $request){

        $penjualan=Session::get('penjualan');
        $pengeluaran=Session::get('pengeluaran');
        $pengeluaranLain=Session::get('pengeluaranLain');
        $laba=Session::get('laba');

        $start=Session::get('start3');
        $end=Session::get('end3');

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakLaporanLaba',compact('penjualan','pengeluaran','pengeluaranLain','laba','start','end'))->stream();  
    }

    public function cetakLaporanAsset(Request $request){
        $tamp = Session::get('tamp');
        $gudang = Session::get('gudang');
        $toko = Session::get('toko');
        $harga = Session::get('harga');
        $total = Session::get('total');

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakLaporanAsset',compact('tamp','gudang','toko','harga','total'))->stream();  
    }

    public function cetakLaporanAssetGudang(Request $request){
        $tamp = Session::get('tamp');
        $gudang = Session::get('gudang');

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakLaporanAssetGudang',compact('tamp','gudang'))->stream();  
    }

    public function cetakLaporanAssetToko(Request $request){
        $tamp = Session::get('tamp');
        $toko = Session::get('toko');

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakLaporanAssetToko',compact('tamp','toko'))->stream();  
    }


    public function cetakLaporanPenjualan(Request $request){

        $tamp=Session::get('data');
        $total=Session::get('total');
        $start=Session::get('start');
        $end=Session::get('end');

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakLaporanPenjualan',compact('tamp','total','start','end'))->stream();  
    }
    
    public function cetakLaporanPengeluaran(Request $request){

        $tamp=Session::get('data2');
        $total=Session::get('total2');
        $start=Session::get('start2');
        $end=Session::get('end2');

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakLaporanPengeluaran',compact('start','end','tamp','total'))->stream();  
    }

    public function cetakLaporanPengeluaranLainnya(Request $request){

        $tamp=Session::get('data2');
        $total=Session::get('total2');
        $start=Session::get('start2');
        $end=Session::get('end2');

        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakLaporanPengeluaran',compact('start','end','tamp','total'))->stream();  
    }


    public function cetakStok3(Request $request){

        $stok = DB::table('tb_stoks')->get();
        $total_stok = DB::table('tb_stoks')->sum('stok_toko');
        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakStok3',compact('stok','total_stok'))->stream();  
    }
    public function cetakStruk(Request $request,$kode){

        $struk = DB::table('tb_penjualans')
        ->join('tb_pembelians','tb_pembelians.fk_kode_penjualan','tb_penjualans.kode_penjualan')
        ->join('tb_logins','tb_logins.kode_pegawai','tb_penjualans.fk_kode_pegawai')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->where('tb_penjualans.kode_penjualan',$kode)
        ->groupby('tb_penjualans.kode_penjualan')
        ->get();

        $struk2 = DB::table('tb_penjualans')
        ->join('tb_pembelians','tb_pembelians.fk_kode_penjualan','tb_penjualans.kode_penjualan')
        ->join('tb_logins','tb_logins.kode_pegawai','tb_penjualans.fk_kode_pegawai')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->where('tb_penjualans.kode_penjualan',$kode)
        ->get();

        $sum_diskon = DB::table('tb_penjualans')
        ->join('tb_pembelians','tb_pembelians.fk_kode_penjualan','tb_penjualans.kode_penjualan')
        ->join('tb_logins','tb_logins.kode_pegawai','tb_penjualans.fk_kode_pegawai')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->where('tb_penjualans.kode_penjualan',$kode)
        ->sum('diskon_rp');

        $sum_jumlah = DB::table('tb_penjualans')
        ->join('tb_pembelians','tb_pembelians.fk_kode_penjualan','tb_penjualans.kode_penjualan')
        ->join('tb_logins','tb_logins.kode_pegawai','tb_penjualans.fk_kode_pegawai')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->where('tb_penjualans.kode_penjualan',$kode)
        ->sum('total_barang');

        $sum_ongkir = DB::table('tb_penjualans')
        ->join('tb_pembelians','tb_pembelians.fk_kode_penjualan','tb_penjualans.kode_penjualan')
        ->join('tb_logins','tb_logins.kode_pegawai','tb_penjualans.fk_kode_pegawai')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->where('tb_penjualans.kode_penjualan',$kode)
        ->sum('ongkir');

        $sum_total = ($sum_jumlah + $sum_ongkir) ;

        // return view('owner.stok.cetakStruk',compact('struk','struk2','sum_total','sum_diskon','sum_jumlah','sum_ongkir'));

        // $total = DB::table('tb_pembelians')
        // ->join('tb_penjualans','tb_penjualans.kode_penjualan','tb_pembelians.fk_kode_penjualan')
        // ->where('tb_penjualans.kode_penjualan',$kode)
        // ->sum('total_barang');
        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('owner.stok.cetakStruk',compact('struk','struk2','sum_total','sum_diskon','sum_jumlah','sum_ongkir'))->setPaper([0,0,500,119.055],'landscape')->stream();  
    }

    public function dataProduksi()
    {
        $tamp = DB::table('tb_produksis')
        ->join('tb_produks','tb_produks.kode_produk','tb_produksis.fk_kode_produk')
        ->get();
        return view('owner.produksi.dataProduksi',compact('tamp'));
    }

    public function tambahProduksi()
    {
        $tamp = DB::table('tb_produks')->get();
        return view('owner.produksi.tambahProduksi',compact('tamp'));
    }

    public function registerProduksi(Request $request){

        if($request->jumlah < 0){
            return redirect('tambahProduksi')->with('alert','Amount Invalid !');
        }
        $this->validate($request, [
            'nama_produk' => 'required',
            'tanggal_produksi' => 'required',            
            'jumlah' => 'required|',
            'keterangan' => 'required',              
        ]);

        DB::table('tb_produksis')
        ->insert([
            'fk_kode_produk' => $request->nama_produk,
            'tanggal_produksi' => $request->tanggal_produksi,
            'jumlah' => $request->jumlah,                
            'keterangan_produksi' => $request->keterangan,
                       
        ]);

        $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->count();
        if($cek == 0){            
            DB::table('tb_stoks')
            ->insert([
                'stok_gudang' => '0',
                'stok_toko' => '0',             
                'tot_stok' => '0',
                'fk_kode_pro' => $request->nama_produk,
                           
            ]);

            DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                'stok_gudang' => $request->jumlah,
            ]);
            $total_stok_gudang = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_gudang');
            $total_stok_toko = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_toko');
            $total = $total_stok_gudang + $total_stok_toko;
            DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                'tot_stok' => $total,
            ]);              
            return redirect('dataProduksi')->with('alert-success','Product Added !');
        }
        else{
            $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_gudang');

            DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                'stok_gudang' => $cek + $request->jumlah,
            ]);
            $total_stok_gudang = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_gudang');
            $total_stok_toko = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_toko');
            $total = $total_stok_gudang + $total_stok_toko;
            DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                'tot_stok' => $total,
            ]);              
            return redirect('dataProduksi')->with('alert-success','Product Added !');
        }
    }
    public function dataDelivery()
    {
        $tamp = DB::table('tb_delivery_produks')
        ->join('tb_produks','tb_produks.kode_produk','tb_delivery_produks.fk_kode_produk')
        ->get();
        return view('owner.delivery.dataDelivery',compact('tamp'));
    }

    public function tambahDelivery()
    {
        $tamp = DB::table('tb_produksis')
        ->join('tb_produks','tb_produks.kode_produk','tb_produksis.fk_kode_produk')
        ->groupby('tb_produks.nama_produk')
        ->get();
        return view('owner.delivery.tambahDelivery',compact('tamp'));
    }

    public function registerDelivery(Request $request){

            $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->first();
            if($cek->stok_gudang == 0){
                return redirect('tambahDelivery')->with('alert','Stok Gudang Habis !');
            }
            else if($cek->stok_gudang < $request->jumlah){
                return redirect('tambahDelivery')->with('alert','Jumlah Tidak Boleh Lebih Dari Stok Gudang !');
            }
            else if($request->jumlah < 0){
                return redirect('tambahDelivery')->with('alert','Amount Invalid !');
            }
            else{

                $this->validate($request, [
                    'nama_produk' => 'required',
                    'tanggal_delivery' => 'required',            
                    'jumlah' => 'required|',
                    'keterangan' => 'required',              
                ]);

                DB::table('tb_delivery_produks')
                ->insert([
                    'fk_kode_produk' => $request->nama_produk,
                    'tanggal_produksi_delivery' => $request->tanggal_delivery,
                    'jumlah_delivery' => $request->jumlah,                
                    'keterangan_delivery' => $request->keterangan,
                               
                ]);

                $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->count();


                if($cek == 0){
                    $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->first();

                    DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                        'stok_gudang' => $cek->stok_gudang - $request->jumlah,
                        'stok_toko' => $request->jumlah,
                    ]);

                    $total_stok_gudang = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_gudang');
                    $total_stok_toko = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_toko');
                    $total = $total_stok_gudang + $total_stok_toko;
                    DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                        'tot_stok' => $total,
                    ]);            
                    return redirect('dataDelivery')->with('alert-success','Product Added !');
                }
                else{
                    $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->first();
                    $sum = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_toko');

                    $tamp = $sum + $request->jumlah;
                    DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                        'stok_gudang' => $cek->stok_gudang - $request->jumlah,
                        'stok_toko' => $tamp,
                    ]);
                    $total_stok_gudang = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_gudang');
                    $total_stok_toko = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_toko');
                    $total = $total_stok_gudang + $total_stok_toko;
                    DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                        'tot_stok' => $total,
                    ]);              
                    return redirect('dataDelivery')->with('alert-success','Product Added !');
                }
            }
    }

    public function dataReturn()
    {
        $tamp = DB::table('tb_return_produks')
        ->join('tb_produks','tb_produks.kode_produk','tb_return_produks.fk_kode_produk')
        ->get();
        return view('owner.return.dataReturn',compact('tamp'));
    }

    public function tambahReturn()
    {
        $tamp = DB::table('tb_produksis')
        ->join('tb_produks','tb_produks.kode_produk','tb_produksis.fk_kode_produk')
        ->groupby('tb_produks.nama_produk')
        ->get();
        return view('owner.return.tambahReturn',compact('tamp'));
    }

    public function registerReturn(Request $request){

            $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->first();
            if($cek->stok_toko == 0){
                return redirect('tambahReturn')->with('alert','Stok Toko Habis !');
            }
            else if($cek->stok_toko < $request->jumlah){
                return redirect('tambahReturn')->with('alert','Jumlah Tidak Boleh Lebih Dari Stok Toko !');
            }
            else if($request->jumlah < 0){
                return redirect('tambahReturn')->with('alert','Amount Invalid !');
            }
            else{

                $this->validate($request, [
                    'nama_produk' => 'required',
                    'tanggal_return' => 'required',            
                    'jumlah' => 'required',
                    'keterangan' => 'required',              
                ]);

                DB::table('tb_return_produks')
                ->insert([
                    'fk_kode_produk' => $request->nama_produk,
                    'tanggal_return' => $request->tanggal_return,
                    'jumlah_return' => $request->jumlah,                
                    'keterangan_return' => $request->keterangan,
                               
                ]);

                $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->count();


                if($cek == 0){
                    $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->first();

                    DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                        'stok_toko' => $cek->stok_toko - $request->jumlah,
                        'stok_gudang' => $request->jumlah,
                    ]);

                    $total_stok_gudang = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_gudang');
                    $total_stok_toko = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_toko');
                    $total = $total_stok_gudang + $total_stok_toko;
                    DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                        'tot_stok' => $total,
                    ]);            
                    return redirect('dataReturn')->with('alert-success','Product Added !');
                }
                else{
                    $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->first();
                    $sum = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_gudang');

                    $tamp = $sum + $request->jumlah;
                    DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                        'stok_toko' => $cek->stok_toko - $request->jumlah,
                        'stok_gudang' => $tamp,
                    ]);
                    $total_stok_gudang = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_gudang');
                    $total_stok_toko = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_toko');
                    $total = $total_stok_gudang + $total_stok_toko;
                    DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                        'tot_stok' => $total,
                    ]);              
                    return redirect('dataReturn')->with('alert-success','Product Added !');
                }
            }
    }

    public function dataPenjualanTokoOwner()
    {
        $tamp = DB::table('tb_pembelians')
        ->select('tb_pembelians.*','tb_produks.*','tb_penjualans.*')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->join('tb_penjualans','tb_penjualans.kode_penjualan','tb_pembelians.fk_kode_penjualan')

        // ->selectRaw('sum(jumlah_barang) as sum, sum(total_barang) as sums')
        // ->groupby('tb_produks.kode_produk')
        ->where('tb_penjualans.jenis_penjualan','Toko')
        ->get();

        return view('owner.penjualan.dataPenjualanToko',compact('tamp'));

    }
    public function dataPenjualanInstagram()
    {
        $tamp = DB::table('tb_pembelians')
        ->select('tb_pembelians.*','tb_produks.*','tb_penjualans.*')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->join('tb_penjualans','tb_penjualans.kode_penjualan','tb_pembelians.fk_kode_penjualan')
        // ->selectRaw('sum(jumlah_barang) as sum, sum(total_barang) as sums')
        // ->groupby('tb_produks.kode_produk')
        ->where('tb_penjualans.jenis_penjualan','Instagram')
        ->get();
        return view('owner.penjualan.dataPenjualanInstagram',compact('tamp'));
    }
    public function dataPenjualanEvent()
    {
        $tamp = DB::table('tb_pembelians')
        ->select('tb_pembelians.*','tb_produks.*','tb_penjualans.*')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->join('tb_penjualans','tb_penjualans.kode_penjualan','tb_pembelians.fk_kode_penjualan')
        // ->selectRaw('sum(jumlah_barang) as sum, sum(total_barang) as sums')
        // ->groupby('tb_produks.kode_produk')
        ->where('tb_penjualans.jenis_penjualan','Event')
        ->get();
        return view('owner.penjualan.dataPenjualanEvent',compact('tamp'));
    }
    public function dataPenjualanWeb()
    {
        $tamp = DB::table('tb_pembelians')
        ->select('tb_pembelians.*','tb_produks.*','tb_penjualans.*')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->join('tb_penjualans','tb_penjualans.kode_penjualan','tb_pembelians.fk_kode_penjualan')
        // ->selectRaw('sum(jumlah_barang) as sum, sum(total_barang) as sums')
        // ->groupby('tb_produks.kode_produk')
        ->where('tb_penjualans.jenis_penjualan','Web')
        ->get();
        return view('owner.penjualan.dataPenjualanWeb',compact('tamp'));
    }
    public function dataPenjualanMarketplace()
    {
        $tamp = DB::table('tb_pembelians')
        ->select('tb_pembelians.*','tb_produks.*','tb_penjualans.*')
        ->join('tb_produks','tb_produks.kode_produk','tb_pembelians.fk_kode_produk')
        ->join('tb_penjualans','tb_penjualans.kode_penjualan','tb_pembelians.fk_kode_penjualan')
        // ->selectRaw('sum(jumlah_barang) as sum, sum(total_barang) as sums')
        // ->groupby('tb_produks.kode_produk')
        ->where('tb_penjualans.jenis_penjualan','Marketplace')
        ->get();
        return view('owner.penjualan.dataPenjualanMarketplace',compact('tamp'));
    }


    public function dataAkunPengeluaran()
    {
        $tamp = DB::table('tb_akun_pengeluarans')->get();
        return view('owner.akunPengeluaran.dataAkunPengeluaran',compact('tamp'));
    }
    public function tambahDataAkunPengeluaran()
    {
        return view('owner.akunPengeluaran.tambahDataAkunPengeluaran');
    }
    public function registertambahAkunPengeluaran(Request $request){

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

        return redirect('dataAkunPengeluaran')->with('alert-success','Account Added !');

    }

    public function editAkunPengeluaran($id)
    {
        $tamp = DB::table('tb_akun_pengeluarans')
        ->where('kode_akun',$id)
        ->get();

        return view('owner.akunPengeluaran.editDataAkunPengeluaran',compact('tamp'));
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

        return redirect('dataAkunPengeluaran')->with('alert-success','Edit Success !');

    }
    public function hapusAkunPengeluaran($id)
    {
        $dataakun = DB::table('tb_pengeluarans')->where('fk_kode_akun',$id)->count();
        if($dataakun > 0){
            return redirect('dataAkunPengeluaran')->with('alert','Akun Sedang Digunakan Dipengeluaran');
        }else{
            DB::table('tb_akun_pengeluarans')->where('kode_akun',$id)->delete();
        return redirect('dataAkunPengeluaran')->with('alert-success','Account Deleted');
        }
        
    }



    public function dataPengeluaran()
    {
        $tamp = DB::table('tb_pengeluarans')
        ->join('tb_akun_pengeluarans','tb_akun_pengeluarans.kode_akun','tb_pengeluarans.fk_kode_akun')
        ->get();
        return view('owner.pengeluaran.dataPengeluaran',compact('tamp'));
    }
    
    public function tambahPengeluaran()
    {   
        $tamp = DB::table('tb_akun_pengeluarans')->get();
        $byk = DB::table('tb_akun_pengeluarans')->count();
        if($byk == 0){
            return redirect('dataPengeluaran')->with('alert','Account Is Empty !');
        }
        return view('owner.pengeluaran.tambahPengeluaran',compact('tamp'));
    }
    public function registertambahPengeluaran(Request $request){

        if($request->jumlah < 0){
            return redirect('tambahPengeluaran')->with('alert','Amount Invalid !');
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

        return redirect('dataPengeluaran')->with('alert-success','Expenditure Success !');

    }

    public function editPengeluaran($id)
    {
        $tamp = DB::table('tb_akun_pengeluarans')
        ->get();
        $peng = DB::table('tb_pengeluarans')
        ->where('id',$id)
        ->get();
        return view('owner.pengeluaran.editPengeluaran',compact('tamp','peng'));
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

        return redirect('dataPengeluaran')->with('alert-success','Edit Success !');

    }
    public function hapusPengeluaran($id)
    {
        DB::table('tb_pengeluarans')->where('id',$id)->delete();
        return redirect('dataPengeluaran')->with('alert-success','Account Deleted');
    }

    public function dataPengeluaranLain()
    {
        $tamp = DB::table('tb_pengeluaran_lains')
        ->join('tb_produks','tb_produks.kode_produk','=','tb_pengeluaran_lains.nama_pengeluaran')
        ->get();
        return view('owner.pengeluaran_lain.dataPengeluaranLain',compact('tamp'));
    }
    
    public function tambahPengeluaranLain()
    {   
        $tamp = DB::table('tb_produks')->get();
        return view('owner.pengeluaran_lain.tambahPengeluaranLain',compact('tamp'));
    }
    public function registerTambahPengeluaranLain(Request $request){

        if($request->jml_pengeluaran_lain < 0){
            return redirect('tambahPengeluaranLain')->with('alert','Amount Invalid !');
        }
        $this->validate($request, [
            'tgl_pengeluaran_lain' => 'required',
            'jml_pengeluaran_lain' => 'required',
            'nama_pengeluaran' => 'required',
            'keterangan' => 'required'            
        ]);

        DB::table('tb_pengeluaran_lains')
        ->insert([
            'tgl_pengeluaran_lain' => $request->tgl_pengeluaran_lain,
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'jml_pengeluaran_lain' => $request->jml_pengeluaran_lain,
            'keterangan' => $request->keterangan
        ]);

        return redirect('dataPengeluaranLain')->with('alert-success','Expenditure Success !');

    }

    public function editPengeluaranLain($id)
    {
        $tamp = DB::table('tb_produks')->get();
        $peng = DB::table('tb_pengeluaran_lains')
        ->where('id',$id)
        ->get();
        return view('owner.pengeluaran_lain.editPengeluaranLain',compact('peng','tamp'));
    }
    public function updatePengeluaranLain(Request $request,$id){
        if($request->jml_pengeluaran_lain < 0){
            return redirect('editPengeluaranLain/'.$id)->with('alert','Amount Invalid !');
        }
        $this->validate($request, [
           'tgl_pengeluaran_lain' => 'required',
            'jml_pengeluaran_lain' => 'required',
            'nama_pengeluaran' => 'required',
            'keterangan' => 'required'
        ]);
        
        DB::table('tb_pengeluaran_lains')->where('id',$id)->update([
            'tgl_pengeluaran_lain' => $request->tgl_pengeluaran_lain,
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'jml_pengeluaran_lain' => $request->jml_pengeluaran_lain,
            'keterangan' => $request->keterangan,            
        ]);

        return redirect('dataPengeluaranLain')->with('alert-success','Edit Success !');

    }
    public function hapusPengeluaranLain($id)
    {
        DB::table('tb_pengeluaran_lains')->where('id',$id)->delete();
        return redirect('dataPengeluaranLain')->with('alert-success','Account Deleted');
    }

    public function dataPengeluaranLainnya()
    {
        $tamp = DB::table('tb_pengeluaran_lainnyas')
        ->get();
        return view('owner.pengeluaran_lain.dataPengeluaranLainnya',compact('tamp'));
    }
    
    public function tambahPengeluaranLainnya()
    {   
        return view('owner.pengeluaran_lain.tambahPengeluaranLainnya',compact('tamp'));
    }
    public function registerTambahPengeluaranLainnya(Request $request){

        if($request->jml_pengeluaran_lainnya < 0){
            return redirect('tambahPengeluaranLainnya')->with('alert','Amount Invalid !');
        }
        $this->validate($request, [
            'tgl_pengeluaran_lainnya' => 'required',
            'jml_pengeluaran_lainnya' => 'required',
            'keterangan_pengeluaran_lainnya' => 'required'            
        ]);

        DB::table('tb_pengeluaran_lainnyas')
        ->insert([
            'tgl_pengeluaran_lainnya' => $request->tgl_pengeluaran_lainnya,
            'jml_pengeluaran_lainnya' => $request->jml_pengeluaran_lainnya,
            'keterangan_pengeluaran_lainnya' => $request->keterangan_pengeluaran_lainnya,
        ]);

        return redirect('dataPengeluaranLainnya')->with('alert-success','Expenditure Success !');

    }

    public function editPengeluaranLainnya($id)
    {
        $peng = DB::table('tb_pengeluaran_lainnyas')
        ->where('id',$id)
        ->get();
        return view('owner.pengeluaran_lain.editPengeluaranLainnya',compact('peng','tamp'));
    }
    public function updatePengeluaranLainnya(Request $request,$id){
        if($request->jml_pengeluaran_lain < 0){
            return redirect('editPengeluaranLainnya/'.$id)->with('alert','Amount Invalid !');
        }
        $this->validate($request, [
           'tgl_pengeluaran_lainnya' => 'required',
            'jml_pengeluaran_lainnya' => 'required',
            'keterangan_pengeluaran_lainnya' => 'required',
        ]);
        
        DB::table('tb_pengeluaran_lainnyas')->where('id',$id)->update([
            'tgl_pengeluaran_lainnya' => $request->tgl_pengeluaran_lainnya,
            'jml_pengeluaran_lainnya' => $request->jml_pengeluaran_lainnya,
            'keterangan_pengeluaran_lainnya' => $request->keterangan_pengeluaran_lainnya,            
        ]);

        return redirect('dataPengeluaranLainnya')->with('alert-success','Edit Success !');

    }
    public function hapusPengeluaranLainnya($id)
    {
        DB::table('tb_pengeluaran_lainnyas')->where('id',$id)->delete();
        return redirect('dataPengeluaranLainnya')->with('alert-success','Account Deleted');
    }

    public function ubahPassOwner($id)
    {
        $tamp = DB::table('tb_logins')->where('kode_pegawai',$id)->get();
        return view('owner.akun.ubahPassOwner',compact('tamp'));
    }


    public function updatePassOwner(Request $request, $kode_pegawai)
    {
        $data = DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->first();
        if(!Hash::check($request->old_password,$data->password)){
            return redirect('changePassOwner/'.$kode_pegawai)->with('alert','Change Failed !');
        }

        $this->validate($request, [
        'old_password' => 'required|min:2',
        'new_password' => 'required|min:2',
        'confir' => 'required|same:new_password',          
        ]);
        
        DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->update([
            'password'=>bcrypt($request->new_password),        
        ]);

        return redirect('dashboardOwner')->with('alert-success','Change Success !');
    }

    public function ubahPassToko($id)
    {
        $tamp = DB::table('tb_logins')->where('kode_pegawai',$id)->get();
        return view('adminToko.ubahPassToko',compact('tamp'));
    }


    public function updatePassToko(Request $request, $kode_pegawai)
    {

        $data = DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->first();
        if(!Hash::check($request->old_password,$data->password)){
            return redirect('changePassToko/'.$kode_pegawai)->with('alert','Change Failed !');
        }

        $this->validate($request, [
        'old_password' => 'required|min:2',
        'new_password' => 'required|min:2',
        'confir' => 'required|same:new_password',          
        ]);
        
        DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->update([
            'password'=>bcrypt($request->new_password),        
        ]);

        return redirect('dashboardAdminToko')->with('alert-success','Change Success !');
    }

    public function ubahPassWeb($id)
    {
        $tamp = DB::table('tb_logins')->where('kode_pegawai',$id)->get();
        return view('adminWeb.ubahPassWeb',compact('tamp'));
    }


    public function updatePassWeb(Request $request, $kode_pegawai)
    {

        $data = DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->first();
        if(!Hash::check($request->old_password,$data->password)){
            return redirect('changePassWeb/'.$kode_pegawai)->with('alert','Change Failed !');
        }

        $this->validate($request, [
        'old_password' => 'required|min:2',
        'new_password' => 'required|min:2',
        'confir' => 'required|same:new_password',          
        ]);
        
        DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->update([
            'password'=>bcrypt($request->new_password),        
        ]);

        return redirect('dashboardAdminWeb')->with('alert-success','Change Success !');
    }
    public function ubahPassGudang($id)
    {
        $tamp = DB::table('tb_logins')->where('kode_pegawai',$id)->get();
        return view('adminGudang.ubahPassGudang',compact('tamp'));
    }


    public function updatePassGudang(Request $request, $kode_pegawai)
    {

        $data = DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->first();
        if(!Hash::check($request->old_password,$data->password)){
            return redirect('changePassGudang/'.$kode_pegawai)->with('alert','Change Failed !');
        }

        $this->validate($request, [
        'old_password' => 'required|min:2',
        'new_password' => 'required|min:2',
        'confir' => 'required|same:new_password',          
        ]);
        
        DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->update([
            'password'=>bcrypt($request->new_password),        
        ]);

        return redirect('dashboardAdminGudang')->with('alert-success','Change Success !');
    }

    public function ubahPassEvent($id)
    {
        $tamp = DB::table('tb_logins')->where('kode_pegawai',$id)->get();
        return view('adminEvent.ubahPassEvent',compact('tamp'));
    }


    public function updatePassEvent(Request $request, $kode_pegawai)
    {

        $data = DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->first();
        if(!Hash::check($request->old_password,$data->password)){
            return redirect('changePassEvent/'.$kode_pegawai)->with('alert','Change Failed !');
        }

        $this->validate($request, [
        'old_password' => 'required|min:2',
        'new_password' => 'required|min:2',
        'confir' => 'required|same:new_password',          
        ]);
        
        DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->update([
            'password'=>bcrypt($request->new_password),        
        ]);

        return redirect('dashboardAdminEvent')->with('alert-success','Change Success !');
    }

    public function ubahPassIg($id)
    {
        $tamp = DB::table('tb_logins')->where('kode_pegawai',$id)->get();
        return view('adminInstagram.ubahPassIg',compact('tamp'));
    }


    public function updatePassIg(Request $request, $kode_pegawai)
    {

        $data = DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->first();
        if(!Hash::check($request->old_password,$data->password)){
            return redirect('changePassIg/'.$kode_pegawai)->with('alert','Change Failed !');
        }

        $this->validate($request, [
        'old_password' => 'required|min:2',
        'new_password' => 'required|min:2',
        'confir' => 'required|same:new_password',          
        ]);
        
        DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->update([
            'password'=>bcrypt($request->new_password),        
        ]);

        return redirect('dashboardAdminInstagram')->with('alert-success','Change Success !');
    }

    public function ubahPassMarketplace($id)
    {
        $tamp = DB::table('tb_logins')->where('kode_pegawai',$id)->get();
        return view('adminMarketplace.ubahPassMarketplace',compact('tamp'));
    }


    public function updatePassMarketplace(Request $request, $kode_pegawai)
    {

        $data = DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->first();
        if(!Hash::check($request->old_password,$data->password)){
            return redirect('changePassMarketplace/'.$kode_pegawai)->with('alert','Change Failed !');
        }

        $this->validate($request, [
        'old_password' => 'required|min:2',
        'new_password' => 'required|min:2',
        'confir' => 'required|same:new_password',          
        ]);
        
        DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->update([
            'password'=>bcrypt($request->new_password),        
        ]);

        return redirect('dashboardAdminMarketplace')->with('alert-success','Change Success !');
    }




    public function dataLaba()
    {
        return view('owner.dataLaba.dataLaba');
    }
    public function registerLaba(Request $request){
        

        $start = date('Y-m-d', strtotime($request->start));
        $end  = date('Y-m-d', strtotime($request->end));

        echo $labaPenjualan = DB::table('tb_penjualans')
        ->whereBetween('tanggal_penjualan', array($start, $end))
        ->get();

    }

    public function laporanAsset(){
        $tamp = DB::table('tb_produks')
        ->join('tb_stoks','tb_stoks.fk_kode_pro','=','tb_produks.kode_produk')
        ->orderby('tb_stoks.stok_gudang','DESC')
        ->get();

        $kategori = DB::table('tb_kategoris')->get();

        $gudang = DB::table('tb_stoks')
        ->sum('stok_gudang');

        $toko = DB::table('tb_stoks')
        ->sum('stok_toko');

        $harga = DB::table('tb_produks')
        ->join('tb_stoks','tb_stoks.fk_kode_pro','=','tb_produks.kode_produk')
        ->sum('harga_jual');
        Session::put('tamp',$tamp);
        Session::put('kategori',$kategori);
        Session::put('gudang',$gudang);
        Session::put('toko',$toko);
        Session::put('harga',$harga);
        return view('owner.laporan.laporanAsset',compact('tamp','kategori','gudang','toko'));
    }
    public function registerLaporanAsset(Request $request){
        
        $kat = $request->kategori_asset;
        $posisi = $request->posisi_asset;
        if($posisi == 'Gudang'){   
            $kategori = DB::table('tb_kategoris')->get();

            $tamp = DB::table('tb_produks')
            ->join('tb_stoks','tb_stoks.fk_kode_pro','=','tb_produks.kode_produk')
            ->where('tb_produks.fk_kode_kat',$kat)
            ->get();

            $gudang = DB::table('tb_produks')
            ->join('tb_stoks','tb_stoks.fk_kode_pro','=','tb_produks.kode_produk')
            ->where('tb_produks.fk_kode_kat',$kat)
            ->sum('stok_gudang');            

            Session::put('tamp',$tamp);
            Session::put('kategori',$kategori);
            Session::put('kat',$kat);
            Session::put('gudang',$gudang);
            
            return view('owner.laporan.laporanAssetGudang',compact('tamp','kategori','kat','gudang'));
        }elseif ($posisi == 'Toko') {
            $tamp = DB::table('tb_produks')
            ->join('tb_stoks','tb_stoks.fk_kode_pro','=','tb_produks.kode_produk')
            ->where('tb_produks.fk_kode_kat',$kat)
            ->get();

           $toko = DB::table('tb_produks')
            ->join('tb_stoks','tb_stoks.fk_kode_pro','=','tb_produks.kode_produk')
            ->where('tb_produks.fk_kode_kat',$kat)
            ->sum('stok_toko');

            $kategori = DB::table('tb_kategoris')->get();

            Session::put('tamp',$tamp);
            Session::put('kategori',$kategori);
            Session::put('kat',$kat);
            Session::put('toko',$toko);
            return view('owner.laporan.laporanAssetToko',compact('tamp','kategori','kat','toko'));
        }
    }

    public function laporanPenjualan(){

        $start = "-1";
        $end  = "-1";

        $jenis = DB::table('tb_penjualans')->get();
        $total = 0;
        $tamp = DB::table('tb_penjualans')
        ->join('tb_pembelians','tb_pembelians.fk_kode_penjualan','tb_penjualans.kode_penjualan')
        ->whereBetween('tanggal_penjualan', array($start, $end))
        ->get();
        return view('owner.laporan.laporanPenjualan',compact('tamp','jenis','total'));
    }
    public function registerLaporanPenjualan(Request $request){
        
        $start = date('Y-m-d', strtotime($request->start));
        $end  = date('Y-m-d', strtotime($request->end));

        $jenis = DB::table('tb_penjualans')->get();

        $tamp = DB::table('tb_penjualans')
        ->select('tb_penjualans.*','tb_pembelians.*')
        ->join('tb_pembelians','tb_pembelians.fk_kode_penjualan','tb_penjualans.kode_penjualan')
        ->whereBetween('tanggal_penjualan', array($start, $end))
        ->orderBy('tb_penjualans.jenis_penjualan','ASC')
        ->get();

        $total = DB::table('tb_penjualans')
        ->select('tb_penjualans.*','tb_pembelians.*')
        ->join('tb_pembelians','tb_pembelians.fk_kode_penjualan','tb_penjualans.kode_penjualan')
        ->whereBetween('tanggal_penjualan', array($start, $end)) 
        ->sum('total_barang');

        $startDate = date('d-m-Y', strtotime($request->start));
        $endDate  = date('d-m-Y', strtotime($request->end));

        Session::put('data',$tamp);
        Session::put('total',$total);
        Session::put('start',$startDate);
        Session::put('end',$endDate);


        return view('owner.laporan.laporanPenjualan',compact('tamp','total','jenis'));
    }

    public function laporanPengeluaran(Request $request){
        
        $start = "-1";
        $end  = "-1";
        $total = 0;
        $tamp = DB::table('tb_pengeluarans')
        ->whereBetween('tgl_pengeluaran', array($start, $end))
        ->get();
        return view('owner.laporan.laporanPengeluaran',compact('tamp','total'));

    }
    public function registerLaporanPengeluaran(Request $request){
        $start = date('Y-m-d', strtotime($request->start));
        $end  = date('Y-m-d', strtotime($request->end));

        $tamp = DB::table('tb_pengeluarans')
        ->select('tb_pengeluarans.*')
        ->whereBetween('tgl_pengeluaran', array($start, $end))
        ->orderBy('tb_pengeluarans.tgl_pengeluaran','ASC')
        ->get();

        $total = DB::table('tb_pengeluarans')
        ->whereBetween('tgl_pengeluaran', array($start, $end))
        ->sum('jumlah_pengeluaran');

        
        

        $startDate = date('d-m-Y', strtotime($request->start));
        $endDate  = date('d-m-Y', strtotime($request->end));

        Session::put('data2',$tamp);
        Session::put('total2',$total);
        Session::put('start2',$startDate);
        Session::put('end2',$endDate);
        


        return view('owner.laporan.laporanPengeluaran',compact('tamp','total'));
    }

    public function laporanPengeluaranLainnya(Request $request){
        
        $start = "-1";
        $end  = "-1";
        $total = 0;
        $tamp = DB::table('tb_pengeluaran_lainnyas')
        ->whereBetween('tgl_pengeluaran_lainnya', array($start, $end))
        ->get();
        return view('owner.laporan.laporanPengeluaranLainnya',compact('tamp','total'));

    }
    public function registerLaporanPengeluaranLainnya(Request $request){
        $start = date('Y-m-d', strtotime($request->start));
        $end  = date('Y-m-d', strtotime($request->end));

        $tamp = DB::table('tb_pengeluaran_lainnyas')
        ->select('tb_pengeluaran_lainnyas.*')
        ->whereBetween('tgl_pengeluaran_lainnya', array($start, $end))
        ->orderBy('tb_pengeluaran_lainnyas.tgl_pengeluaran_lainnya','ASC')
        ->get();

        $total = DB::table('tb_pengeluaran_lainnyas')
        ->whereBetween('tgl_pengeluaran_lainnya', array($start, $end))
        ->sum('jml_pengeluaran_lainnya');

        
        

        $startDate = date('d-m-Y', strtotime($request->start));
        $endDate  = date('d-m-Y', strtotime($request->end));

        Session::put('data2',$tamp);
        Session::put('total2',$total);
        Session::put('start2',$startDate);
        Session::put('end2',$endDate);
        


        return view('owner.laporan.laporanPengeluaranLainnya',compact('tamp','total'));
    }

    public function laporanLaba(Request $request){

        $laba = 0;
        $penjualan = 0; 
        $pengeluaran = 0;
        $pengeluaranLain = 0;
        return view('owner.laporan.laporanLaba',compact('penjualan','pengeluaran','pengeluaranLain','laba'));

    }
    public function registerLaporanLaba(Request $request){
        
        $start = date('Y-m-d', strtotime($request->start));
        $end  = date('Y-m-d', strtotime($request->end));        

        $penjualan = DB::table('tb_penjualans')
        ->select('tb_penjualans.*','tb_pembelians.*')
        ->join('tb_pembelians','tb_pembelians.fk_kode_penjualan','tb_penjualans.kode_penjualan')
        ->whereBetween('tanggal_penjualan', array($start, $end)) 
        ->sum('total_barang');

        $pengeluaran = DB::table('tb_pengeluarans')
        ->whereBetween('tgl_pengeluaran', array($start, $end))
        ->sum('jumlah_pengeluaran');

        $pengeluaranLain = DB::table('tb_pengeluaran_lainnyas')
        ->whereBetween('tgl_pengeluaran_lainnya', array($start, $end))
        ->sum('jml_pengeluaran_lainnya');

        $laba = $penjualan - ($pengeluaran + $pengeluaranLain);
        $startDate = date('d-m-Y', strtotime($request->start));
        $endDate  = date('d-m-Y', strtotime($request->end));

        Session::put('penjualan',$penjualan);
        Session::put('pengeluaran',$pengeluaran);
        Session::put('pengeluaranLain',$pengeluaranLain);
        Session::put('laba',$laba);
        Session::put('start3',$startDate);
        Session::put('end3',$endDate);
        return view('owner.laporan.laporanLaba',compact('penjualan','pengeluaran','pengeluaranLain','laba'));

    }

}
