<?php

namespace App\Http\Controllers\Admin;

use App\Company;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('page', 'categories');
        $categories = Category::get();
        $company = new Company();
        $companyData = $company->getCompanyInfo();
        return view('admin.categories.categories', compact('categories', 'companyData'));
    }

    public function addCategory(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $category = new Category;

            $category->name = $data['categoryTitle'];
            $category->description = $data['categoryResume'];
            $category->save();
            Session::flash('success_message', 'La categoria se creo Correctamente');
            return redirect('dashboard/categories');
        }
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.categories.add_category')->with(compact('companyData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editCategory(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $data = $request->all();

            $category = Category::find($id);

            $category->update([
                'title' => $data['categoryTitle'], 'description' => $data['categoryResume']
            ]);

            Session::flash('success_message', 'La categoria se Actualizo Correctamente');
            return redirect('dashboard/categories');
        }
        $categoryDetail = Category::find($id);
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.categories.edit_category')->with(compact('categoryDetail', 'companyData'));
    }

    public function deleteCategory($id)
    {
        Category::find($id)->delete();
        $message = 'La Categoria se elimino correctamente';
        Session::flash('success_message', $message);
        return redirect('dashboard/categories');
    }
}
