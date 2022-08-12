<?php

namespace App\Http\Controllers\Api;

use App\Order;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
                $order->shipping = $request->shipping ?? (object)[];
                $order->cost_shipping = $request->cost_shipping;
                $order->total = $request->total ?? 0.0;
                $emailUser = $order->shipping->email ?? $user->email;
                $orderIsSaved = $order->save();
                if ($orderIsSaved) {
                    Mail::send('emails.confirmOrder', [
                        'user' => $user,
                        'dataOrder' => $order->detail,
                        'orderId' =>  $order->id,
                        'price' => $order->total,
                        'dateOrder' => fecha_string(),
                        'shipping' => $order->cost_shipping ?? 0
                    ], function (Message $message) use ($emailUser) {
                        $message->to($emailUser);
                        $message->bcc('patriciapajaresr@gmail.com');
                        $message->subject('Compra Exitosa');
                    });
                    return response()->json([
                        'status' => 200,
                        'message' => 'Compra Exitosa',
                        'order_number' => $order->id,
                    ], 200);
                }
                return response()->json([
                    'status' => 400,
                    'message' => 'Algo salio mal',
                ], 400);
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
                return OrderResource::collection(Order::query()->where('user_id', $user->id)->paginate($limit));
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
