<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\PaymentMethods\PaymentInterface;

use App\Http\Requests\Checkout\CheckoutRequest;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('front.checkout', [
            'cart_products' => Cart::getAll(),
        ]);
    }

    public function store(CheckoutRequest $request, PaymentInterface $payment_gateway)
    {
        return $payment_gateway->pay($request);
    }
}
