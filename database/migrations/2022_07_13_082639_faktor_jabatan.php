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
        Schema::create('data_faktor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_faktor');
            $table->integer('nilai');
            $table->text('indikator');
            $table->string('tingkat', 50);
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
        Schema::dropIfExists('data_faktor');
    }
};
