<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use App\Company;
use App\Product;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        Session::put('page', 'slider');
        $sliders = Slider::query()->orderBy('order')->get();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.slider.slider')->with(compact('sliders', 'companyData'));
    }

    public function updateSliderOrder(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Slider::query()->where('id', $data['id_slide'])
                ->update(['order' => $data['order']]);
            return response()->json(['status' => 'Ordenado Correctamente']);
        }
    }

    public function addSlider(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $slider = new Slider;
            $title = 'Slider ' . strval(Slider::count() + 1);
            $slug = strtr(strtolower($title), ' ', '-');
            $route = strtr(strtolower($title), ' ', '-');

            if (!File::exists('images/admin_images/slider')) {
                $path = 'images/admin_images/slider';
                File::makeDirectory($path, 0777, true, true);
            };

            // Upload Image
            if ($request->hasFile('sliderImage')) {
                $image_tmp = $request->file('sliderImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $banner_path = 'images/admin_images/slider/' . $fileName;
                    Image::make($image_tmp)->save($banner_path);
                    $slider->url_image = env('URL_BASE') . '/' . $banner_path;
                }
            }

            $slider->title = $title;
            $slider->slug = $slug;
            $slider->route = $route;
            $slider->order = Slider::count() + 1;
            $slider->product_id = $request->input('product_id');
            $slider->created_at = new DateTime('now', new DateTimeZone('America/Lima'));
            $slider->updated_at = new DateTime('now', new DateTimeZone('America/Lima'));

            $slider->save();
            Session::flash('success_message', 'El slider se creo Correctamente');
            return redirect('dashboard/slider');
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        $slider = new Slider();
        $products = Product::getProductsIdAndDisplayName($request);
        return view('admin.slider.add_slider', compact('companyData', 'slider', 'products'));
    }

    public function editSlider(Request $request, $id = null)
    {
        $slider = Slider::query()->findOrFail($id);
        if ($request->isMethod('post')) {
            $data = $request->all();
            // Upload image
            if ($request->hasFile('sliderImage')) {
                $image_tmp = $request->file('sliderImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $banner_path = 'images/admin_images/slider/' . $fileName;
                    Image::make($image_tmp)->save($banner_path);
                    $completePath = env('URL_DOMAIN') . '/' . $banner_path;
                    $slider->url_image = $completePath;
                }
            } else if (!empty($data['current_image'])) {
                $fileName = $data['current_image'];
            } else {
                $fileName = '';
            }
            $slider->product_id = $request->input('product_id');
            $slider->save();
            Session::flash('success_message', 'El slider se actualizo Correctamente');
            return redirect('dashboard/slider');
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        $products = Product::getProductsIdAndDisplayName($request);
        return view('admin.slider.edit_slider')->with(compact('slider', 'companyData', 'products'));
    }

    public function deleteSlider($id)
    {
        Slider::find($id)->delete();
        Session::flash('success_message', 'El slider se elimino correctamente');
        return redirect()->back();
    }
}
