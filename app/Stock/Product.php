<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SetsSlugFromNameTrait;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'quantity',
        'image_path'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
