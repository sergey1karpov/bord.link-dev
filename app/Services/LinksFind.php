<?php

namespace App\Services;

/**
 * Class HashTagsFind
 * @package App\Services
 *
 * Принимаем строку, режем её по пробелу, с помощью регулярки ищем теги в массиве и складываем их в новый массив, через
 * foreach пробегаем и делаем ссылку
 *
 */
class LinksFind {

    public static function findUrl($message) {

        $url = '#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si';
        $string = preg_replace($url, '<a href="http://$0" target="_blank" title="http://$0">$0</a>', $message);
        return $string;

    }


}


//ehjgtrt www.google.com rtthtrhrth test.ru/test yandex.ru ergerg grtgrtg www.trapshot.com/erefrfe/fref



//ryyyr #rrrr iituut iit #Google rrr #Tom65
//$fl_array = preg_grep("/^#[A-Za-zА-Яа-я0-9_]{4,20}/", $array);
//'<a href="#">'.$value.'</a>'

// (http://|https://)?(www.)?[A-z]*(.com|.co.uk|.us|.org|.net|.mobi|.ru)
