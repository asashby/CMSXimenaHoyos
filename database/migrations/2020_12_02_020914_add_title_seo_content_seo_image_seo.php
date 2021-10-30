<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleSeoContentSeoImageSeo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('title_seo')->nullable()->after('page_image');
            $table->string('content_seo')->nullable()->after('title_seo');
            $table->string('image_seo')->nullable()->after('content_seo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('title_seo');
            $table->dropColumn('content_seo');
            $table->dropColumn('image_seo');
        });
    }
}
