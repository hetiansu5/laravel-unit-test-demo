<?php

namespace App\Utils;

use App\Exceptions\InvalidRequestException;

class CodeUtil
{

    /**
     * 是否淘口令
     *
     * @param string $text
     * @return bool
     */
    public static function isTaoCode($text)
    {
        $res = preg_match('/tb\.cn/', $text);
        if ($res) {
            return true;
        }

        return (bool)preg_match('/[a-zA-Z0-9]{11}/', $text);
    }

    /**
     * @throws InvalidRequestException
     */
    public static function throwException()
    {
        throw new InvalidRequestException();
    }

}