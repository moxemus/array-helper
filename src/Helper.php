<?php

namespace moxemus\array;

class Helper
{

    /**
     * Returns real first array element, not with zero index
     *
     * @param array $array
     * @return mixed
     */
    public static function getFirstElement(array $array): mixed
    {
        if (empty($array)) return null;

        $keys = array_keys($array);
        $firstIndex = $keys[0];

        return $array[$firstIndex];
    }

    /**
     * Returns is array empty without NULL, '' and 0 values
     *
     * @param array $array
     * @return mixed
     */
    public static function isEmpty(array $array): bool
    {
        return empty(array_filter($array));
    }

    /**
     * Moves element on any new place in array
     *
     * @param array $array
     * @param $indexFrom
     * @param $indexTo
     * @return mixed
     */
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