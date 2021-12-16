<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recipe;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->get('limit');
        $timefood = $request->get('time');
        $search = $request->get('search');
        $limit = !empty($limit) && is_numeric($limit) ? $limit : 10;
        $recipes = Recipe::orderByDesc('published_at')->time($timefood)->title($search)->paginate($limit);
        return $recipes;
    }

    public function detailRecipe($slug)
    {
        $recipeInfo = Recipe::where('slug', $slug)->first();
        $recipeInfo->ingredients =  $recipeInfo->ingredients;
        $recipeInfo->nutritional_facts = $recipeInfo->nutritional_facts;
        $recipeInfo->steps = $recipeInfo->steps;
        return $recipeInfo;
    }
}
