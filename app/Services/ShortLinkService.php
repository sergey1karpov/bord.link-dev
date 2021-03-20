<?php

namespace App\Services;

use App\Link;

class ShortLinkService {

    /**
     * Generate random 10 symbols
     */
    public static function flush() {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $parth = substr(str_shuffle($chars), 0, 10);
        return $parth;
    }

    /**
     * Принимаем ссылку, которую юзер хочет сократить.
     *
     * Создаём объект Link, в old_link идет наша ссылка, в short_link рандомные символы
     *
     * Возвращаем короткую ссылку
     */
    public static function generate($link) {
        $short = new Link();
        $short->old_link = $link;
        $short->short_link = self::flush();
        $short->save();
        return $short->short_link;
    }

}
