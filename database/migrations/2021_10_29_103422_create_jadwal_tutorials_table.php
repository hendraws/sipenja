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
    			$table->integer('jurusan_id')->nullable();
    			$table->integer('kelas_id')->nullable();
    			$table->integer('kelompok_id')->nullable();
    			$table->string('link')->nullable();
    			$table->string('keterangan')->nullable();
    			$table->bigInteger('created_by')->nullable();
    			$table->bigInteger('updated_by')->nullable();
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
