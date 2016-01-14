<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/15/15
 * Time: 5:18 PM
 */

namespace App\Mailing;



use App\Orders\Order;

class AdminMailer extends Mailer {

    protected $to = ['sales@golfdaybirdie.co.za' => 'Ryan Keipiel'];

    public function sendContactMessage(array $contact_message)
    {
        $from = $contact_message['email'];
        $subject = 'Site message from GBB';
        $data = compact('contact_message');
        $view = 'emails.contact';

        $this->sendTo($this->to, $from, $subject, $view, $data);
    }

    public function sendOrderNotification(Order $order)
    {
        $from = $order->customer_email;
        $subject = 'Order from GolfDayBirdie';
        $view = 'emails.order';

        $this->sendTo($this->to, $from, $subject, $view, compact('order'));
    }

}