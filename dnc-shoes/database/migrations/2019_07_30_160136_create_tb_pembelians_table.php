<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pembelians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('harga_barang');
            $table->string('jumlah_barang');
            $table->string('diskon');
            $table->string('diskon_rp');
            $table->string('total_barang');            
            $table->integer('fk_kode_produk')->unsigned();
            $table->foreign('fk_kode_produk')
                   ->references('kode_produk')
                   ->on('tb_produks');            
            $table->integer('fk_kode_penjualan')->unsigned();
            $table->foreign('fk_kode_penjualan')
                   ->references('kode_penjualan')
                   ->on('tb_penjualans'); 
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
        Schema::dropIfExists('tb_pembelians');
    }
}
