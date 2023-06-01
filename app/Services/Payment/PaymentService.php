<?php 

namespace App\Services\Payment;
use App\Http\Requests\Checkout\CheckoutRequest;

abstract class PaymentService
{
    public abstract function pay(CheckoutRequest $request); 
}