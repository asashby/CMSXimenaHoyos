<?php

namespace App\Http\Controllers\Api;

use App\FocusedExercise;
use App\Http\Controllers\Controller;
use App\Http\Resources\FocusedExerciseResource;
use App\Plan;

class FocusedExerciseController extends Controller
{
    public function index()
    {
        return FocusedExerciseResource::collection(FocusedExercise::query()->get()
            ->append(['desktop_image_url', 'mobile_image_url', 'current_user_is_subcribed']));
    }

    public function show($focusedExerciseId)
    {
        return FocusedExerciseResource::make(FocusedExercise::query()
            ->with(['focused_exercise_items'])
            ->findOrFail($focusedExerciseId)
            ->append([
                'desktop_image_url',
                'mobile_image_url',
                'current_user_is_subcribed',
            ]));
    }

    public function getPlansByFocusedExerciseId($focusedExerciseId)
    {
        $focusedExercise = FocusedExercise::query()->with(['plans'])
            ->findOrFail($focusedExerciseId);
        return [
            'data' => $focusedExercise->plans
        ];
    }

    public function getFocusedExercisesPlans()
    {
        return [
            'data' => Plan::query()->whereHas('focused_exercises')->get(),
        ];
    }
}
