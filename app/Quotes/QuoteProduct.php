<?php

namespace App\Quotes;

use Illuminate\Database\Eloquent\Model;

class QuoteProduct extends Model
{
    use BelongsToQuoteRequestTrait;

    protected $table = 'quote_products';

    protected $fillable = [
        'product_name',
        'quantity'
    ];
}
