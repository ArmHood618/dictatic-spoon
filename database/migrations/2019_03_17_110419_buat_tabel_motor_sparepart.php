<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelMotorSparepart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motor_sparepart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_motor');
            $table->unsignedBigInteger('id_sparepart');
            $table->foreign('id_motor')->references('id')->on('motor')->onDelete('cascade');
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
        Schema::dropIfExists('motor_sparepart');
    }
}
