<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	if ( !Schema::hasTable('jadwal_tutorials') ) {
    		Schema::create('jadwal_tutorials', function (Blueprint $table) {
    			$table->bigIncrements('id');
    			$table->bigInteger('jadwal_id');
    			$table->integer('jurusan_id');
    			$table->string('kode_mk');
    			$table->integer('kelompok_id');
            // $table->integer('kelompok_id');
    			$table->timestamps();
    		});
    	}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('jadwal_tutorials');
    }
}
