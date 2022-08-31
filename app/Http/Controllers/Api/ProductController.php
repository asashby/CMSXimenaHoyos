<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->get('limit');
        $category = $request->get('categoryId');
        $search = $request->get('search');
        $limit = !empty($limit) && is_numeric($limit) ? $limit : 10;
        $product = Product::query()->with('categories:id,name')
            ->when($request->filled('is_active'), fn (Builder $query) => $query->where('is_active', $request->input('is_active') == 'true'))
            ->when($request->filled('in_stock') && $request->input('in_stock') == 'true', fn (Builder $query) => $query->where('stock', '>', 0))
            ->search($search)->category($category)
            ->orderBy('created_at')->paginate($limit);

        return $product;
    }

    public function productDetail($id)
    {
        $product = Product::find($id);
        $product->images = array_map(function ($item) {
            return env('APP_URL') . "/storage/" . $item['id'] . "/" . $item['file_name'];
        }, $product->getMedia()->toArray());
        unset($product->media);

        return $product;
    }
}
