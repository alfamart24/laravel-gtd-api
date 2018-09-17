<?php

namespace Webadvance\Kitapiv2\Helpers;

class Json
{
    /*
     * проверяем является ли строка json-ом
     */
    public static function isJSON($string) {

        return ((is_string($string) && (is_object(json_decode($string)) || is_array(json_decode($string))))) ? true : false;
    }
}