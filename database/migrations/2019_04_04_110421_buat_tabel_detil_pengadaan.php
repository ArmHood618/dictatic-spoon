<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelDetilPengadaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detil_pengadaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pengadaan');
            $table->unsignedBigInteger('id_sparepart');
            $table->integer('jumlah');
            $table->foreign('id_pengadaan')->references('id')->on('pengadaan')->onDelete('cascade');
            $table->foreign('id_sparepart')->references('id')->on('sparepart')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detil_pengadaan');
    }
}
