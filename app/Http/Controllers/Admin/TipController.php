<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Tip;
use App\Company;
use Auth;
use DateTime;
use DateTimeZone;
use Session;
use File;
use Image;

class TipController extends Controller
{
    public function index(Request $request){
        Session::put('page', 'tips');
        $search = $request->get('search');
        $tips = Tip::orderBy('published_at','desc')->title($search)->get();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.tips.tips')->with(compact('tips','companyData'));
    }

    public function addTip(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();

            $tip = new Tip;

            $rulesData = [
                'tipTitle' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'tipSubTitle' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'tipResume' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
            ];

            $customMessage = [
                'tipTitle.required' => 'El campo titulo es requerido',
                'tipTitle.regex' =>  'El campo titulo es invalido',
                'tipSubTitle.regex' => 'El campo subtitulo no es válido',
                'tipResume.regex' => 'El campo resumen no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);
            $slugClean = $tip->cleanSlug(strtolower($data['tipTitle']));

            $slug = strtr(strtolower($slugClean), ' ', '-');
            //echo '<pre>'; print_r($slug); die;

            if(!File::exists('images/backend_images/tips')) {
                $path = 'images/admin_images/tips';
                File::makeDirectory($path ,0755,true, true);
            }

           	// Upload Image
            if($request->hasFile('tipImage')){
                $image_tmp = $request->file('tipImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/admin_images/tips/'.$fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $tip->page_image = env('URL_DOMAIN').'/'.$large_image_path;

                }
            }

            if($request->hasFile('tipMobileImage')){
                $image_tmp = $request->file('tipMobileImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/admin_images/tips/'.$fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $tip->mobile_image = env('URL_DOMAIN').'/'.$large_image_path;

                }
            }

            $tip->title = $data['tipTitle'];
            $tip->admin_id = Auth::guard('admin')->user()->id;
            $tip->subtitle = $data['tipSubTitle'];
            $tip->resume = $data['tipResume'];
            $tip->slug = $slug;
            $tip->route = $slug;
            $tip->published_at = new DateTime('now', new DateTimeZone('America/Lima'));
            $tip->content = htmlspecialchars_decode(e($data['tipContent']));

			$tip->save();
            Session::flash('success_message', 'El tip se creo Correctamente');
            return redirect('dashboard/tips');
        }

        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.tips.add_tip')->with(compact('companyData'));
    }

    public function editTip(Request $request, $id = null){

        if($request->isMethod('post')){

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;
            $rulesData = [
                'tipTitle' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'tipSubTitle' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'tipResume' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
            ];

            $customMessage = [
                'tipTitle.required' => 'El campo titulo es requerido',
                'tipTitle.regex' =>  'El campo titulo es invalido',
                'tipSubTitle.regex' => 'El campo subtitulo no es válido',
                'tipResume.regex' => 'El campo resumen no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);
            $tip = new Tip();
            $slugClean = $tip->cleanSlug(strtolower($data['tipTitle']));

            $slug = strtr(strtolower($slugClean), ' ', '-');
            $route = strtr(strtolower($data['tipTitle']), ' ', '-');

            //echo '<pre>'; print_r($slug); die;

        	// Upload Image
            if($request->hasFile('tipImage')){
            	$image_tmp = $request->file('tipImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
	                $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/admin_images/tips/'.$fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePath = env('URL_DOMAIN').'/'.$large_image_path;

                }
            }else if(!empty($data['currentTipImage'])){
            	$completePath = $data['currentTipImage'];
            }else{
            	$completePath = '';
            }

            if($request->hasFile('tipMobileImage')){
                $image_tmp = $request->file('tipMobileImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/admin_images/tips/'.$fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completeMobileImage = env('URL_DOMAIN').'/'.$large_image_path;

                }
            }else if(!empty($data['currentTipMobileImage'])){
            	$completeMobileImage = $data['currentTipMobileImage'];
            }else{
            	$completeMobileImage = '';
            }



        Tip::where(['id'=>$id])->update(['title'=>$data['tipTitle'],'subtitle'=>$data['tipSubTitle'],'route'=>$slug,'slug'=>$slug, 'content'=>htmlspecialchars_decode(e($data['tipContent'])), 'page_image' => $completePath, 'mobile_image' => $completeMobileImage,'resume' => $data['tipResume']]);

        Session::flash('success_message', 'El tip se Actualizo Correctamente');
        return redirect('dashboard/tips');

        }

        $tipDetail = Tip::where(['id'=>$id])->first();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.tips.edit_tip')->with(compact('tipDetail', 'companyData'));

    }

    public function deleteTip($id){
        Tip::find($id)->delete();
        $message = 'EL tip se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect('dashboard/tips');
    }
}
