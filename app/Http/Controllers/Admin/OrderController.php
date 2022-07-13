<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Order;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        Session::put('page', 'orders');
        $orders = Order::with('user')->get();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.orders.orders', compact('orders', 'companyData'));
    }

    public function detail($id)
    {
        $orderDetail = Order::select('detail')->where('id', $id)->first();
        return $orderDetail;
    }
}
