<?php

namespace Hmimeee\Easysendsms\Exceptions;

class EasysendsmsException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
