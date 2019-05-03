<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_motor');
            $table->unsignedBigInteger('id_cabang');
            $table->string('jenis_transaksi');
            $table->date('tanggal');
            $table->string('nama');
            $table->string('no_telp');
            $table->string('no_plat');
            $table->date('tanggal_keluar')->nullable();
            $table->boolean('isLunas')->default(0);
            $table->boolean('isSelesai')->default(0);
            $table->foreign('id_motor')->references('id')->on('motor')->onDelete('cascade');
            $table->foreign('id_cabang')->references('id')->on('cabang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
