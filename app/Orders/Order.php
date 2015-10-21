<?php

namespace App\Orders;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'order_query'
    ];

    public function orderItems()
    {
        return $this->hasMany('App\Orders\OrderItem', 'order_id');
    }

    public function addItems($cartItemCollection)
    {
        foreach($cartItemCollection as $item) {
            $this->orderItems()->create((new CartItemResolver())->resolveToOrderArray($item));
        }
    }

    public function toggleArchivedStatus()
    {
        $isArchived = $this->attributes['is_archived'];
        $this->is_archived = ! $this->attributes['is_archived'];
        $this->save();

        return ! $isArchived;
    }
}
