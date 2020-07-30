<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Guzzle
 * @package App\Facades
 * @see \GuzzleHttp\Client;
 *
 * @method static push(\App\Events\Event $event)
 */
class Kafka extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'kafka';
    }
}