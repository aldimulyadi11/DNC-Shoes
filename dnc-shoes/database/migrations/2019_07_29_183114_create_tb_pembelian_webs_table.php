<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPembelianWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pembelian_webs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('harga_barang_web');
            $table->string('jumlah_barang_web');
            $table->string('diskon_web');
            $table->string('total_barang_web');            
            $table->integer('fk_kode_produk')->unsigned();
            $table->foreign('fk_kode_produk')
                   ->references('kode_produk')
                   ->on('tb_produks'); 
            $table->integer('fk_kode_penjualan')->unsigned();
            $table->foreign('fk_kode_penjualan')
                   ->references('kode_penjualan_web')
                   ->on('tb_penjualan_webs');           
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pembelian_webs');
    }
}
