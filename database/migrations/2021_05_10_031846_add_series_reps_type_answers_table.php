<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeriesRepsTypeAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('type_answers', function (Blueprint $table) {
            $table->integer('series')->nullable()->after('url_image');
            $table->integer('reps')->nullable()->after('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('type_answers', function (Blueprint $table) {
            $table->dropColumn('series');
            $table->dropColumn('reps');
        });
    }
}
