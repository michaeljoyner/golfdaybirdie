<?php

namespace App\Stock;

use App\UploadedImages\GetsImageSourcesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SetsSlugFromNameTrait, GetsImageSourcesTrait, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'quantity',
        'image_path'
    ];

    protected $dates = ['deleted_at', 'updated_at', 'created_at'];

    protected $fallbackImagePath = 'images/products/default.jpg';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function versions()
    {
        return $this->hasMany('App\Stock\ProductVersion', 'product_id');
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Stock\Size');
    }

    public static function promotedItems()
    {
        $promoted =  static::where('promote', 1)->limit(9)->get();

        if($promoted->count() < 9) {
            $remaining = 9 - $promoted->count();

            $filler = static::where('promote', 0)->orderByRaw('RAND()')->take($remaining)->get();
            $promoted = $promoted->merge($filler);
        }

        return $promoted;
    }

    public function togglePromoteState()
    {
        $prev = $this->attributes['promote'];
        $this->promote = ! $this->attributes['promote'];
        $this->save();
        return ! $prev;
    }




}
