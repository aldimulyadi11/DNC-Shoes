<?php
//use DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Input;

// Route::get('dashboard', function () {
//     return view('dashboard');
// });

// LOGIN CONTROLLER //

Route::get('/','loginController@login');
Route::post('loginPost','loginController@loginPost');
Route::post('registerPost','loginController@registerPost');
Route::get('register','loginController@register');
Route::get('logout','loginController@logout');

// MASTER CONTROLLER //

Route::get('dashboardOwner','masterController@dashboardOwner');
Route::get('dashboardAdminToko','masterController@dashboardAdminToko');
Route::get('dashboardAdminGudang','masterController@dashboardAdminGudang');
Route::get('dashboardAdminWeb','masterController@dashboardAdminWeb');
Route::get('dashboardAdminMarketplace','masterController@dashboardAdminMarketplace');
Route::get('dashboardAdminInstagram','masterController@dashboardAdminInstagram');
Route::get('dashboardAdminEvent','masterController@dashboardAdminEvent');
Route::get('dashboardAdminKeuangan','masterController@dashboardAdminKeuangan');

// OWNER CONTROLLER //

Route::get('dataAkun','ownerController@dataAkun');
Route::get('registerAkunBaru','ownerController@registerAkunBaru');
Route::get('editAkunBaru/{a}','ownerController@editAkunBaru');
Route::get('hapusAkunBaru/{c}','ownerController@hapusAkunBaru');
Route::get('dataKategori','ownerController@dataKategori');
Route::get('tambahKategori','ownerController@tambahKategori');
Route::get('editKategori/{d}','ownerController@editKategori');
Route::get('hapusKategori/{f}','ownerController@hapusKategori');
Route::get('dataProduk','ownerController@dataProduk');
Route::get('tambahProduk','ownerController@tambahProduk');
Route::get('editProduk/{g}','ownerController@editProduk');
Route::get('hapusProduk/{i}','ownerController@hapusProduk');
Route::get('cetakPenjualanToko','ownerController@cetakPenjualanToko');
Route::get('cetakPenjualanWeb','ownerController@cetakPenjualanWeb');
Route::get('cetakPenjualanMarket','ownerController@cetakPenjualanMarket');
Route::get('cetakPenjualanIg','ownerController@cetakPenjualanIg');
Route::get('cetakPenjualanEvent','ownerController@cetakPenjualanEvent');
Route::get('cetakStok','ownerController@cetakStok');
Route::get('cetakStok2','ownerController@cetakStok2');
Route::get('cetakStok3','ownerController@cetakStok3');
Route::get('cetakLaporanLaba','ownerController@cetakLaporanLaba');
Route::get('cetakLaporanPenjualan','ownerController@cetakLaporanPenjualan');
Route::get('cetakLaporanPengeluaran','ownerController@cetakLaporanPengeluaran');
Route::get('cetakLaporanPengeluaranLainnya','ownerController@cetakLaporanPengeluaranLainnya');
Route::get('cetakLaporanAsset','ownerController@cetakLaporanAsset');
Route::get('cetakLaporanAssetGudang','ownerController@cetakLaporanAssetGudang');
Route::get('cetakLaporanAssetToko','ownerController@cetakLaporanAssetToko');
Route::get('stokProduk','ownerController@stokProduk');
Route::get('stokProdukAlfabet','ownerController@stokProdukAlfabet');
Route::get('stokProdukTerbanyak','ownerController@stokProdukTerbanyak');
Route::get('editStok/{stok}','ownerController@editStok');
Route::post('updateStok/{stokk}','ownerController@updateStok');
Route::get('dataProduksi','ownerController@dataProduksi');
Route::get('tambahProduksi','ownerController@tambahProduksi');
Route::get('laporanPenjualan','ownerController@laporanPenjualan');
Route::get('laporanPengeluaran','ownerController@laporanPengeluaran');
Route::get('laporanPengeluaranLainnya','ownerController@laporanPengeluaranLainnya');
Route::get('laporanAsset','ownerController@laporanAsset');
Route::post('registerLaporanAsset','ownerController@registerLaporanAsset');

