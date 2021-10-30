<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use App\Mail\ActivationMail;
use App\User;
use App\Company;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;
use Illuminate\Support\Str;

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
        $courses = Course::orderBy('id', 'ASC')->pluck('title', 'id');
        $user['courses_free'] = $user->courses_free ?? [];
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.users.edit', compact('user', 'courses', 'companyData'));
    }

    public function show($id)
    {
    }

    public function update(UserPostRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->sur_name = $request->sur_name;
        $user->email = $request->email;
        $user->external_enterprise = $request->external_enterprise;
        $user->enterprise = $request->enterprise;
        $user->courses_free = $request->courses;
        $user->addittional_info = ['gender' => $request->gender, 'worker_type' => $request->worker_type, 'nameCity' => $request->name_city];
        $user->is_activated = $request->is_activated;
        $user->save();
        return redirect()->route('users.index')->with('status', '¡Registrado satisfactoriamente!');
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
