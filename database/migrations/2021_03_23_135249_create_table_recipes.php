<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->nullable();
                $table->string('route')->nullable();
                $table->string('title')->nullable();
                $table->longText('description')->nullable();
                $table->string('page_image')->nullable();
                $table->json('attributes')->nullable();
                $table->string('image_content')->nullable();
                $table->json('ingredients')->nullable();
                $table->string('url_video')->nullable();
                $table->json('steps')->nullable();
                $table->timestamp('published_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
