<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Order;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        Session::put('page', 'orders');
        $orders = Order::query()->with('user')->latest()->get();
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
        $newStateId = $request->input('state_id', $order->state_id);
        if (array_key_exists($newStateId, Order::STATES)) {
            $oldStateId = $order->state_id;
            if ($newStateId != $oldStateId) {
                $factor = 0;
                if (
                    in_array($oldStateId, [Order::CANCELADO, Order::PENDIENTE])
                    && in_array($newStateId, [Order::ENTREGADO])
                ) {
                    $factor = -1;
                } elseif (in_array($oldStateId, [Order::ENTREGADO])) {
                    $factor = 1;
                }
                foreach ($order->detail as $orderDetailValue) {
                    $quantity = bcmul($factor, $orderDetailValue->count);
                    Product::query()
                        ->where('id', $orderDetailValue->product_id)
                        ->update([
                            'stock' => DB::raw("stock + $quantity")
                        ]);
                }

                $order->state_id = $newStateId;
                $order->save();
            }
        }
        return redirect()->route('orders.index');
    }
}
