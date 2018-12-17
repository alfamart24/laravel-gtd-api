<?php

namespace Alfamart24\Gtdapi\Helpers;

class StringHelp
{
    /*
     *  Почемуто ответ приходит и содержит первый символ "с"
     *  он мешает декодировать json
     *  поэтому проверяем есть ли первый симсол "с" и удаляем его
     *  '~^(c)[\[]~'
     *
     * @param $string
     * @return bool|string
     */
    public static function checkC($string)
    {
        return preg_match('~^(c)~', $string) ? substr($string, 1) : $string;
    }
}
