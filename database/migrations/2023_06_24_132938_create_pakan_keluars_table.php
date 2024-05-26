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
        Schema::create('pakan_keluars', function (Blueprint $table) {
            $table->id('idPakanKeluar');
            $table->unsignedBigInteger('idPakan');
            $table->date('tglKeluar')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->string('pemakai', 50);
            $table->integer('qtyKeluar');
            $table->foreign('idPakan')->references('idPakan')->on('stok_pakans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pakan_keluars');
    }
};
