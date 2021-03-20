<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileAlbums extends Model
{
    protected $table = 'profilealbums';

    protected $fillable = [
        'title', 'playlist', 'cover', 'user_id', 'info',
        'amazon', 'applemusic', 'boom', 'deezer', 'googleplay', 'itunes', 'soundcloud', 'spotify', 'vkmusic', 'yandexmusic', 'youtubemusic', 'zvuk',
        ];

    public static function checkImg($cover) {
        $path = Storage::putFile('public/'.Auth::user()->id.'/playlist', $cover);
        $url = Storage::url($path);
        return $url;
    }

    public static function newProfileAlbum($data) {
        ProfileAlbums::create([
            'title' => $data['audioTitle'],
            'playlist' => $data['playlist'],
            'user_id' => Auth::user()->id,
            'info' => $data['info'],
            'cover' => ProfileAlbums::checkImg($data['cover']),

            'amazon' => $data['amazon'],
            'applemusic' => $data['applemusic'],
            'boom' => $data['boom'],
            'deezer' => $data['deezer'],
            'googleplay' => $data['googleplay'],
            'itunes' => $data['itunes'],
            'soundcloud' => $data['soundcloud'],
            'spotify' => $data['spotify'],
            'vkmusic' => $data['vkmusic'],
            'yandexmusic' => $data['yandexmusic'],
            'youtubemusic' => $data['youtubemusic'],
            'zvuk' => $data['zvuk']
        ]);
    }

    public static function editProfileAlbum($data, $album) {

        $album->title = $data['audioTitle'];
        $album->playlist = $data['playlist'];
        $album->user_id = Auth::user()->id;
        $album->info = $data['info'];

        if(isset($data['cover'])) {
            $album->cover = ProfileAlbums::checkImg($data['cover']);
        }

        $album->amazon = $data['amazon'];
        $album->applemusic = $data['applemusic'];
        $album->boom = $data['boom'];
        $album->deezer = $data['deezer'];
        $album->googleplay = $data['googleplay'];
        $album->itunes = $data['itunes'];
        $album->soundcloud = $data['soundcloud'];
        $album->spotify = $data['spotify'];
        $album->vkmusic = $data['vkmusic'];
        $album->yandexmusic = $data['yandexmusic'];
        $album->youtubemusic = $data['youtubemusic'];
        $album->zvuk = $data['zvuk'];

        $album->update();
    }
}
