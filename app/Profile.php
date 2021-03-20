<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use User;
// use App\Services\LinksFind;

class Profile extends Model
{
    protected $fillable =['message', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comments::class);
    }

    public function likes() {
        return $this->hasMany(Likepost::class);
    }

    public static function getMySubscribers($user) {
        $subscribers = DB::table('followers')->join('users', 'followers.subscriberId', '=', 'users.id')
            ->where('followers.followerId', $user)
            ->get();
        return $subscribers;
    }

    public static function getMyFollowers($user) {
        $followers = DB::table('followers')->join('users', 'followers.followerId', '=', 'users.id')
            ->where('followers.subscriberId', $user)
            ->get();
        return $followers;
    }

    public static function getMyFollowersPosts($user) {
        $followersPosts = DB::table('followers')
            ->join('users', 'followers.followerId', '=', 'users.id')
            ->join('profiles', 'profiles.user_id','=', 'users.id')
            ->where('followers.subscriberId', $user)
            ->orderBy('profiles.created_at', 'desc')
            ->paginate(15);
        return $followersPosts;
    }

    public static function addUserPost($data) {
        $post = new Profile();
        $post->title = $data['title'];
        $post->slug = $data['slug'];
        $post->message = $data['message'];

        $post->user_id = Auth::user()->id;
        $post->videoPost = str_replace('watch?v=', 'embed/', $data['videoPost']);

        if(isset($data['img'])) {
            $post->img = Profile::addMainPostImage($data['img']);
        }

        if (isset($data['images'])) {
            $post->post_images = Profile::addAdditionalImagesForPost($data['images']);
        }

        //    Отлов ссылок
        // $post->slug = LinksFind::findUrl($data['slug']); //find link
        // $post->message = LinksFind::findUrl($data['message']); //find link

        $post->save();
    }

    public static function editUserPost($data, $post) {
        $post->user_id = Auth::user()->id;
        $post->title = $data['title'];
        $post->slug = $data['slug'];
        $post->message = $data['message'];
        $post->videoPost = str_replace('watch?v=', 'embed/', $data['videoPost']);

        if(isset($data['img'])) {
            $post->img = Profile::addMainPostImage($data['img']);
        }

        if (isset($data['imgs'])) {
            $post->post_images = Profile::addAdditionalImagesForPost($data['imgs']);
        }

        $post->update();
    }

    public static function addMainPostImage($img) {
        $path = Storage::putFile('public/' . Auth::user()->id . '/post', $img); //Where to put the file
        $url = Storage::url($path); //url() - Get the URL for the file at the given path.
        return $url;
    }

    public static function addAdditionalImagesForPost($imgs) {
        $images = [];
        $urls = [];

        foreach($imgs as $key => $image){
            $images[] = Storage::putFile('public/' . Auth::user()->id . '/post', $image);
            if(count($images) > 10) {
                return redirect()->back();
            }
        }
        foreach($images as $img) {
            $urls[] = Storage::url($img);
        }
        $aaa = serialize($urls);
        return $aaa;
    }

}
