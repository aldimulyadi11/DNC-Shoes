<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbDeliveryProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_delivery_produks', function (Blueprint $table) {
            $table->increments('kode_delivery');
            $table->date('tanggal_produksi_delivery');
            $table->string('jumlah_delivery');
            $table->string('keterangan_delivery');            
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
        Schema::dropIfExists('tb_delivery_produks');
    }
}
