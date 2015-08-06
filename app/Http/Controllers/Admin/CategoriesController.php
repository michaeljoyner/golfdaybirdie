<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryFormRequest;
use App\Stock\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function create()
    {
        $category = new Category();
        return view('admin.categories.create')->with(compact('category'));
    }

    public function store(CategoryFormRequest $request)
    {
        Category::create($request->all());

        return redirect()->to('/admin');
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
