<?php

namespace App\Http\Controllers\Api;

use App\FocusedExercise;
use App\Http\Controllers\Controller;
use App\Http\Resources\FocusedExerciseResource;
use App\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FocusedExerciseController extends Controller
{
    public function index()
    {
        return FocusedExerciseResource::collection(
            FocusedExercise::query()->withCount([
                'users',
            ])->get()
                ->append(['desktop_image_url', 'mobile_image_url', 'current_user_is_subcribed'])
        );
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
        $focusedExercise = FocusedExercise::query()
            ->with(['plans'])
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

    public function isCurrentUserSubscribed()
    {
        if (Auth::guard('web')->check()) {
            return [
                'data' => DB::table('focused_exercise_user')
                    ->where('user_id', Auth::guard('web')->id())
                    ->where('expiration_date', '>=', now()->format('Y-m-d H:i:s'))
                    ->exists(),
            ];
        }
        return [
            'data' => false,
        ];
    }
}
