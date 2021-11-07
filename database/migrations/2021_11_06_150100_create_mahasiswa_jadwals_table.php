<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_jadwals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_order')->nullable();
            $table->bigInteger('nim')->nullable();
            $table->integer('lokasi_id')->nullable();
            $table->string('status')->default('aktif')->nullable();
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
        Schema::dropIfExists('mahasiswa_jadwals');
    }
}
