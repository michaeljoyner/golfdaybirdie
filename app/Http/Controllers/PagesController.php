<?php

namespace App\Http\Controllers;

use App\Http\FlashMessages\Flasher;
use App\Http\Requests\CheckoutFormRequest;
use App\Http\Requests\ContactFormRequest;
use App\Mailing\AdminMailer;
use App\Quotes\QuoteProduct;
use App\Quotes\QuoteRequest;
use App\Quotes\QuoteRequestRepo;
use App\Stock\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function home()
    {
        $products = Product::all();

        return view('front.pages.home')->with(compact('products'));
    }

    public function showCheckout()
    {
        $items = Cart::content();
        $ids = [];
        foreach($items as $item) {
            $ids[] = $item->id;
        }
        $products = Product::find($ids);
        return view('front.pages.checkout')->with(compact('products'));
    }

    public function handleCheckout(CheckoutFormRequest $request, QuoteRequestRepo $quoteRequestRepo)
    {
        $cartContents = $this->emptyCart();

        $quoteRequestRepo->store($request, $cartContents);

        $this->flasher->success('Thank You!', 'Thanks for your order. We will be in touch soon.');

        return redirect()->to('/');
    }

    public function contact(ContactFormRequest $request, AdminMailer $mailer)
    {
        $mailer->sendContactMessage($request->only(['name', 'email', 'enquiry']));

        if($request->ajax()) {
            return response()->json('ok');
        }

        return redirect()->to('/');
    }

    private function emptyCart()
    {
        $contents = Cart::content();
        Cart::destroy();

        return $contents;
    }
}
