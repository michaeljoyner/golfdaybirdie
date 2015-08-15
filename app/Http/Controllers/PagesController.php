<?php

namespace App\Http\Controllers;

use App\Http\FlashMessages\Flasher;
use App\Http\Requests\CheckoutFormRequest;
use App\Mailing\AdminMailer;
use App\Quotes\QuoteProduct;
use App\Quotes\QuoteRequest;
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

    public function handleCheckout(CheckoutFormRequest $request, AdminMailer $mailer)
    {
        $cartContents = Cart::content();
        Cart::destroy();

        $packagingOptions = [
            'packaging_A' => $request->has('packaging_A') ? 1 : 0,
            'packaging_B' => $request->has('packaging_B') ? 1 : 0
        ];

        $requestFields = $request->only(['name', 'email', 'phone', 'address', 'enquiry']);

        $quoteRequest = QuoteRequest::create(array_merge($requestFields, $packagingOptions));

        $requestedProducts = $this->getProductsFromRequest($cartContents, $request);
        foreach($requestedProducts as $productRequest) {
            $quoteRequest->products()->create($productRequest);
        }

        if($request->has('logo_images')) {
            $images = $request->get('logo_images');
            foreach($images as $image) {
                $quoteRequest->images()->create(['image_path' => $image]);
            }
        }

        $newQuoteRequest = QuoteRequest::with('products', 'images')->find($quoteRequest->id);

        $mailer->notifyOfQuoteRequest($newQuoteRequest);

        $this->flasher->success('Thank You!', 'Thanks for your order. We will be in touch soon.');

        return redirect()->to('/');
    }

    private function getProductsFromRequest($cartContents, $request)
    {
        $productRequests = [];

        foreach($cartContents as $item) {
            $productRequests[] = [
                'product_name' => $item->name,
                'quantity' => $request->get('product_'.$item->id)
            ];
        }
        return $productRequests;
    }
}
