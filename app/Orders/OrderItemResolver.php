<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 10/17/15
 * Time: 9:42 AM
 */

namespace App\Orders;


use App\Stock\Product;
use App\Stock\ProductVersion;
use App\Stock\Size;

class OrderItemResolver {

    public function resolve($item)
    {
        return  new OrderItem($item->rowid, $item->id, $item->name, $item->qty, $item->options['size'], $item->options['images']);
    }
}