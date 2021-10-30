<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	if ( !Schema::hasTable('jadwals') ) {
    		Schema::create('jadwals', function (Blueprint $table) {
    			$table->bigIncrements('id');
    			$table->string('nomor')->nullable();
    			$table->string('tahun_ajaran')->nullable();
    			$table->date('tanggal_mulai');
    			$table->date('tanggal_selesai');
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
    	Schema::dropIfExists('jadwals');
    }
}
