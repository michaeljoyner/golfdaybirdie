<?php

namespace App\Http\Controllers;

use JavaScript;
use App\Orders\OrderItemResolver;
use App\Stock\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * @var OrderItemResolver
     */
    private $itemResolver;

    public function __construct(OrderItemResolver $itemResolver)
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

    public function remove($itemId)
    {
        $id = intval($itemId);

        $rowId = Cart::search(['id' => $id]);
        $item = Cart::get($rowId[0]);
        Cart::remove($rowId[0]);


        return response()->json([
            'id' => $item->id,
            'name' => $item->name
        ]);
    }

    public function getContents(Request $request, $timestamp)
    {
        if(! $request->ajax()) {
            return response('invalid request', 403);
        }

        $items = [];

        $contents = Cart::content();
        foreach($contents as $item) {
            $items[] = $item;
        }

        return response()->json($items);
    }

    public function viewCart()
    {
        $contents = Cart::content();

        return view('front.testcheckout')->with(compact('contents'));
    }

    public function destroy(Request $request)
    {
        Cart::destroy();

        if($request->ajax()) {
            return response()->json('ok');
        }

        return redirect()->to('/checkout');
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

    public function removeItem($rowId)
    {
        $result = Cart::remove($rowId);
        return response()->json('ok');
    }
}
