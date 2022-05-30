<?php

namespace App\Http\Controllers\Auth;

use Hash;
use App\Tip;
use App\Area;
use App\User;
use DateTime;
use Validator;
use App\Slider;
use App\Article;
// use JWTAuth;
use App\Company;
use App\Section;
use DateTimeZone;
use App\Addresses;
use Illuminate\Support\Str;
use App\Mail\ActivationMail;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Http\Requests\MailRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\ResetPasswordRequest;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\ClientException;

class AuthController extends Controller
{
    public $loginAfterSignUp = true;


    public function login(Request $request, $tokenMaki = null)
    {
        $token = null;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El email es invalido',
            'email.email' => 'El email es invalido',
            'password.required' => 'El campo contraseña es requerido',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 400,
                'message' => $validator->errors()->first()
            ], 400);
        }

        $user = User::where(['email' => $request->email, 'origin' => $request->origin])->first();

        $user['courses'] = $user->courses()->count();

        if (!$user) {
            return response()->json([
                'statusCode' => 400,
                'code' => 'EMAIL_NOT_FOUND',
                'message' => 'EL correo no existe'
            ], 400);
        }
        try {
            if (!$token = JWTAuth::fromUser($user)) {
                return response()->json([
                    'statusCode' => 401,
                    'code' => 'PASSWORD_INVALID',
                    'message' => 'contraseña incorrecta',
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json([
            'status' => 200,
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function httpTokenPublic($url, $method = 'GET', array $data = [], $tokenCommerce = '')
    {
        $client = new GuzzleHttpClient();
        $configureDefaults = ['headers' => ['Authorization' => 'Bearer ' . env('TOKEN_PROJECT') ?? $tokenCommerce], 'verify' => false];
        if (count($data) > 0) {
            $configureDefaults['json'] = $data;
        }
        $response = $client->request(
            $method,
            $url,
            $configureDefaults
        );
        return [
            'data' => json_decode($response->getBody()->getContents()),
            'status' => $response->getStatusCode(),
        ];
    }

    public function register(RegisterRequest $request)
    {

        $fecha = new DateTime('now', new DateTimeZone('America/Lima'));
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json([
                'statusCode' => 400,
                'code' => 'EMAIL_ALREADY_REGISTERED',
                'message' => 'EL correo ya esta registrado'
            ], 400);
        }
        $data = $request->all();

        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        $fecha = new DateTime('now', new DateTimeZone('America/Lima'));

        $user = new User;
        $user->name = $request->name;
        $user->sur_name = $request->sur_name;

        $user->email = $email;
        $user->password = bcrypt($password);

        $user->external_enterprise = $request->external_enterprise;
        $user->enterprise = $request->enterprise;
        $user->addittional_info = $request->addittional_info;
        $user->created_at = $fecha;
        $user->updated_at = $fecha;
        $user->save();

        $data_send = [
            'email' => $email,
            'password' => $password,
        ];
        $request = new Request($data_send);
        return $this->login($request);
    }

 public function loginSocial(Request $request)
    {

        $fecha = new DateTime('now', new DateTimeZone('America/Lima'));
        $companyData = Company::where('code', env('CODE_COMPANY'))->first();
        $user = User::where(['email' => $request->email])->first();

        if (!$user) {
            $user = new User;
            $user->name = $request->name;
            $user->sur_name = $request->last_name;
            $user->email = $request->email;
            $user->url_image = $request->url_image;
            $user->origin = $request->origin;
            $user->password = base64_encode($request->password);
            $user->created_at = $fecha;
            $user->updated_at = $fecha;
            $user->save();
        }

        $data_send = [
            'email' => $request->email,
            'origin' => $request->origin,
            'password' => $request->password,
        ];
        $request = new Request($data_send);
        return $this->login($request);
    }

    public function updateUserData(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $flag_goald = !isset($request->addittional_info) ? 0 : 1;
        $user->name = $request->name ?? $user->name;
        $user->sur_name = $request->last_name ?? $user->sur_name;
        $user->goal = $request->goal;
        $user->addittional_info = $request->addittional_info;
        $user->flag_goald = $flag_goald;
        $user->update();
        return response()->json([
            'statusCode' => 200,
            'message' => 'Los datos se ectualizaron correctamente'
        ]);
    }



    public function getCoursesCount(Request $request)
    {
        $data = $request->header('Authorization');
        $token =  explode(' ', $data)[1];
        $user = JWTAuth::toUser($token);
        $userData = User::where(['id' => $user->id])->first();
        $coursesCount = $userData->courses()->count();
        $status = $coursesCount > 0 ? 'success' : 'fail';
        return response()->json([
            'status' => $status,
            'courseCount' => $userData->courses()->count(),
        ]);
    }



    public function logout(Request $request)
    {
        $data = $request->header('Authorization');

        try {

            JWTAuth::invalidate($data);

            return response()->json([
                'status' => 200,
                'message' => 'EL usuario cerro sesion correctamente',
            ], 200);
        } catch (JWTException $exception) {

            return response()->json([
                'status' => 500,
                'message' => 'Ocurrio un error al intentar cerrar',
            ], 500);
        }
    }

    public function home()
    {
        $section = new Section;
        $sectionData = $section->select("id", "name", "description", "slug", "route", "activated", "text_link", "order_home")->orderBy('order_home', 'asc')->get();
        foreach ($sectionData as $index => $items) {
            $sectionData[$index]->articles = $items->articles()->get();
        }
        return $sectionData;
    }

    public function getSectionDetail($slug)
    {
        $sectionDetail = Section::select('id', 'name', 'slug', 'page_image', 'route', 'description')->where('slug', $slug)->first();
        return $sectionDetail;
    }

    public function getArticlesBySections(Request $request, $slugSection)
    {
        $limit = $request->get('limit');
        $limit = !empty($limit) && is_numeric($limit) ? $limit : 10;
        $section = new Section;
        $sectionData = $section->where("slug", $slugSection)->first();
        $articlesBySection = $sectionData->articles()->select('id', 'title', 'subtitle', 'page_image', 'content', "slug", "text_link")->orderByDesc('published_at')->paginate($limit);
        return $articlesBySection;
    }

    public function getArticleDetail(Request $request, $idArticle)
    {
        $article = new Article;
        $articleData = $article->where("id", $idArticle)->first();
        return $articleData;
    }

    public function aboutXimena()
    {
        $article = new Article;
        $aboutXimena = $article->where("slug", "sobre-ximena")->first();
        $aboutXimena->addittional_info = $aboutXimena->addittional_info;
        return $aboutXimena;
    }

    public function getTips(Request $request)
    {
        $limit = $request->get('limit');
        $search = $request->get('search');
        $limit = !empty($limit) && is_numeric($limit) ? $limit : 10;
        $tip = new Tip;
        $tips = $tip->select('id', 'title', 'subtitle', 'page_image', "mobile_image", "slug", "route")->title($search)->orderByDesc('published_at')->paginate($limit);
        return $tips;
    }

    public function getTipDetail(Request $request, $slug = null)
    {
        $tip = new Tip;
        $tipData = $tip->where("slug", $slug)->first();
        return $tipData;
    }

    public function getSections()
    {
        return Section::select('id', 'name', 'route', 'slug', 'slug', 'page_image', 'order')->where('activated', 1)->orderBy('order', 'asc')->get();
    }

    public function getSlide()
    {
        return Slider::select('id', 'url_image', 'order')->orderBy('order', 'asc')->get();
    }

    public function sendLinkResetPassword(MailRequest $request)
    {
        $data = $request->all();
        if (isset($data['email'])) {
            $user = User::where('email', $data['email'])->where('is_activated', 1)->first();
            if (isset($user)) {
                $token = Str::random(10);
                $fecha = new DateTime('now', new DateTimeZone('America/Lima'));
                $email = $data['email'];

                DB::table('password_resets')->insert(['email' => $email, 'token' => $token, 'created_at' =>  $fecha]);

                Mail::send('emails.reset', ['token' => $token, 'name' => $user->name], function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('Restaurar Contraseña');
                });

                return response()->json([
                    'status' => 200,
                    'message' => 'Se ha enviado un enlace a tu correo',
                ], 200);

                /* $data_send = [
                    'email' => $data['email'],
                    'name' => $user->name
                ];
                Mail::to($data['email'])->send(new ResetPasswordMail($data_send));
                if (count(Mail::failures()) > 0) {
                    return new \Error(Mail::failures());
                } */
            }
            return response(['status' => 400, 'message' => 'Usuario no encontrado'], 400);
        }
        return response(['status' => 400, 'message' => 'El email ingresado no es válido'], 400);
    }

    public function activate($data, $content)
    {
        $data = [
            'email' => $data,
            'password' => $content
        ];
        $request = new Request($data);
        return $this->login($request);
    }

    public function ResetPassword(ResetPasswordRequest $request)
    {

        $token = $request->get('token');
        $password = $request->get('password');
        $passwordReset = DB::table('password_resets')->where('token', $token)->first();
        if (isset($passwordReset)) {
            $user = User::where('email', $passwordReset->email)->first();
            $user->password = bcrypt($password);
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'Tu contraseña ha sido restablecida con exíto',
            ], 200);
        }
        return response(['status' => 400, 'message' => 'Token no valido'], 400);
    }

    public function getAreas()
    {
        return Area::select('id', 'name')->get();
    }

    public function getUserDetails(Request $request)
    {
        $data = $request->header('Authorization');
        $token =  explode(' ', $data)[1];
        $user = JWTAuth::toUser($token);
        $company = Company::first();
        if ($user) {
            return response()->json(['statusCode' => 200, 'user' => $user]);
        }
    }

    public function getUserAddress(Request $request)
    {
        $data = $request->header('Authorization');
        $token =  explode(' ', $data)[1];
        $user = JWTAuth::toUser($token);
        $address = $user->address;
        return response()->json($address);
    }

    public function createUserAddress(Request $request)
    {
        $data = $request->header('Authorization');
        $token =  explode(' ', $data)[1];
        $user = JWTAuth::toUser($token);
        $dataPayload = $request->all();

        $address = new Addresses;

        $address->alias = $dataPayload['alias'];
        $address->address = $dataPayload['address'];
        $address->user_id = $user->id;
        $address->nro = $dataPayload['nro'];
        $address->province = $dataPayload['province'];
        $address->district = $dataPayload['district'];

        $address->save();
        return response()->json(['statusCode' => 200, 'message' => 'La direccion se registro Correctamente']);
    }

    public function editUserAddress(Request $request, $id = null)
    {
        $data = $request->header('Authorization');
        $token =  explode(' ', $data)[1];
        $user = JWTAuth::toUser($token);
        $dataPayload = $request->all();

        $address = new Addresses;
        Addresses::where(['id' => $id])->update(['alias' => $dataPayload['alias'], 'address' => $dataPayload['address'], 'province' => $dataPayload['province'], 'district' => $dataPayload['district']]);

        return response()->json(['statusCode' => 200, 'message' => 'La direccion se actualizo Correctamente']);
    }

    public function setFavoriteUserAddress(Request $request, $id = null)
    {
        $data = $request->header('Authorization');
        $token =  explode(' ', $data)[1];
        $user = JWTAuth::toUser($token);
        $addressDefault = Addresses::where('flag_default', true)->first();
        if ($addressDefault) {
            Addresses::where(['id' => $addressDefault->id])->update(['flag_default' => false]);
        }
        Addresses::where(['id' => $id])->update(['flag_default' => true]);

        return response()->json(['statusCode' => 200, 'message' => 'se modifico correctamente']);
    }

    public function deleteUserAddress(Request $request, $id = null)
    {
        $data = $request->header('Authorization');
        $token =  explode(' ', $data)[1];
        $user = JWTAuth::toUser($token);

        Addresses::where(['id' => $id])->delete();

        return response()->json(['statusCode' => 200, 'message' =>  'La direccion se elimino Correctamente']);
    }

    public function setAdditionalInfo(Request $request)
    {
        $data = $request->header('Authorization');
        $token =  explode(' ', $data)[1];
        $user = JWTAuth::toUser($token);
        $dataPayload = $request->all();
        User::where('id', $user->id)->update(['goal' => $dataPayload['goal'] ?? null, 'addittional_info' => $dataPayload['addittional_info'] ?? null, 'flag_goald' => true]);
        return response()->json(['statusCode' => 200, 'message' =>  'El objetivo se seteo correctamente']);
    }

    public function getCompanyData()
    {
        $company = new Company;
        $company = $company->getCompanyInfo();
        return response()->json(['statusCode' => 200, 'data' => $company]);
    }

    public function refreshtoken()
    {
        $token = JWTAuth::getToken();
        $token = JWTAuth::refresh($token);
        return response()->json(['token' => $token], 200);
    }
}

