<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Plan;
use Exception;
use App\Course;
use App\Company;
use App\FocusedExercise;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;

class PlanController extends Controller
{
    public function index(Request $request)
    {
        Session::put('page', 'plans');
        $plans = Plan::query()->with(['courses', 'focused_exercises'])
            ->get();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.plans.plans', compact('plans', 'companyData'));
    }

    public function plansByCourse($slug)
    {
        try {
            $courseDetail = Course::query()->where('slug', $slug)->first();
            $plansByCourse = $courseDetail->plans;
            return response()->json([
                'plansByCourse' => $plansByCourse,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'ERROR' => $e->getMessage(),
            ]);
        }
    }

    public function plansByCourseSlug($slug)
    {
        try {
            $courseDetail = Course::query()->where('slug', $slug)->first();
            $plansByCourse = $courseDetail->plans;
            return response()->json([
                'plansByCourse' => $plansByCourse,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'ERROR' => $e->getMessage(),
            ], 400);
        }
    }

    public function addPlan(Request $request)
    {
        $courses = Course::orderBy('id', 'ASC')->pluck('title', 'id')->toArray();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        $plan = new Plan();
        $focusedExercises = FocusedExercise::getFocusedExercisesIdAndDisplayName($request);
        return view('admin.plans.add_plan')->with(compact('courses', 'companyData', 'plan', 'focusedExercises'));
    }

    public function storePlan(PlanRequest $request)
    {
        $plan = new Plan($request->validated());
        $plan->slug = Str::slug(strtolower($plan->title));
        $plan->course_id = $request->input('coursesIds', []);
        $plan->save();
        $plan->courses()->sync($plan->course_id);
        $plan->focused_exercises()->sync($request->input('focusedExercisesIds', []));
        return redirect()->route('plans.index')->with([
            'success_message' => 'EL plan se creo Correctamente',
        ]);
    }

    public function editPlan(Request $request, $id)
    {
        $plan = Plan::query()->with([
            'courses',
            'focused_exercises',
        ])->find($id);
        $courses = Course::orderBy('id', 'ASC')->pluck('title', 'id')->toArray();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        $focusedExercises = FocusedExercise::getFocusedExercisesIdAndDisplayName($request);
        return view('admin.plans.edit_plan')->with(compact('plan', 'courses', 'companyData', 'focusedExercises'));
    }

    public function updatePlan(PlanRequest $request, $id)
    {
        $plan = Plan::query()->find($id);
        $plan->fill($request->validated());
        $plan->slug = Str::slug(strtolower($plan->title));

        $finalArray = array_map(function ($item) {
            return (int) $item;
        }, $request->input('coursesIds', []));
        $plan->course_id = $finalArray;
        $plan->save();
        $plan->courses()->sync($plan->course_id);
        $plan->focused_exercises()->sync($request->input('focusedExercisesIds', []));
        return redirect()->route('plans.index')->with([
            'success_message' => 'El plan se Actualizo Correctamente',
        ]);
    }

    public function deletePlan($id)
    {
        Plan::query()->find($id)->delete();
        $message = 'El reto se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('plans.index');
    }
}
