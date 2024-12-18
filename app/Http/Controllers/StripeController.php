<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }
 
    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
 
        $orderNum = time();
        $productname = $request->get('productDetails');
        $totalprice = $request->get('total');
        $two0 = "00";
        $total = "$totalprice$two0";

             // order entry

        DB::table('orders')->insert([
            'order_number' =>$orderNum,
           'total_amount' => $totalprice,
           'payment_method' => 'paypal'
        ]);

        // order Details entry

            foreach (session()->get('cart')as $key => $val){
                // dd($val['name']);

                DB::table('order_details')->insert([
                    'order_number' =>$orderNum,
                   'book_id' => $key,
                   'quantity' => $val['quantity'],
                   'price' => $val['price'],
                ]);
        
            };
 
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'USD',
                        'product_data' => [
                            "name" => $productname,
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],
                 
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('shopping.checkout'),
        ]);

        session()->get('cart');
        return redirect()->away($session->url);
    }
 
    public function success()
    {
        return view('success');
    }

    // public function productOrder()
    // {
    //     $cart = session()->get('cart');
    // //    echo  $cart->name;
    //     // dd($cart);


    //     // DB::table('order');
    // }
}
