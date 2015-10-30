<?php

namespace App\Orders;

use App\UploadedImages\GetsImageSourcesTrait;
use Illuminate\Database\Eloquent\Model;

class OrderImage extends Model
{
    use GetsImageSourcesTrait;

    protected  $table = 'order_images';

    protected $fillable = ['image_path'];

    public function order()
    {
        return $this->belongsTo('App\Orders\Order', 'order_id');
    }
}
