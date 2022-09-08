<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFocusedExerciseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('focused_exercise_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('focused_exercise_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->dateTime('expiration_date');
            $table->timestamps();
            $table->unique(['focused_exercise_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('focused_exercise_user');
    }
}