Route::get('laporanLaba','ownerController@laporanLaba');
Route::get('dataDelivery','ownerController@dataDelivery');
Route::get('tambahDelivery','ownerController@tambahDelivery');
Route::get('dataReturn','ownerController@dataReturn');
Route::get('tambahReturn','ownerController@tambahReturn');
Route::post('registerReturn','ownerController@registerReturn');
Route::get('cetakStruk/{ccx}','ownerController@cetakStruk');
Route::get('dataPenjualanTokoOwner','ownerController@dataPenjualanTokoOwner');
Route::get('dataPenjualanInstagramOwner','ownerController@dataPenjualanInstagram');
Route::get('dataPenjualanEventOwner','ownerController@dataPenjualanEvent');
Route::get('dataPenjualanMarketplaceOwner','ownerController@dataPenjualanMarketplace');
Route::get('dataPenjualanWebOwner','ownerController@dataPenjualanWeb');
Route::get('dataAkunPengeluaran','ownerController@dataAkunPengeluaran');
Route::get('tambahDataAkunPengeluaran','ownerController@tambahDataAkunPengeluaran');
Route::get('editAkunPengeluaran/{akun}','ownerController@editAkunPengeluaran');
Route::post('updateAkunPengeluaran/{akunu}','ownerController@updateAkunPengeluaran');
Route::get('hapusAkunPengeluaran/{akunp}','ownerController@hapusAkunPengeluaran');

Route::get('dataPengeluaran','ownerController@dataPengeluaran');
Route::get('tambahPengeluaran','ownerController@tambahPengeluaran');
Route::get('editPengeluaran/{aaa}','ownerController@editPengeluaran');
Route::get('hapusPengeluaran/{ccc}','ownerController@hapusPengeluaran');

Route::get('dataPengeluaranLain','ownerController@dataPengeluaranLain');
Route::get('tambahPengeluaranLain','ownerController@tambahPengeluaranLain');
Route::post('registerTambahPengeluaranLain','ownerController@registerTambahPengeluaranLain');
Route::get('editPengeluaranLain/{lain}','ownerController@editPengeluaranLain');
Route::post('updatePengeluaranLain/{lainu}','ownerController@updatePengeluaranLain');
Route::get('hapusPengeluaranLain/{lains}','ownerController@hapusPengeluaranLain');

Route::get('dataPengeluaranLainnya','ownerController@dataPengeluaranLainnya');
Route::get('tambahPengeluaranLainnya','ownerController@tambahPengeluaranLainnya');
Route::post('registerTambahPengeluaranLainnya','ownerController@registerTambahPengeluaranLainnya');
Route::get('editPengeluaranLainnya/{lainn}','ownerController@editPengeluaranLainnya');
Route::post('updatePengeluaranLainnya/{lainun}','ownerController@updatePengeluaranLainnya');
Route::get('hapusPengeluaranLainnya/{lainsn}','ownerController@hapusPengeluaranLainnya');

Route::get('akunToko','adminTokoController@akunToko');
Route::get('editAkunToko/{ggg}','ownerController@editAkunToko');
Route::get('changePassOwner/{mn}','ownerController@ubahPassOwner');
Route::post('updatePassOwner/{gh}','ownerController@updatePassOwner');
Route::get('changePassToko/{ll}','ownerController@ubahPassToko');
Route::post('updatePassToko/{gg}','ownerController@updatePassToko');
Route::get('changePassWeb/{lll}','ownerController@ubahPassWeb');
Route::post('updatePassWeb/{ggg}','ownerController@updatePassWeb');
Route::post('updatePassGudang/{kl}','ownerController@updatePassGudang');
Route::get('changePassGudang/{jj}','ownerController@ubahPassGudang');
Route::get('changePassMarketplace/{io}','ownerController@ubahPassMarketplace');
Route::get('changePassIg/{ju}','ownerController@ubahPassIg');
Route::get('changePassEvent/{lk}','ownerController@ubahPassEvent');
Route::get('dataLaba','ownerController@dataLaba');
Route::post('registerPostBaru','ownerController@registerPostBaru');
Route::post('updateAkunBaru/{b}','ownerController@updateAkunBaru');
Route::post('registerKategori','ownerController@registerKategori');
Route::post('updateKategori/{e}','ownerController@updateKategori');
Route::post('/registerProduk','ownerController@registerProduk');
Route::post('updateProduk/{h}','ownerController@updateProduk');
Route::post('registerProduksi','ownerController@registerProduksi');
Route::post('registerDelivery','ownerController@registerDelivery');
Route::post('registerTambahAkunPengeluaran','ownerController@registerTambahAkunPengeluaran');
Route::post('registerTambahPengeluaran','ownerController@registerTambahPengeluaran');
Route::post('updatePengeluaran/{bbb}','ownerController@updatePengeluaran');
Route::post('updatePassEvent/{jk}','ownerController@updatePassEvent');
Route::post('updatePassIg/{yu}','ownerController@updatePassIg');
Route::post('updatePassMarketplace/{oi}','ownerController@updatePassMarketplace');
Route::post('registerLaba','ownerController@registerLaba');
Route::post('registerLaporanPenjualan','ownerController@registerLaporanPenjualan');
Route::post('registerLaporanPengeluaran','ownerController@registerLaporanPengeluaran');
Route::post('registerLaporanPengeluaranLainnya','ownerController@registerLaporanPengeluaranLainnya');
Route::post('registerLaporanLaba','ownerController@registerLaporanLaba');




