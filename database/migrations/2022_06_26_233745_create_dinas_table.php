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
        Schema::create('dinas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_dinas');
            $table->timestamps();
        });
        Schema::create('hak_akses_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->primary();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->cascadeOnUpdate();
            $table->unsignedInteger('dinas_id');
            $table->foreign('dinas_id')->references('id')->on('dinas')->onDelete('no action')->cascadeOnUpdate();
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
        Schema::dropIfExists('hak_akses_user');
        Schema::dropIfExists('dinas');
    }
};
