<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypeSetsTableUserQuestionsAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_questions_answers', function (Blueprint $table) {
            $table->json('sets')->change();
            $table->string('date_answered')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_questions_answers', function (Blueprint $table) {
            $table->string('sets')->change();
            $table->string('date_answered')->change();
        });
    }
}
