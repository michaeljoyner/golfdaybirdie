<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Http\FlashMessages\Flasher;
use App\Http\Requests\CheckoutFormRequest;
use App\Http\Requests\ContactFormRequest;
use App\Mailing\AdminMailer;
use App\Orders\CartItemResolver;
use App\Stock\Category;
use App\Stock\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JavaScript;

class PagesController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;
    /**
     * @var CartItemResolver
     */
    private $cartItemResolver;

    public function __construct(Flasher $flasher, CartItemResolver $cartItemResolver)
    {
        $this->flasher = $flasher;
        $this->cartItemResolver = $cartItemResolver;
    }

    public function home()
    {
        $announcements = Announcement::getPick();
        $products = Product::promotedItems();
        $categories = Category::all();

        return view('front.pages.home')->with(compact('products', 'categories', 'announcements'));
    }

    public function about()
    {
        return view('front.pages.about');
    }

    public function category($slug)
    {
        $category = Category::with('products')->where('slug', $slug)->first();

        return view('front.pages.category')->with(compact('category'));
    }

    public function product($slug)
    {
        $product = Product::with('category', 'versions', 'sizes')->where('slug', $slug)->first();
        Javascript::put([
            'versions' => $product->versions,
            'sizes' => $product->sizes
        ]);
        return view('front.pages.product')->with(compact('product'));
    }

    public function showCheckout()
    {
        $orderedItems = $this->getOrderedItems();

        return view('front.pages.checkout')->with(compact('orderedItems'));
    }


    public function contact(ContactFormRequest $request, AdminMailer $mailer)
    {
        $mailer->sendContactMessage($request->only(['name', 'email', 'enquiry']));

        if($request->ajax()) {
            return response()->json('ok');
        }

        return redirect()->to('/');
    }

    private function getOrderedItems()
    {
        $cartItems = Cart::content();

        return $cartItems->map(function($item) {
            return $this->cartItemResolver->resolve($item);
        })->values()->all();
    }

}
