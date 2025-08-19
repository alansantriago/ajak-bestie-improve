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
        Schema::create('beban_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jabatan', 50);
            $table->foreign('kode_jabatan')->references('kode_jabatan')->on('hubungan_jabatan')->onDelete('cascade')->cascadeOnUpdate();
            $table->unsignedInteger('jumlah_hasil');
            $table->unsignedDouble('penyelesaian');
            $table->integer('tingkat');
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
        Schema::dropIfExists('beban_kerja');
    }
};
