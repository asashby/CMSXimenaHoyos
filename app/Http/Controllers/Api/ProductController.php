<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->get('limit');
        $category = $request->get('categoryId');
        $search = $request->get('search');
        $limit = !empty($limit) && is_numeric($limit) ? $limit : 10;
        $product = Product::with('categories:id,name')->category($category)->orderBy('created_at')->paginate($limit);

        return $product;
    }

    public function productDetail($id)
    {
        $product = Product::with('images')->find($id);
        return $product;
    }
}
