<?php

namespace App\Http\Controllers\Admin;

use App\Orders\Order;
use App\Orders\OrderItem;
use App\Stock\Category;
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
        })->filter(function($orderItem) {
            return $orderItem != null;
        });
        $promoted = Product::where('promote', 1)->get();
        $ordersInLastWeek = Order::recentCount();
        $totalCategories = Category::all()->count();
        $totalProducts = Product::all()->count();
        return view('admin.dashboard')->with(compact('promoted', 'popular', 'ordersInLastWeek', 'totalCategories', 'totalProducts'));
    }
}
