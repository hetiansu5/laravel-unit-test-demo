<?php

namespace App\Handlers;

use App\Services\lovelyCateService;

/**
 * 有人退群
 *
 * @package App\Handlers
 */
class MemberLeaveGroupHandler implements WeChatHandler
{

    //msg 消息体：
    //{
    //	"member_wxid": "xxx",
    //	"member_nickname": "xxx",
    //	"group_wxid": "11111@chatroom",
    //	"group_name": "xxx",
    //	"timestamp": 1575890752
    //}
    public function fire(lovelyCateService $service)
    {
        $origin = json_decode($service->msg, true);
        $msg = sprintf("万般留不住，%s终于还是走了~", $origin['member_nickname']);
        $service->sendTextMsg($msg);
    }

}