<?php

use App\Http\Controllers\Admin\ProductController;
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
        Route::get('/list-questions/{id}/unit', 'QuestionController@getTableQuestionByUnit');
        Route::post('/questions/edit/{id}', 'QuestionController@update');
        Route::get('/course/{id}/units', 'UnitController@unitsByChallenge');
        Route::get('/courses/{id}/units', 'UnitController@unitsByChallenge2');

        //Plans
        Route::get('/plans', 'PlanController@index')->name('plans.index');
        Route::get('/plans/create', 'PlanController@addPlan')->name('plans.create');
        Route::post('/plans/create', 'PlanController@storePlan')->name('plans.store');
        Route::get('/plans/edit/{id?}', 'PlanController@editPlan')->name('plans.edit');
        Route::post('/plans/edit/{id?}', 'PlanController@updatePlan')->name('plans.update');
        Route::get('/plan/delete/{id}', 'PlanController@deletePlan');

        //Products
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::get('/products/delete/{id}', 'ProductController@destroy');

        Route::post('/store/media', 'ProductController@storeMedia')->name('products.storeMedia');

        //Orders
        Route::resource('/orders', 'OrderController');
        Route::get('order/{id}/detail', 'OrderController@detail');
        Route::post('order/change-state', 'OrderController@changeOrderState')->name('orders.changeState');
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

        Route::get('/focused', 'FocusedController@index')->name('focused.index');
        Route::patch('/focused/status', 'FocusedController@updateFocusedStatus');
        Route::match(['get', 'post'], '/focused/create', 'FocusedController@addFocused');
        Route::match(['get', 'post'], '/focused/edit/{id}', 'FocusedController@editFocused');
        Route::get('/focused/delete/{id}', 'FocusedController@deleteFocused');
        Route::get('/focused/{focused}', 'FocusedController@showFocused')->name('focused.show');
        Route::get('/focused-exercise-item/create', 'FocusedExerciseItemController@create')->name('focused_exercise_item.create');
        Route::post('/focused-exercise-item', 'FocusedExerciseItemController@store')->name('focused_exercise_item.store');
        Route::get('/focused-exercise-item/{focusedExerciseItem}/edit', 'FocusedExerciseItemController@edit')->name('focused_exercise_item.edit');
        Route::put('/focused-exercise-item/{focusedExerciseItem}', 'FocusedExerciseItemController@update')->name('focused_exercise_item.update');
        Route::delete('/focused-exercise-item/{focusedExerciseItem}', 'FocusedExerciseItemController@destroy')->name('focused_exercise_item.destroy');

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
