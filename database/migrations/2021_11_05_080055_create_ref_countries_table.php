<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


    	if (!Schema::hasTable('ref_countries')) {

    		Schema::create('ref_countries', function (Blueprint $table) {
    			$table->increments('id');
    			$table->char('iso','2');
    			$table->string('name','80');
    			$table->string('nicename','80');
    			$table->char('iso3','3')->nullable();
    			$table->smallInteger('numcode')->nullable();
    			$table->integer('phonecode');
    			$table->timestamps();
    		});

    		$file = 'database/raw/01-ref_country.sql';
    		DB::unprepared(file_get_contents($file));
    	}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('ref_countries');
    }
}
