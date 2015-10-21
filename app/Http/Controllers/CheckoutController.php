<?php

namespace App\Http\Controllers;

use App\Orders\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $order = Order::create($request->all());

        $order->addItems(Cart::content());

        Cart::destroy();

        return redirect('/');
    }
}
