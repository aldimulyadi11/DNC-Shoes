<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class adminGudangController extends Controller
{

    public function dataDeliveryAdminGudang()
    {
        $tamp = DB::table('tb_delivery_produks')
        ->join('tb_produks','tb_produks.kode_produk','tb_delivery_produks.fk_kode_produk')
        ->get();
        return view('adminGudang.dataDeliveryAdminGudang',compact('tamp'));
    }

    public function tambahDeliveryAdminGudang()
    {
        $tamp = DB::table('tb_produksis')
        ->join('tb_produks','tb_produks.kode_produk','tb_produksis.fk_kode_produk')
        ->groupby('tb_produks.nama_produk')
        ->get();
        return view('adminGudang.tambahDeliveryAdminGudang',compact('tamp'));
    }

    public function registerDeliveryAdminGudang(Request $request){

            $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->first();
            if($cek->stok_gudang == 0){
                return redirect('dataDeliveryAdminGudang')->with('alert','Stok Gudang Habis !');
            }
            else if($request->jumlah < 0){

                return redirect('tambahDeliveryAdminGudang')->with('alert','Amount Invalid !');
            }
            else if($cek->stok_gudang < $request->jumlah){

                return redirect('tambahDeliveryAdminGudang')->with('alert','Jumlah Tidak Boleh Lebih Dari Stok Gudang !');
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
                    return redirect('dataDeliveryAdminGudang')->with('alert-success','Product Added !');
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
                    return redirect('dataDeliveryAdminGudang')->with('alert-success','Product Added !');
                }
            }
    }

    public function dataPengeluaranLain()
    {
        $tamp = DB::table('tb_pengeluaran_lains')
        ->join('tb_produks','tb_produks.kode_produk','tb_pengeluaran_lains.nama_pengeluaran')
        ->get();
        return view('adminGudang.dataPengeluaranLain',compact('tamp'));
    }
    
    public function tambahPengeluaranLain()
    {   
        $tamp = DB::table('tb_produks')->get();
        return view('adminGudang.tambahPengeluaranLain',compact('tamp'));
    }
    public function registerTambahPengeluaranLain(Request $request){

        if($request->jml_pengeluaran_lain < 0){
            return redirect('tambahPengeluaranLainAdminGudang')->with('alert','Amount Invalid !');
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

        return redirect('dataPengeluaranLainAdminGudang')->with('alert-success','Expenditure Success !');

    }

    public function editPengeluaranLain($id)
    {
        $tamp = DB::table('tb_produks')->get();
        $peng = DB::table('tb_pengeluaran_lains')
        ->where('id',$id)
        ->get();
        return view('adminGudang.editPengeluaranLain',compact('tamp','peng'));
    }
    public function updatePengeluaranLain(Request $request,$id){
        if($request->jml_pengeluaran_lain < 0){
            return redirect('editPengeluaranLainAdminGudang/'.$id)->with('alert','Amount Invalid !');
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

        return redirect('dataPengeluaranLainAdminGudang')->with('alert-success','Edit Success !');

    }
    public function hapusPengeluaranLain($id)
    {
        DB::table('tb_pengeluaran_lains')->where('id',$id)->delete();
        return redirect('dataPengeluaranLainAdminGudang')->with('alert-success','Account Deleted');
    }

    public function dataPengeluaranLainnya()
    {
        $tamp = DB::table('tb_pengeluaran_lainnyas')
        ->get();
        return view('adminGudang.dataPengeluaranLainnya',compact('tamp'));
    }

    public function tambahPengeluaranLainnya()
    {   
        return view('adminGudang.tambahPengeluaranLainnya',compact('tamp'));
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

        return redirect('dataPengeluaranLainnyaAdminGudang')->with('alert-success','Expenditure Success !');

    }

    public function editPengeluaranLainnya($id)
    {
        $peng = DB::table('tb_pengeluaran_lainnyas')
        ->where('id',$id)
        ->get();
        return view('adminGudang.editPengeluaranLainnya',compact('peng','tamp'));
    }
    public function updatePengeluaranLainnya(Request $request,$id){
        if($request->jml_pengeluaran_lain < 0){
            return redirect('editPengeluaranLainnyaAdminGudang/'.$id)->with('alert','Amount Invalid !');
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

        return redirect('dataPengeluaranLainnyaAdminGudang')->with('alert-success','Edit Success !');

    }
    public function hapusPengeluaranLainnya($id)
    {
        DB::table('tb_pengeluaran_lainnyas')->where('id',$id)->delete();
        return redirect('dataPengeluaranLainnyaAdminGudang')->with('alert-success','Account Deleted');
    }


    public function dataReturnAdminGudang()
    {
        $tamp = DB::table('tb_return_produks')
        ->join('tb_produks','tb_produks.kode_produk','tb_return_produks.fk_kode_produk')
        ->get();
        return view('adminGudang.dataReturnAdminGudang',compact('tamp'));
    }

    public function tambahReturnAdminGudang()
    {
        $tamp = DB::table('tb_produksis')
        ->join('tb_produks','tb_produks.kode_produk','tb_produksis.fk_kode_produk')
        ->groupby('tb_produks.nama_produk')
        ->get();
        return view('adminGudang.tambahReturnAdminGudang',compact('tamp'));
    }

    public function registerReturnAdminGudang(Request $request){

            $cek = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->first();
            if($cek->stok_toko == 0){
                return redirect('tambahReturnAdminGudang')->with('alert','Stok Toko Habis !');
            }
            else if($cek->stok_toko < $request->jumlah){
                return redirect('tambahReturnAdminGudang')->with('alert','Jumlah Tidak Boleh Lebih Dari Stok Toko !');
            }
            else if($request->jumlah < 0){
                return redirect('tambahReturnAdminGudang')->with('alert','Amount Invalid !');
            }
            else{

                $this->validate($request, [
                    'nama_produk' => 'required',
                    'tanggal_return' => 'required',            
                    'jumlah' => 'required|',
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
                        'stok_toko' => $cek->stok_gudang - $request->jumlah,
                        'stok_gudang' => $request->jumlah,
                    ]);

                    $total_stok_gudang = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_gudang');
                    $total_stok_toko = DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->sum('stok_toko');
                    $total = $total_stok_gudang + $total_stok_toko;
                    DB::table('tb_stoks')->where('fk_kode_pro',$request->nama_produk)->update([
                        'tot_stok' => $total,
                    ]);            
                    return redirect('dataReturnAdminGudang')->with('alert-success','Product Added !');
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
                    return redirect('dataReturnAdminGudang')->with('alert-success','Product Added !');
                }
            }
    }

   public function dataKategoriAdminGudang()
    {
        $tamp = DB::table('tb_kategoris')->get();
        return view('adminGudang.dataKategoriAdminGudang',compact('tamp'));
    }
    public function tambahKategoriAdminGudang()
    {
        return view('adminGudang.tambahKategoriAdminGudang');
    }
    public function registerKategoriAdminGudang(Request $request){
        $kat=DB::table('tb_kategoris')->where('nama_kategori','=',$request->nama_kategori)->count();

        if($kat > 0){
            return redirect('tambahKategoriAdminGudang')->with('alert','Data is Already Exist !');
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

        return redirect('dataKategoriAdminGudang')->with('alert-success','Category Added !');
    }

    public function editKategoriAdminGudang($kode_kategori){

        $tamp = DB::table('tb_kategoris')->where('kode_kategori',$kode_kategori)->get();
        return view('adminGudang.editKategoriAdminGudang',compact('tamp'));
    }

    public function updateKategoriAdminGudang(Request $request, $kode_kategori)
    {
        $kat=DB::table('tb_kategoris')        
        ->where('kode_kategori','=',$request->kode_kategori)
        ->orwhere('nama_kategori','=',$request->nama_kategori)
        ->count();
        if($kat > 1){
            return redirect('editKategoriAdminGudang/'.$request->kode_kategori)->with('alert','Data is Already Exist !');
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

        return redirect('dataKategoriAdminGudang')->with('alert-success','Edit Success !');

        }
    }
    public function hapusKategoriAdminGudang($kode_kategori)
    {
        $byk = DB::table('tb_produks')->where('fk_kode_kat',$kode_kategori)->count();
        if($byk > 0){
            return redirect('dataKategoriAdminGudang')->with('alert','Kategori Sedang Digunakan !');
        }

        DB::table('tb_kategoris')->where('kode_kategori',$kode_kategori)->delete();
        return redirect('dataKategoriAdminGudang')->with('alert-success','Category Deleted !');
    }


    public function dataProdukAdminGudang()
    {
        $tamp = DB::table('tb_produks')
        ->select('tb_produks.*','tb_kategoris.*')
        ->join('tb_kategoris','tb_kategoris.kode_kategori','tb_produks.fk_kode_kat')
        ->get();
        return view('adminGudang.dataProdukAdminGudang',compact('tamp'));
    }
    public function tambahProdukAdminGudang()
    {
        $tamp = DB::table('tb_kategoris')->get();
        return view('adminGudang.tambahProdukAdminGudang',compact('tamp'));
    }
    public function registerProdukAdminGudang(Request $request){


        $pro=DB::table('tb_produks')->where('nama_produk','=',$request->nama_produk)->count();

        if($pro > 0){
            return redirect('tambahProdukAdminGudang')->with('alert','Data is Already Exist !');
        }
        else if($request->stok_minimum < 0){
            return redirect('tambahProdukAdminGudang')->with('alert','Stok Invalid !');
        }
        else if($request->harga_jual < 0){
            return redirect('tambahProdukAdminGudang')->with('alert','Price Invalid !');
        }       
        else{
            
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
            return redirect('dataProdukAdminGudang')->with('alert-success','Product Added !');
        }
    }

    public function editProdukAdminGudang($kode_produk){

        $tamp = DB::table('tb_produks')->where('kode_produk',$kode_produk)->get();
        $tamp2 = DB::table('tb_kategoris')->get();
        return view('adminGudang.editProdukAdminGudang',compact('tamp','tamp2'));

   
    }

    public function updateProdukAdminGudang(Request $request, $kode_produk)
    {
        $pro=DB::table('tb_produks')        
        ->where('kode_produk','=',$request->kode_produk)
        ->orwhere('nama_produk','=',$request->nama_produk)
        ->count();
        if($pro > 1){
            return redirect('editProdukAdminGudang/'.$request->kode_produk)->with('alert','Data is Already Exist !');
        }
        else if($request->stok_minimum < 0){
            return redirect('editProdukAdminGudang/'.$kode_produk)->with('alert','Stok Invalid !');
        }
        else if($request->harga_jual < 0){
            return redirect('editProdukAdminGudang/'.$kode_produk)->with('alert','Price Invalid !');
        }    
        else{
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

            return redirect('dataProdukAdminGudang')->with('alert-success','Edit Success !');
        }
    }

    public function dataStokAdminGudang()
    {       
         $tamp = DB::table('tb_stoks')
        ->join('tb_produks','tb_produks.kode_produk','tb_stoks.fk_kode_pro')
        ->get();
        return view('adminGudang.dataStokAdminGudang',compact('tamp'));
    }

    public function dataProduksiAdminGudang()
    {
        $tamp = DB::table('tb_produksis')
        ->join('tb_produks','tb_produks.kode_produk','tb_produksis.fk_kode_produk')
        ->get();
        return view('adminGudang.dataProduksiAdminGudang',compact('tamp'));
    }
    public function tambahProduksiAdminGudang()
    {
        $tamp = DB::table('tb_produks')->orderBy('nama_produk','ASC')->get();
        return view('adminGudang.tambahProduksiAdminGudang',compact('tamp'));
    }

    public function registerProduksiAdminGudang(Request $request){

        if($request->jumlah < 0){

            return redirect('tambahProduksiAdminGudang')->with('alert','Amount Invalid !');
        }

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
            return redirect('dataProduksiAdminGudang')->with('alert-success','Product Added !');
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
            return redirect('dataProduksiAdminGudang')->with('alert-success','Product Added !');
        }
    }

    public function hapusProdukAdminGudang($kode_produk)
    {
        $byk = DB::table('tb_delivery_produks')->where('fk_kode_produk',$kode_produk)->count();
        $byk2 = DB::table('tb_pembelians')->where('fk_kode_produk',$kode_produk)->count();
        $byk3 = DB::table('tb_produksis')->where('fk_kode_produk',$kode_produk)->count();
        $byk4 = DB::table('tb_stoks')->where('fk_kode_pro',$kode_produk)->count();
        if($byk > 0){
            return redirect('dataProdukAdminGudang')->with('alert','Produk Sedang Digunakan !');
        }        
        else if($byk2 > 0){
            return redirect('dataProdukAdminGudang')->with('alert','Produk Sedang Digunakan !');
        }        
        else if($byk3 > 0){
            return redirect('dataProdukAdminGudang')->with('alert','Produk Sedang Digunakan !');
        }        
        else if($byk4 > 0){
            return redirect('dataProdukAdminGudang')->with('alert','Produk Sedang Digunakan !');
        }
        else{
            DB::table('tb_produks')->where('kode_produk',$kode_produk)->delete();
            return redirect('dataProdukAdminGudang')->with('alert-success','Product Deleted !');   
        }
    }
}
