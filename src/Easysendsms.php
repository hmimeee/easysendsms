<?php

namespace Hmimeee\Easysendsms;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Hmimeee\Easysendsms\Messages\EasysendsmsMessage;
use Hmimeee\Easysendsms\Exceptions\EasysendsmsException;

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
     * @return void
     */
    public function send()
    {
        $response = Http::baseUrl($this->baseUrl)->post('bulksms', [
            'username' => $this->username,
            'password' => $this->password,
            'from' => $this->from,
            'to' => $this->to,
            'text' => $this->message->content,
            'type' => $this->message->type,
        ])->json();

        if (is_integer($response)) {
            throw new EasysendsmsException($this->getErrorMessage($response));
        }
    }

    /**
     * Get the exception message return
     * 
     * @param mixed $code
     * @return string
     */
    public function getErrorMessage($code)
    {
        $errors = [
            "1001" => "Invalid URL. This means that one of the parameters was not provided or left blank.",
            "1002" => "Invalid username or password parameter.",
            "1003" => "Invalid type parameter.",
            "1004" => "Invalid message.",
            "1005" => "Invalid mobile number.",
            "1006" => "Invalid sender name.",
            "1007" => "Insufficient credit.",
            "1008" => "Internal error (do NOT re-submit the same message again).",
            "1009" => "Service not available (do NOT re-submit the same message again)."
        ];

        return $errors[$code] ?? 'Unknow error occured';
    }
}
