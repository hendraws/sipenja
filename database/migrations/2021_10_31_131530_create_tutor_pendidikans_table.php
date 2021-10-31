<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorPendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_pendidikans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tutor_id');
            $table->string('bidang_studi');
            $table->string('kode_pt');
            $table->string('nama_pt')->comment('perguruan tinggi');
            $table->string('akreditasi');
            $table->string('kode_pendidikan_akhir');
            $table->string('nama_pendidikan_akhir');
            $table->string('tahun_lulus');
            $table->string('gelar');
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('tutor_pendidikans');
    }
}
