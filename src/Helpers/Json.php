<?php

namespace Wstanley\Kitapi\Helpers;

class Json
{
    /**
     *  Проверяем является ли строка json-ом
     *
     * @param $string
     * @return bool
     */
    public static function isJSON($string) {

        return ((is_string($string) && (is_object(json_decode($string)) || is_array(json_decode($string)))))
            ? true : false;
    }
}