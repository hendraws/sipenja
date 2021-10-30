<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefJurusansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	if ( !Schema::hasTable('ref_jurusans') ) {
    		Schema::create('ref_jurusans', function (Blueprint $table) {
    			$table->bigIncrements('id');
    			$table->bigInteger('fakultas_id');
    			$table->string('kode_jurusan');
    			$table->string('name');
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
    	Schema::dropIfExists('ref_jurusans');
    }
}
