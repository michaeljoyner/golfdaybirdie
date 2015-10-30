<?php

namespace App\Http\Controllers;

use App\Events\OrderWasReceived;
use App\Http\FlashMessages\Flasher;
use App\Http\Requests\CheckoutFormRequest;
use App\Orders\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function checkout(CheckoutFormRequest $request)
    {
        $order = Order::create($request->all());

        $order->attachImages($request->get('logo_images', []));

        $order->addItems(Cart::content());

        Cart::destroy();

        event(new OrderWasReceived($order));

        $this->flasher->success('Thank You!', 'We will be in touch to take care of your order soon.');

        return redirect('/');
    }
}
