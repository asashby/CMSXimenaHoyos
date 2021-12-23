<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Plan;
use App\Company;
use Exception;
use Illuminate\Http\Request;
use Session;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
