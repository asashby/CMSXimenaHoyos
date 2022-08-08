<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Focused;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

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

    public function addFocused(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $focused = new Focused();

            $focused->slug = Str::slug($data['focusedTitle']);

            if (!File::exists('images/backend_images/focused')) {
                $path = 'images/admin_images/focused';
                File::makeDirectory($path, 0755, true, true);
            }

            if (empty($data['focusedUrlVideo'])) {
                $urlVideo = '';
            }

            $focused->title = $data['focusedTitle'];
            $focused->subtitle = $data['focusedSubTitle'];
            $focused->video_url = !empty($data['focusedUrlVideo']) ? $data['focusedUrlVideo'] : '';
            $focused->published_at = Carbon::now();
            $focused->description = htmlspecialchars_decode(e($data['focusedContent']));

            $focused->save();
            Session::flash('success_message', 'El ejercicio focalizado se creo Correctamente');
            return redirect('dashboard/focused');
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.focused.add_focused')->with(compact('companyData'));
    }

    public function editFocused(Request $request, $id)
    {
        if ($request->isMethod('post')) {

            $data = $request->all();

            $focused = Focused::find($id);

            $slug = Str::slug($data['focusedTitle']);

            $focused->update(['title' => $data['focusedTitle'], 'slug' => $slug,  'subtitle' => $data['focusedSubTitle'], 'video_url' => $data['focusedUrlVideo'] ?? '', 'published_at' => Carbon::now(), 'description' => htmlspecialchars_decode(e($data['focusedContent']))]);

            Session::flash('success_message', 'Los Datos se Actualizaron Correctamente');
            return redirect('dashboard/focused');
        }

        $focusedDetail = Focused::find($id);
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.focused.edit_focused')->with(compact('focusedDetail', 'companyData'));
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
        $focused = Focused::query()->with(['focused_exercise_items'])
            ->findOrFail($focusedId);
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.focused.show_focused', [
            'focused' => $focused,
            'companyData' => $companyData,
        ]);
    }
}
