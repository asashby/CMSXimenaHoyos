<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameUrlimageConfirmAnswerTypeAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('type_answers', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
            $table->string('url_image')->nullable()->after('name');
            $table->string('confirm_answer')->nullable()->after('url_image');
            $table->softDeletes()->after('updated_at');
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
            $table->dropColumn('name');
            $table->dropColumn('url_image');
            $table->dropColumn('confirm_answer');
        });
    }
}
