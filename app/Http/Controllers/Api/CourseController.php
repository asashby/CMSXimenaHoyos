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

    /*
    public function detailCourseByUser($id)
    {
        $courseData = Course::find($id);
        $courseData['attributes'] = json_decode($courseData['attributes']);
        return response()->json($courseData, 200);
    }
    */

    public function detailCourse($slug, Request $request)
    {
        $courseData = Course::where('slug', $slug)->first();
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
        /*     $courseData = Course::where('slug', $slug)->first();
        $units = Unit::select('id', 'title', 'day', 'slug', 'url_icon')->where('course_id', $courseData->id)->orderBy('day', 'ASC')->get();
     */
        // $user = User::find(Auth::user()->id);
        $courseData = Course::where('slug', $slug)->first();
        $units = Unit::select('id', 'title', 'day', 'slug', 'url_icon')->where('course_id', $courseData->id)->orderBy('day', 'ASC')->get();
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
        /*     $courseData = Course::where('slug', $slug)->first();
        $units = Unit::select('id', 'title', 'day', 'slug', 'url_icon')->where('course_id', $courseData->id)->orderBy('day', 'ASC')->get();
     */
        $user = User::find(Auth::user()->id);
        $courseData = Course::where('slug', $slug)->first();
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
        $courseData = Course::where('slug', $slug)->first();
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
            $course = Course::where('slug', $slug)->first();
            $courses = $user->courses;
            $courses = $courses->firstWhere('id', $course->id);
            if (!isset($courses)) {
                $check = in_array($course->id, json_decode($user->courses_free));
                if ($check) {
                    $date_now = new \DateTime('now', new \DateTimeZone('America/Lima'));
                    $newUser['course_id'] = $course->id;
                    $newUser['user_id'] = $user->id;
                    $newUser['init_date'] = $date_now;
                    $newUser['insc_date'] = $date_now;
                    $newUser['flag_registered'] = 1;
                    $newUser['paid'] = 1;
                    $newUser['created_at'] = $date_now;
                    $newUser['updated_at'] = $date_now;
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

    /*     public function UserRegisterOnCourse(Request $request, $slug)
    {
        try {
            DB::beginTransaction();
            $user = User::find(Auth::user()->id);
            $data = array_merge($request->all());
            //Verificamos si el usuario ya esta regisrado en el curso elejido
            $course = Course::where('slug', $slug)->first();
            //  $plan = Plan::where('id', $data['plan_id'])->first();
            // $months = strval($plan->months);
            $courses = $user->courses;
            $courses = $courses->firstWhere('id', $course->id);
            $emailUser = $user->email;
            $date_now = date('d-m-y h:i:s');
            // $expirationDate = date('d-m-y h:i:s', strtotime("+" . $months . "months", strtotime($date_now)));
            if (!isset($courses)) {
                $newUser['course_id'] = $course->id;
                $newUser['user_id'] = $user->id;
                $newUser['init_date'] = $date_now;
                $newUser['insc_date'] = $date_now;
                // $newUser['expiration_date'] = $expirationDate;
                $newUser['flag_registered'] = 1;
                $newUser['external_order_id'] =  $data['orderId'];
                $newUser['link'] = $data['link'];
                $newUser['paid'] = 1;
                $newUser['created_at'] = $date_now;
                $newUser['updated_at'] = $date_now;
                DB::table('user_courses')->insert($newUser);
                DB::commit();
                Mail::send('emails.confirmPayment', ['userName' => $user->name, 'courseName' => $course->name, 'orderId' => $data['orderId'], 'months' => 1], function ($message) use ($emailUser) {
                    $message->to($emailUser);
                    $message->subject('Compra Exitosa');
                });
                return response()->json([
                    'status' => 200,
                    'message' => 'Registro exitoso',
                    'url' =>  $data['link'],
                ], 200);
            }
            return response()->json([
                'statusCode' => 400,
                'code' => 'ALREADY_REGISTERED',
                'message' => 'Ya se encuentra Registrado'
            ], 400);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'code' => 'ERROR_REQUEST',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    } */

public function UserRegisterOnCourse(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::find(Auth::user()->id);
            $emailUser = $user->email;
            if (!empty($request->plan_id) || !empty($request->product_id)) {
                if (!empty($request->product_id)) {
                    $ids = implode($request->product_id);
                    $plan = Plan::where('woocommerce_ids', 'like', "%$ids%")->first();
                } else {
                    $plan = Plan::find($request->plan_id);
                }
                $coursesPlan = $plan->course_id;
                $dataCourses =  Course::whereIn('id', $coursesPlan)->get();
                $findCourses = $user->courses()->whereIn('course_id', $coursesPlan)->count();
                $date_now = Carbon::now('America/Lima');
                if ($findCourses === 0) {
                    foreach ($coursesPlan as $courseId) {
                        $newUser['course_id'] = $courseId;
                        $newUser['user_id'] = $user->id;
                        $newUser['init_date'] = $date_now;
                        $newUser['insc_date'] = $date_now;
                        $newUser['expiration_date'] = Carbon::now('America/Lima')->addMonths($plan->months);
                        $newUser['flag_registered'] = 1;
                        $newUser['external_order_id'] =  $request->orderId;
                        $newUser['link'] = $request->link;
                        $newUser['paid'] = 1;
                        $newUser['created_at'] = $date_now;
                        $newUser['updated_at'] = $date_now;
                        $newId = DB::table('user_courses')->insertGetId($newUser);
                        DB::commit();
                    }

                    if (!empty($request->plan_id)) {
                        Mail::send('emails.confirmPaymentCourseNew', ['user' => $user, 'dataCourses' => $dataCourses, 'orderId' =>  strval($newId), 'months' => $plan->months, 'price' => $plan->price, 'dateOrder' => fecha_string()], function ($message) use ($emailUser) {
                            $message->to($emailUser);
                            $message->subject('Compra Exitosa');
                        });
                    } else {
                        Mail::send('emails.confirmPurchaseWoocommerce', ['user' => $user, 'orderId' => strval($newId), 'items' => $request->line_items, 'total' => number_format($request->total, 2), 'dateOrder' => fecha_string(), 'subtotal' => number_format($request->total - 13, 2)], function ($message) use ($emailUser) {
                            $message->to($emailUser);
                            $message->subject('Compra Exitosa');
                        });
                    }
                    return response()->json([
                        'status' => 200,
                        'message' => 'Registro exitoso',
                        'url' =>  $request->link,
                    ], 200);
                }
                return response()->json([
                    'statusCode' => 400,
                    'code' => 'ALREADY_REGISTERED',
                    'message' => 'Ya se encuentra Registrado'
                ], 400);
            } else {
                Mail::send('emails.confirmPurchaseWoocommerce', ['user' => $user, 'orderId' => strval(rand(1, 1000)), 'items' => $request->line_items, 'total' => number_format($request->total, 2), 'subtotal' => number_format($request->total - 13, 2), 'dateOrder' => fecha_string()], function ($message) use ($emailUser) {
                    $message->to($emailUser);
                    $message->subject('Compra Exitosa');
                });
                return response()->json([
                    'status' => 200,
                    'message' => 'Compra Exitosa',
                ], 200);
            }
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
        $course = Course::where('slug', $slug)->first();
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

        Course::where('slug', $slug)->update(['rating' => $commentProm]);

        return response()->json([
            'code' => 'COMMENT_SAVED',
            'statusCode' => 200,
            'message' => 'El comentario se guardo correctamente'
        ], 200);
    }

    public function commentsByCourse($slug)
    {
        $course = Course::where('slug', $slug)->first();
        $comments = Comments::where('course_id', $course->id)->get(['rating', 'title', 'content']);
        return \response()->json($comments, 200);
    }
}

