<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nim')->nullable();
            $table->bigInteger('nik')->nullable();
            $table->string('nama')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('agama')->nullable();
            $table->string('jurusan_id')->nullable();
            $table->string('fakultas_id')->nullable();
            $table->integer('semester')->nullable();
            $table->integer('kurikulum')->nullable();
            $table->integer('keterangan_layanan')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('mahasiswas');
    }
}
