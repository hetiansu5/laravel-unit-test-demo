<?php

namespace App\Exceptions;

class InvalidRequestException extends \Exception
{
    protected $message = "非法请求";

    public function __construct()
    {
        parent::__construct($this->message);
    }

}