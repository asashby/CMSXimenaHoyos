<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Unit;
use App\Course;
use App\Company;
use App\Question;
use App\TypeAnswer;
use Illuminate\Http\Request;
use App\Scopes\ActivatedScope;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequestPost;


class UnitController extends Controller
{

    public function index(Request $request)
    {
        Session::put('page', 'units');
        $units = Unit::withoutGlobalScope(ActivatedScope::class)->orderBy('created_at', 'desc')->get(['id', 'title', 'is_activated', 'content', 'course_id', 'order', 'url_image', 'url_video', 'day']);
        $type_answers = TypeAnswer::orderBy('name', 'ASC')->get(['id', 'series', 'reps']);
        $courses = Course::orderBy('title', 'ASC')->get(['title', 'id']);
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.units.index', compact('units', 'type_answers', 'courses', 'companyData'));
    }

    public function create()
    {
        $courses = Course::orderBy('title', 'ASC')->pluck('title', 'id');
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.units.create', compact('courses', 'companyData'));
    }

    public function store(UnitRequestPost $request)
    {
        $data = array_merge($request->all());
        /*  $data['series'] = intval($data['series']) ;
        $data['reps'] = intval($data['reps']); */
        /*  $data['calories'] = intval($data['calories']); */
        $unit = new Unit();
        $slugClean = $unit->cleanSlug(strtolower($data['title']));
        $slug = strtr(strtolower($slugClean), ' ', '-');
        $data['slug'] = $slug;
        $data['url_image'] = $this->loadFile($request, 'url_image', 'units/images', 'units_images');
        $data['mobile_image'] = $this->loadFile($request, 'mobile_image', 'units/images', 'units_images');
        $data['url_icon'] = $this->loadFile($request, 'url_icon', 'units/images', 'units_images');
        $last_id = DB::table('units')->latest('id')->first();
        $new_id = strval($last_id->id + 1);
        $data['code'] = $new_id . $data['day'] . $data['course_id'];
        $unit->fill($data);
        $unit->save();
        return redirect()->route('units.index')->with('status', '¡Registrado satisfactoriamente!');
    }

    public function unitsByChallenge($id)
    {
        $units = Unit::where('course_id', $id)->orderByRaw("CAST(day as UNSIGNED) ASC")->get(['id', 'day', 'title']);
        return $units;
    }

    public function unitsByChallenge2($id)
    {
        $units = Unit::where('course_id', $id)->orderByRaw("CAST(day as UNSIGNED) ASC")->get(['id', 'day', 'title']);
        return $units;
    }


    public function edit($id)
    {
        $unit = Unit::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        $unit->day = intval($unit->day);
        $courses = Course::orderBy('title', 'ASC')->pluck('title', 'id');
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.units.edit', compact('courses', 'unit', 'companyData'));
    }


    public function update(UnitRequestPost $request, $id)
    {
        $data = array_merge($request->all());
        $unit = Unit::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        $unitObj = new Unit;
        if ($request->file('url_image')) {
            $data['url_image'] = $this->loadFile($request, 'url_image', 'units/images', 'units_images');
        }
        if ($request->file('mobile_image')) {
            $data['mobile_image'] = $this->loadFile($request, 'mobile_image', 'units/images', 'units_images');
        }
        if ($request->file('url_icon')) {
            $data['url_icon'] = $this->loadFile($request, 'url_icon', 'units/images', 'units_images');
        }
        $slugClean = $unitObj->cleanSlug(strtolower($data['title']));
        $slug = strtr(strtolower($slugClean), ' ', '-');
        $data['code'] = $id . $data['day'] . $data['course_id'];
        $data['slug'] = $slug;
        $unit->update($data);
        return redirect()->route('units.index')->with('status', '¡Modificado satisfactoriamente!');
    }


    public function destroy($id)
    {
        Unit::withoutGlobalScope(ActivatedScope::class)->findOrFail($id)->delete();
        return redirect()->route('units.index')->with('status', '¡Eliminado satisfactoriamente!');
    }

    public function getList()
    {
        $units = Course::orderBy('title', 'ASC')->get(['id', 'title']);

        return $units;
    }

    public function changeStatus($id)
    {
        $unit = Unit::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        if ($unit->is_activated == 0) {
            $unit->is_activated = 1;
        } else {
            $unit->is_activated = 0;
        }
        $unit->save();
        return $unit;
    }

    public function deleteImageUnit($id)
    {
        $unit = Unit::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        $this->destroyFile($unit->url_image);
        $unit->url_image = null;
        $unit->save();

        return view('admin.units.image', compact('unit'))->render();
    }

    public function getTableQuestionsByUnit($id)
    {
        $type_answers = TypeAnswer::orderBy('name', 'ASC')->pluck('name', 'id');
        $questions = Question::withoutGlobalScope(ActivatedScope::class)->where('unit_id', $id)->orderBy('title', 'ASC')->get();
        return view('admin.units.table_questions_unit', compact('questions', 'type_answers'))->render();
    }

    public function getTableUnitsByCourse($id)
    {
        if ($id == 0) {
            $units = Unit::withoutGlobalScope(ActivatedScope::class)->orderByRaw("CAST(day as UNSIGNED) ASC")->get(['id', 'title', 'day', 'is_activated', 'content', 'course_id', 'order', 'url_image', 'url_video']);
        } else {
            $units = Unit::withoutGlobalScope(ActivatedScope::class)->where('course_id', $id)->orderByRaw("CAST(day as UNSIGNED) ASC")->get(['id', 'title', 'day', 'is_activated', 'content', 'course_id', 'order', 'url_image', 'url_video']);
        }
        return view('admin.units.table', compact('units'))->render();
    }


    public function unitOrderUpdate(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Unit::withoutGlobalScope(ActivatedScope::class)->where('id', $data['unit_id'])->update(['order' => $data['order']]);
            return response()->json(['status' => 'Ordenado Correctamente']);
        }
    }
}
