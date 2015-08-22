<?php

namespace App\Quotes;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $table = 'quote_requests';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'enquiry',
        'packaging_A',
        'packaging_B',
        'archived'
    ];

    public function products()
    {
        return $this->hasMany('App\Quotes\QuoteProduct', 'quote_request_id');
    }

    public function images()
    {
        return $this->hasMany('App\Quotes\QuoteImage', 'quote_request_id');
    }

    public function packagingRequired()
    {
        if($this->attributes['packaging_A'] && $this->attributes['packaging_B']) {
            return 'Yes. Requests both versions of packaging!';
        } else if($this->attributes['packaging_A']) {
            return 'Yes. Requests branded packaging of 3s';
        } else if ($this->attributes['packaging_B']) {
            return 'Yes. Requests branded set box of 12';
        } else {
            return 'No branded packaging requested.';
        }

    }
}
