<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('front.checkout', [
            'cart_products' => Cart::getAll(),
        ]);
    }

    public function pay(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        
        $line_items = [];
        foreach(Cart::getAll() as $item)
        {
            $price_data = [];
            $price_data['currency'] = 'usd';
            $price_data['product_data'] = ['name' => $item->model->title];
            $price_data['unit_amount'] = $item->model->price;

            $item_data = array(
                'price_data' => $price_data,
                'quantity' => $item->qty
            );
            $line_items[] = $item_data;
        }
        $line_items[] = array(
            'price_data' => array(
                'currency' => 'usd', 
                'product_data' => ['name' => 'Tax'], 
                'unit_amount' => \Cart::tax(0, '', '')
            ),
            'quantity' => 1
        );

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => 'http://localhost:4242/success',
            'cancel_url' => 'http://localhost:4242/cancel',
        ]);

        return redirect($checkout_session->url);
    }
}
