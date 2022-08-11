<?php

namespace App\Http\Controllers\Api;

use App\Focused;
use App\Http\Controllers\Controller;
use App\Http\Resources\FocusedExerciseResource;

class FocusedExerciseController extends Controller
{
    public function index()
    {
        return FocusedExerciseResource::collection(Focused::query()->get()
            ->append(['desktop_image_url', 'mobile_image_url']));
    }

    public function show($focusedExerciseId)
    {
        return FocusedExerciseResource::make(Focused::query()
            ->with(['focused_exercise_items'])
            ->findOrFail($focusedExerciseId)
            ->append([
                'desktop_image_url',
                'mobile_image_url',
            ]));
    }
}
