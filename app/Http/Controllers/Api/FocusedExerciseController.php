<?php

namespace App\Http\Controllers\Api;

use App\Focused;
use App\Http\Controllers\Controller;
use App\Http\Resources\FocusedExerciseResource;

class FocusedExerciseController extends Controller
{
    public function index()
    {
        return FocusedExerciseResource::collection(Focused::query()->get());
    }

    public function show($focusedExerciseId)
    {
        return FocusedExerciseResource::make(Focused::query()->with(['focused_exercise_items'])
            ->findOrFail($focusedExerciseId));
    }
}
