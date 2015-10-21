<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessages\Flasher;
use App\Stock\Product;
use App\Stock\ProductVersion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductVersionsController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    public function create($productId)
    {
        $product = Product::findorFail($productId);
        $version = new ProductVersion();

        return view('admin.products.versions.create')->with(compact('version', 'product'));
    }

    public function store($productId, Request $request)
    {
        $product = Product::findOrFail($productId);

        $product->versions()->create($request->all());

        $this->flasher->success('New Version added', 'Diversity is the spice of life');

        return redirect()->to('admin/products/'.$productId);
    }

    public function edit($id)
    {
        $version = ProductVersion::findOrFail($id);

        return view('admin.products.versions.edit')->with(compact('version'));
    }

    public function update($id, Request $request)
    {
        $version = ProductVersion::with('product')->findOrFail($id);

        $product = $version->product;

        $version->update($request->all());

        $this->flasher->success('Version updated', 'Keeping it current... Respect');

        return redirect()->to('admin/products/'.$product->id);
    }

    public function delete($id)
    {
        $version = ProductVersion::with('product')->findOrFail($id);
        $product = $version->product;

        $version->delete();

        $this->flasher->success('Version deleting', 'Trimming the fat');

        return redirect()->to('admin/products/'.$product->id);


    }
}
