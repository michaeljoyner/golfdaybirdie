<?php

namespace App\Http\Controllers\Admin;

use App\Orders\OrderItem;
use App\Stock\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function dashboard()
    {
        $popular = OrderItem::mostPopular()->map(function($item) {
           return $item->product;
        });
        $promoted = Product::where('promote', 1)->get();
        return view('admin.dashboard')->with(compact('promoted', 'popular'));
    }
}
