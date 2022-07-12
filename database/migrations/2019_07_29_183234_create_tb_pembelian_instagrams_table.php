<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPembelianInstagramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pembelian_instagrams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('harga_barang_instagram');
            $table->string('jumlah_barang_instagram');
            $table->string('diskon_instagram');
            $table->string('total_barang_instagram');            
            $table->integer('fk_kode_produk')->unsigned();
            $table->foreign('fk_kode_produk')
                   ->references('kode_produk')
                   ->on('tb_produks'); 
            $table->integer('fk_kode_penjualan')->unsigned();
            $table->foreign('fk_kode_penjualan')
                   ->references('kode_penjualan_instagram')
                   ->on('tb_penjualan_instagrams');           
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
        Schema::dropIfExists('tb_pembelian_instagrams');
    }
}
