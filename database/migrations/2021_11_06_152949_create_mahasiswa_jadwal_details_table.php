<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaJadwalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_jadwal_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nim')->nullable();
            $table->bigInteger('mahasiswa_jadwal_id')->nullable();
            $table->bigInteger('jadwal_id')->nullable();
            $table->bigInteger('jadwal_tutorial_id')->nullable();
            $table->bigInteger('jadwal_tutorial_detail_id')->nullable();
            $table->integer('number')->nullable();
            $table->string('waktu')->nullable();
            $table->string('matakuliah_id')->nullable();
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
        Schema::dropIfExists('mahasiswa_jadwal_details');
    }
}
