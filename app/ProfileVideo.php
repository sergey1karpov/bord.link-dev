<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProfileVideo extends Model
{
    protected $table = 'profilevideos';

    public static function newProfileVideo($data) {
        $profileVideo = new ProfileVideo();
        $profileVideo->user_id = Auth::user()->id;
        $profileVideo->title = $data['title'];
        $profileVideo->info = $data['info'];
        $profileVideo->audio = $data['audio'];
        $profileVideo->video = str_replace('watch?v=', 'embed/', $data['videoProfile']);

        $profileVideo->itunes = $data['itunes'];
        $profileVideo->applemusic = $data['applemusic'];
        $profileVideo->vkmusic = $data['vkmusic'];
        $profileVideo->boom = $data['boom'];
        $profileVideo->yandexmusic = $data['yandexmusic'];
        $profileVideo->googleplay = $data['googleplay'];
        $profileVideo->deezer = $data['deezer'];
        $profileVideo->zvuk = $data['zvuk'];
        $profileVideo->amazon = $data['amazon'];
        $profileVideo->spotify = $data['spotify'];
        $profileVideo->soundcloud = $data['soundcloud'];

        $profileVideo->save();
    }

    public static function editUserVideo($data, $video) {
        $video->user_id = Auth::user()->id;
        $video->video = str_replace('watch?v=', 'embed/', $data['videoProfile']);
        $video->title = $data['title'];
        $video->info = $data['info'];
        $video->audio = $data['audio'];

        $video->itunes = $data['itunes'];
        $video->applemusic = $data['applemusic'];
        $video->vkmusic = $data['vkmusic'];
        $video->boom = $data['boom'];
        $video->yandexmusic = $data['yandexmusic'];
        $video->googleplay = $data['googleplay'];
        $video->deezer = $data['deezer'];
        $video->zvuk = $data['zvuk'];
        $video->amazon = $data['amazon'];
        $video->spotify = $data['spotify'];
        $video->soundcloud = $data['soundcloud'];

        $video->update();
    }
}
