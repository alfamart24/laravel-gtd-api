<?php

namespace Wstanley\Kitapi\Helpers;

class StringHelp
{
    /*
     *  Почемуто ответ приходит и содержит первый символ "с"
     *  он мешает декодировать json
     *  поэтомы проверяем есть ли первый симсол "с" и удаляем его
     */
    public static function checkC($string)
    {
        return preg_match('~^(c)~', $string) ? self::cutC($string) : $string; // '~^(c)[\[]~'
    }

    private static function cutC($string)
    {
        return $string = substr($string, 1);
    }
}