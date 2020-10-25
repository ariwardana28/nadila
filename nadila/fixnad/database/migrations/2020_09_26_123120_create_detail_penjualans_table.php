<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_penjualan');
            $table->foreign('id_penjualan')->references('id')->on('penjualans');
            $table->unsignedBigInteger('id_menu');
            $table->foreign('id_menu')->references('id')->on('menus');
            $table->string('meja');
            $table->string('sub_total');
            $table->string('qty');
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
        Schema::dropIfExists('detail_penjualans');
    }
}
