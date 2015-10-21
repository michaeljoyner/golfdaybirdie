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

class CartItemResolver {

    public function resolve($item)
    {
        return  new CartItem($item->rowid, $item->id, $item->name, $item->qty, $item->options['size'], $item->options['images']);
    }

    public function resolveToOrderArray($item)
    {
        $ids = $this->getModelIds($item);
        return [
            'product_id' => $ids['product'],
            'version_id' => $ids['version'],
            'size_id' => $ids['size'],
            'quantity' => $item->qty
        ];
    }

    private function getModelIds($item)
    {
        $ids = explode('_', $item->id);
        return [
            'product' => intval($ids[0]),
            'version' => intval($ids[1]) === 0 ? null : intval($ids[1]),
            'size' => intval($ids[2]) === 0 ? null : intval($ids[2])
        ];
    }
}