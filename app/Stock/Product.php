<?php

namespace App\Stock;

use App\UploadedImages\GetsImageSourcesTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SetsSlugFromNameTrait, GetsImageSourcesTrait;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'quantity',
        'image_path'
    ];

    protected $fallbackImagePath = 'images/products/default.jpg';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
