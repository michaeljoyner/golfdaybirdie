<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 10/17/15
 * Time: 9:34 AM
 */

namespace App\Orders;


class OrderItem {

    public $cartRowId;
    public $itemId;
    public $quantity;
    public $images = [];
    public $itemName;
    public $size;

    function __construct($cartRowId, $itemId, $itemName, $quantity, $size, $images)
    {
        $this->cartRowId = $cartRowId;
        $this->itemId = $itemId;
        $this->itemName = $itemName;
        $this->quantity = $quantity;
        $this->size = $size;
        $this->images = $images;
    }


    public function name()
    {
        return $this->itemName;
    }

    public function thumb() {
        return $this->images['thumb'];
    }

    public function size()
    {
        return $this->size;
    }

}