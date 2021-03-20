<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $fillable = ['user_id', 'eventdata', 'city', 'cover', 'info', 'tickets', 'address','title', 'vk', 'fb',
        'youbrand', 'concert', 'yandex', 'kassir', 'time', 'ponominaly', 'ticketland', 'radario'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public static function checkImg($cover) {
        $path = Storage::putFile('public/'.Auth::user()->id.'/event',$cover);
        $url = Storage::url($path);
        return $url;
    }

    public static function addUserEvent($data) {
        Event::create([
            'user_id' => Auth::user()->id,
            'title' => $data['title'],
            'eventdata' => $data['eventdata'],
            'city' => $data['city'],
            'address' => $data['address'],
            'info' => $data['info'],
            'tickets' => $data['tickets'],
            'vk' => $data['vk'],
            'fb' => $data['fb'],
            'cover' => Event::checkImg($data['cover']),
            'time' => $data['time'],

            'youbrand' => $data['youbrand'],
            'concert' => $data['concert'],
            'yandex' => $data['yandex'],
            'kassir' => $data['kassir'],
            'ponominalu' => $data['ponominalu'],
            'ticketland' => $data['ticketland'],
            'radario' => $data['radario']
        ]);
    }

    public static function editUserEvent($data, $event) {
        $event->user_id = Auth::user()->id;
        $event->title = $data['title'];
        $event->eventdata = $data['eventdata'];
        $event->city = $data['city'];
        $event->address = $data['address'];
        $event->info = $data['info'];
        $event->tickets = $data['tickets'];
        $event->vk = $data['vk'];
        $event->fb = $data['fb'];

        if(isset($data['cover'])) {
            $event->cover = Event::checkImg($data['cover']);
        }

        $event->time = $data['time'];
        $event->youbrand = $data['youbrand'];
        $event->concert = $data['concert'];
        $event->yandex = $data['yandex'];
        $event->kassir = $data['kassir'];
        $event->ponominalu = $data['ponominalu'];
        $event->ticketland = $data['ticketland'];
        $event->radario = $data['radario'];

        $event->update();
    }
}
