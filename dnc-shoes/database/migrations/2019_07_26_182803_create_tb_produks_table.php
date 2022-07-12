<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_produks', function (Blueprint $table) {
            $table->increments('kode_produk');            
            $table->string('nama_produk',100)->unique();
            $table->string('harga_jual');
            $table->string('stok_minimum');
            $table->string('ket');
            $table->integer('fk_kode_kat')->unsigned();
            $table->foreign('fk_kode_kat')
                   ->references('kode_kategori')
                   ->on('tb_kategoris');            
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
        Schema::dropIfExists('tb_produks');
    }
}
