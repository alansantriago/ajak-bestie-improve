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
        Schema::create('syarat_kerja', function (Blueprint $table) {
            // $table->id();
            $table->unsignedInteger('jabatan_id')->primary();
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('cascade')->cascadeOnUpdate();
            $table->text('keterampilan');
            $table->string('bakat', 100);
            $table->string('temperamen', 100);
            $table->string('minat', 100);
            $table->text('upaya_fisik');
            $table->string('jenis_kelamin', 20);
            $table->string('umur', 20);
            $table->string('tinggi', 20);
            $table->string('berat', 20);
            $table->string('postur', 50);
            $table->string('penampilan', 50);
            $table->string('hubungan_data', 100);
            $table->string('hubungan_orang', 100);
            $table->string('hubungan_benda', 100);
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
        Schema::dropIfExists('syarat_kerja');
    }
};
