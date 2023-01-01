<?php

namespace moxemus\array;

class Helper
{
    public static function getFirstElement(array $array): mixed
    {
        if (empty($array)) return null;

        $keys = array_keys($array);
        $firstIndex = $keys[0];

        return $array[$firstIndex];
    }

    public static function isEmpty(array $array): bool
    {
        return empty(array_filter($array));
    }

    public static function moveElement(array &$array, $indexFrom, $indexTo): bool
    {
        $fromValue = $array[$indexFrom] ?? null;
        $toValue   = $array[$indexTo] ?? null;

        if (is_null($fromValue)) return false;

        if (isset($toValue))
        {
            $array[$indexFrom]  = $toValue;
        }

        $array[$indexTo] = $fromValue;

        return true;
    }
}