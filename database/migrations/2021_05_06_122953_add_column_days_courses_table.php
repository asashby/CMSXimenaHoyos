<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDaysCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->integer('days')->after('slug');
            $table->string('level')->after('days');
            $table->string('frequency')->after('level');
            $table->string('duration')->after('frequency');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('days');
            $table->dropColumn('level');
            $table->dropColumn('frequency');
            $table->dropColumn('duration');
        });
    }
}
