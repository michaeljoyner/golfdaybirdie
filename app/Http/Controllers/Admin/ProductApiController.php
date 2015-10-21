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
        $products = Product::where('name', 'LIKE', '%'.$searchTerm.'%')->with('versions')->get()->toArray();
        $productsWithVariants = Product::whereHas('versions', function($query) use ($searchTerm) {
            $query->where('version_name', 'LIKE', '%'.$searchTerm.'%');
        })->with(['versions' => function($query) use ($searchTerm) {
            $query->where('version_name', 'LIKE', '%'.$searchTerm.'%');
        }])->get()->toArray();

        $extendedProducts = $this->flattenOutProducts($products);
        $extendedVariants = $this->flattenOutProducts($productsWithVariants, false);

        $all = array_merge($extendedProducts, $extendedVariants);

        return response()->json($all);
    }

    public function listProducts()
    {
        $products = Product::with('versions')->get()->toArray();

        $extendedProducts = $this->flattenOutProducts($products);


        return response()->json($extendedProducts);
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

    private function flattenOutProducts($products, $withBase = true)
    {
        $extendedProducts = [];
        foreach($products as $product) {
            if($withBase) {
                $base = $product;
                $base['versions'] = [];
                array_push($extendedProducts, $base);
            }
            foreach($product['versions'] as $version) {
                $versioned = $product;
                $versioned['versions'] = [$version];
                array_push($extendedProducts, $versioned);
            }
        }

        return $extendedProducts;
    }
}
