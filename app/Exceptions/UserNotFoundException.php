<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UserNotFoundException extends HttpException
{
    protected $code = "user.not.found";
    protected $message = "用户不存在";

    public function __construct()
    {
        parent::__construct(404, $this->message);
    }

}