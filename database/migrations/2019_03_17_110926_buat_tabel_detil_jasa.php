<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelDetilJasa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detil_jasa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_jasa');
            $table->unsignedBigInteger('id_transaksi');
            $table->integer('jumlah');
            $table->foreign('id_jasa')->references('id')->on('jasa')->onDelete('cascade');
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
        Schema::dropIfExists('detil_jasa');
    }
}
