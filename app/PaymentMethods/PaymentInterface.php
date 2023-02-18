<?php 

namespace App\PaymentMethods;
use Illuminate\Http\Request;

interface PaymentInterface {
    public function pay(Request $request);
}