<?php

namespace App\Http\Controllers;

use App\Follower;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    /**
     * Метод подписок
     */
    public function followUser($id, $userId) {
        $user = User::find($id);
        if($user) {

            //Ищем в базе запись о подписке
            $follow = Follower::where('subscriberId', $id)
                ->where('followerId', $userId)
                ->first();

            //Если записи нет, создаём её
            if(!isset($follow)) {
                $followUser = new Follower();

                //Инфа того, кто на меня подписался
                $followUser->subscriberId = $id;
                $followUser->subscriberNickname = Auth::user()->nickname;
                $followUser->subscriberPageLink = 'bord.link/'.Auth::user()->nickname;
                $followUser->subscriberAvatar = Auth::user()->avatar;
                $followUser->subscriberVerify = Auth::user()->verify;

                //Инфа на кого я подписался
                $followUser->followerId = $userId;
                $a = User::find($userId);
                $followUser->followerNickname = $a->nickname;
                $followUser->followerPageLink = 'bord.link/'.$a->nickname;
                $followUser->followerAvatar = $a->avatar;
                $followUser->followerVerify = $a->verify;

                //Меняем статус подписки на true
                $followUser->followorunfollow = true;

                //Сохраняем все дело
                $followUser->save();

                //Добавляем в счетчик +1
                $a = User::find($id);
                $a->iamfollower++;
                $a->update();

                $b = User::find($userId);
                $b->myfollowers++;
                $b->update();

                return redirect()->back();
            } else {
                //Если же запись о подписке есть, но стоит false, переключаем её в true
                if ($follow->followorunfollow == false) {
                    $follow->followorunfollow = true;

                    $follow->subscriberId = $id;
                    $follow->followerId = $userId;

                    $follow->update();

                    $a = User::find($id);
                    $a->iamfollower++;
                    $a->update();

                    $b = User::find($userId);
                    $b->myfollowers++;
                    $b->update();

                    return redirect()->back();
                }
                //Если запись true, то переключаем её в false и делаем -1 в счетчики
                $follow->followorunfollow = false;

                $follow->subscriberId = 0;
                $follow->followerId = 0;

                $follow->update();

                $a = User::find($id);
                $a->iamfollower--;
                $a->update();

                $b = User::find($userId);
                $b->myfollowers--;
                $b->update();

                return redirect()->back();
            }
        }
    }
}
