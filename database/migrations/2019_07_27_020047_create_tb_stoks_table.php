<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_stoks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stok_gudang');
            $table->string('stok_toko');
            $table->string('tot_stok');
            $table->integer('fk_kode_pro')->unsigned();
            $table->foreign('fk_kode_pro')
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
        Schema::dropIfExists('tb_stoks');
    }
}
