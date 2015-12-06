<?php

namespace App\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'product_id',
        'version_id',
        'size_id',
        'quantity'
    ];

    public static function mostPopular()
    {
        return static::with('product')->groupBy('product_id')->orderByRaw('COUNT(product_id) DESC')->limit(5)->get();
    }

    public function order()
    {
        return $this->belongsTo('App\Orders\Order', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Stock\Product', 'product_id')->withTrashed();
    }

    public function version()
    {
        return $this->belongsTo('App\Stock\ProductVersion', 'version_id');
    }

    public function size()
    {
        return $this->belongsTo('App\Stock\Size', 'size_id');
    }

    public function fullItemName()
    {
        if($this->attributes['version_id']) {
            return $this->product->name. ' - ' . $this->version->version_name;
        }

        return $this->product->name;
    }

    public function getSizeText()
    {
        if($this->attributes['size_id']) {
            return $this->size->size;
        }

        return 'N/A';
    }

    public function itemThumb()
    {
        if($this->attributes['version_id']) {
            return $this->version->smallestImageSrc();
        }

        return $this->product->smallestImageSrc();
    }
}
