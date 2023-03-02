<?php 

namespace App\PaymentMethods;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use App\Models\Cart;
use App\Models\Order;

class Paypal implements PaymentInterface
{
    public function pay(Request $request)
    {
        $orderPrice = 0;
        $product_ids = [];

        foreach(Cart::getAll() as $item)
        {
            $qty = $item->qty;
            while($qty) {
                $orderPrice += $item->price;
                $product_ids[] = array('product_id' => $item->model->id);
                $qty--;
            }
        }

        if(count($product_ids) === 0) {
            abort(500);
        }

        $orderPrice += \Cart::tax(0, '', '');

        // inserting a new order for this session
        $order = Order::createWithOrderItems($orderPrice, $request, $product_ids);

        $orderPrice /= 100;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success_payment', $order),
                "cancel_url" => route('cancelled_payment', $order),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "$orderPrice"
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
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

    public function successTransaction(Request $request, $order)
    {
        dd("Success");

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('success_payment', $order)
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('checkout')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        dd("Cancelled");

        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}