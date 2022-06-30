<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Order;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class orderController extends Controller
{
    public  function createOrder(Request $request)
    {
        try {
            $user = Auth::user();
            $emailUser = $user->email;
            if ($user) {
                $order = new Order();
                $order->user_id = $user->id;
                $order->origin = $request->origin ?? "";
                $order->detail = $request->line_items ?? [];
                $order->shipping = $request->shipping ?? [];
                $order->cost_shipping = $request->cost_shipping;
                $order->total = $request->total ?? 0.0;
                $order->save();
                if ($order) {
                    Mail::send('emails.confirmOrder', ['user' => $user, 'dataOrder' => $request->line_items, 'orderId' =>  $order->id, 'price' => $request->total, 'dateOrder' => fecha_string(), 'shipping', $request->cost_shipping ?? 0], function ($message) use ($emailUser) {
                        $message->to($emailUser);
                        $message->subject('Compra Exitosa');
                    });
                }
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
