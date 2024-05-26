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
        Schema::create('pakan_masuks', function (Blueprint $table) {
            $table->id('idPakanMasuk');
            $table->unsignedBigInteger('idPakan');
            $table->date('tglMasuk')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->string('penerima', 50);
            $table->integer('qtyMasuk');
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
        Schema::dropIfExists('pakan_masuks');
    }
};
