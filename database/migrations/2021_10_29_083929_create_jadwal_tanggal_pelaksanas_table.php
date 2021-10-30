<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTanggalPelaksanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	if ( !Schema::hasTable('jadwal_tanggal_pelaksanas') ) {
    		Schema::create('jadwal_tanggal_pelaksanas', function (Blueprint $table) {
    			$table->bigIncrements('id');
    			$table->bigInteger('jadwal_id');
    			$table->date('tanggal_mulai');
    			$table->date('tanggal_selesai');
    			$table->string('created_by')->nullable();
    			$table->string('updated_by')->nullable();
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
    	Schema::dropIfExists('jadwal_tanggal_pelaksanas');
    }
}
