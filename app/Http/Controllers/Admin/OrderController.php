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
        $orderDetail = Order::select('detail')->where('id', $id)->first();
        return $orderDetail;
    }

    public function updateOrderStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Pendiente') {
                $status = 2;
            } else {
                $status = 1;
            }
            Order::where('id', $data['order_id'])->update(['state_id' => $status]);
            return response()->json(['status' => $status, 'order_id' => $data['order_id']]);
        }
    }

    public function cancelOrder(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Pendiente') {
                $status = 2;
            } else {
                $status = 1;
            }
            Order::where('id', $data['order_id'])->update(['state_id' => $status]);
            return response()->json(['status' => $status, 'order_id' => $data['order_id']]);
        }
    }
}
