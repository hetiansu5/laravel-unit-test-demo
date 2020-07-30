<?php

namespace App\Handlers;

use App\Services\lovelyCateService;

interface WeChatHandler
{
    public function fire(lovelyCateService $service);
}