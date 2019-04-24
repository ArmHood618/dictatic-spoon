<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelSisaStok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sisa_stok', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_sparepart');
            $table->string('bulan');
            $table->string('tahun');
            $table->integer('sisa_stok');
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
        Schema::dropIfExists('sisa_stok');
    }
}
