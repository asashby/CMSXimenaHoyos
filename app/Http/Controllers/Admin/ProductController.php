<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Company;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'products');
        $products = Product::all();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.products.products', compact('products', 'companyData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();

        $categories_drop_down = "<option disabled>Select</option>";
        foreach ($categories as $category) {
            $categories_drop_down .= "<option value='" . $category->id . "'>" . $category->name . "</option>";
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.products.add_product', compact('categories_drop_down', 'companyData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        $product = Product::create([
            'name' => $request->productTitle,
            'slug' => Str::slug($request->productTitle),
            'url_image' => $this->loadFile($request, 'productImage', 'products/images', 'products_images'),
            'attributes' => $request->attributes ?? [],
            'description' => $request->productResume,
            'sku' => $request->productSku ?? '',
            'price' => $request->productPrice,
        ]);

        $product->categories()->sync($request->categories ?? []);

        if ($request->has('photo')) {
            foreach ($request->input('photo', []) as $file) {
                $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection();
            }
        }

        Session::flash('success_message', 'El Producto se creo Correctamente');
        return redirect()->route('products.index');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $photos = $product->getMedia();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        $categoriesProduct = $product->categories()->pluck('categories.id')->toArray();
        $categories = Category::get();
        $categories_drop_down = "<option disabled>Select</option>";
        foreach ($categories as $category) {
            if (in_array($category->id, $categoriesProduct)) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_drop_down .= "<option value='" . $category->id . "'>" . $category->name . "</option>";
        }
        return view('admin.products.edit_product', compact('product', 'companyData', 'photos', 'categories_drop_down'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update([
            'name' => $request->productTitle,
            'slug' => Str::slug($request->productTitle),
            'url_image' => $this->loadFile($request, 'productImage', 'products/images', 'products_images'),
            'attributes' => $request->attributes ?? [],
            'sku' => $request->productSku,
            'description' => $request->productResume,
            'price' => $request->productPrice,
        ]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        $message = 'EL producto se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect()->route('products.index');
    }
}
