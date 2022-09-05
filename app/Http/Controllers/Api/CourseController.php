<?php

namespace App\Http\Controllers\Api;

use App\Plan;
use App\Unit;
use App\User;
use App\Course;
use App\Comments;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmPurchaseMail;
use App\UserCourse;

class CourseController extends Controller
{
    public function coursesByUser(Request $request)
    {
        $limit = !empty($request->get('limit')) && is_numeric($request->get('limit')) ? $request->get('limit') : 10;
        $userFind =  User::find(Auth::user()->id);
        $courses_by_user = $userFind->courses()->where('paid', 1)->paginate($limit);
        foreach ($courses_by_user as $course_by_user) {
            $course_by_user['flag_completed'] = $course_by_user->pivot->flag_completed;
            unset($course_by_user->pivot);
        }
        return $courses_by_user;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $limit = !empty($request->get('limit')) && is_numeric($request->get('limit')) ? $request->get('limit') : 10;
        $courses = Course::select('id', 'title', 'prices', 'url_image', 'days', 'level', 'slug', 'frequency')->title($search)->paginate($limit);
        return $courses;
    }

    public function detailCourse($slug, Request $request)
    {
        $courseData = Course::query()->where('slug', $slug)->first();
        $courseUsers = $courseData->users;
        if (isset($data)) {
            $user = User::find(Auth::user()->id);
            $finalCourseData = $courseUsers->firstWhere('id', $user->id);
            if (!isset($finalCourseData)) {
                $courseData['course_paid'] = 0;
            } else {
                $courseData['course_paid'] = $finalCourseData->pivot->paid ?? 0;
            }
        }
        $courseData['usersCount'] = $courseUsers->count();
        $courseData['attributes'] = json_decode($courseData['attributes']);
        unset($courseData['users']);
        return response()->json($courseData, 200);
    }

    public function unitsByCourse($slug)
    {
        $courseData = Course::query()->where('slug', $slug)->first();
        $units = Unit::select('id', 'title', 'day', 'slug', 'url_icon')
            ->where('course_id', $courseData->id)->orderBy('day', 'ASC')->get();
        if (isset($user)) {
            $units_by_user = $user->units->where('course_id', $courseData->id);
            foreach ($units as $unit) {
                if (count($units_by_user) > 0) {
                    foreach ($units_by_user as $unit_user) {
                        if ($unit->id === $unit_user->pivot->unit_id) {
                            $unit->flag_complete_unit = $unit_user->pivot->flag_complete_unit;
                            unset($unit_user);
                            break;
                        } else {
                            $unit->flag_complete_unit = 0;
                            unset($unit_user);
                        }
                    }
                } else {
                    $unit->flag_complete_unit = 0;
                }
            }
        }
        return response()->json($units, 200);
    }

    public function unitsByCourseUser($slug)
    {
        $user = User::find(Auth::user()->id);
        $courseData = Course::query()->where('slug', $slug)->first();
        $units = Unit::select('id', 'title', 'day', 'slug', 'url_icon')->where('course_id', $courseData->id)->orderBy('day', 'ASC')->get();
        $units_by_user = $user->units->where('course_id', $courseData->id);
        foreach ($units as $unit) {
            if (count($units_by_user) > 0) {
                foreach ($units_by_user as $unit_user) {
                    if ($unit->id === $unit_user->pivot->unit_id) {
                        $unit->flag_complete_unit = $unit_user->pivot->flag_complete_unit;
                        unset($unit_user);
                        break;
                    } else {
                        $unit->flag_complete_unit = 0;
                        unset($unit_user);
                    }
                }
            } else {
                $unit->flag_complete_unit = 0;
            }
        }
        return response()->json($units, 200);
    }

    public function detailCourseUser($slug)
    {
        $user = User::find(Auth::user()->id);
        $courseData = Course::query()->where('slug', $slug)->first();
        $courseUsers = $courseData->users;
        $finalCourseData = $courseUsers->firstWhere('id', $user->id);
        if (!isset($finalCourseData)) {
            $courseData['course_paid'] = 0;
        } else {
            $courseData['course_paid'] = $finalCourseData->pivot->paid ?? 0;
        }
        $courseData['usersCount'] = $courseUsers->count();
        $courseData['attributes'] = json_decode($courseData['attributes']);
        unset($courseData['users']);
        return response()->json($courseData, 200);
    }

