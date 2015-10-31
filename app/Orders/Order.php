<?php

namespace App\Orders;

use Carbon\Carbon;
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

    public function orderImages()
    {
        return $this->hasMany('App\Orders\OrderImage', 'order_id');
    }

    public static function mostPopularItems()
    {
        $popularItems = OrderItem::groupBy('product_id')->orderByRaw('COUNT(product_id) DESC')->get();

        return $popularItems;
    }

    public static function recentCount()
    {
        $count = static::where('created_at', '>' ,Carbon::now()->subWeek())->count();
        return $count;
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

    public function attachImages($images)
    {
        if(is_array($images)) {
            foreach($images as $image) {
                $this->orderImages()->create(['image_path' => $image]);
            }

            return;
        }

        $this->orderImages()->create(['image_path' => $images]);
    }
}
