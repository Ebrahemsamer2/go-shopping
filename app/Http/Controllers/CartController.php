<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Models\Cart;

class CartController extends Controller
{
    public function addToCart(AddToCartRequest $request)
    {
        return Cart::add( $request );
    }
}
