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
        Schema::create('korelasi_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jabatan', 50);
            $table->foreign('kode_jabatan')->references('kode_jabatan')->on('hubungan_jabatan')->onDelete('cascade')->cascadeOnUpdate();
            $table->string('nama_jabatan');
            $table->string('unit_kerja');
            $table->string('deskripsi');
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
        Schema::dropIfExists('korelasi_jabatan');
    }
};