// ADMIN GUDANG CONTROLLER //

Route::get('dataProdukAdminGudang','adminGudangController@dataProdukAdminGudang');
Route::get('tambahProdukAdminGudang','adminGudangController@tambahProdukAdminGudang');
Route::get('editProdukAdminGudang/{j}','adminGudangController@editProdukAdminGudang');
Route::get('hapusProdukAdminGudang/{l}','adminGudangController@hapusProdukAdminGudang');
Route::get('dataKategoriAdminGudang','adminGudangController@dataKategoriAdminGudang');
Route::get('tambahKategoriAdminGudang','adminGudangController@tambahKategoriAdminGudang');
Route::get('editKategoriAdminGudang/{m}','adminGudangController@editKategoriAdminGudang');
Route::get('hapusKategoriAdminGudang/{o}','adminGudangController@hapusKategoriAdminGudang');
Route::get('dataStokAdminGudang','adminGudangController@dataStokAdminGudang');
Route::get('dataProduksiAdminGudang','adminGudangController@dataProduksiAdminGudang');
Route::get('dataDeliveryAdminGudang','adminGudangController@dataDeliveryAdminGudang');
Route::get('dataReturnAdminGudang','adminGudangController@dataReturnAdminGudang');
Route::get('tambahProduksiAdminGudang','adminGudangController@tambahProduksiAdminGudang');
Route::get('tambahDeliveryAdminGudang','adminGudangController@tambahDeliveryAdminGudang');
Route::get('tambahReturnAdminGudang','adminGudangController@tambahReturnAdminGudang');
Route::post('registerDeliveryAdminGudang','adminGudangController@registerDeliveryAdminGudang');
Route::post('registerReturnAdminGudang','adminGudangController@registerReturnAdminGudang');
Route::post('registerKategoriAdminGudang','adminGudangController@registerKategoriAdminGudang');
Route::post('registerProduksiAdminGudang','adminGudangController@registerProduksiAdminGudang');
Route::post('/registerProdukAdminGudang','adminGudangController@registerProdukAdminGudang');
Route::post('updateProdukAdminGudang/{k}','adminGudangController@updateProdukAdminGudang');
Route::post('updateKategoriAdminGudang/{n}','adminGudangController@updateKategoriAdminGudang');

Route::get('dataPengeluaranLainAdminGudang','adminGudangController@dataPengeluaranLain');
Route::get('tambahPengeluaranLainAdminGudang','adminGudangController@tambahPengeluaranLain');
Route::post('registerTambahPengeluaranLainAdminGudang','adminGudangController@registerTambahPengeluaranLain');
Route::get('editPengeluaranLainAdminGudang/{lain}','adminGudangController@editPengeluaranLain');
Route::post('updatePengeluaranLainAdminGudang/{lainu}','adminGudangController@updatePengeluaranLain');
Route::get('hapusPengeluaranLainAdminGudang/{lains}','adminGudangController@hapusPengeluaranLain');

Route::get('dataPengeluaranLainnyaAdminGudang','adminGudangController@dataPengeluaranLainnya');
Route::get('tambahPengeluaranLainnyaAdminGudang','adminGudangController@tambahPengeluaranLainnya');
Route::post('registerTambahPengeluaranLainnyaAdminGudang','adminGudangController@registerTambahPengeluaranLainnya');
Route::get('editPengeluaranLainnyaAdminGudang/{lainng}','adminGudangController@editPengeluaranLainnya');
Route::post('updatePengeluaranLainnyaAdminGudang/{lainung}','adminGudangController@updatePengeluaranLainnya');
Route::get('hapusPengeluaranLainnyaAdminGudang/{lainsng}','adminGudangController@hapusPengeluaranLainnya');
// ADMIN TOKO CONTROLLER //


