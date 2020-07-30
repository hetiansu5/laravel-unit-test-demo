<?php

namespace App\Handlers;

use App\Services\lovelyCateService;

/**
 * 群聊消息
 *
 * Class GroupChatHandler
 * @package App\Handlers
 */
class GroupChatHandler implements WeChatHandler
{

    public function fire(lovelyCateService $service)
    {
        $service->sendTextMsg("我收到了群聊消息：" . $service->msg);
    }

}