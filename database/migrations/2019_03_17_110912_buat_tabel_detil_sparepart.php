<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelDetilSparepart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detil_sparepart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_sparepart');
            $table->unsignedBigInteger('id_transaksi');
            $table->integer('jumlah');
            $table->foreign('id_sparepart')->references('id')->on('sparepart')->onDelete('cascade');
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
        Schema::dropIfExists('detil_sparepart');
    }
}
