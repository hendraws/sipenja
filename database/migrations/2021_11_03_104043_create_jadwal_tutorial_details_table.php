<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTutorialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('jadwal_tutorial_details', function (Blueprint $table) {
    		$table->bigIncrements('id');
    		$table->bigInteger('jadwal_id')->nullable();
    		$table->bigInteger('jadwal_tutorial_id')->nullable();
    		$table->integer('number')->nullable();
    		$table->string('waktu')->nullable();
    		$table->integer('matakuliah_id')->nullable();
    		$table->string('jumlah_peserta')->nullable();
    		$table->bigInteger('tutor_id')->nullable();
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
    	Schema::dropIfExists('jadwal_tutorial_details');
    }
}
