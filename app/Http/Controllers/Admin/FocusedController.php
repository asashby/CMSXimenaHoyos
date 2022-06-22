<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Company;
use File;
use App\Focused;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    public function addFocused(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $focused = new Focused();

            $focused->slug = Str::slug($data['focusedTitle']);
            //echo '<pre>'; print_r($slug); die;

            if (!File::exists('images/backend_images/focused')) {
                $path = 'images/admin_images/focused';
                File::makeDirectory($path, 0755, true, true);
            }

            // Upload Image
            if ($request->hasFile('focusedImage')) {
                $image_tmp = $request->file('focusedImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/focused/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $focused->page_image = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if ($request->hasFile('focusedMobileImage')) {
                $image_tmp = $request->file('focusedMobileImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/focused/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $focused->mobile_image = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if (empty($data['focusedUrlVideo'])) {
                $urlVideo = '';
            }

            $focused->title = $data['focusedTitle'];
            $focused->subtitle = $data['focusedSubTitle'];
            $focused->video_url = !empty($data['focusedUrlVideo']) ? $data['focusedUrlVideo'] : '';
            $focused->published_at = Carbon::now('America/Lima');
            $focused->description = htmlspecialchars_decode(e($data['focusedContent']));

            $focused->save();
            Session::flash('success_message', 'El ejercicio focalizado se creo Correctamente');
            return redirect('dashboard/focused');
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.focused.add_focused')->with(compact('companyData'));
    }

    public function editArticle(Request $request, $slug)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();

            $focused = new Focused();

            $focused->slug = Str::slug($data['focusedTitle']);

            // echo '<pre>'; print_r($slug); die;

            // Upload Image
            if ($request->hasFile('focusedImage')) {
                $image_tmp = $request->file('focusedImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/focuseds/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePath = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentArticleImage'])) {
                $completePath = $data['currentArticleImage'];
            } else {
                $completePath = '';
            }

            if ($request->hasFile('focusedBanner')) {
                $image_tmp = $request->file('focusedBanner');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/focuseds/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathBanner = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentArticleBanner'])) {
                $completePathBanner = $data['currentArticleBanner'];
            } else {
                $completePathBanner = '';
            }

            if ($request->hasFile('focusedBannerMobile')) {
                $image_tmp = $request->file('focusedBannerMobile');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/focuseds/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathBannerMobile = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentArticleBannerMobile'])) {
                $completePathBannerMobile = $data['currentArticleBannerMobile'];
            } else {
                $completePathBannerMobile = '';
            }


            $socialMedia = [
                'facebook' => $data['linkFb'],
                'instagram' => $data['linkIns'],
                'tiktok' => $data['linkTk']
            ];

            Article::where(['slug' => $slug])->update(['title' => $data['focusedTitle'], 'subtitle' => $data['focusedSubTitle'], 'route' => $slug, 'slug' => $slug, 'section_id' => $data['sectionId'], 'page_image' => $completePath, 'banner' => $completePathBanner, 'addittional_info' => json_encode($socialMedia), 'description' => $data['focusedResume'], 'url_video' => $data['focusedUrlVideo'], 'mobile_image' => $completePathBannerMobile]);

            Session::flash('success_message', 'Los Datos se Actualizaron Correctamente');
            return redirect('dashboard/focuseds/edit/sobre-ximena');
        }

        $focusedDetail = Article::where(['slug' => $slug])->first();
        $focusedDetail->addittional_info = $focusedDetail->addittional_info;
        $sections = Section::get();
        $section_drop_down = "<option value='' disabled>Select</option>";
        foreach ($sections as $section) {
            if ($section->id == $focusedDetail->section_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $section_drop_down .= "<option value='" . $section->id . "' " . $selected . ">" . $section->name . "</option>";
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.focused.edit_focused')->with(compact('focusedDetail', 'section_drop_down', 'companyData'));
    }
}
