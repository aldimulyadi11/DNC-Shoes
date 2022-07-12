<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbReturnProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_return_produks', function (Blueprint $table) {
            $table->increments('kode_return');
            $table->date('tanggal_return');
            $table->integer('fk_kode_produk');
            $table->integer('jumlah_return');
            $table->string('keterangan_return');
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
        Schema::dropIfExists('tb_return_produks');
    }
}
