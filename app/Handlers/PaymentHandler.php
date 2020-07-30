<?php

namespace App\Handlers;

use App\Services\lovelyCateService;

/**
 * 收到转账
 *
 * @package App\Handlers
 */
class PaymentHandler implements WeChatHandler
{

    //{
    //	"paysubtype": "3",
    //	"is_arrived": 1,
    //	"is_received": 1,
    //	"receiver_pay_id": "1000050101201912090003409856290",
    //	"payer_pay_id": "100005010119120900084341523899983197",
    //	"money": "0.01",
    //	"remark": "",
    //	"robot_pay_id": "1000050101201912090003409856290",
    //	"pay_id": "100005010119120900084341523899983197",
    //	"update_msg": "receiver_pay_id、payer_pay_id属性为robot_pay_id、pay_id的新名字，内容是一样的，建议更换"
    //}
    public function fire(lovelyCateService $service)
    {
        $origin = json_decode($service->msg, true);
        $msg = sprintf("我收到了你的转账，金额：%s元", $origin['money']);
        $service->acceptTransfer();//同意接收转账
        $service->sendTextMsg($msg);//发送回执
    }

}