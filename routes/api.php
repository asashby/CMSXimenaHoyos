<?php

use App\Http\Controllers\Api\FocusedExerciseController;
use App\Http\Controllers\Api\MailController;
use App\Http\Controllers\Api\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Auth\AuthController@login');
Route::post('/login-social', 'Auth\AuthController@loginSocial');
Route::post('/register', 'Auth\AuthController@register');
Route::get('/home', 'Auth\AuthController@home');
Route::get('/sections/{slugSection}/articles', 'Auth\AuthController@getArticlesBySections');
Route::get('/article/{idArticle}', 'Auth\AuthController@getArticleDetail');
Route::get('/sections', 'Auth\AuthController@getSections');
Route::get('/banner', 'Auth\AuthController@getSlide');
Route::get('/areas', 'Auth\AuthController@getAreas');
Route::get('/tips', 'Auth\AuthController@getTips');
Route::get('/tips/{slug}', 'Auth\AuthController@getTipDetail');
Route::get('/company/public', 'Auth\AuthController@getCompanyData');
Route::get('/sections/{slug}', 'Auth\AuthController@getSectionDetail');
Route::get('/about/{slug}', 'Auth\AuthController@aboutXimena');

Route::get('/activation/{data}/{content}', 'Auth\AuthController@activate');
Route::post('/forget-password', 'Auth\AuthController@sendLinkResetPassword');
Route::post('/reset-password', 'Auth\AuthController@ResetPassword');

//ruta para recetas -> esta publico temporalmente
Route::get('/recipes', 'Api\RecipeController@index');
Route::get('/recipes/{slug}', 'Api\RecipeController@detailRecipe');

Route::get('/certificate/{id}/course/download', 'Api\CourseController@downloadPdf');

Route::patch('/order/{orderId}/confirm-payment', 'Api\CourseController@confirmPaymentOrder');

Route::get('/courses', 'Api\CourseController@index');
Route::get('/courses/{slug}/detail', 'Api\CourseController@detailCourse');
Route::get('/course/{id}/plans', 'Admin\PlanController@plansByCourse');
Route::get('/course/{slug}/plans-list', 'Admin\PlanController@plansByCourseSlug');
Route::get('/courses/{slug}/units', 'Api\CourseController@unitsByCourse');
Route::get('/units/{slug}/detail', 'Api\UnitController@getUnitDetail');

//Categories
Route::get('/categories', 'Api\CategoryController@index');

//Products
Route::get('/products', 'Api\ProductController@index');
Route::get('/products/{id}/detail', 'Api\ProductController@productDetail');
// Focused
Route::get('/focused-exercises/{focusedExercise}/plans', [FocusedExerciseController::class, 'getPlansByFocusedExerciseId']);
// Sliders
Route::get('/sliders', [SliderController::class, 'index']);

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('logout', 'Auth\AuthController@logout');
    Route::get('current', 'Auth\AuthController@getUserDetails');
    Route::post('current/update', 'Auth\AuthController@updateUserData');
    Route::get('current/courses', 'Auth\AuthController@getCoursesCount');
    Route::post('current/additionalInfo', 'Auth\AuthController@setAdditionalInfo');

    //courses
    Route::post('/courses/{slug}/check-free', 'Api\CourseController@checkCourseFree');
    Route::patch('/courses/payment', 'Api\CourseController@userRegisterOnPlan');

    //directions
    Route::get('address', 'Auth\AuthController@getUserAddress');
    Route::post('address/create', 'Auth\AuthController@createUserAddress');
    Route::post('address/edit/{id?}', 'Auth\AuthController@editUserAddress');
    Route::post('address/setFavorite/{id}', 'Auth\AuthController@setFavoriteUserAddress');
    Route::post('address/delete/{id}', 'Auth\AuthController@deleteUserAddress');

    Route::get('refresh', 'Auth\AuthController@refreshToken');
    //Lista de Retos por usuario
    Route::get('courses-by-user', 'Api\CourseController@coursesByUser');

    // courses
    Route::get('/courses/{slug}/detail-user', 'Api\CourseController@detailCourseUser');
    Route::get('/courses/{slug}/units-user', 'Api\CourseController@unitsByCourseUser');
    Route::get('units', 'Api\UnitController@index');

    Route::post('purchase/confirm', 'Api\CourseController@confirmPurchaseProductMail');

    Route::get('units/{id}/questions', 'Api\UnitController@questionsByUnit');
    Route::get('questions/{id}/answers', 'Api\QuestionController@index');
    Route::get('questions/{slug}/detail', 'Api\QuestionController@questionDetail');

    //Orders
    Route::post('order/payment', 'Api\orderController@createOrder');
    Route::get('order-user', 'Api\orderController@OrdersByUser');

    //RUTA PARA FINALIZAR EL CURSO
    Route::post('questions/final', 'Api\UnitController@finishQuestion');
    Route::post('units/{id}/final', 'Api\UnitController@finishUnit');
    //RUTA PARA VALORACION Y COMENTARIO
    Route::post('rating/course/{slug}', 'Api\CourseController@rateAndCommentCourse');
    Route::get('comments/course/{slug}', 'Api\CourseController@commentsByCourse');

    //Rutas para Culqui
    Route::post('culqui/create-charge', 'Api\CulquiController@createCharge');

    Route::post('client-contact', [MailController::class, 'clientContact']);

    Route::get('focused-exercises', [FocusedExerciseController::class, 'index']);
    Route::get('focused-exercises/{focusedExercise}', [FocusedExerciseController::class, 'show']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
