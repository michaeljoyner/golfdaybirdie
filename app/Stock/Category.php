<?php

namespace App\Stock;

use App\UploadedImages\GetsImageSourcesTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SetsSlugFromNameTrait, GetsImageSourcesTrait;

    protected $table = 'categories';

    protected $fallbackImagePath = 'images/umbrella.png';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_path'
    ];

    public function products()
    {
        return $this->hasMany('App\Stock\Product');
    }

}