    public function checkCourseFree($slug)
    {
        try {
            DB::beginTransaction();
            $user = User::find(Auth::user()->id);
            $course = Course::query()->where('slug', $slug)->first();
            $courses = $user->courses;
            $courses = $courses->firstWhere('id', $course->id);
            if (!isset($courses)) {
                $check = in_array($course->id, json_decode($user->courses_free));
                if ($check) {
                    $dateNow = new \DateTime('now', new \DateTimeZone('America/Lima'));
                    $newUser['course_id'] = $course->id;
                    $newUser['user_id'] = $user->id;
                    $newUser['init_date'] = $dateNow;
                    $newUser['insc_date'] = $dateNow;
                    $newUser['flag_registered'] = 1;
                    $newUser['paid'] = 1;
                    $newUser['created_at'] = $dateNow;
                    $newUser['updated_at'] = $dateNow;
                    DB::table('user_courses')->insert($newUser);
                    DB::commit();
                    return response()->json([
                        'status' => 200,
                        'code' => 'FREE_ACCESS',
                        'message' => 'Acceso Gratuito'
                    ], 200);
                }
                return response()->json([
                    'status' => 400,
                    'code' => 'NOT_FREE_ACCESS',
                    'message' => 'No Tiene Acceso Gratuito'
                ], 400);
            }
            return response()->json([
                'code' => 'ALREADY_REGISTERED',
                'status' => 400,
                'message' => 'Ya esta Registrado al Reto'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 'ERROR_REQUEST',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function userRegisterOnPlan(Request $request)
    {
        $validated = $request->validate([
            'plan_id' => [
                'required',
                'integer'
            ]
        ]);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $emailUser = $user->email;
            $orderId = $request->input('orderId', 0);
            $plan = Plan::query()->with(['courses'])
                ->find($validated['plan_id']);
            $dateNow = Carbon::now();
            foreach ($plan->courses as $courseItem) {
                $userCourse =  UserCourse::query()->firstOrNew([
                    'user_id' => $user->id,
                    'course_id' => $courseItem->id,
                ], [
                    'init_date' => $dateNow,
                    'insc_date' => $dateNow,
                    'expiration_date' => $dateNow,
                    'flag_registered' => 1,
                    'external_order_id' => 0,
                    'link' => $request->link,
                    'paid' => 1,
                ]);
                if ($userCourse->expiration_date < $dateNow) {
                    $userCourse->expiration_date = Carbon::parse($dateNow)->addMonth($plan->months);
                } else {
                    $userCourse->expiration_date = Carbon::parse($userCourse->expiration_date)->addMonth($plan->months);
                }
                $userCourse->external_order_id = $orderId;
                $userCourse->save();
            }
            DB::commit();
            Mail::send('emails.confirmPaymentCourseNew', [
                'user' => $user,
                'dataCourses' => $plan->courses,
                'orderId' => strval($orderId),
                'months' => $plan->months,
                'price' => $plan->price,
                'dateOrder' => fecha_string()
            ], function ($message) use ($emailUser) {
                $message->to($emailUser);
                $message->subject('Compra Exitosa');
            });
            return response()->json([
                'status' => 200,
                'message' => 'Registro exitoso',
                'url' =>  $request->link,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'code' => 'ERROR_REQUEST',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function confirmPurchaseProductMail(Request $request)
    {
        $user = User::find(Auth::user()->id);
        Mail::to($user->email)->send(new ConfirmPurchaseMail($request));
    }

    public function confirmPaymentOrder($orderId)
    {
        $orderData = DB::table('user_courses')->where('external_order_id', $orderId)->first();
        if (isset($orderData) && !$orderData->paid) {
            DB::table('user_courses')->where('id', $orderData->id)->update(['paid' => true]);
            return response()->json([
                'statusCode' => 200,
                'code' => 'UPDATED_SUCCESFULLY',
                'message' => 'La orden se Actualizo Correctamente'
            ], 200);
        } else if (!isset($orderData)) {
            return response()->json([
                'statusCode' => 400,
                'code' => 'ORDER_NOT_FOUND',
                'message' => 'No se encontro la orden'
            ], 200);
        }
        return response()->json([
            'statusCode' => 400,
            'code' => 'ALREADY_PAID',
            'message' => 'La orden ya fue pagada'
        ], 400);
    }

    public function downloadPdf($id)
    {
        $course = Course::find($id);
        $path_relative = Str::of($course->file_url)->after(env('URL_DOMAIN'));
        $sbstr_path_rel = substr($path_relative, 1);
        if (is_file($sbstr_path_rel)) {
            $name_pdf = $course->title;
            return response()->download($sbstr_path_rel, $name_pdf . ".pdf");
        }
        return response()->json([
            'code' => 'DOCUMENT_NOT_FOUND',
            'statusCode' => 404,
            'message' => 'Documento no encontrado'
        ], 404);
    }

    public function rateAndCommentCourse(Request $request, $slug)
    {
        $user = Auth::user()->id;
        $user_name = Auth::user()->name;
        $course = Course::query()->where('slug', $slug)->first();
        if (!$course) {
            return response()->json([
                'code' => 'COURSE_NOT_FOUND',
                'statusCode' => 404,
                'message' => 'Curso no encontrado'
            ], 404);
        }
        $user_is_registered = DB::table('user_courses')->where('user_id', $user)->where('course_id', $course->id)->first();
        if (!$user_is_registered) {
            return response()->json([
                'code' => 'USER_IS_NOT_REGISTERED',
                'statusCode' => 404,
                'message' => 'el usuario no se encuentra registrado'
            ], 404);
        }
        $comments = new Comments();
        $comments->rating = $request->rating;
        $comments->user_id = $user;
        $comments->course_id = $course->id;
        $comments->title = $user_name;
        $comments->content = $request->content;

        $comments->save();

        $commentCount = $comments->where('course_id', $course->id)->count();
        $commentSum = $comments->where('course_id', $course->id)->sum('rating');
        $commentProm = floatval($commentSum) / $commentCount;

        Course::query()->where('slug', $slug)->update(['rating' => $commentProm]);

        return response()->json([
            'code' => 'COMMENT_SAVED',
            'statusCode' => 200,
            'message' => 'El comentario se guardo correctamente'
        ], 200);
    }

    public function commentsByCourse($slug)
    {
        $course = Course::query()->where('slug', $slug)->first();
        $comments = Comments::where('course_id', $course->id)->get(['rating', 'title', 'content']);
        return \response()->json($comments, 200);
    }
}
