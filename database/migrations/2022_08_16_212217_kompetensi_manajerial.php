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
        Schema::create('data_kompetensi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_kompetensi', 50);
            $table->integer('level');
            $table->text('deskripsi');
            $table->text('indikator');
            $table->timestamps();
        });
        Schema::create('standar_kompetensis', function (Blueprint $table) {
            $table->unsignedInteger('jabatan_id')->primary();
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('cascade')->cascadeOnUpdate();
            $table->string('pangkat', 50);
            $table->string('kelompok_jabatan', 50);
            $table->string('urusan_pemerintahan', 100);
            $table->text('indikator_kinerja');
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
        Schema::dropIfExists('data_kompetensi');
        Schema::dropIfExists('standar_kompetensis');
    }
};
