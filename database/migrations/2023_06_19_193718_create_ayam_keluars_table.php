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
        Schema::create('ayam_keluars', function (Blueprint $table) {
            $table->id('idAyamKeluar');
            $table->unsignedBigInteger('idAyam');
            $table->date('tglKeluar')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->string('penjual', 50);
            $table->integer('qtyKeluar');
            $table->foreign('idAyam')->references('idAyam')->on('stok_ayams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ayam_keluars');
    }
};
