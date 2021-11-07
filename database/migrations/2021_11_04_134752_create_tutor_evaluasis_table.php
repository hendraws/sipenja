<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorEvaluasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	if ( !Schema::hasTable('tutor_evaluasis') ) {    		
    		Schema::create('tutor_evaluasis', function (Blueprint $table) {
    			$table->bigIncrements('id');
    			$table->bigInteger('tutor_id')->nullable();
    			$table->bigInteger('nip')->nullable();
    			$table->integer('nilai')->nullable();
    			$table->string('file')->nullable();
    			$table->bigInteger('created_by')->nullable();
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
    	Schema::dropIfExists('tutor_evaluasis');
    }
}
