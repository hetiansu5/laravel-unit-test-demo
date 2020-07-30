<?php

namespace App\Handlers;

use App\Services\lovelyCateService;

/**
 * 收到二维码转账
 *
 * @package App\Handlers
 */
class QRCodePaymentHandler implements WeChatHandler
{

    //{
    //	"to_wxid": "wxid_9c6d4r3taosh22",
    //	"msgid": 1705897420,
    //	"received_money_index": "1",
    //	"money": "0.01",
    //	"total_money": "0.01",
    //	"remark": "",
    //	"scene_desc": "个人收款完成",
    //	"scene": 3,
    //	"timestamp": 1575891497
    //}
    public function fire(lovelyCateService $service)
    {
        $origin = json_decode($service->msg, true);
        $msg = sprintf("收到扫码转账，金额：%s元", $origin['money']);
        file_put_contents("receive_money.log", $msg . PHP_EOL, FILE_APPEND);
    }

}