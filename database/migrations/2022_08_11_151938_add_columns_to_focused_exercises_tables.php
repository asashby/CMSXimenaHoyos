<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToFocusedExercisesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('focused_exercises', function (Blueprint $table) {
            $table->dropColumn('page_image');
            $table->string('desktop_image')->nullable()->after('subtitle');
            $table->string('mobile_image')->nullable()->after('desktop_image');
        });
        Schema::table('focused_exercise_items', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
            $table->text('series')->nullable()->after('description');
            $table->text('repetitions')->nullable()->after('series');
            $table->string('desktop_image')->nullable()->after('repetitions');
            $table->string('mobile_image')->nullable()->after('desktop_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('focused_exercises', function (Blueprint $table) {
            $table->string('page_image')->nullable();
            $table->dropColumn('desktop_image');
            $table->dropColumn('mobile_image');
        });
        Schema::table('focused_exercise_items', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('series');
            $table->dropColumn('repetitions');
            $table->dropColumn('desktop_image');
            $table->dropColumn('mobile_image');
        });
    }
}