Route::get('dataProdukAdminToko','adminTokoController@dataProdukAdminToko');
Route::get('dataStokToko','adminTokoController@dataStokToko');
Route::get('dataDeliveryAdminToko','adminTokoController@dataDeliveryAdminToko');
Route::get('tambahDeliveryAdminToko','adminTokoController@tambahDeliveryAdminToko');
Route::get('dataPenjualanToko','adminTokoController@dataPenjualanToko');
Route::get('detailPembelianToko/{cc}','adminTokoController@detailPembelianToko');
Route::get('tambahPenjualanToko','adminTokoController@tambahPenjualanToko');
Route::get('tambahPembelianToko/{aa}','adminTokoController@tambahPembelianToko');
Route::post('registerDeliveryAdminToko','adminTokoController@registerDeliveryAdminToko');
Route::post('registerPenjualanToko','adminTokoController@registerPenjualanToko');
Route::post('registerPembelianToko/{bb}','adminTokoController@registerPembelianToko');

// ADMIN WEB CONTROLLER //


Route::get('dataPenjualanWeb','adminWebController@dataPenjualanWeb');
Route::get('detailPembelianWeb/{ff}','adminWebController@detailPembelianWeb');
Route::get('tambahPenjualanWeb','adminWebController@tambahPenjualanWeb');
Route::get('dataProdukAdminWeb','adminWebController@dataProdukAdminWeb');
Route::get('dataStokAdminWeb','adminWebController@dataStokAdminWeb');
Route::get('dataProduksiAdminWeb','adminWebController@dataProduksiAdminWeb');
Route::get('tambahProduksiAdminWeb','adminWebController@tambahProduksiAdminWeb');
Route::get('tambahPembelianWeb/{dd}','adminWebController@tambahPembelianWeb');
Route::post('registerPembelianWeb/{ee}','adminWebController@registerPembelianWeb');
Route::post('registerPenjualanWeb','adminWebController@registerPenjualanWeb');
Route::post('registerProduksiAdminWeb','adminWebController@registerProduksiAdminWeb');

// ADMIN MARKETPLACE CONTROLLER //

Route::get('dataPenjualanMarketplace','adminMarketplaceController@dataPenjualanMarketplace');
Route::get('detailPembelianMarketplace/{gg}','adminMarketplaceController@detailPembelianMarketplace');
Route::get('tambahPenjualanMarketplace','adminMarketplaceController@tambahPenjualanMarketplace');
Route::get('tambahPembelianMarketplace/{hh}','adminMarketplaceController@tambahPembelianMarketplace');
Route::get('dataProdukAdminMarketplace','adminMarketplaceController@dataProdukAdminMarketplace');
Route::get('dataStokAdminMarketplace','adminMarketplaceController@dataStokAdminMarketplace');
Route::get('dataProduksiAdminMarketplace','adminMarketplaceController@dataProduksiAdminMarketplace');
Route::get('tambahProduksiAdminMarketplace','adminMarketplaceController@tambahProduksiAdminMarketplace');
Route::post('registerProduksiAdminMarketplace','adminMarketplaceController@registerProduksiAdminMarketplace');
Route::post('registerPenjualanMarketplace','adminMarketplaceController@registerPenjualanMarketplace');
Route::post('registerPembelianMarketplace/{ii}','adminMarketplaceController@registerPembelianMarketplace');
// ADMIN INSTAGRAM CONTROLLER //

Route::get('dataPenjualanInstagram','adminInstagramController@dataPenjualanInstagram');
Route::get('detailPembelianInstagram/{jj}','adminInstagramController@detailPembelianInstagram');
Route::get('tambahPenjualanInstagram','adminInstagramController@tambahPenjualanInstagram');
Route::get('tambahPembelianInstagram/{kk}','adminInstagramController@tambahPembelianInstagram');
Route::get('dataProdukAdminInstagram','adminInstagramController@dataProdukAdminInstagram');
Route::get('dataStokAdminInstagram','adminInstagramController@dataStokAdminInstagram');
Route::get('dataProduksiAdminInstagram','adminInstagramController@dataProduksiAdminInstagram');
Route::get('tambahProduksiAdminInstagram','adminInstagramController@tambahProduksiAdminInstagram');
Route::post('registerProduksiAdminInstagram','adminInstagramController@registerProduksiAdminInstagram');
Route::post('registerPenjualanInstagram','adminInstagramController@registerPenjualanInstagram');
Route::post('registerPembelianInstagram/{ll}','adminInstagramController@registerPembelianInstagram');
// ADMIN EVENT CONTROLLER //

