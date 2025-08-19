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
        Schema::create('lingkungan_kerja', function (Blueprint $table) {
            // $table->id();
            $table->unsignedInteger('jabatan_id')->primary();
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('cascade')->cascadeOnUpdate();
            $table->unsignedInteger('tempat_kerja');
            $table->string('suhu', 50);
            $table->string('udara', 50);
            $table->string('keadaan_ruangan', 50);
            $table->string('letak', 50);
            $table->string('penerangan', 50);
            $table->string('suara', 50);
            $table->string('keadaan_tempat_kerja', 50);
            $table->string('getaran', 50);
            $table->string('fisik', 100);
            $table->string('mental', 50);
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
        Schema::dropIfExists('lingkungan_kerja');
    }
};
