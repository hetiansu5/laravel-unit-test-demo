<?php

namespace App\Handlers;

use App\Models\Cart;
use App\Services\lovelyCateService;
use App\Services\ZheTaoKeService;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * 私聊信息
 *
 * Class PrivateChatHandler
 * @package App\Handlers
 */
class PrivateChatHandler implements WeChatHandler
{

    public function fire(lovelyCateService $service)
    {
//        if ($service->msg == '签到') {
//            $reply = '签到成功了，金币增加10';
//            $service->sendTextMsg($reply);
//        } else if ($service->msg == '链接') {
//            $title = "付款金额：25圆，返红包：0.5圆";
//            $content = "呼吸运动弄篮球迭吸顶老师端付款佛为等级分公司";
//            $shareUrl = "https://abauifau88w460.kuaizhan.com/?word=(%EF%BF%A5PfUU1kDG4K4%EF%BF%A5)&image=https://img.alicdn.com/bao/uploaded/i2/3326246594/O1CN01wmbl0q1ya6FjbuGI5_!!0-item_pic.jpg&from=singlemessage";
//            $picUrl = "http://rank.uuu9.com//resource/upload/player/VRXF1WT8DC53I38E.png";
//            $service->sendLinkMsg($title, $content, $shareUrl, $picUrl);
//        }
        switch ($service->msg) {
            case "签到":
                //一一一一签 到 成 功一一一一
                //【签到次数】0 次
                //【签到奖励已转入可提现金额】
                //【每日语录】都能尽心做一件枯燥，最后真的会获得意外之喜
                //温馨提醒：首次签到会默认显示0次噢，但实际签到奖励有到账噢~~
                break;
            case "余额":
                //一一一一查 询 成 功一一一一
                //【账户余额】0.01 圆
                //【累计提现】0.00 圆
                //【推广人数】1人
                //【推广待结奖励】0.00圆
                //一一一一一一一一一一一一一
                //温馨提醒：
                //①待结奖励，购买人确认收货，便可提现噢~
                //②提现人数多，偶尔延迟，耐心等待~
                //③发送:【5】每天可领取饿了么外卖5圆抵扣券噢~
                break;
            case "订单":
                //一一一一订 单 相 关一一一一
                //【自己单数】0单
                //【待结订单】0笔
                //【待结红包金额】0.00圆
                break;
            case "提现":
                //一一一一提 现 处 理 中一一一一
                //您申请的0.01圆审核中，最迟48小时内到账，省钱就是这么简单!
                //用66智能返利，省钱就是这么溜~
                //将我名片推荐给好友添加，好友下单，您永久获得好友返莉最高60%奖励
                break;
        }
    }

    public function convertTaoCode(lovelyCateService $service)
    {
        $taoCode = $service->msg;
        try {
            $response = ZheTaoKeService::getInstance()->translateTaoCode($taoCode);
        } catch (HttpException $e) {
            $service->sendTextMsg("非常抱歉，您搜索的商品暂无返利，您可以继续尝试其他商品~");
            return;
        }

        $title = '点击领券下单 付款金额：25圆 返红包：0.5圆'; //返利
        $content = $response['jianjie']; //商品短标题
        $picUrl = $response['pict_url']; //商品主图

        $taoCode = "￥Ry0tYxAT18H￥"; //淘口令
        $taoKeFee = $response['tkfee3']; //返佣金额
        $couponClickUrl = $response['coupon_click_url']; //二合一链接（优惠券+推广）
        $itemUrl = $response['item_url']; //推广长链接，如果是渠道ID，请自行拼接上relationId的信息,否则订单信息中可能查不到渠道信息
        $shareUrl = '';

       

        $service->sendLinkMsg($title, $content, $shareUrl, $picUrl);

        //创建购物车

    }

    //AppKey: 28098849
    //SecretKey: c6672ada52f9ebe4698ea8f98e22f269
    //SUB_PID: mm_46816356_1012550210_109673250014
    //AD_ZONE_ID: 109673250014

}