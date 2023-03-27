<?php

namespace Hmimeee\Easysendsms;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Hmimeee\Easysendsms\Messages\EasysendsmsMessage;

class Easysendsms
{
    /**
     * The base URL to send the request.
     *
     * @var string
     */
    protected $baseUrl = 'https://api.easysendsms.app';

    /**
     * @param string $username
     * @param string $password
     * @param string $from
     * @param \Hmimeee\Easysendsms\Messages\EasysendsmsMessage $message
     * 
     * @return void
     */
    public function __construct(
        protected string $to,
        protected string $username,
        protected string $password,
        protected string $from,
        protected EasysendsmsMessage $message
    ) {
        $this->from = $message->from ?? $from;
    }

    /**
     * Send the message
     * 
     * @return true
     */
    public function send()
    {
        Http::baseUrl($this->baseUrl)->timeout(6)->post('bulksms', [
            'username' => $this->username,
            'password' => $this->password,
            'from' => $this->from,
            'to' => $this->to,
            'text' => $this->message->content,
            'type' => $this->message->type,
        ]);

        return true;
    }
}
