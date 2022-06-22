<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Company;
use App\Focused;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FocusedController extends Controller
{
    public function index()
    {
        Session::put('page', 'focused');
        $exercises = Focused::get();
        $company = new Company();
        $companyData = $company->getCompanyInfo();
        return view('admin.focused.focused', compact('exercises', 'companyData'));
    }
}
