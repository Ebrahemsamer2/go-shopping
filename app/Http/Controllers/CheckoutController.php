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

        // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        
        // $line_items = [];
        // $orderPrice = 0;
        // $product_ids = [];

        // foreach(Cart::getAll() as $item)
        // {
        //     $qty = $item->qty;

        //     $price_data = [];
        //     $price_data['currency'] = 'usd';
        //     $price_data['product_data'] = ['name' => $item->model->title];
        //     $price_data['unit_amount'] = $item->model->price;

        //     $item_data = array(
        //         'price_data' => $price_data,
        //         'quantity' => $qty,
        //     );
        //     $line_items[] = $item_data;

        //     while($qty) {
        //         $orderPrice += $item->price;
        //         $product_ids[] = array('product_id' => $item->model->id);
        //         $qty--;
        //     }
        // }

        // if(count($product_ids) === 0) {
        //     abort(500);
        // }

        // $line_items[] = array(
        //     'price_data' => array(
        //         'currency' => 'usd', 
        //         'product_data' => ['name' => 'Tax'], 
        //         'unit_amount' => \Cart::tax(0, '', '')
        //     ),
        //     'quantity' => 1
        // );

        // $orderPrice += \Cart::tax(0, '', '');
        
        // // inserting a new order for this session
        // $order = Order::createWithOrderItems($orderPrice, $request, $product_ids);

        // $checkout_session = $stripe->checkout->sessions->create([
        //     'line_items' => $line_items,
        //     'mode' => 'payment',
        //     'success_url' => route('success_payment', $order),
        //     'cancel_url' => route('cancelled_payment', $order),
        // ]);

        // return redirect($checkout_session->url);
    }
}
