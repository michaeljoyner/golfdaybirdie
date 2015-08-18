<?php

namespace App\Listeners;

use App\Events\QuoteRequestWasReceived;
use App\Mailing\AdminMailer;
use App\Quotes\QuoteRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuoteRequested
{
    /**
     * @var AdminMailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param AdminMailer $mailer
     */
    public function __construct(AdminMailer $mailer)
    {
        //
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  QuoteRequestWasReceived  $event
     * @return void
     */
    public function handle(QuoteRequestWasReceived $event)
    {
        $quoteRequest = QuoteRequest::with('products', 'images')->findOrFail($event->quoteRequest->id);

        $this->mailer->notifyOfQuoteRequest($quoteRequest);
    }
}
