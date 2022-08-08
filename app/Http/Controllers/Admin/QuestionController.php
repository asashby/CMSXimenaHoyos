<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Unit;
use App\Course;
use App\Company;
use App\Question;
use App\TypeAnswer;
use Carbon\Traits\Units;
use Illuminate\Http\Request;
use App\Scopes\ActivatedScope;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\QuestionRequestPost;

class QuestionController extends Controller
{

    public function index()
    {
        Session::put('page', 'questions-list');
        $type_answers = TypeAnswer::orderBy('name', 'ASC')->get(['id', 'series', 'reps']);
        $questions = Question::withoutGlobalScope(ActivatedScope::class)->orderBy('order', 'desc')->get(['id', 'title', 'is_activated', 'content', 'unit_id']);
        $courses = Course::orderBy('title', 'ASC')->get(['title', 'id']);
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.questions.index', compact('questions', 'type_answers', 'courses', 'companyData'));
    }


    public function create()
    {
        $courses = Course::orderBy('title', 'ASC')->get(['id', 'title']);
        $company = new Company;
        $section_drop_down = "<option value='' selected disabled>Seleccione Reto</option>";
        foreach ($courses as $course) {
            $section_drop_down .= "<option value='" . $course->id . "'>" . $course->title . "</option>";
        }
        $companyData = $company->getCompanyInfo();
        return view('admin.questions.createForm', compact('section_drop_down', 'courses', 'companyData'));
    }


    public function store(QuestionRequestPost $request)
    {
        $data = array_merge($request->all());
        $question = new Question();
        $slugClean = $question->cleanSlug(strtolower($data['title']));
        $data['url_image'] = $this->loadFile($request, 'url_image', 'questions/images', 'units_images');
        $data['mobile_image'] = $this->loadFile($request, 'mobile_image', 'questions/images', 'units_images');
        $slug = strtr(strtolower($slugClean), ' ', '-');
        $data['slug'] = $slug;
        $last_id = DB::table('questions')->latest('id')->first();
        $new_id = strval($last_id->id + 1);
        $data['code'] = $new_id . $data['unit_id'] . $data['course_id'];
        $question->fill($data);
        $question->save();

        return redirect()->route('questions.index')->with('status', '¡Registrado satisfactoriamente!');
    }

    public function getTableQuestionByUnit($id)
    {
        if ($id == 0) {
            $questions = Question::withoutGlobalScope(ActivatedScope::class)->orderBy('order', 'ASC')->get(['id', 'title', 'is_activated', 'order']);
        } else {
            $questions = Question::withoutGlobalScope(ActivatedScope::class)->where('unit_id', $id)->orderBy('order', 'ASC')->get(['id', 'title', 'is_activated', 'order']);
        }
        return view('admin.questions.table', compact('questions'))->render();
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $question = Question::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        $unit = Unit::find($question->unit_id);
        $question->course_id = $unit->course_id;
        $courses = Course::orderBy('title', 'ASC')->get(['id', 'title']);
        $units = Unit::orderBy('title', 'ASC')->get(['id', 'title', 'day']);
        $courses_drop_down = "<option value='' disabled>Seleccione Reto</option>";
        foreach ($courses as $course) {
            if ($course->id == $question->course_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $courses_drop_down .= "<option value='" . $course->id . "' " . $selected . ">" . $course->title . "</option>";
        }
        $unit_drop_down = "<option value='' disabled>Seleccione Dia</option>";
        foreach ($units as $unit) {
            if ($unit->id == $question->unit_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $unit_drop_down .= "<option value='" . $unit->id . "' " . $selected . "> Día " . $unit->day . " - " . $unit->title . "</option>";
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.questions.editForm', compact('unit_drop_down', 'courses_drop_down', 'courses', 'units', 'question', 'companyData'));
    }


    public function update(QuestionRequestPost $request, $id)
    {
        $data = array_merge($request->all());
        $question = Question::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        if ($request->file('url_image')) {
            $data['url_image'] = $this->loadFile($request, 'url_image', 'units/images', 'units_images');
        }
        if ($request->file('mobile_image')) {
            $data['mobile_image'] = $this->loadFile($request, 'mobile_image', 'units/images', 'units_images');
        }
        $companyObj = new Question;
        $slugClean = $companyObj->cleanSlug(strtolower($data['title']));
        $slug = strtr(strtolower($slugClean), ' ', '-');
        $data['slug'] = $slug;
        $question->update($data);
        return redirect()->route('questions.index')->with('status', '¡Modificado satisfactoriamente!');
    }


    public function destroy($id)
    {
        Question::withoutGlobalScope(ActivatedScope::class)->findOrFail($id)->delete();
        return redirect()->route('questions.index')->with('status', '¡Eliminado satisfactoriamente!');
    }

    public function changeStatus($id)
    {
        $question = Question::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        if ($question->is_activated == 0) {
            $question->is_activated = 1;
        } else {
            $question->is_activated = 0;
        }
        $question->save();
        return $question;
    }
}
