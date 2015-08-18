<?php

namespace App\Events;

use App\Events\Event;
use App\Quotes\QuoteRequest;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class QuoteRequestWasReceived extends Event
{
    use SerializesModels;
    /**
     * @var QuoteRequest
     */
    public $quoteRequest;

    /**
     * Create a new event instance.
     *
     * @param QuoteRequest $quoteRequest
     */
    public function __construct(QuoteRequest $quoteRequest)
    {
        //
        $this->quoteRequest = $quoteRequest;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
