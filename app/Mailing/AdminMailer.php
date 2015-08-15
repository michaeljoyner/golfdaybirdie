<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/15/15
 * Time: 5:18 PM
 */

namespace App\Mailing;


use App\Quotes\QuoteRequest;

class AdminMailer extends Mailer {

    protected $to = ['joyner.michael@gmail.com' => 'Michael Joyner'];

    public function notifyOfQuoteRequest($quoteRequest)
    {
        $from = $quoteRequest->email;
        $subject = 'GolfBallBranding Quote Request from '.$quoteRequest->name;
        $data = ['data' => serialize($quoteRequest)];
        $view = 'emails.quoterequest';

        $this->sendTo($this->to, $from, $subject, $view, $data);
    }

}