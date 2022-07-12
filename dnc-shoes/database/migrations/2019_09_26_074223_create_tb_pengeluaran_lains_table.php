<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPengeluaranLainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pengeluaran_lains', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_pengeluaran_lain');
            $table->string('nama_pengeluaran');
            $table->integer('jml_pengeluaran_lain');
            $table->string('keterangan');
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
        Schema::dropIfExists('tb_pengeluaran_lains');
    }
}
