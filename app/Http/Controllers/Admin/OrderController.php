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
        $orders = Order::query()->with('user')->get();
        $company = new Company;
        $companyData = $company->getCompanyInfo();
        return view('admin.orders.orders', compact('orders', 'companyData'));
    }

    public function detail($id)
    {
        return Order::query()->select('detail')->where('id', $id)->first();
    }

    public function changeOrderState(Request $request)
    {
        $order = Order::query()->findOrFail($request->input('id'));
        if (array_key_exists($request->input('state_id'), Order::STATES)) {
            $order->state_id = $request->input('state_id');
            $order->save();
        }
        return redirect()->route('orders.index');
    }
}
