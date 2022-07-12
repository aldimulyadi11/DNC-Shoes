<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_logins', function (Blueprint $table) {
            $table->increments('kode_pegawai');
            $table->string('nama');
            $table->string('alamat');
            $table->string('telp');
            $table->string('bagian');
            $table->string('username',100)->unique();
            $table->string('password');            
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
        Schema::dropIfExists('tb_logins');
    }
}
