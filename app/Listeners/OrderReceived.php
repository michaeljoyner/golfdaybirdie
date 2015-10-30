<?php

namespace App\Listeners;

use App\Events\OrderWasReceived;
use App\Mailing\AdminMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderReceived
{
    /**
     * @var AdminMailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     */
    public function __construct(AdminMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  OrderWasReceived  $event
     * @return void
     */
    public function handle(OrderWasReceived $event)
    {
        $this->mailer->sendOrderNotification($event->order);
    }
}
