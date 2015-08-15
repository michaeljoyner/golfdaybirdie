<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessages\Flasher;
use App\Http\Requests\ProductFormRequest;
use App\Stock\Category;
use App\Stock\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function index()
    {
        $products = Product::all();

        return view('admin.products.index')->with(compact('products'));
    }

    public function create()
    {
        $product = new Product();

        return view('admin.products.create')->with(compact('product'));
    }

    public function store(ProductFormRequest $request)
    {
        $category = $this->getParentCategory();

        $category->products()->create($request->all());

        $this->flasher->success('Product Added', 'Growth and expansion - good signs');

        return redirect()->to('/admin/products');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.edit')->with(compact('product'));
    }

    public function update(ProductFormRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        $this->flasher->success('Product Updated', 'Good job, applaud yourself.');

        return redirect()->to('/admin/products');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        $this->flasher->success('Product Deleted', 'What comes must eventually go. This is the circle of life');

        return redirect()->to('/admin/products');
    }

    /**
     * @return mixed
     */
    private function getParentCategory()
    {
        $category = Category::where('name', 'default')->first();

        if(! $category) {
            $category = Category::create([
                'name' => 'default',
                'description' => 'default'
            ]);
        }

        return $category;
    }
}
