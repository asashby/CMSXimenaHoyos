<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->integer('series')->nullable()->after('url_video');
            $table->integer('reps')->nullable()->after('series');
            $table->integer('time_rest')->nullable()->after('reps');
            $table->decimal('calories', 2)->nullable()->after('time_rest');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn('series');
            $table->dropColumn('reps');
            $table->dropColumn('time_rest');
            $table->dropColumn('calories');
        });
    }
}
