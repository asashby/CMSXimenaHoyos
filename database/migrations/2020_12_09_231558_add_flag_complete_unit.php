<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlagCompleteUnit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unit_users_course', function (Blueprint $table) {
            $table->boolean('flag_complete_unit')->nullable()->after('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unit_users_course', function (Blueprint $table) {
            $table->dropColumn('flag_complete_unit');
            
        });
    }
}
