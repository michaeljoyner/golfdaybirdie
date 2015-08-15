<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/14/15
 * Time: 10:51 AM
 */

namespace App\Quotes;


trait BelongsToQuoteRequestTrait {

    public function quoteRequest()
    {
        return $this->belongsTo('App\Quotes\QuoteRequest', 'quote_request_id');
    }

}