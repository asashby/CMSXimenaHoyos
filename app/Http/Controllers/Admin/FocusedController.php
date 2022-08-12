<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Focused;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FocusedController extends Controller
{
    public function index()
    {
        Session::put('page', 'focused');
        $exercises = Focused::query()->latest()->get();
        $company = new Company();
        $companyData = $company->getCompanyInfo();
        return view('admin.focused.focused', compact('exercises', 'companyData'));
    }

    public function addFocused(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $focusedExercise = new Focused($request->all());
            $focusedExercise->slug = Str::slug($focusedExercise->title);
            $focusedExercise->description = htmlspecialchars_decode(e($data['description']));
            $focusedExercise->published_at = Carbon::now();
            if ($request->hasFile('desktop_image')) {
                $focusedExercise->desktop_image = $request->file('desktop_image')->storePublicly('focused_exercises', 'public');
            }
            if ($request->hasFile('mobile_image')) {
                $focusedExercise->mobile_image = $request->file('mobile_image')->storePublicly('mobile_image', 'public');
            }
            $focusedExercise->save();
            Session::flash('success_message', 'El ejercicio focalizado se creo Correctamente');
            return redirect('dashboard/focused');
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        $focusedExercise = new Focused();
        return view('admin.focused.add_focused')->with([
            'companyData' => $companyData,
            'focusedExercise' => $focusedExercise,
        ]);
    }

    public function editFocused(Request $request, int $id)
    {
        $focusedExercise = Focused::query()->findOrFail($id);
        if ($request->isMethod('post')) {
            $focusedExercise->fill($request->all());
            $focusedExercise->slug = Str::slug($focusedExercise->title);
            $focusedExercise->description = htmlspecialchars_decode(e($request->input('description')));
            $focusedExercise->published_at = Carbon::now();
            if ($request->hasFile('desktop_image')) {
                if ($focusedExercise->desktop_image) {
                    Storage::disk('public')->delete($focusedExercise->desktop_image);
                }
                $focusedExercise->desktop_image = $request->file('desktop_image')->storePublicly('focused_exercises', 'public');
            }
            if ($request->hasFile('mobile_image')) {
                if ($focusedExercise->mobile_image) {
                    Storage::disk('public')->delete($focusedExercise->mobile_image);
                }
                $focusedExercise->mobile_image = $request->file('mobile_image')->storePublicly('mobile_image', 'public');
            }
            $focusedExercise->save();
            Session::flash('success_message', 'Los Datos se Actualizaron Correctamente');
            return redirect('dashboard/focused');
        }

        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.focused.edit_focused')->with(compact('focusedExercise', 'companyData'));
    }

    public function deleteFocused($id)
    {
        Focused::find($id)->delete();
        $message = 'El Focalizado se Elimino correctamente';
        Session::flash('success_message', $message);
        return redirect('dashboard/focused');
    }

    public function showFocused(int $focusedId)
    {
        $focusedExercise = Focused::query()->with(['focused_exercise_items'])
            ->findOrFail($focusedId);
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.focused.show_focused', [
            'focused' => $focusedExercise,
            'companyData' => $companyData,
        ]);
    }
}
