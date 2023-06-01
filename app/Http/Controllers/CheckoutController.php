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
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                $order->updateStatus(Order::COMPLETED_ORDER_STATUS);
                return view("front.order.success_payment", ['order' => $order]);
            } else {
                return $this->paymentCancel($order);
            }
        }
        $order->updateStatus(Order::COMPLETED_ORDER_STATUS);
        return view("front.order.success_payment", ['order' => $order]);
    }
}
