<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\UpdateCartRequest;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('front.cart', [
            'cart_products' => Cart::getAll()
        ]);
    }

    public function addToCart(AddToCartRequest $request)
    {
        return Cart::add( $request );
    }

    public function updateCart( UpdateCartRequest $request )
    {
        return Cart::updateCart( $request );
    }

    public function removeFromCart(Request $request)
    {
        return Cart::remove( $request->rowId, $request->cart_type);
    }
}
