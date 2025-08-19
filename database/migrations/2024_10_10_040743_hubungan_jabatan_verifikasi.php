<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HubunganJabatanVerifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hubungan_jabatan_verifikasi', function (Blueprint $table) {
            $table->string('kode_jabatan',50)->nullable();
            $table->foreign('kode_jabatan')->references('kode_jabatan')->on('hubungan_jabatan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('status_beban_kerja',50)->nullable();
            $table->string('status_korelasi_jabatan',50)->nullable();
            $table->string('status_kompetensi_teknis',50)->nullable();
            $table->float('total_beban_kerja')->nullable();
            $table->string('file_beban_kerja',100)->nullable();
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
       Schema::dropIfExists('hubungan_jabatan_verifikasi');
    }
}
