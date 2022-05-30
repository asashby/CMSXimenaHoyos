<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Plan;
use App\User;
use App\Course;
use App\Company;
use Illuminate\Support\Str;
use App\Mail\ActivationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserPostRequest;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    public function index()
    {
        Session::put('page', 'users');
        $users = User::orderBy('name', 'ASC')->get();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.users.index', compact('users', 'companyData'));
    }

    public function create()
    {
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.users.create', compact('companyData'));
    }

    public function store(UserPostRequest $request)
    {
        $password = $this->getPassword($request->name, $request->sur_name);
        $timestamp = new \DateTime('now', new \DateTimeZone('America/Lima'));
        $userRecord = [
            [
                'name' => $request->name,
                'sur_name' => $request->sur_name,
                'email' => $request->email,
                'password' => bcrypt($password),
                'external_enterprise' => $request->external_enterprise,
                'enterprise' => $request->enterprise,
                'addittional_info' => ['gender' => $request->gender, 'worker_type' => $request->worker_type, 'nameCity' => $request->name_city],
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];
        $user = User::insert($userRecord);
        $data_send = [
            'email' => $request->email,
            'password' => $password,
        ];
        Mail::to($request->email)->send(new ActivationMail($data_send));
        if ($user == 1) {
            return redirect()->route('users.index')->with('status', '¡Registrado satisfactoriamente!, Revisa tu correo para activaer tu cuenta');
        }
        return redirect()->route('users.index')->with('status', 'error');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $plans = Plan::select('plans.id as planId', 'courses.id as courseId', 'plans.title as planName', 'courses.title as courseName', 'plans.months as numberMonths')->join('courses_plans', 'courses_plans.plan_id', '=', 'plans.id')->join('courses', 'courses_plans.course_id', '=', 'courses.id')->where('plans.is_activated', 1)->get();
        /* $user['courses'] = Plan::select('plans.id as planId', 'courses.id as courseId', 'plans.title as planName', 'courses.title as courseName', 'plans.months as numberMonths')->join('courses_plans', 'courses_plans.plan_id', '=', 'plans.id')->join('courses', 'courses_plans.course_id', '=', 'courses.id')->join('user_courses', 'user_courses.course_id', '=', 'courses.id')->where('user_courses.user_id', $id)->distinct()->get()->toArray(); */
        $userCourses = $user->courses()->pluck('plan_id');
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.users.edit', compact('user', 'plans', 'userCourses', 'companyData'));
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
        // $data = $request->all();
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->sur_name = $request->sur_name;
        $user->email = $request->email;
        $user->external_enterprise = $request->external_enterprise;
        $user->enterprise = $request->enterprise;
        $finalArray = array();
        $date_now = Carbon::now('America/Lima');
        if (isset($request->plans)) {
            foreach ($request->plans as $plan) {
                $detPlan = Plan::find($plan);
                foreach ($detPlan->course_id as $course) {
                    $finalArray[$course] = [
                        'insc_date' => $date_now,
                        'init_date' => $date_now,
                        'expiration_date' => $date_now->addMonths($detPlan->months),
                        'user_id' => $id,
                        'course_id' => $course,
                        'plan_id' => $plan,
                        'flag_registered' => 1,
                        'paid' => 1,
                    ];
                }
            }
        }
        $user->courses()->sync($finalArray);
        $user->courses_free = $request->courses;
        $user->addittional_info = ['gender' => $request->gender, 'worker_type' => $request->worker_type, 'nameCity' => $request->name_city];
        $user->is_activated = $request->is_activated;
        $user->save();
        return redirect()->route('users.index')->with('status', '¡Actualizado Correctamente!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('status', '¡Eliminado satisfactoriamente!');
    }

    public function getPassword($value1, $value2)
    {
        $string1 = Str::words($value1, 1, '');
        $string2 = Str::words($value2, 1, '');
        $string1 = Str::of($string1)->replace(' ', '');
        $string2 = Str::of($string2)->replace(' ', '');
        return Str::upper($string1 . '' . $string2);
    }

    public function changeStatus($id)
    {
        $user = User::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        if ($user->is_activated == 0) {
            $user->is_activated = 1;
        } else {
            $user->is_activated = 0;
        }
        $user->save();
        return $user;
    }
}
