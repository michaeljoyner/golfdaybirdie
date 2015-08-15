<?php

namespace App\Quotes;

use App\UploadedImages\GetsImageSourcesTrait;
use Illuminate\Database\Eloquent\Model;

class QuoteImage extends Model
{
    use BelongsToQuoteRequestTrait, GetsImageSourcesTrait;

    protected $table = 'quote_images';

    protected $fillable = [
        'image_path'
    ];

    protected $fallbackImagePath = 'images/products/default.jpg';

}
