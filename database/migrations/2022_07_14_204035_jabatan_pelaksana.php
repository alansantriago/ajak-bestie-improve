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
        Schema::create('jabatan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_jabatan');
            $table->string('nama_unit');
            $table->text('ikhtisar');
            $table->string('pdd_formal');
            $table->text('pdd_jurusan');
            $table->string('pelatihan_struktural')->default("Tidak Dipersyaratkan");
            $table->string('pelatihan_fungsional')->default("Tidak Dipersyaratkan");
            $table->text('pelatihan_teknis')->default("Tidak Dipersyaratkan");
            $table->text('pengalaman_kerja')->default("Tidak Dipersyaratkan");
            $table->text('hasil_kerja_jabatan');
            $table->text('tanggung_jawab');
            $table->text('wewenang');
            $table->text('prestasi_harapan');
            $table->string('jenis_jabatan',50);
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
        Schema::dropIfExists('jabatan');
    }
};
