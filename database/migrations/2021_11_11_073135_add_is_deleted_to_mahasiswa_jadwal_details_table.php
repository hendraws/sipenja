<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDeletedToMahasiswaJadwalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa_jadwal_details', function (Blueprint $table) {
            $table->string('is_deleted')->after('matakuliah_id')->default('N');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa_jadwal_details', function (Blueprint $table) {
            $table->drop('is_deleted');
        });
    }
}
