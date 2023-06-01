<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;

use App\Http\Requests\Checkout\CheckoutRequest;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use App\Services\Payment\Paypal;
use App\Services\Payment\Stripe;
use App\Services\Payment\PaymentService;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('front.checkout', [
            'cart_products' => Cart::getAll(),
        ]);
    }

    public function handlePayment(CheckoutRequest $request, PaymentService $payment_service)
    {
        return $payment_service->pay($request);   
    }

    public function paymentCancel(Order $order) {
        $order->updateStatus(Order::CANCELLED_ORDER_STATUS);
        return view("front.order.cancelled_payment", ['order' => $order]);
    }

    public function paymentSuccess(Order $order, Request $request) {
        if(strtoupper($order->payment_method) === Order::PAYPAL_PAYMENT_METHOD) {
            $payment_service = new Paypal();
        } else {
            $payment_service = new Stripe();
        }
        return $payment_service->paymentSuccess($order, $request);
    }
}