Route::get('dataProdukAdminEvent','adminEventController@dataProdukAdminEvent');
Route::get('dataStokAdminEvent','adminEventController@dataStokAdminEvent');
Route::get('dataProduksiAdminEvent','adminEventController@dataProduksiAdminEvent');
Route::get('tambahProduksiAdminEvent','adminEventController@tambahProduksiAdminEvent');
Route::get('dataPenjualanEvent','adminEventController@dataPenjualanEvent');
Route::get('detailPembelianEvent/{sdf}','adminEventController@detailPembelianEvent');
Route::get('tambahPenjualanEvent','adminEventController@tambahPenjualanEvent');
Route::get('tambahPembelianEvent/{fds}','adminEventController@tambahPembelianEvent');
Route::post('registerPenjualanEvent','adminEventController@registerPenjualanEvent');
Route::post('registerProduksiAdminEvent','adminEventController@registerProduksiAdminEvent');
Route::post('registerPembelianEvent/{asa}','adminEventController@registerPembelianEvent');

// ADMIN KEUANGAN CONTROLLER //
Route::get('changePassKeuangan/{ck}','adminKeuanganController@ubahPassKeuangan');
Route::post('updatePassKeuangan/{uk}','adminKeuanganController@updatePassKeuangan');

Route::get('dataAkunPengeluaranKeuangan','adminKeuanganController@dataAkunPengeluaran');
Route::get('tambahDataAkunPengeluaranKeuangan','adminKeuanganController@tambahDataAkunPengeluaran');
Route::post('registerTambahAkunPengeluaranKeuangan','adminKeuanganController@registerTambahAkunPengeluaran');
Route::get('editAkunPengeluaranKeuangan/{akun}','adminKeuanganController@editAkunPengeluaran');
Route::post('updateAkunPengeluaranKeuangan/{akunk}','adminKeuanganController@updateAkunPengeluaran');
Route::get('hapusAkunPengeluaranKeuangan/{akunk}','adminKeuanganController@hapusAkunPengeluaran');

Route::get('dataPengeluaranKeuangan','adminKeuanganController@dataPengeluaran');
Route::get('tambahPengeluaranKeuangan','adminKeuanganController@tambahPengeluaran');
Route::post('registerTambahPengeluaranKeuangan','adminKeuanganController@registerTambahPengeluaran');
Route::get('editPengeluaranKeuangan/{keua}','adminKeuanganController@editPengeluaran');
Route::get('hapusPengeluaranKeuangan/{keuang}','adminKeuanganController@hapusPengeluaran');

// ROUTING SELECT2 //

Route::get('tambahPembelianToko/add/ajax-state',function(){
	$barang = Input::get('nama_produk');
	$data = DB::table('tb_produks')->select('harga_jual')->where('kode_produk',$barang)->get();
	return $data;
	}
);

Route::get('tambahPembelianWeb/add/ajax-state',function(){
	$barang = Input::get('nama_produk');
	$data = DB::table('tb_produks')->select('harga_jual')->where('kode_produk',$barang)->get();
	return $data;
	}
);

Route::get('tambahPembelianInstagram/add/ajax-state',function(){
	$barang = Input::get('nama_produk');
	$data = DB::table('tb_produks')->select('harga_jual')->where('kode_produk',$barang)->get();
	return $data;
	}
);
Route::get('tambahPembelianMarketplace/add/ajax-state',function(){
	$barang = Input::get('nama_produk');
	$data = DB::table('tb_produks')->select('harga_jual')->where('kode_produk',$barang)->get();
	return $data;
	}
);
Route::get('tambahPembelianEvent/add/ajax-state',function(){
	$barang = Input::get('nama_produk');
	$data = DB::table('tb_produks')->select('harga_jual')->where('kode_produk',$barang)->get();
	return $data;
	}
);