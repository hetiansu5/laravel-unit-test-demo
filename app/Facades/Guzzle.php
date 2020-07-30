<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Guzzle
 * @package App\Facades
 * @see \GuzzleHttp\Client;
 *
 * @method static ResponseInterface get(string $url, array $opts)
 * @method static ResponseInterface post(string $url, array $opts)
 */
class Guzzle extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'guzzle';
    }
}