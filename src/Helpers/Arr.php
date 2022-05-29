<?php

namespace moz\Database\Helpers;

class Arr
{

    public static function get($data, $key, $default = null)
    {
        $keys = explode('.', $key);
        $result = $data;
        foreach ($keys as $key) {
            $result = $result[$key] ?? null;
        }
        return $result;
    }


}