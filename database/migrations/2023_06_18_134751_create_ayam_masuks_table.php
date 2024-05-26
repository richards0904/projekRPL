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
        Schema::create('ayam_masuks', function (Blueprint $table) {
            $table->id('idAyamMasuk');
            $table->unsignedBigInteger('idAyam');
            $table->date('tglMasuk')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->string('penerima', 50);
            $table->integer('qtyMasuk');
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
        Schema::dropIfExists('ayam_masuks', function (Blueprint $table) {
            $table->dropForeign('idAyam');
            $table->dropIndex('idAyam');
        });
    }
};
