<?php

namespace App\Handlers;

use App\Models\User;
use App\Models\UserReferrer;
use App\Services\lovelyCateService;

/**
 * 好友请求
 *
 * @package App\Handlers
 */
class FriendRequestHandler implements WeChatHandler
{

    //收到好友请求，自动同意好友申请
    //{"share_wxid":"wxid_rk6j0wtc0fpg21","share_nickname":"Tim"}
    public function fire(lovelyCateService $service)
    {
        $user = $this->registerUser($service);

        $service->agreeFriendVerify();

        $this->sendCourseMessage($user);
    }

    private function registerUser(lovelyCateService $service)
    {
        $wxid = $service->from_wxid;

        $user = User::findByWxid($wxid);
        if ($user) {
            return $user;
        }

        $user = new User();
        $user->setWxid($wxid);
        $user->setName($service->from_name);
        $user->setAvatar($service->avatar);
        $user->save();

        if ($service->share_wxid) {
            $refererUser = User::findByWxid($service->share_wxid);
            $userReferrer = new UserReferrer();
            $userReferrer->setId($user->getId());
            $userReferrer->setChannel(UserReferrer::CHANNEL_WECHAT);
            $userReferrer->setReferrerWxid($service->share_wxid);
            if ($refererUser) {
                $userReferrer->setReferrerId($refererUser->getId());
            }
            $userReferrer->save();

            //给推荐人发奖励
            $message = "【推荐好友已通过】\n";
            $message .= "您已成功推荐的好友：{$service->from_name}\n";
            $message .= "他使用小助手购物的每一笔返利，系统将给您额外奖励";
            $service->sendTextMsg($message, null, $service->share_wxid);
        }

        return $user;
    }

    /**
     * 发送教程消息
     *
     * TODO
     */
    private function sendCourseMessage(User $user)
    {
    }

}