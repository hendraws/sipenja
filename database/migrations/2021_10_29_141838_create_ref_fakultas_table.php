<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefFakultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	if ( !Schema::hasTable('ref_fakultas') ) {
    		Schema::create('ref_fakultas', function (Blueprint $table) {
    			$table->bigIncrements('id');
    			$table->string('kode_fakultas')->nullable();
    			$table->string('name')->nullable();
    			$table->string('jenjang')->nullable();
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
    	Schema::dropIfExists('ref_fakultas');
    }
}
