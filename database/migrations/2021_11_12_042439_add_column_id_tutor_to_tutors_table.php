<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdTutorToTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('tutors')) {
            Schema::table('tutors', function (Blueprint $table) {
                $table->string('id_tutor')->nullable()->after('id');
            });
        }

        if (Schema::hasTable('jadwal_tutorials')) {
            Schema::table('jadwal_tutorials', function (Blueprint $table) {
                $table->string('id_tutorial')->nullable()->after('id');
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
        Schema::table('tutors', function (Blueprint $table) {

        });
    }
}
