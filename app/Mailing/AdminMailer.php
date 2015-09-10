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

    protected $to = ['ryan@absolutesport.co.za' => 'Ryan Keipiel'];

    public function notifyOfQuoteRequest($quoteRequest)
    {
        $from = $quoteRequest->email;
        $subject = 'GolfBallBranding Quote Request from '.$quoteRequest->name;
        $data = ['data' => serialize($quoteRequest)];
        $view = 'emails.quoterequest';

        $this->sendTo($this->to, $from, $subject, $view, $data);
    }

    public function sendContactMessage(array $contact_message)
    {
        $from = $contact_message['email'];
        $subject = 'Site message from GBB';
        $data = compact('contact_message');
        $view = 'emails.contact';

        $this->sendTo($this->to, $from, $subject, $view, $data);
    }

}