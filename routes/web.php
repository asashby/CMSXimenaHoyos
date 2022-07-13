<?php

use Illuminate\Support\Facades\Auth;
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
    Route::group(['middleware' => ['admin'], 'prefix' => 'dashboard'], function () {
        Route::get('/', 'AdminController@dashboard');
        Route::get('/settings', 'AdminController@settings');
        Route::get('logout', 'AdminController@logout');
        Route::post('/verify-curr-pwd', 'AdminController@verifyPassword');
        Route::post('/update-pwd', 'AdminController@updatePassword');
        Route::match(['get', 'post'], '/upd-admin-details', 'AdminController@updateAdminDetails');

        //Sections
        Route::get('/sections', 'SectionController@index');
        Route::post('/upd-section-status', 'SectionController@updateSectionStatus');
        Route::post('/section/upd-section-order', 'SectionController@updateOrder');
        Route::match(['get', 'post'], '/section/create', 'SectionController@addSection');
        Route::match(['get', 'post'], '/section/edit/{id?}', 'SectionController@editSection');
        Route::get('/section/delete/{id}', 'SectionController@deleteSection');

        //Recipes
        Route::get('/recipes', 'RecipeController@index');
        Route::post('/upd-recipes-status', 'RecipeController@updateSectionStatus');
        Route::match(['get', 'post'], '/recipes/create', 'RecipeController@addRecipe');
        Route::match(['get', 'post'], '/recipes/edit/{id?}', 'RecipeController@editRecipe');
        Route::get('/recipe/delete/{id}', 'RecipeController@deleteRecipe');

        //Tips
        Route::get('/tips', 'TipController@index');
        Route::post('/upd-tips-status', 'TipController@updateTipStatus');
        Route::match(['get', 'post'], '/tips/create', 'TipController@addTip');
        Route::match(['get', 'post'], '/tips/edit/{id?}', 'TipController@editTip');
        Route::get('/tip/delete/{id}', 'TipController@deleteTip');

        //Slider
        Route::get('/slider', 'SliderController@index');
        Route::match(['get', 'post'], '/slider/create', 'SliderController@addSlider');
        Route::match(['get', 'post'], '/slider/edit/{id?}', 'SliderController@editSlider');
        Route::post('/slide/upd-slide-order', 'SliderController@updateOrder');
        Route::get('/slider/delete/{id}', 'SliderController@deleteSlider');

        //Articles
        Route::get('/articles', 'ArticleController@index');
        Route::match(['get', 'post'], '/articles/create', 'ArticleController@addArticle');
        Route::match(['get', 'post'], '/articles/edit/{slug}', 'ArticleController@editArticle');
        Route::get('/article/delete/{id}', 'ArticleController@deleteArticle');

        //Areas
        Route::get('/areas', 'AreasController@index');
        Route::match(['get', 'post'], '/area/create', 'AreasController@addArea');
        Route::match(['get', 'post'], '/area/edit/{id?}', 'AreasController@editArea');
        Route::get('/area/delete/{id}', 'AreasController@deleteArea');

        //helpCenter
        Route::match(['get', 'post'], '/company', 'CompanyController@index');
        Route::match(['get', 'post'], '/policies/{name?}', 'CompanyController@policies');
        Route::match(['get', 'post'], '/helpcenter', 'CompanyController@addArea');
        Route::get('/areas', 'AreasController@index');

        //Course
        Route::get('/courses', 'CourseController@index');
        Route::get('/courses-users', 'CourseController@CoursesByUser');
        Route::get('/courses-detail-course/{id}', 'CourseController@getTemplateDetailCourse');
        Route::match(['get', 'post'], '/courses/create', 'CourseController@addCourse');
        Route::match(['get', 'post'], '/courses/edit/{id?}', 'CourseController@editCourse');
        Route::get('courses/{id}/units', 'CourseController@getUnitCourse');
        Route::get('/dashboard/course/delete/{id}', 'CourseController@deleteCourse');

        //Unit
        Route::resource('/units', 'UnitController');
        Route::patch('/units/{id}/status', 'UnitController@changeStatus');
        Route::delete('/units/{id}/delete/file', 'UnitController@deleteImageUnit');
        Route::get('/list-questions-units/{id}', 'UnitController@getTableQuestionsByUnit');
        Route::get('/list-units/{id}/course', 'UnitController@getTableUnitsByCourse');
        Route::post('/units/order', 'UnitController@unitOrderUpdate');
        //Question
        Route::resource('/questions', 'QuestionController');
        Route::patch('/questions/{id}/status', 'QuestionController@changeStatus');
        Route::get('list-questions/{id}/unit', 'QuestionController@getTableQuestionByUnit');
        Route::post('/questions/edit/{id}', 'QuestionController@update');
        Route::get('course/{id}/units', 'UnitController@unitsByChallenge');
        Route::get('courses/{id}/units', 'UnitController@unitsByChallenge2');

        //Plans
        Route::resource('/plans', 'PlanController');
        Route::post('/upd-plan-status', 'PlanController@updatePlanStatus');
        Route::match(['get', 'post'], '/plans/create', 'PlanController@addPlan');
        Route::match(['get', 'post'], '/plans/edit/{id?}', 'PlanController@editPlan');
        Route::get('/plan/delete/{id}', 'PlanController@deletePlan');

        //Products
        Route::resource('/products', ProductController::class);
        Route::get('/products/delete/{id}', 'ProductController@destroy');
        Route::post('/store/media', 'ProductController@storeMedia')->name('products.storeMedia');

        //Orders
        Route::resource('/orders', 'OrderController');
        Route::get('order/{id}/detail', 'OrderController@detail');
        Route::post('upd-order-status', 'OrderController@updateOrderStatus');
        Route::get('order/cancel/{id}', 'OrderController@cancelOrder');
        /*Route::post('/upd-product-status', 'ProductController@updateProductStatus');
        Route::match(['get', 'post'], '/products/create', 'ProductController@addProduct');
        Route::match(['get', 'post'], '/products/edit/{id?}', 'ProductController@editProduct');
        Route::get('/product/delete/{id}', 'ProductController@deleteProduct');*/

        //Categories
        Route::resource('/categories', 'CategoryController');
        Route::post('/upd-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], '/categories/create', 'CategoryController@addCategory');
        Route::match(['get', 'post'], '/categories/edit/{id?}', 'CategoryController@editCategory');
        Route::get('/category/delete/{id}', 'CategoryController@deleteCategory');


        //Focused
        Route::resource('/focused', 'FocusedController');
        Route::patch('/focused/status', 'FocusedController@updateFocusedStatus');
        Route::match(['get', 'post'], '/focused/create', 'FocusedController@addFocused');
        Route::match(['get', 'post'], '/focused/edit/{id}', 'FocusedController@editFocused');
        Route::get('/focused/delete/{id}', 'FocusedController@deleteFocused');

        //TypeAnswers
        Route::resource('/type-answers', 'TypeAnswerController');
        //Users
        Route::resource('/users', 'UserController');
        Route::patch('/users/{id}/status', 'UserController@changeStatus');
        //TypeAnswersQuestions
        Route::resource('/type-answers-questions', 'TypeAnswerQuestionController');
        Route::get('/list-answers-questions/{id}', 'TypeAnswerQuestionController@show');
        Route::patch('/validated-answers-questions/{id}', 'TypeAnswerQuestionController@changeValid');
        Route::patch('/status-answers-questions/{id}', 'TypeAnswerQuestionController@changeStatus');
        Route::get('/answers-questions/{id}/edit', 'TypeAnswerQuestionController@edit');
        Route::put('/answers-questions/{id}', 'TypeAnswerQuestionController@update');
        Route::delete('/answers-questions/{id}/delete', 'TypeAnswerQuestionController@destroy');
    });
});
