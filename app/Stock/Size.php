<?php

namespace App\Stock;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    protected $fillable = ['size'];

    public function products()
    {
        return $this->belongsToMany('App\Stock\Product');
    }
}
