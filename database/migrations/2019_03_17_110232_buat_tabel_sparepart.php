<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelSparepart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sparepart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_letak');
            $table->unsignedBigInteger('id_ruang');
            $table->string('nama');
            $table->string('tipe');
            $table->integer('stok')->default(0);
            $table->integer('stok_min');
            $table->double('harga_beli');
            $table->double('harga_jual');
            $table->foreign('id_letak')->references('id')->on('letak')->onDelete('cascade');
            $table->foreign('id_ruang')->references('id')->on('ruang_penempatan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sparepart');
    }
}
