<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('idPesanan');
            $table->unsignedBigInteger('idAyam');
            $table->unsignedBigInteger('id');
            $table->date('tglPesan')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->enum('status', ['Dikonfirmasi', 'Sedang Diproses', 'Dibatalkan'])->default('Sedang Diproses');
            $table->integer('jumlahBeli');
            $table->integer('total');
            $table->foreign('idAyam')->references('idAyam')->on('stok_ayams')->onDelete('cascade');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
};
