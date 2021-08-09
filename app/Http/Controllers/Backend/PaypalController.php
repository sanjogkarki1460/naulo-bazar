<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{
    //
    public function index()
    {
        return view('paypal');
    }
    public function checkout()
    {
        $provider = new ExpressCheckout();
        $data = [];
        $data['items'] = [
            [
                'name' => 'Product 1',
                'price' => 9.99,
                'qty' => 1
            ],
            [
                'name' => 'Product 2',
                'price' => 4.99,
                'qty' => 2
            ]
        ];
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = url('/checkout/success');
        $data['cancel_url'] = url('/paypal');
        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $data['total'] = $total;
        $response = $provider->setExpressCheckout($data);

        // Use the following line when creating recurring payment profiles (subscriptions)
        $response = $provider->setExpressCheckout($data, true);

        // This will redirect user to PayPal
        return redirect($response['paypal_link']);

    }
    public function checkoutSuccess(Request $request)
    {
       
    }
}
