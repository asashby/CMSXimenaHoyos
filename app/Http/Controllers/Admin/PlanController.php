<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Plan;
use Exception;
use App\Course;
use App\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'plans');
        $plans = Plan::get();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.plans.plans', compact('plans', 'companyData'));
    }

    public function plansByCourse($id)
    {
        try {
            $plansByCourse = Plan::orderByDesc('created_at')->course($id)->get();
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
            $plansByCourse = Plan::orderByDesc('created_at')->slug($slug)->get();
            return response()->json([
                'plansByCourse' => $plansByCourse,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'ERROR' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addPlan(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $plan = new Plan;

            /* echo '<pre>';
            print_r($data);
            die; */

            $slug = Str::slug(strtolower($data['planTitle']));

            // echo '<pre>'; print_r($data['planTitle']); die;

            $plan->title = $data['planTitle'];
            $plan->slug = $slug;
            $plan->description = $data['planResume'];
            $plan->months = $data['planMonths'];
            $plan->price = (float) $data['planPrice'];
            $plan->course_id = $data['courses'] ?? '[]';
            $plan->save();
            if (isset($data['courses'])) {
                $plan->courses()->sync($data['courses']);
            }
            Session::flash('success_message', 'EL plan se creo Correctamente');
            return redirect('dashboard/plans');
        }
        $courses = Course::orderBy('id', 'ASC')->pluck('title', 'id')->toArray();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.plans.add_plan')->with(compact('courses', 'companyData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editPlan(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();

            $slug = Str::slug($data['planTitle']);

            $plan = Plan::find($id);
            $finalArray = array_map(function ($item) {
                return (int) $item;
            }, $data['courses'] ?? []);

            $plan->update([
                'title' => $data['planTitle'], 'slug' => $slug, 'description' => $data['planResume'], 'price' => (float) $data['planPrice'], 'months' => $data['planMonths'], 'course_id' => $finalArray ?? '[]'
            ]);
            if (isset($data['courses'])) {
                $plan->find($id)->courses()->sync($data['courses']);
            }
            Session::flash('success_message', 'El plan se Actualizo Correctamente');
            return redirect('dashboard/plans');
        }


        $planDetail = Plan::find($id);
        $courses = Course::orderBy('id', 'ASC')->pluck('title', 'id')->toArray();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.plans.edit_plan')->with(compact('planDetail', 'courses', 'companyData'));
    }

    public function deletePlan($id)
    {
        Plan::find($id)->delete();
        $message = 'El reto se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect('dashboard/plans');
    }
}
