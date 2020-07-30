<?php

namespace App\Services;

use App\Events\Event;
use Illuminate\Support\Facades\Redis;

class KafkaService
{

    const KEY = "kafka:queue";

    /**
     * @param Event $event
     */
    public function push($event)
    {
        $bodyMessage = json_encode([
            'tag' => $event->getTag(),
            'body' => json_encode($event)
        ]);
        $redis = Redis::connection();
        $redis->rpush(self::KEY, $bodyMessage);
    }

}
