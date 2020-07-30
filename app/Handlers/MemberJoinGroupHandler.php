<?php

namespace App\Handlers;

use App\Services\lovelyCateService;

/**
 * 新人入群
 *
 * Class NewJoinGroupHandler
 * @package App\Handlers
 */
class MemberJoinGroupHandler implements WeChatHandler
{

    //{
    //	"group_wxid": "xxx@chatroom",
    //	"group_name": "xxx",
    //	"guest": [{
    //		"wxid": "xxx",
    //		"nickname": "xxx"
    //	}],
    //	"inviter": {
    //		"wxid": "xxx",
    //		"nickname": "xxx"
    //	}
    //}
    public function fire(lovelyCateService $service)
    {
        $origin = json_decode($service->msg, true);
        $msg = sprintf("%s拉了新人入群，撒花欢迎：%s！！", $origin['inviter']['nickname'], $origin['guest'][0]['nickname']);
        $service->sendTextMsg($msg);
    }

}