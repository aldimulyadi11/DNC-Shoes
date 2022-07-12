<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPembelianMarketplacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pembelian_marketplaces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('harga_barang_marketplace');
            $table->string('jumlah_barang_marketplace');
            $table->string('diskon_marketplace');
            $table->string('total_barang_marketplace');            
            $table->integer('fk_kode_produk')->unsigned();
            $table->foreign('fk_kode_produk')
                   ->references('kode_produk')
                   ->on('tb_produks'); 
            $table->integer('fk_kode_penjualan')->unsigned();
            $table->foreign('fk_kode_penjualan')
                   ->references('kode_penjualan_marketplace')
                   ->on('tb_penjualan_marketplaces');           
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
        Schema::dropIfExists('tb_pembelian_marketplaces');
    }
}
