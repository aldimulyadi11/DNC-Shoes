<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_produksis', function (Blueprint $table) {
            $table->increments('kode_produksi');
            $table->date('tanggal_produksi');
            $table->string('jumlah');
            $table->string('keterangan_produksi');            
            $table->integer('fk_kode_produk')->unsigned();
            $table->foreign('fk_kode_produk')
                   ->references('kode_produk')
                   ->on('tb_produks'); 
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
        Schema::dropIfExists('tb_produksis');
    }
}
