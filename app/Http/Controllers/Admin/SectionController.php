<?php

namespace App\Http\Controllers\Admin;

use Image;
use App\Company;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SectionController extends Controller
{
    public function index()
    {
        Session::put('page', 'sections');
        $sections =  Section::orderBy('order')->get();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.sections.sections')->with(compact('sections', 'companyData'));
    }

    public function updateSectionStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Activado') {
                $status = 0;
            } else {
                $status = 1;
            }
            Section::where('id', $data['section_id'])->update(['activated' => $status]);
            return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
        }
    }

    public function updateOrder(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            /* echo '<pre>'; print_r($data); die; */
            Section::where('id', $data['id_section'])->update(['order' => $data['order']]);
            return response()->json(['status' => 'Ordenado Correctamente']);
        }
    }

    public function addSection(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            /* echo '<pre>'; print_r($data['sectionName']); die; */

            $section = new Section;

            $rulesData = [
                'sectionName' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'sectionImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            $customMessage = [
                'sectionName.required' => 'El campo nombre es requerido',
                'sectionName.regex' => 'El campo nombre no es válido',
                'sectionImage.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',
                'sectionImage.max' => 'La imagen no debe pesar mas de 2MB',
            ];

            $this->validate($request, $rulesData, $customMessage);

            $slugClean = $section->cleanSlug(strtolower($data['sectionName']));
            $slug = strtr(strtolower($slugClean), ' ', '-');

            if ($request->hasFile('sectionImage')) {
                $image_tmp = $request->file('sectionImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $section->page_image = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            $section->name = $data['sectionName'];
            $section->description = htmlspecialchars_decode(e($data['sectionDescription']));
            $section->slug = $slug;
            $section->route = $slug;
            $section->order = Section::count() + 1;
            $section->save();

            $message = 'La Seccion se agrego correctamente';
            Session::flash('success_message', $message);
            return redirect('/dashboard/sections');
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.sections.add_section', compact('companyData'));
    }

    /* echo '<pre>'; print_r($data); die; */

    public function editSection(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            /* echo '<pre>'; print_r($data); die; */

            $rulesData = [
                'sectionName' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'sectionImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            $customMessage = [
                'sectionName.required' => 'El campo nombre es requerido',
                'sectionName.regex' => 'El campo nombre no es válido',
                'sectionImage.mimes' => 'Formato invalido, formatos soportados: jpeg, png, jpg, gif, svg',
                'sectionImage.max' => 'La imagen no debe pesar mas de 2MB',
            ];


            $this->validate($request, $rulesData, $customMessage);

            $section = new Section();
            $slugClean = $section->cleanSlug(strtolower($data['sectionName']));
            $slug = strtr(strtolower($slugClean), ' ', '-');

            if ($request->hasFile('sectionImage')) {
                $image_tmp = $request->file('sectionImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathSeo = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentSectionImage'])) {
                $completePathSeo = $data['currentSectionImage'];
            } else {
                $completePathSeo = '';
            }

            Section::where(['id' => $id])->update(['name' => $data['sectionName'], 'slug' => $slug, 'route' => $slug, 'description' => htmlspecialchars_decode(e($data['sectionDescription'])), 'page_image' => $completePathSeo]);

            $message = 'La Seccion se actualizo correctamente';
            Session::flash('success_message', $message);
            return redirect('/dashboard/sections');
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        $sectionDetail = Section::where(['id' => $id])->first();
        return view('admin.sections.edit_section')->with(compact('sectionDetail', 'companyData'));
    }




    public function deleteSection($id)
    {
        Section::find($id)->delete();
        $message = 'La Seccion se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect('dashboard/sections');
    }
}
