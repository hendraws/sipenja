<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	if ( !Schema::hasTable('mata_kuliahs') ) {
    		Schema::create('mata_kuliahs', function (Blueprint $table) {
    			$table->bigIncrements('id');
    			$table->string('kode_mk')->nullable();
    			$table->string('nama_mk')->nullable()->comment('mk : matakuliah');
    			$table->string('kode_ba')->nullable()->comment('ba : bahan ajar');
    			$table->string('nama_ba')->nullable();
    			$table->string('sks')->nullable();
    			$table->string('semester')->nullable();
    			$table->integer('kurikulum_id')->nullable();
    			$table->integer('jurusan_id')->nullable();
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
    	Schema::dropIfExists('mata_kuliahs');
    }
}
