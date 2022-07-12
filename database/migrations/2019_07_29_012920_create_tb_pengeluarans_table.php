<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPengeluaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pengeluarans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tgl_pengeluaran');
            $table->string('jumlah_pengeluaran');
            $table->string('keterangan_pengeluaran');
            $table->string('deskripsi_pengeluaran');

            $table->integer('fk_kode_akun')->unsigned();
            $table->foreign('fk_kode_akun')
                   ->references('kode_akun')
                   ->on('tb_akun_pengeluarans');
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
        Schema::dropIfExists('tb_pengeluarans');
    }
}
