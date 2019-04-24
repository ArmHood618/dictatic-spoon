<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_cabang');
            $table->string('id_role');
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_telp');
            $table->double('gaji');
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->foreign('id_cabang')->references('id')->on('cabang')->onDelete('cascade');
            $table->foreign('id_role')->references('id')->on('role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
