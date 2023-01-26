<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function successPayment(Order $order) {
        if($order->updateStatus(Order::COMPLETED_ORDER_STATUS)) {
            return view('front.order.success_payment', [
                'order' => $order
            ]);
        }
        abort(500);
    }

    public function cancelledPayment(Order $order) {
        if($order->updateStatus(Order::CANCELLED_ORDER_STATUS)) {
            return view('front.order.cancelled_payment', [
                'order' => $order
            ]);
        }
        abort(500);
    }
}
