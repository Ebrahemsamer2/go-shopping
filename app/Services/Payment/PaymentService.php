<?php 

namespace App\Services\Payment;
use App\Http\Requests\Checkout\CheckoutRequest;
use Illuminate\Http\Request;
use App\Models\Order;

abstract class PaymentService
{
    public abstract function pay(CheckoutRequest $request);
    public abstract function paymentsuccess(Order $order, Request $request);
}