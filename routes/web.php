<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->group(function () {

    Route::match(['get', 'post'], '/', 'AdminController@login');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('dashboard/settings', 'AdminController@settings');
        Route::get('logout', 'AdminController@logout');
        Route::post('dashboard/verify-curr-pwd', 'AdminController@verifyPassword');
        Route::post('dashboard/update-pwd', 'AdminController@updatePassword');
        Route::match(['get', 'post'], 'dashboard/upd-admin-details', 'AdminController@updateAdminDetails');

        //Sections
        Route::get('dashboard/sections', 'SectionController@index');
        Route::post('dashboard/upd-section-status', 'SectionController@updateSectionStatus');
        Route::post('dashboard/section/upd-section-order', 'SectionController@updateOrder');
        Route::match(['get', 'post'], 'dashboard/section/create', 'SectionController@addSection');
        Route::match(['get', 'post'], 'dashboard/section/edit/{id?}', 'SectionController@editSection');
        Route::get('dashboard/section/delete/{id}', 'SectionController@deleteSection');

        //Recipes
        Route::get('dashboard/recipes', 'RecipeController@index');
        Route::post('dashboard/upd-recipes-status', 'RecipeController@updateSectionStatus');
        Route::match(['get', 'post'], 'dashboard/recipes/create', 'RecipeController@addRecipe');
        Route::match(['get', 'post'], 'dashboard/recipes/edit/{id?}', 'RecipeController@editRecipe');
        Route::get('dashboard/recipe/delete/{id}', 'RecipeController@deleteRecipe');

         //Tips
         Route::get('dashboard/tips', 'TipController@index');
         Route::post('dashboard/upd-tips-status', 'TipController@updateTipStatus');
         Route::match(['get', 'post'], 'dashboard/tips/create', 'TipController@addTip');
         Route::match(['get', 'post'], 'dashboard/tips/edit/{id?}', 'TipController@editTip');
         Route::get('dashboard/tip/delete/{id}', 'TipController@deleteTip');

        //Slider
        Route::get('dashboard/slider', 'SliderController@index');
        Route::match(['get', 'post'], 'dashboard/slider/create', 'SliderController@addSlider');
        Route::match(['get', 'post'], 'dashboard/slider/edit/{id?}', 'SliderController@editSlider');
        Route::post('dashboard/slide/upd-slide-order', 'SliderController@updateOrder');
        Route::get('dashboard/slider/delete/{id}', 'SliderController@deleteSlider');

        //Articles
        Route::get('dashboard/articles', 'ArticleController@index');
        Route::match(['get', 'post'], 'dashboard/articles/create', 'ArticleController@addArticle');
        Route::match(['get', 'post'], 'dashboard/articles/edit/{slug}', 'ArticleController@editArticle');
        Route::get('dashboard/article/delete/{id}', 'ArticleController@deleteArticle');

        //Areas
        Route::get('dashboard/areas', 'AreasController@index');
        Route::match(['get', 'post'], 'dashboard/area/create', 'AreasController@addArea');
        Route::match(['get', 'post'], 'dashboard/area/edit/{id?}', 'AreasController@editArea');
        Route::get('dashboard/area/delete/{id}', 'AreasController@deleteArea');

        //helpCenter
        Route::match(['get', 'post'], 'dashboard/company', 'CompanyController@index');
        Route::match(['get', 'post'], 'dashboard/policies/{name?}', 'CompanyController@policies');
        Route::match(['get', 'post'], 'dashboard/helpcenter', 'CompanyController@addArea');
        Route::get('dashboard/areas', 'AreasController@index');

        //Course
        Route::get('dashboard/courses', 'CourseController@index');
        Route::get('dashboard/courses-users', 'CourseController@CoursesByUser');
        Route::get('dashboard/courses-detail-course/{id}', 'CourseController@getTemplateDetailCourse');
        Route::match(['get', 'post'], 'dashboard/courses/create', 'CourseController@addCourse');
        Route::match(['get', 'post'], 'dashboard/courses/edit/{id?}', 'CourseController@editCourse');
        Route::get('dashboard/courses/{id}/units', 'CourseController@getUnitCourse');
        Route::get('/dashboard/course/delete/{id}', 'CourseController@deleteCourse');

        //Unit
        Route::resource('dashboard/units', 'UnitController');
        Route::patch('dashboard/units/{id}/status', 'UnitController@changeStatus');
        Route::delete('dashboard/units/{id}/delete/file', 'UnitController@deleteImageUnit');
        Route::get('dashboard/list-questions-units/{id}', 'UnitController@getTableQuestionsByUnit');
        Route::get('dashboard/list-units/{id}/course', 'UnitController@getTableUnitsByCourse');
        Route::post('dashboard/units/order', 'UnitController@unitOrderUpdate');
        //Question
        Route::resource('dashboard/questions', 'QuestionController');
        Route::patch('dashboard/questions/{id}/status', 'QuestionController@changeStatus');
        Route::get('list-questions/{id}/unit', 'QuestionController@getTableQuestionByUnit');
        Route::post('dashboard/questions/edit/{id}', 'QuestionController@update');
        Route::get('course/{id}/units', 'UnitController@unitsByChallenge');
        Route::get('courses/{id}/units', 'UnitController@unitsByChallenge2');

        //TypeAnswers
        Route::resource('dashboard/type-answers', 'TypeAnswerController');
        //Users
        Route::resource('dashboard/users', 'UserController');
        Route::patch('dashboard/users/{id}/status', 'UserController@changeStatus');
        //TypeAnswersQuestions
        Route::resource('dashboard/type-answers-questions', 'TypeAnswerQuestionController');
        Route::get('dashboard/list-answers-questions/{id}', 'TypeAnswerQuestionController@show');
        Route::patch('dashboard/validated-answers-questions/{id}', 'TypeAnswerQuestionController@changeValid');
        Route::patch('dashboard/status-answers-questions/{id}', 'TypeAnswerQuestionController@changeStatus');
        Route::get('dashboard/answers-questions/{id}/edit', 'TypeAnswerQuestionController@edit');
        Route::put('dashboard/answers-questions/{id}', 'TypeAnswerQuestionController@update');
        Route::delete('dashboard/answers-questions/{id}/delete', 'TypeAnswerQuestionController@destroy');
    });
});

