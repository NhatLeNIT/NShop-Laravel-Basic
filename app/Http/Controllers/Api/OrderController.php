<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\OrderDetail;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $result = true;
        $code_order = 'DH' . time();
        $order = new Order();
        $order->code_order = $code_order;
        if($request->user_id != 0)
            $order->id_user = $request->user_id;
        $order->receiver_name = $request->receiver_name;
        $order->receiver_phone = $request->receiver_phone;
        $order->receiver_address = $request->receiver_address;
        if($request->note != "")
            $order->note = $request->note;
        $order->created_at = new DateTime();

        if ($order->save()) {
            $details = $request->details;
            foreach ($details as $item) {
                $orderDetail = new OrderDetail();
                $orderDetail->id_order = $order->id;
                $orderDetail->id_product = $item['product_id'];
                $orderDetail->quantity = $item['quantity'];
                $orderDetail->price = $item['price'];
                if (!$orderDetail->save()) $result = false;
            }
        } else $result = false;
        if ($result)
            return response()->json(["result" => true], 200);
        return response()->json(["result" => false], 422);
    }
}
