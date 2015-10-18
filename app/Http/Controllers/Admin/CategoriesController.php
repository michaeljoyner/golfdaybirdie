<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessages\Flasher;
use App\Http\Requests\CategoryFormRequest;
use App\Stock\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
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
        $categories = Category::all();

        return view('admin.categories.index')->with(compact('categories'));
    }

    public function show($id)
    {
        $category = Category::with('products')->findOrFail($id);

        return view('admin.categories.show')->with(compact('category'));
    }

    public function create()
    {
        $category = new Category();
        return view('admin.categories.create')->with(compact('category'));
    }

    public function store(CategoryFormRequest $request)
    {
        Category::create($request->all());

        $this->flasher->success('Category Created', 'Good for you, old chap.');

        return redirect()->to('/admin/categories');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit')->with(compact('category'));
    }

    public function update(CategoryFormRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->update($request->all());

        return redirect()->to('/admin');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->to('/admin');
    }
}
