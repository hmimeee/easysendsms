<?php

namespace Hmimeee\Easysendsms\Channels;

use Hmimeee\Easysendsms\Easysendsms;
use Illuminate\Notifications\Notification;
use Hmimeee\Easysendsms\Messages\EasysendsmsMessage;

class EasysendsmsChannel
{
    /**
     * The username that will be used while send.
     *
     * @var string
     */
    protected $username;

    /**
     * The password that will be used while send.
     *
     * @var string
     */
    protected $password;

    /**
     * The phone number notifications should be sent from.
     *
     * @var string
     */
    protected $from;

    /**
     * Create a new Vonage channel instance.
     *
     * @param  \Hmimeee\Easysendsms\Easysendsms  $client
     * @param  string  $from
     * @return void
     */
    public function __construct(string $username, string $password, string $from)
    {
        $this->username = $username;
        $this->password = $password;
        $this->from = $from;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('sms', $notification)) {
            return;
        }

        $message = $notification->toSms($notifiable);

        if (is_string($message)) {
            $message = new EasysendsmsMessage($message);
        }

        $client = new Easysendsms($to, $this->username, $this->password, $this->from, $message);

        return $client->send();
    }
}
