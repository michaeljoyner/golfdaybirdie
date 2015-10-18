<?php

namespace App\Stock;

use App\UploadedImages\GetsImageSourcesTrait;
use Illuminate\Database\Eloquent\Model;

class ProductVersion extends Model
{
    use GetsImageSourcesTrait;

    protected $table = 'product_versions';

    protected $fillable = [
        'version_name',
        'description',
        'image_path'
    ];

    protected $fallbackImagePath = 'images/golfshirt.jpg';


    public function product()
    {
        return $this->belongsTo('App\Stock\Product', 'product_id');
    }
}
