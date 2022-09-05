<?php

namespace App\Http\Controllers\Admin;


use App\User;
use App\Unit;
use App\Course;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File as File;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        Session::put('page', 'courses');
        $courses = Course::withoutGlobalScope(ActivatedScope::class)->orderBy('created_at', 'desc')->get(['id', 'title', 'url_image', 'banner', 'file_url', 'is_activated', 'type', 'days']);
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.courses.courses', compact('courses', 'companyData'));
    }

    public function addCourse(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $course = new Course;

            $rulesData = [
                'courseTitle' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseSubTitle' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseType' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseDays' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseLevel' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseFrequence' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseDuration' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseUrlVideo' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',

            ];

            $customMessage = [
                'courseTitle.required' => 'El campo titulo es requerido',
                'courseSubTitle.regex' => 'El campo Subtitulo no es Valido',
                'courseType.regex' => 'El campo Tipo no es válido',
                'courseTitle.regex' =>  'El campo titulo es invalido',
                'courseDuration.regex' => 'El campo Duracionss no es válido',
                'courseFrequence.regex' => 'El campo resumen no es válido',
                'courseUrlVideo.regex' => 'El campo texto Video Reto no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);
            $slugClean = $course->cleanSlug(strtolower($data['courseTitle']));

            $slug = strtr(strtolower($slugClean), ' ', '-');


            if (!File::exists('images/admin_images/courses')) {
                $path = 'images/admin_images/courses';
                File::makeDirectory($path, 0755, true, true);
            }

            // Upload Image
            if ($request->hasFile('courseBanner')) {
                $image_tmp = $request->file('courseBanner');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/courses/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $course->banner = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if ($request->hasFile('courseBannerMobile')) {
                $image_tmp = $request->file('courseBannerMobile');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/courses/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $course->mobile_image = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if ($request->hasFile('courseContent')) {
                $image_tmp = $request->file('courseContent');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/courses/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $course->url_image = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if (empty($data['courseUrlVideo'])) {
                $urlVideo = '';
            }


            $course->title = $data['courseTitle'];
            $course->subtitle = $data['courseSubTitle'];
            $course->type = $data['courseType'];
            $course->days = $data['courseDays'];
            $course->frequency = $data['courseFrequence'];
            $course->description = $data['courseDescription'];
            $course->level = $data['courseLevel'];
            $course->prices = $data['coursePrice'] ?? 0.00;
            $course->duration = $data['courseDuration'];
            $course->url_video = $data['courseUrlVideo'];
            $course->slug = $slug;
            $course->save();
            Session::flash('success_message', 'El Reto se Registro Correctamente');

            return redirect('dashboard/courses');
        }

        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.courses.add_course')->with(compact('companyData'));
    }


    public function editCourse(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rulesData = [
                'courseTitle' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseSubTitle' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseType' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseDays' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseLevel' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseFrequence' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseDuration' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'courseUrlVideo' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',

            ];

            $customMessage = [
                'courseTitle.required' => 'El campo titulo es requerido',
                'courseSubTitle.regex' => 'El campo Subtitulo no es Valido',
                'courseType.regex' => 'El campo subtitulo no es válido',
                'courseTitle.regex' =>  'El campo titulo es invalido',
                'courseDuration.regex' => 'El campo subtitulo no es válido',
                'courseFrequence.regex' => 'El campo resumen no es válido',
                'courseUrlVideo.regex' => 'El campo texto Video Reto no es válido',
            ];

            $this->validate($request, $rulesData, $customMessage);
            $course = new Course();
            $slugClean = $course->cleanSlug(strtolower($data['courseTitle']));

            $slug = strtr(strtolower($slugClean), ' ', '-');
            $route = strtr(strtolower($data['courseTitle']), ' ', '-');

            // Upload Image
            if ($request->hasFile('courseBanner')) {
                $image_tmp = $request->file('courseBanner');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/courses/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathBanner = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentCourseBanner'])) {
                $completePathBanner = $data['currentCourseBanner'];
            } else {
                $completePathBanner = '';
            }

            if ($request->hasFile('courseBannerMobile')) {
                $image_tmp = $request->file('courseBannerMobile');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/courses/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathBannerMobile = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentCourseBannerMobile'])) {
                $completePathBannerMobile = $data['currentCourseBannerMobile'];
            } else {
                $completePathBannerMobile = '';
            }

            if ($request->hasFile('courseContent')) {
                $image_tmp = $request->file('courseContent');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/courses/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathContent = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentCourseContent'])) {
                $completePathContent = $data['currentCourseContent'];
            } else {
                $completePathContent = '';
            }

            if (empty($data['courseUrlVideo'])) {
                $urlVideo = '';
            } else {
                $urlVideo = $data['courseUrlVideo'];
            }

            Course::query()->where(['id' => $id])->update(['title' => $data['courseTitle'], 'subtitle' => $data['courseSubTitle'], 'type' => $data['courseType'], 'days' => $data['courseDays'], 'slug' => $slug, 'frequency' => $data['courseFrequence'], 'description' => $data['courseDescription'], 'banner' => $completePathBanner, 'url_image' => $completePathContent, 'mobile_image' => $completePathBannerMobile, 'level' => $data['courseLevel'], 'duration' => $data['courseDuration'], 'url_video' => $urlVideo, 'prices' => $data['coursePrice'] ?? 0.00]);

            Session::flash('success_message', 'El articulo se Actualizo Correctamente');
            return redirect('dashboard/courses');
        }

        $courseDetail = Course::query()->where(['id' => $id])->first();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.courses.edit_course')->with(compact('courseDetail', 'companyData'));
    }

    public function getUnitCourse($id)
    {
        $unitsByCourse = Unit::orderBy('day')->where('course_id', $id)->get();
        return $unitsByCourse;
    }

    public function getUnitsCourseByUser($course_id, $user_id)
    {
        $user = User::find($user_id);
        $course = Course::find($course_id);
        $units = $course->units;
        $title_course = $course->title;
        foreach ($units as $unit) {
            if (count($user->units) > 0) {
                foreach ($user->units as $unit_course) {
                    if ($unit->id == $unit_course->pivot->unit_id) {
                        $unit->questions = $unit_course->pivot->questions;
                        $unit->date_answered = $unit_course->pivot->date_answered;
                        $unit->is_completed = 1;
                        unset($user->units, $unit_course);
                        break;
                    } else {
                        $unit->questions = "";
                        $unit->is_completed = 0;
                        $unit->date_answered = "";
                    }
                }
            } else {
                $unit->questions = "";
                $unit->is_completed = 0;
                $unit->date_answered = "";
            }
        }
        return view('admin.progress.table_units', compact('units', 'title_course'))->render();
    }

    public function getTemplateDetailCourse($id)
    {
        $course = Course::find($id);

        $users = $course->users;
        $user_list = view('admin.progress.table', compact('course'))->render();
        $course_detail = view('admin.progress.detail', compact('course'))->render();

        return response([
            'detail' => $course_detail,
            'users' => $user_list
        ]);
    }

    public function CoursesByUser()
    {
        Session::put('page', 'courses-users');
        $courses = Course::orderBy('title', 'ASC')->get(['id', 'title']);
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.progress.index', compact('courses', 'companyData'));
    }

    public function changeStatus($id)
    {
        $course = Course::withoutGlobalScope(ActivatedScope::class)->findOrFail($id);
        if ($course->is_activated == 0) {
            $course->is_activated = 1;
        } else {
            $course->is_activated = 0;
        }
        $course->save();
        return $course;
    }

    public function deleteCourse($id)
    {
        Course::find($id)->delete();
        $message = 'El reto se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect('dashboard/courses');
    }
}
