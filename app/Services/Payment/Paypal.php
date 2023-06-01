<?php 

namespace App\Services\Payment;
use App\Http\Requests\Checkout\CheckoutRequest;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use App\Models\Cart;
use App\Models\Order;

class Paypal extends PaymentService
{
    public function pay(CheckoutRequest $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $orderPrice = 0;
        $product_ids = [];
        $products_items = [];
        foreach(Cart::getAll() as $item)
        {
            $qty = $item->qty;
            $item_price = $item->model->netPrice() / 100;
            $amount = array(
                "reference_id" => $item->model->id . '-' . $item->model->slug,
                "title" => $item->model->title,
                "amount" => [
                    "currency_code" => "USD",
                    "value" => $item_price
                ]
            );
            $products_items[] = $amount;
            while($qty) {
                $orderPrice += $item->price;
                $product_ids[] = array('product_id' => $item->model->id);
                $qty--;
            }
        }
        $tax = \Cart::tax(0, '', '');
        $orderPrice += $tax;
        $order = Order::createWithOrderItems($orderPrice, $request, $product_ids);

        $tax /= 100;
        $products_items[] = array(
            "reference_id" => 'tax',
            "amount" => [
                "currency_code" => "USD",
                "value" => $tax
            ]
        );

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('checkout.success_payment', $order),
                "cancel_url" => route('checkout.cancelled_payment', $order),
            ],
            "purchase_units" => $products_items
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('checkout')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('checkout')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function paymentSuccess(Order $order, Request $request) {
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
}