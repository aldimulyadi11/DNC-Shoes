<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penjualans', function (Blueprint $table) {
            $table->increments('kode_penjualan');
            $table->date('tanggal_penjualan');
            $table->string('nama_pembeli');
            $table->string('jenis_penjualan');
            $table->integer('fk_kode_pegawai')->unsigned();
            $table->foreign('fk_kode_pegawai')
                   ->references('kode_pegawai')
                   ->on('tb_logins');
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
        Schema::dropIfExists('tb_penjualans');
    }
}
