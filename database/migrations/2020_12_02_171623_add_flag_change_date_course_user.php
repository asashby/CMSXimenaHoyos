<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlagChangeDateCourseUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_courses', function (Blueprint $table) {
            $table->datetime('insc_date')->nullable()->change();
            $table->datetime('init_date')->nullable()->change();
            $table->datetime('final_date')->nullable()->change();
            $table->tinyInteger('flag_registered')->default('0')->after('course_id');
            $table->tinyInteger('flag_completed')->default('0')->after('flag_registered');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_courses', function (Blueprint $table) {
            //
        });
    }
}
