<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Company;
use App\Recipe;
use App\Section;
use Session;
use File;
use Auth;
use Image;
use DateTime;
use DateTimeZone;

class RecipeController extends Controller
{
    public function index()
    {
        Session::put('page', 'recipes');
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        $recipes = Recipe::get();
        return view('admin.recipes.recipes')->with(compact('recipes', 'companyData'));
    }

    public function addRecipe(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $recipe = new Recipe;

            // echo '<pre>'; print_r($data); die;


            $rulesData = [
                'challenges' => 'nullable|array',
                'recipeTitle' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'recipeResume' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'recipeDificult' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'attributes' => 'nullable|json',
                'indredients' => 'nullable|array',
                'indredients.*' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'steps' => 'nullable|array',
                'steps.*' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
            ];

            $customMessage = [
                'challenges.required' => 'Debe Seleccionar uno o varios retos',
                'challenges.array' => 'Debe ser un array valido',
                'recipeTitle.required' => 'El campo titulo es requerido',
                'recipeDificult.regex' => 'El campo dificultad es invalido',
                'recipeTitle.regex' =>  'El campo titulo es invalido',
                'recipeResume.regex' => 'El campo descrpicion no es válido',
                'steps.*.regex' => 'El campo preparacion no es valido',
                'attributes.json' => 'El campo atributos no es valido',
                'ingredients.*.regex' => 'El campo atributos no es valido',
            ];


            $this->validate($request, $rulesData, $customMessage);
            $slugClean = $recipe->cleanSlug(strtolower($data['recipeTitle']));

            $slug = strtr(strtolower($slugClean), ' ', '-');
            // echo '<pre>'; print_r($data['recipeTitle']); die;

            if (!File::exists('images/backend_images/recipes')) {
                $path = 'images/admin_images/recipes';
                File::makeDirectory($path, 0755, true, true);
            }

            // Upload Image
            if ($request->hasFile('recipeBanner')) {
                $image_tmp = $request->file('recipeBanner');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/recipes/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $recipe->page_image = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if ($request->hasFile('recipeBannerMobile')) {
                $image_tmp = $request->file('recipeBannerMobile');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/recipes/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $recipe->mobile_image = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }

            if ($request->hasFile('recipeContent')) {
                $image_tmp = $request->file('recipeContent');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/recipes/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $recipe->image_content = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            }


            if (empty($data['recipeUrlVideo'])) {
                $urlVideo = '';
            }

            $recipe->title = $data['recipeTitle'];
            $recipe->slug = $slug;
            $recipe->route = $slug;
            $recipe->time_food = $data['timefood'];
            $recipe->nutritional_facts = $data['attributes'] ?? '[]';
            $recipe->description = $data['recipeResume'];
            $recipe->ingredients = $data['ingredientsRecipe'] ?? '[]';
            $recipe->dificult = $data['recipeDificult'];
            $recipe->steps = $data['stepsRecipe'] ?? '[]';
            $recipe->url_video = !empty($data['recipeUrlVideo']) ? $data['recipeUrlVideo'] : '';
            $recipe->published_at = new DateTime('now', new DateTimeZone('America/Lima'));
            $recipe->save();
            if (isset($data['challenges'])) {
                $recipe->course()->attach($data['challenges']);
            }
            Session::flash('success_message', 'La receta se creo Correctamente');
            return redirect('dashboard/recipes');
        }

        $courses = Course::get();

        $courses_drop_down = "<option disabled>Select</option>";
        foreach ($courses as $course) {
            $courses_drop_down .= "<option value='" . $course->id . "'>" . $course->title . "</option>";
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.recipes.add_recipe')->with(compact('courses_drop_down', 'companyData'));
    }

    public function editRecipe(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();

            // echo '<pre>'; print_r($data); die;

            $rulesData = [
                'challenges' => 'nullable|array',
                'recipeTitle' => 'required|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'recipeResume' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'recipeDificult' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'attributes' => 'nullable|json',
                'indredients' => 'nullable|array',
                'indredients.*' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
                'steps' => 'nullable|array',
                'steps.*' => 'nullable|regex:/^[A-Za-zá-úÁ-ÚñÑ0-9\-! ,&\'\"\/@\.:\(\)]+$/',
            ];

            $customMessage = [
                'challenges.required' => 'Debe Seleccionar uno o varios retos',
                'challenges.array' => 'Debe ser un array valido',
                'recipeTitle.required' => 'El campo titulo es requerido',
                'recipeTitle.regex' =>  'El campo titulo es invalido',
                'recipeDificult.regex' => 'El campo dificultad es invalido',
                'recipeResume.regex' => 'El campo descrpicion no es válido',
                'steps.*.regex' => 'El campo preparacion no es valido',
                'attributes.json' => 'El campo atributos no es valido',
                'ingredients.*.regex' => 'El campo atributos no es valido',
            ];


            $this->validate($request, $rulesData, $customMessage);
            $recipe = new Recipe();
            $slugClean = $recipe->cleanSlug(strtolower($data['recipeTitle']));

            $slug = strtr(strtolower($slugClean), ' ', '-');
            $route = strtr(strtolower($data['recipeTitle']), ' ', '-');



            // Upload Image
            if ($request->hasFile('recipeBanner')) {
                $image_tmp = $request->file('recipeBanner');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/recipes/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePath = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentRecipeBanner'])) {
                $completePath = $data['currentRecipeBanner'];
            } else {
                $completePath = '';
            }

            if ($request->hasFile('recipeBannerMobile')) {
                $image_tmp = $request->file('recipeBannerMobile');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/recipes/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathMobile = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentRecipeBannerMobile'])) {
                $completePathMobile = $data['currentRecipeBannerMobile'];
            } else {
                $completePathMobile = '';
            }

            if ($request->hasFile('recipeContent')) {
                $image_tmp = $request->file('recipeContent');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/recipes/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathSeo = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentRecipeContent'])) {
                $completePathSeo = $data['currentRecipeContent'];
            } else {
                $completePathSeo = '';
            }


            if (is_null($data['ingredientsRecipe'])) {
                $recipeIng = $data['currentIngredientsRecipe'];
            } else {
                $recipeIng = $data['ingredientsRecipe'];
            }

            if (is_null($data['stepsRecipe'])) {
                $recipeStep = $data['currentStepsRecipe'];
            } else {
                $recipeStep = $data['stepsRecipe'];
            }

            if (is_null($data['attributes'])) {
                $recipeNutritionalFacts = $data['currentAttributesRecipe'];
            } else {
                $recipeNutritionalFacts = $data['attributes'];
            }

            Recipe::where(['id' => $id])->update([
                'title' => $data['recipeTitle'], 'route' => $slug, 'slug' => $slug, 'nutritional_facts' =>  $recipeNutritionalFacts, 'description' => $data['recipeResume'], 'ingredients' => $recipeIng, 'steps' => $recipeStep, 'url_video' => $data['recipeUrlVideo'], 'time_food' => $data['timefood'], 'page_image' => $completePath, 'image_content' => $completePathSeo,
                'mobile_image' => $completePathMobile, 'dificult' => $data['recipeDificult']
            ]);
            if (isset($data['challenges'])) {
                $recipe->find($id)->course()->sync($data['challenges']);
            } else {
                $recipe->find($id)->course()->detach();
            }
            Session::flash('success_message', 'La Receta se Actualizo Correctamente');
            return redirect('dashboard/recipes');
        }


        $recipeDetail = Recipe::where('id', $id)->first();
        $courses = Course::all();
        $company = new Company;
        // dd(json_decode($recipeDetail-> steps));
        $companyData = $company->getCompanyInfo();
        return view('admin.recipes.edit_recipe')->with(compact('recipeDetail', 'courses', 'companyData'));
    }

    public function deleteRecipe($id)
    {
        Recipe::find($id)->delete();
        $message = 'La Receta se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect('dashboard/recipes');
    }
}
