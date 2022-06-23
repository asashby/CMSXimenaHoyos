<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Session;
use App\Company;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ProductController extends Controller
{
    private $mediaCollection = 'photos';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'products');
        $products = Product::get();
        $mediaCollection = $this->mediaCollection;
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.products.products', compact('products', 'companyData', 'mediaCollection'));
    }

    public function addProduct(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();

            $product = new Product;

            /* echo '<pre>';
            print_r($data);
            die;*/

            $product->name = $data['productTitle'];
            $product->slug = Str::slug($data['productTitle']);
            $product->category_id = $data['productCategory'];
            $product->attributes = $data['attributes'] ?? '[]';
            $product->description = $data['productResume'];
            $product->price = $data['productPrice'];
            $product->save();

            foreach ($request->input('photo', []) as $file) {
                $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }

            Session::flash('success_message', 'El Producto se creo Correctamente');
            return redirect('dashboard/products');
        }

        $categories = Category::get();

        $categories_drop_down = "<option disabled>Select</option>";
        foreach ($categories as $category) {
            $categories_drop_down .= "<option value='" . $category->id . "'>" . $category->title . "</option>";
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.products.add_product')->with(compact('categories_drop_down', 'companyData'));
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

    public function editProduct(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();

            /*echo '<pre>';
            print_r($data);
            die;*/


            $product = Product::with('photos')->find($id);


            if ($request->hasFile('productBannerMobile')) {
                $image_tmp = $request->file('productBannerMobile');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/products/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathMobile = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentProductBannerMobile'])) {
                $completePathMobile = $data['currentProductBannerMobile'];
            } else {
                $completePathMobile = '';
            }

            if ($request->hasFile('productContent')) {
                $image_tmp = $request->file('productContent');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'images/admin_images/products/' . $fileName;
                    Image::make($image_tmp)->save($large_image_path);
                    $completePathSeo = env('URL_DOMAIN') . '/' . $large_image_path;
                }
            } else if (!empty($data['currentProductContent'])) {
                $completePathSeo = $data['currentProductContent'];
            } else {
                $completePathSeo = '';
            }

            if (is_null($data['attributes'])) {
                $productNutritionalFacts = $data['currentAttributesProduct'];
            } else {
                $productNutritionalFacts = $data['attributes'];
            }

            $product->name = $data['productTitle'];
            $product->slug = Str::slug($data['productTitle']);
            $product->category_id = $data['productCategory'] ?? 1;
            $product->attributes = $data['attributes'] ?? '[]';
            $product->description = $data['productResume'];
            $product->price = $data['productPrice'];
            $product->update();

            /* $product->update([
                'name' => $data['productTitle'], 'slug' => Str::slug($data['productTitle']), 'category_id' => $data['productCategory'], 'description' => $data['productResume'], 'price' => $data['productPrice'],
                'attributes' => $data['attributes']
            ]);
 */
            if (count($product->photos) > 0) {
                foreach ($product->photos as $media) {
                    if (!in_array($media->file_name, $request->input('photos', []))) {
                        $media->delete();
                    }
                }
            }

            $media = $product->photos->pluck('file_name')->toArray();

            foreach ($request->input('photos', []) as $file) {
                if (count($media) === 0 || !in_array($file, $media)) {
                    $product->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
                }
            }

            /* if (isset($data['challenges'])) {
                $product->find($id)->course()->sync($data['challenges']);
            } else {
                $product->find($id)->course()->detach();
            } */
            Session::flash('success_message', 'La Receta se Actualizo Correctamente');
            return redirect('dashboard/products');
        }

        $productDetail = Product::find($id);
        $categories = Category::all();
        $photos = $productDetail->getMedia($this->mediaCollection);
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.products.edit_product')->with(compact('productDetail', 'companyData', 'photos', 'categories'));
    }


    public function deleteProduct($id)
    {
        Product::find($id)->delete();
        $message = 'El Producto se Elimino correctamente';
        Session::flash('success_message', $message);
        return redirect('dashboard/products');
    }
}
