<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    public  function createOrder(Request $request)
    {
        try {
            $user = Auth::user();
            if ($user) {
                $order = new Order();
                $order->user_id = $user->id;
                $order->origin = $request->origin ?? "";
                $order->detail = $request->line_items ?? [];
                $order->cost_shipping = $request->cost_shipping;
                $order->total = $request->total ?? 0.0;
                $order->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'Compra Exitosa',
                    'order_number' => $order->id,
                ], 200);
            }
            return response()->json([
                'status' => 400,
                'message' => 'Usuario no Existe',
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 'ERROR_REQUEST',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function OrdersByUser(Request $request)
    {
        try {
            $user = Auth::user();
            if ($user) {
                $limit = $request->get('limit') ?? 10;
                $ordersUser = User::find($user->id)->orders()->paginate($limit);
                return $ordersUser;
            }
            return response()->json([
                'status' => 400,
                'message' => 'Usuario no Existe',
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'code' => 'ERROR_REQUEST',
                'statusCode' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
