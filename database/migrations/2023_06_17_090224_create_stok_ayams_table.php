<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('stok_ayams', function (Blueprint $table) {
            $table->id('idAyam');
            $table->string('jenisAyam', 25);
            $table->string('deskripsi', 100);
            $table->integer('stok');
            $table->integer('hargajual');
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stok_ayams');
    }
};
