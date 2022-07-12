<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class adminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataProdukAdminEvent()
    {
        $tamp = DB::table('tb_produks')
        ->select('tb_produks.*','tb_kategoris.*')
        ->join('tb_kategoris','tb_kategoris.kode_kategori','tb_produks.fk_kode_kat')
        ->get();
        return view('adminEvent.dataProdukAdminEvent',compact('tamp'));
    }
    public function dataStokAdminEvent()
    {       
         $tamp = DB::table('tb_stoks')
        ->join('tb_produks','tb_produks.kode_produk','tb_stoks.fk_kode_pro')
        ->get();
        return view('adminEvent.dataStokAdminEvent',compact('tamp'));
    }

    public function dataProduksiAdminEvent()
    {
        $tamp = DB::table('tb_produksis')
        ->join('tb_produks','tb_produks.kode_produk','tb_produksis.fk_kode_produk')
        ->get();
        return view('adminEvent.dataProduksiAdminEvent',compact('tamp'));
    }
    public function tambahProduksiAdminEvent()
    {
        $tamp = DB::table('tb_produks')->get();
        return view('adminEvent.tambahProduksiAdminEvent',compact('tamp'));
    }

    public function registerProduksiAdminEvent(Request $request){

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
            return redirect('dataProduksiAdminEvent')->with('alert-success','Product Added !');
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
            return redirect('dataProduksiAdminEvent')->with('alert-success','Product Added !');
        }
    }

    public function dataPenjualanEvent()
    {
        $id = Session::get('id_event');
        $tamp = DB::table('tb_penjualans')
        ->join('tb_logins','tb_logins.kode_pegawai','tb_penjualans.fk_kode_pegawai')
        ->where('kode_pegawai',$id)
        ->get();
        return view('adminEvent.dataPenjualanEvent',compact('tamp'));
    }

    public function tambahPenjualanEvent()
    {     
        return view('adminEvent.tambahPenjualanEvent');
    }

    public function registerPenjualanEvent(Request $request){

        $id = Session::get('id_event');

        DB::table('tb_penjualans')
        ->insert([
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'nama_pembeli' => $request->nama_pembeli,
            'keterangan_pembeli' => $request->keterangan_pembeli,
            'jenis_penjualan' => "Event",
            'fk_kode_pegawai' => $id,
                       
        ]);
        return redirect('dataPenjualanEvent')->with('alert-success','Data Added !');
    }
    public function tambahPembelianEvent(Request $request, $kode_penjualan)
    {    
        $tamp = DB::table('tb_produks')->orderBy('nama_produk','ASC')->get();
        $tamps = DB::table('tb_penjualans')->where('kode_penjualan',$kode_penjualan)->get();
        return view('adminEvent.tambahPembelianEvent',compact('tamp','tamps'));
    }
    public function registerPembelianEvent(Request $request, $kode_penjualan){
        
        $byk = DB::table('tb_pembelians')
        ->where([
            ['fk_kode_produk',$request->nama_produk],
            ['fk_kode_penjualan',$kode_penjualan],
        ])->count();

        $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->first();
        $sum = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_gudang');
        if($request->diskon < 0 ){
            return redirect('tambahPembelianEvent/'.$kode_penjualan)->with('alert','Diskon Invalid !');
        }
        else if($byk > 0){
            return redirect('tambahPembelianEvent/'.$kode_penjualan)->with('alert','Produk Sudah Dibeli !');
        }        
        else if($request->jumlah < 0){
            return redirect('tambahPembelianEvent/'.$kode_penjualan)->with('alert','Tidak Boleh Kurang Dari 0 !');
        }

        else{
            if($sum == 0){
                return redirect('dataPenjualanEvent')->with('alert','Stok Kosong !');
            }
            else if($request->jumlah > $sum){
                return redirect('dataPenjualanEvent')->with('alert','Stok Kurang !');   
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
                        'fk_kode_penjualan' => $kode_penjualan,
                                   
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
                        'fk_kode_penjualan' => $kode_penjualan,
                                   
                    ]);
                }
                DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                    'stok_gudang' => $sum - $request->jumlah,
                    ]);
            }
            
        }
        
        return redirect('detailPembelianEvent/'.$kode_penjualan)->with('alert-success','Data Added !');
    }

    public function detailPembelianEvent(Request $request, $kode_penjualan)
    {
        $id = Session::get('id_event');
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
        return view('adminEvent.dataPembelianEvent',compact('tamp','tamps'));
    }
}
