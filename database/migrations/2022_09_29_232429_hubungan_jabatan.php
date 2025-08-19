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
        Schema::create('hubungan_jabatan', function (Blueprint $table) {
            $table->string('kode_jabatan', 50)->primary();
            $table->unsignedInteger('jabatan_id');
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('no action')->cascadeOnUpdate();
            $table->unsignedInteger('dinas_id');
            $table->foreign('dinas_id')->references('id')->on('dinas')->onDelete('no action')->cascadeOnUpdate();
            $table->string('jpt_utama')->nullable();
            $table->string('jpt_madya')->nullable();
            $table->string('jpt_pratama')->nullable();
            $table->string('administrator')->nullable();
            $table->string('pengawas')->nullable();
            $table->unsignedInteger('tingkat');
            $table->unsignedInteger('pegawai')->nullable()->default(0);
            $table->timestamps();
        });
        Schema::create('hubungan_jabatan_parent', function (Blueprint $table) {
            $table->id();
            $table->string('parent_jabatan')->nullable();
            $table->foreign('parent_jabatan')->references('kode_jabatan')->on('hubungan_jabatan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('child_jabatan')->nullable();
            $table->foreign('child_jabatan')->references('kode_jabatan')->on('hubungan_jabatan')->cascadeOnDelete()->cascadeOnUpdate();
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

        Schema::dropIfExists('hubungan_jabatan_parent');
        Schema::dropIfExists('hubungan_jabatan');
    }
};
