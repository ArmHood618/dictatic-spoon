<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelTransaksiPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pegawai');
            $table->unsignedBigInteger('id_transaksi');
            $table->foreign('id_pegawai')->references('id')->on('pegawai')->onDelete('cascade');
            $table->foreign('id_transaksi')->references('id')->on('transaksi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_pegawai');
    }
}
