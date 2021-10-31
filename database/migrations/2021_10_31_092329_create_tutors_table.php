<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	if ( !Schema::hasTable('tutors') ) {
    		Schema::create('tutors', function (Blueprint $table) {
    			$table->bigIncrements('id');
    			$table->bigInteger('nip')->nullable();
    			$table->bigInteger('nik')->nullable();
    			$table->string('nama')->nullable();
    			$table->string('upbjj')->nullable();
    			$table->string('gender')->nullable();
    			$table->date('tanggal_lahir')->nullable();
    			$table->text('alamat')->nullable();
    			$table->string('telepon')->nullable();
    			$table->string('email')->nullable();
    			$table->string('status',1)->nullable();
    			$table->string('institusi')->nullable();
    			$table->string('jabatan_fungsional')->nullable();
    			$table->string('golongan')->nullable();
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
    	Schema::dropIfExists('tutors');
    }
}
