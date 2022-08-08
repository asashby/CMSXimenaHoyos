<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Article;
use App\Company;
use Auth;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Session;
use File;
use Image;

class ArticleController extends Controller
{
    public function index()
    {
        Session::put('page', 'articles');
        $articles = Article::orderBy('published_at', 'desc')->get();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.articles.articles')->with(compact('articles', 'companyData'));
    }

    public function addArticle(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $article = new Article;

            $rulesData = [
                'sectionId' => 'required',
                'articleTitle' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleSubTitle' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleResume' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleTextLink' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
            ];

            $customMessage = [
                'sectionId.required' => 'Debe Seleccionar una seccion',
                'articleTitle.required' => 'El campo titulo es requerido',
                'articleTitle.regex' =>  'El campo titulo es invalido',
                'articleSubTitle.regex' => 'El campo subtitulo no es válido',
                'articleResume.regex' => 'El campo resumen no es válido',
                'articleTextLink.regex' => 'El campo texto Link no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);
            $slugClean = $article->cleanSlug(strtolower($data['articleTitle']));

            $slug = strtr(strtolower($slugClean), ' ', '-');
            //echo '<pre>'; print_r($slug); die;

            if (!File::exists('images/backend_images/articles')) {
                $path = 'images/admin_images/articles';
                File::makeDirectory($path, 0755, true, true);
            }

            // Upload Image
            if ($request->hasFile('articleImage')) {
                $image_tmp = $request->file('articleImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $article->page_image = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if ($request->hasFile('articleMobileImage')) {
                $image_tmp = $request->file('articleMobileImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $article->mobile_image = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if (empty($data['articleUrlVideo'])) {
                $urlVideo = '';
            }

            $article->title = $data['articleTitle'];
            $article->section_id = $data['sectionId'];
            $article->admin_id = Auth::guard('admin')->user()->id;
            $article->subtitle = $data['articleSubTitle'];
            $article->resume = $data['articleResume'];
            $article->banner = $data['articleBanner'];
            $article->text_link = $data['articleTextLink'];
            $article->url_video = !empty($data['articleUrlVideo']) ? $data['articleUrlVideo'] : '';
            $article->slug = $slug;
            $article->route = $slug;
            $article->published_at = new DateTime('now', new DateTimeZone('America/Lima'));
            $article->content = htmlspecialchars_decode(e($data['articleContent']));

            $article->save();
            Session::flash('success_message', 'El articulo se creo Correctamente');
            return redirect('dashboard/articles');
        }

        $sections = Section::get();

        $section_drop_down = "<option value='' selected disabled>Select</option>";
        foreach ($sections as $section) {
            $section_drop_down .= "<option value='" . $section->id . "'>" . $section->name . "</option>";
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.articles.add_article')->with(compact('section_drop_down', 'companyData'));
    }

    public function editArticle(Request $request, $slug)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();
            // echo '<pre>'; print_r($data); die;
            $rulesData = [
                'articleTitle' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleSubTitle' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleResume' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'articleTextLink' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
            ];


            $customMessage = [
                'articleTitle.required' => 'El campo titulo es requerido',
                'articleTitle.regex' => 'El campo titulo no es válido',
                'articleSubTitle.regex' => 'El campo subtitulo no es válido',
                'articleResume.regex' => 'El campo resumen no es válido',
                'articleTextLink.regex' => 'El campo texto Link no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);
            $article = new Article();
            $slugClean = $article->cleanSlug(strtolower($data['articleTitle']));

            $slug = strtr(strtolower($slugClean), ' ', '-');
            $route = strtr(strtolower($data['articleTitle']), ' ', '-');

            // echo '<pre>'; print_r($slug); die;

            // Upload Image
            if ($request->hasFile('articleImage')) {
                $image_tmp = $request->file('articleImage');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePath = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentArticleImage'])) {
                $completePath = $data['currentArticleImage'];
            } else {
                $completePath = '';
            }

            if ($request->hasFile('articleBanner')) {
                $image_tmp = $request->file('articleBanner');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathBanner = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentArticleBanner'])) {
                $completePathBanner = $data['currentArticleBanner'];
            } else {
                $completePathBanner = '';
            }

            if ($request->hasFile('articleBannerMobile')) {
                $image_tmp = $request->file('articleBannerMobile');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/articles/' . $fileName;
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

            Article::where(['slug' => $slug])->update(['title' => $data['articleTitle'], 'subtitle' => $data['articleSubTitle'], 'route' => $slug, 'slug' => $slug, 'section_id' => $data['sectionId'], 'page_image' => $completePath, 'banner' => $completePathBanner, 'addittional_info' => json_encode($socialMedia), 'description' => $data['articleResume'], 'url_video' => $data['articleUrlVideo'], 'mobile_image' => $completePathBannerMobile]);

            Session::flash('success_message', 'Los Datos se Actualizaron Correctamente');
            return redirect('dashboard/articles/edit/sobre-ximena');
        }

        $articleDetail = Article::where(['slug' => $slug])->first();
        $sections = Section::get();
        $section_drop_down = "<option value='' disabled>Select</option>";
        foreach ($sections as $section) {
            if ($section->id == $articleDetail->section_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $section_drop_down .= "<option value='" . $section->id . "' " . $selected . ">" . $section->name . "</option>";
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.articles.edit_article')->with(compact('articleDetail', 'section_drop_down', 'companyData'));
    }

    public function deleteArticle($id)
    {
        Article::find($id)->delete();
        $message = 'La Seccion se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect('dashboard/articles');
    }
}
