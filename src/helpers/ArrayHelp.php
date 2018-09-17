<?php

namespace Webadvance\Kitapiv2\Helpers;

class ArrayHelp
{
    public static function getPlaces($params)
    {

        for ($i=0;$i<count($params['count_place']);$i++) {

            $params['places'][$i]['count_place'] = $params['count_place'][$i];
            $params['places'][$i]['weight']      = $params['weight'][$i];
            $params['places'][$i]['height']      = $params['height'][$i];
            $params['places'][$i]['width']       = $params['width'][$i];
            $params['places'][$i]['length']      = $params['length'][$i];
        }

        unset($params['count_place'], $params['weight'],
            $params['height'], $params['width'], $params['length']);

        return $params;
    }

    public static function calculateResult($data, $type)
    {
        foreach ($data as $result) {

            switch (key($result)) {

                case $type :
                    return $result->$type;

                default :
                    throw new \Exception(sprintf('метода %s в ответе не было, попробуйте %s', $type, key($result)));
            }
        }
    }
}