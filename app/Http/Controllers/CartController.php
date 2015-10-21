<?php

namespace App\Http\Controllers;

use JavaScript;
use App\Orders\CartItemResolver;
use App\Stock\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * @var CartItemResolver
     */
    private $itemResolver;

    public function __construct(CartItemResolver $itemResolver)
    {
        $this->itemResolver = $itemResolver;
    }

    public function add(Request $request)
    {
        $product = Product::with('versions', 'sizes')->findOrFail($request->id);
        $itemId = $this->generateItemId($request);
        $itemName = $this->getCartItemName($product, $request);
        $itemImages = $this->getItemImages($product, $request->get('version', null));
        $size = '';
        if($request->get('size', null)) {
            $sizeModel = $product->sizes()->findOrFail($request->get('size'));
            $size = $sizeModel->size;
        }
        Cart::add($itemId, $itemName, intval($request->quantity), 0.00, ['size' => $size, 'images' => $itemImages]);

        return response()->json([
            'id' => $itemId,
            'name' => $itemName,
            'quantity' => $request->quantity,
            'size' => $size
        ]);
    }

    private function getCartItemName($product, $request)
    {
        if(! $request->get('version', null)) {
            return $product->name;
        }
        $version = $product->versions->where('id', $request->version)->first();

        return $product->name . ' - ' . $version->version_name;
    }

    private function getItemImages($product, $versionId)
    {
        if(! $versionId) {
            return [
                'thumb' => $product->smallestImageSrc(),
                'original' => $product->imageSrc()
            ];
        }

        $version = $product->versions()->findOrFail($versionId);

        return [
            'thumb' => $version->smallestImageSrc(),
            'original' => $version->imageSrc(),
        ];
    }

    public function getItemCount()
    {
        $items = Cart::count();
        $products = Cart::count(false);
        return response()->json(['summary' => [
            'products' => $products,
            'items' => $items
        ], 'empty' => $items + $products]);
    }

    public function showCart()
    {
        $items = Cart::content();
        $cartItems = $items->map(function($item) {
            return $this->itemResolver->resolve($item);
        })->values();


        Javascript::put([
            'items' => $cartItems
        ]);

        return view('front.pages.cart')->with(compact('cartItems'));
    }

    public function updateRow(Request $request, $rowId)
    {
        $qty = $request->item['quantity'];
        Cart::update($rowId, $qty);
        return response()->json('ok');
    }

    public function removeItem($rowId)
    {
        $result = Cart::remove($rowId);
        return response()->json('ok');
    }

    private function generateItemId($request)
    {
        $ids = [
            $request->id,
            $request->get('version', null) ? $request->version : 0,
            $request->get('size', null) ? $request->size : 0
        ];

        return implode('_', $ids);
    }
}
