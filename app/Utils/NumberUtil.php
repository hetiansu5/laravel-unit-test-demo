<?php

namespace App\Utils;

class NumberUtil
{

    public static function integerMoney($value)
    {
        return intval(round($value * 100, 0));
    }

    public static function realMoney($value)
    {
        return round($value / 100, 2);
    }

    /**
     * @param $value1
     * @param $value2
     * @return bool
     */
    public static function equalMoney($value1, $value2)
    {
        return intval($value1 * 100) == intval($value2 * 100);
    }

}