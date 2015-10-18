<?php

namespace App\Http\Controllers\Admin;

use App\Stock\Product;
use App\Stock\Size;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductApiController extends Controller
{
    public function search($searchTerm)
    {
        $products = Product::where('name', 'LIKE', '%'.$searchTerm.'%')->get()->toArray();
        $productsWithVariants = Product::whereHas('versions', function($query) use ($searchTerm) {
            $query->where('version_name', 'LIKE', '%'.$searchTerm.'%');
        })->with('versions')->get()->toArray();

        $all = array_merge($products, $productsWithVariants);

        return $all;
    }

    public function listProducts()
    {
        $products = Product::all();
        $productsWithVariants = Product::has('versions')->with('versions')->get();
//        $all = collect(array_merge($products, $productsWithVariants));
        $productsWithVariants->each(function($item) use ($products) {
            $products->push($item);
        });
        $sorted = $products->sortBy('id');
        $sorted = $sorted->values()->all();
        return $sorted;
    }

    public function getProductSizes($productId)
    {
        $product = Product::findOrFail($productId);

        $sizes = $product->sizes->map(function($size) {
            return $size->size;
        });
        return response()->json($sizes);
    }

    public function syncProductSizes(Request $request, $productId)
    {

        $posted_sizes = $this->getPostedSizes($request);
        $this->createNewSizes($posted_sizes);

        $product = Product::findOrFail($productId);
        $product->sizes()->sync($this->getSizeIds($posted_sizes));

        return response()->json($product->sizes->lists('size')->toArray());
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getPostedSizes(Request $request)
    {
        $posted_sizes = array_map(function ($item) {
            return mb_strtolower($item);
        }, $request->get('sizes'));

        return $posted_sizes;
    }

    /**
     * @return array
     */
    private function getAllSizes()
    {
        $sizes = Size::all()->lists('size')->map(function ($item) {
            return mb_strtolower($item);
        })->toArray();

        return $sizes;
    }

    private function createNewSizes($posted_sizes)
    {
        $new_sizes = array_diff($posted_sizes, $this->getAllSizes());
        foreach($new_sizes as $new_size) {
            Size::create(['size' => $new_size]);
        }
    }

    /**
     * @param $posted_sizes
     */
    private function getSizeIds($posted_sizes)
    {
        return Size::whereIn('size', $posted_sizes)->get()->lists('id')->toArray();
    }
}
