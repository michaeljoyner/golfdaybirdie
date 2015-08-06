<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductFormRequest;
use App\Stock\Category;
use App\Stock\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function create()
    {
        $product = new Product();

        return view('admin.products.create')->with(compact('product'));
    }

    public function store(ProductFormRequest $request)
    {
        $category = $this->getParentCategory();

        $category->products()->create($request->all());

        return redirect()->to('/admin');
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

        return redirect()->to('/admin');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->to('/admin');
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
