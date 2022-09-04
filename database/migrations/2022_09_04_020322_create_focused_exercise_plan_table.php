<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFocusedExercisePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('focused_exercise_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('focused_exercise_id')->constrained();
            $table->foreignId('plan_id')->constrained();
            $table->unique(['focused_exercise_id', 'plan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('focused_exercise_plan');
    }
}
