<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Area;
use App\Company;
use Session;

class AreasController extends Controller
{
    public function index(){
        Session::put('page', 'areas');
        $areas = Area::get();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.areas.areas')->with(compact('areas', 'companyData'));
    }

    public function addArea(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /* echo '<pre>'; print_r($data['sectionName']); die; */

            $section = new Area;

            $rulesData = [
                'areaName' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
            ];

            $customMessage = [
                'areaName.required' => 'El campo nombre es requerido',
                'areaName.regex' => 'El campo nombre no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);

            $section->name = $data['areaName'];
            $section->save();

            $message = 'El area se agrego correctamente';
            Session::flash('success_message', $message);
            return redirect('dashboard/areas');
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.areas.add_area', compact('companyData'));
    }

    public function editArea(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            /* echo '<pre>'; print_r($data['sectionName']); die; */

            $rulesData = [
                'areaName' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
            ];

            $customMessage = [
                'areaName.required' => 'El campo nombre es requerido',
                'areaName.regex' => 'El campo nombre no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);

            Area::where(['id'=>$id])->update(['name'=>$data['areaName']]);

            $message = 'El area se actualizo correctamente';
            Session::flash('success_message', $message);
            return redirect('dashboard/areas');
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        $areaDetail = Area::where(['id'=>$id])->first();
        return view('admin.areas.edit_area')->with(compact('areaDetail','companyData'));
    }

    public function deleteArea($id){
        Area::find($id)->delete();
        $message = 'El area se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect('dashboard/areas');
    }
}
