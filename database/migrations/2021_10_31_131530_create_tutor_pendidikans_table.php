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
    		$table->bigInteger('tutor_id')->nullable();
    		$table->string('bidang_studi')->nullable();
    		$table->string('kode_pt')->nullable();
    		$table->string('nama_pt')->comment('perguruan tinggi')->nullable();
    		$table->string('akreditasi')->nullable();
    		$table->string('kode_pendidikan_akhir')->nullable();
    		$table->string('nama_pendidikan_akhir')->nullable();
    		$table->string('tahun_lulus')->nullable();
    		$table->string('gelar')->nullable();
    		$table->string('created_by')->nullable();
    		$table->string('updated_by')->nullable();
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
