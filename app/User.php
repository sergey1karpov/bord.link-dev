<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'nickname'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile() {
        return $this->hasMany(Profile::class);
    }

    public function profileVideo() {
        return $this->hasMany(ProfileVideo::class);
    }

    public function profileAlbums() {
        return $this->hasMany(ProfileAlbums::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public function getRouteKeyName()
    {
        return 'nickname';
    }

    public function likes() {
        return $this->hasMany(Likepost::class);
    }

    public function followers() {
        return $this->hasMany(Follower::class);
    }

    public static function editUserInformation($data, $user) {
        $user->name = $data['name'];
        $user->nickname = $data['nickname'];
        $user->about = $data['about'];
        $user->site = $data['site'];
        if(isset($data['avatar'])) {
            $user->avatar = User::newUserAvatar($data['avatar'], $user->id);
        }
        if(isset($data['banner'])) {
            $user->banner = User::newUserBanner($data['banner'], $user->id);
        }
        $user->update();
    }

    public static function newUserAvatar($ava, $user) {
        $path = Storage::putFileAs('public/'.Auth::user()->id.'/avatar', $ava, 'userAvatarId'.$user);
        $url = Storage::url($path);
        return $url;
    }

    public static function newUserBanner($banner, $user) {
        $path = Storage::putFileAs('public/'.Auth::user()->id.'/banner', $banner, 'userBannerId'.$user);
        $url = Storage::url($path);
        return $url;
    }
}
