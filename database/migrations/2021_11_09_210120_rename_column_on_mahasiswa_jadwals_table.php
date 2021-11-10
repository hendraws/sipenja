<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnOnMahasiswaJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa_jadwals', function(Blueprint $table) {
            $table->renameColumn('lokasi_id', 'jadwal_tutorial_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa_jadwals', function(Blueprint $table) {
            $table->renameColumn( 'jadwal_tutorial_id','lokasi_id');
        });
    }
}
