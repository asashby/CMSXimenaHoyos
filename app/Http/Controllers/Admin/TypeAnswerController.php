<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use App\TypeAnswer;
use Illuminate\Support\Facades\Session;
use App\Company;

class TypeAnswerController extends Controllers\Controller
{

    public function index()
    {
        Session::put('page', 'type-answer');
        $type_answers = TypeAnswer::orderBy('created_at', 'desc')->get(['id', 'name', 'url_image', 'confirm_answer', 'series', 'reps']);
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.type-answers.index', compact('type_answers', 'companyData'));
    }

    public function create()
    {
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.type-answers.create', compact('companyData'));
    }


    public function store(Request $request)
    {
        $data = array_merge($request->all());
        $course = new TypeAnswer();
        $data['url_image'] = $this->loadFile($request, 'url_image', 'answers/images', 'type_answers_images');
        $course->fill($data);
        $course->save();
        return redirect()->route('type-answers.index')->with('status', '¡Registrado satisfactoriamente!');
    }


    public function edit($id)
    {
        $type_answer = TypeAnswer::findOrFail($id);
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.type-answers.edit', compact('type_answer', 'companyData'));
    }


    public function update(Request $request, $id)
    {

        $data = array_merge($request->all());
        $answer = TypeAnswer::findOrFail($id);
        if ($request->file('url_image')) {
            $data['url_image'] = $this->loadFile($request, 'url_image', 'answers/images', 'type_answers_images');
        }
        $answer->update($data);

        return redirect()->route('type-answers.index')->with('status', '¡Modificado satisfactoriamente!');
    }


    public function destroy($id)
    {
        TypeAnswer::findOrFail($id)->delete();
        return redirect()->route('type-answers.index')->with('status', '¡Eliminado satisfactoriamente!');
    }

    public function getSelect()
    {
        $type_answers = TypeAnswer::orderBy('name', 'ASC')->pluck(['name', 'id']);
        return view('admin.questions.select', compact('type_answers'))->render();
    }
}
