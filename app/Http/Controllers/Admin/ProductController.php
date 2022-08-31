<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Company;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        Session::put('page', 'products');
        $products = Product::all();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.products.products', compact('products', 'companyData'));
    }

    public function create()
    {
        $company = new Company;
        $companyData = $company->getCompanyInfo();

        $categories = Category::get();
        $product = new Product();
        return view('admin.products.add_product', compact('categories', 'companyData', 'product'));
    }

    public function store(ProductRequest $request)
    {
        $product = new Product($request->validated());
        $product->slug = Str::slug($product->name);
        $product->attributes = $request->input('attributes', []);
        $product->description = htmlspecialchars_decode(e($request->description));
        $product->is_active = $request->filled('is_active');
        if ($request->hasFile('productImage')) {
            $product->url_image = $this->loadFile($request, 'productImage', 'products/images', 'products_images');
        }
        $product->save();
        $product->categories()->sync($request->input('categories', []));
        if ($request->has('photo')) {
            foreach ($request->input('photo', []) as $file) {
                $product->addMedia(storage_path("tmp/uploads/$file"))->toMediaCollection();
            }
        }

        return redirect()->route('products.index')->with('success_message', 'El Producto se creo Correctamente');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function edit(int $productId)
    {
        $product = Product::query()->with(['categories'])
            ->findOrFail($productId);
        $photos = $product->getMedia();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        $categories = Category::all();
        return view('admin.products.edit_product', compact('product', 'companyData', 'photos', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->fill($request->validated());
        $product->slug = Str::slug($product->name);
        $product->attributes = $request->input('attributes', []);
        $product->description = htmlspecialchars_decode(e($request->description));
        $product->is_active = $request->filled('is_active');
        if ($request->hasFile('productImage')) {
            if ($product->url_image) {
                $this->destroyFile($product->url_image);
            }
            $product->url_image = $this->loadFile($request, 'productImage', 'products/images', 'products_images');
        }
        $product->save();
        if (count($product->getMedia()) > 0) {
            foreach ($product->getMedia() as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $product->categories()->sync($request->categories ?? []);

        $media = $product->getMedia()->pluck('file_name')->toArray();

        if ($request->has('photo')) {
            foreach ($request->input('photo', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection();
                }
            }
        }
        Session::flash('success_message', 'El Producto se edito Correctamente');
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        Product::query()->find($id)->delete();
        $message = 'EL producto se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('products.index');
    }
}
