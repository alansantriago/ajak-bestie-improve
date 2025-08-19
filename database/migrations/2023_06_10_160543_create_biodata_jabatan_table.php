<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jabatan', 50);
            $table->foreign('kode_jabatan')->references('kode_jabatan')->on('hubungan_jabatan')->onDelete('cascade')->cascadeOnUpdate();
            $table->string('nip');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('masa_kerja_jabatan_tahun');
            $table->string('masa_kerja_jabatan_bulan');
            $table->string('masa_kerja_keseluruhan_tahun');
            $table->string('masa_kerja_keseluruhan_bulan');
            $table->text('riwayat');
            $table->year('tahun_diangkat');
            $table->year('tahun_pensiun');
            $table->string('pangkat');
            $table->string('golongan');
            $table->string('jenjang_pendidikan');
            $table->string('jurusan');
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
        Schema::dropIfExists('biodata_jabatan');
    }
}
