<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbAkunPengeluaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_akun_pengeluarans', function (Blueprint $table) {
            $table->increments('kode_akun');
            $table->string('nama_akun_pengeluaran');
            $table->string('deskripsi_akun_pengeluaran');
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
        Schema::dropIfExists('tb_akun_pengeluarans');
    }
}
