<?php

namespace App\Http\Controllers;

use App\Likepost;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;

class LikePostController extends Controller
{
    /**
     * Лососирование постов
     */
    public function likePost($id, $postId) {

        $user = User::find($id);
        if($user == true) {
            $post = Profile::find($postId);
            if($post == true) {

                //Ищем в базе запись о лососирование поста
                $like = Likepost::where('profile_id', $post->id)
                    ->where('user_id', $user->id)
                    ->first();

                //Если записи нет, создаём её
                if(!isset($like)) {
                    $likepost = new Likepost();
                    $likepost->user_id = Auth::user()->id;
                    $likepost->profile_id = $post->id;
                    $likepost->likeordislike = true;
                    $likepost->save();

                    //В счетчик лайков поста +1
                    $post->likepost++;
                    $post->update();

                    return $post->likepost;
                } else {
                    //Если же запись есть, но в статусе false, ставим true и так же в счетчик +1
                    if ($like->likeordislike == false) {
                        $like->likeordislike = true;
                        $like->update();

                        $post->likepost++;
                        $post->update();

                        return $post->likepost;
                    }
                    //Иначе в false и -1
                    $like->likeordislike = false;
                    $like->update();

                    $post->likepost--;
                    $post->update();

                    return $post->likepost;
                }

            }
        }
    }
}
