<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class adminTokoController extends Controller
{
    public function cetakStruk(Request $request){

        $struk = DB::table('tb_stoks')->get();
        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('adminToko.cetakStruk',compact('struk'))->stream();
        
        
    }

    public function dataProdukAdminToko()
    {
        $tamp = DB::table('tb_produks')
        ->select('tb_produks.*','tb_kategoris.*')
        ->join('tb_kategoris','tb_kategoris.kode_kategori','tb_produks.fk_kode_kat')
        ->get();
        return view('adminToko.dataProdukAdminToko',compact('tamp'));
    }

    public function dataStokToko()
    {       
         $tamp = DB::table('tb_stoks')
        ->join('tb_produks','tb_produks.kode_produk','tb_stoks.fk_kode_pro')
        ->get();
        return view('adminToko.dataStokToko',compact('tamp'));
    }
    public function dataDeliveryAdminToko()
    {
        $tamp = DB::table('tb_delivery_produks')
        ->join('tb_produks','tb_produks.kode_produk','tb_delivery_produks.fk_kode_produk')
        ->get();
        return view('adminToko.dataDeliveryAdminToko',compact('tamp'));
    }

    public function tambahDeliveryAdminToko()
    {
        $tamp = DB::table('tb_produksis')
        ->join('tb_produks','tb_produks.kode_produk','tb_produksis.fk_kode_produk')
        ->groupby('tb_produks.nama_produk')
        ->get();
        return view('adminToko.tambahDeliveryAdminToko',compact('tamp'));
    }

    public function registerDeliveryAdminToko(Request $request){

            $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->first();
            if($cek->stok_gudang == 0){
                return redirect('dataDeliveryAdminToko')->with('alert','Stok Gudang Habis !');
            }
            else if($cek->stok_gudang < $request->jumlah){

                return redirect('tambahDeliveryAdminToko')->with('alert','Jumlah Tidak Boleh Lebih Dari Stok Gudang !');
            }
            else{

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
                    return redirect('dataDeliveryAdminToko')->with('alert-success','Product Added !');
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
                    return redirect('dataDeliveryAdminToko')->with('alert-success','Product Added !');
                }
            }
    }

    public function dataPenjualanToko()
    {
        $id = Session::get('id_toko');
        $tamp = DB::table('tb_penjualans')
        ->join('tb_logins','tb_logins.kode_pegawai','tb_penjualans.fk_kode_pegawai')
        ->where('kode_pegawai',$id)
        ->get();
        return view('adminToko.dataPenjualanToko',compact('tamp'));
    }

    public function tambahPenjualanToko()
    {     
        return view('adminToko.tambahPenjualanToko');
    }

    public function registerPenjualanToko(Request $request){

        $id = Session::get('id_toko');

        DB::table('tb_penjualans')
        ->insert([
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'nama_pembeli' => $request->nama_pembeli,
            'keterangan_pembeli' => $request->keterangan_pembeli,
            'jenis_penjualan' => "Toko",
            'fk_kode_pegawai' => $id,

                       
        ]);
        return redirect('dataPenjualanToko')->with('alert-success','Data Added !');
    }
    public function tambahPembelianToko(Request $request,$id)
    {    
        $tamp = DB::table('tb_produks')->orderBy('nama_produk','ASC')->get();
        $tamps = DB::table('tb_penjualans')->where('kode_penjualan',$id)->get();
        return view('adminToko.tambahPembelianToko',compact('tamp','tamps'));
    }
    public function registerPembelianToko(Request $request,$id){
        
        $byk = DB::table('tb_pembelians')
        ->where([
            ['fk_kode_produk',$request->nama_produk],
            ['fk_kode_penjualan',$id],
        ])->count();

        $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->first();
        $sum = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_toko');
        
        if($request->diskon < 0){
            return redirect('tambahPembelianToko/'.$id)->with('alert','Diskon Invalid !');
        }
        else if($byk > 0){
            return redirect('tambahPembelianToko/'.$id)->with('alert','Produk Sudah Dibeli !');
        }        

        else if($request->jumlah < 0){
            return redirect('tambahPembelianToko/'.$id)->with('alert','Tidak Boleh Kurang Dari 0 !');
        }
        else{
            if($sum == 0){
                return redirect('dataPenjualanToko')->with('alert','Stok Toko Kosong !');
            }
            else if($request->jumlah > $sum){
                return redirect('dataPenjualanToko')->with('alert','Stok Kurang !');   
            }

            else{
                if($request->diskon > 100){
                    $dis = (($request->diskon / $request->harga_jual) * (100/100)) * 100 ;

                    DB::table('tb_pembelians')
                    ->insert([
                        'harga_barang' => $request->harga_jual,            
                        'jumlah_barang' => $request->jumlah,
                        'diskon' => $dis,
                        'diskon_rp' => $request->diskon,
                        'total_barang' => $request->total,
                        'ongkir' => 0,
                        'fk_kode_produk' => $request->nama_produk,
                        'fk_kode_penjualan' => $id,
                                   
                    ]);

                }else{
                    $diskon = ($request->harga_jual * $request->diskon) / 100 ;

                    DB::table('tb_pembelians')
                    ->insert([
                        'harga_barang' => $request->harga_jual,            
                        'jumlah_barang' => $request->jumlah,
                        'diskon' => $request->diskon,
                        'diskon_rp' => $diskon,
                        'total_barang' => $request->total,
                        'ongkir' => 0,
                        'fk_kode_produk' => $request->nama_produk,
                        'fk_kode_penjualan' => $id,
                                   
                    ]);
                }
                DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                    'stok_toko' => $sum - $request->jumlah,
                    ]);
            }
            
        }
        
        return redirect('detailPembelianToko/'.$id)->with('alert-success','Data Added !');
    }

    public function detailPembelianToko(Request $request, $kode_penjualan)
    {
        $id = Session::get('id_toko');
        $tamps = DB::table('tb_penjualans')
        ->join('tb_logins','tb_logins.kode_pegawai','tb_penjualans.fk_kode_pegawai')
        ->where('tb_penjualans.kode_penjualan',$kode_penjualan)
        ->get();

        $tamp = DB::table('tb_produks')
        ->select('tb_produks.*','tb_pembelians.*')
        ->join('tb_pembelians','tb_pembelians.fk_kode_produk','tb_produks.kode_produk')
        ->selectRaw('sum(jumlah_barang) as sum, sum(total_barang) as sums')
        ->groupby('tb_produks.kode_produk')
        ->where('tb_pembelians.fk_kode_penjualan',$kode_penjualan)
        ->get();
        
        return view('adminToko.dataPembelianToko',compact('tamps','tamp'));

    }

    public function akunToko()
    {
        $id = Session::get('id_toko');
        $tamp = DB::table('tb_logins')->where('kode_pegawai',$id)->get();
        return view('adminToko.akunToko',compact('tamp'));
    }

    public function editAkunToko($kode_pegawai){

        $tamp = DB::table('tb_logins')->where('kode_pegawai',$kode_pegawai)->get();
        return view('adminToko.editAkunToko',compact('tamp'));
    }

    // public function updateKategoriAdminGudang(Request $request, $kode_kategori)
    // {
    //     $kat=DB::table('tb_kategoris')        
    //     ->where('kode_kategori','=',$request->kode_kategori)
    //     ->orwhere('nama_kategori','=',$request->nama_kategori)
    //     ->count();
    //     if($kat > 1){
    //         return redirect('editKategoriAdminGudang/'.$request->kode_kategori)->with('alert','Data is Already Exist !');
    //     }
    //     else{

    //         $this->validate($request, [
    //         'nama_kategori' => 'required|min:2',
    //         'keterangan' => 'required|min:2',
            
    //     ]);
        
    //     DB::table('tb_kategoris')->where('kode_kategori',$kode_kategori)->update([
    //         'nama_kategori' => $request->nama_kategori,
    //         'keterangan' => $request->keterangan,            
    //     ]);

    //     return redirect('dataKategoriAdminGudang')->with('alert-success','Edit Success !');

    //     }
    // }
    // public function hapusKategoriAdminGudang($kode_kategori)
    // {
    //     DB::table('tb_kategoris')->where('kode_kategori',$kode_kategori)->delete();
    //     return redirect('dataKategoriAdminGudang')->with('alert-success','Category Deleted !');
    // }
}
