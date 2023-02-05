<?php

namespace moxemus\array;

class Helper
{
    /**
     * Returns array value by index or some default value
     *
     * @param $index
     * @param array $array
     * @param null $default
     * @return mixed
     */
    public static function getValue($index, array $array, $default = null): mixed
    {
        return (key_exists($index, $array))
            ? $array[$index]
            : $default;
    }

    /**
     * Returns int value if it's possible, otherwise returns NULL
     *
     * @param $index
     * @param array $array
     * @return int|null
     */
    public static function getIntOrNull($index, array $array): ?int
    {
        $value = self::getValue($index, $array);

        return (is_null($value))
            ? null
            : intval($value);
    }

    /**
     * Returns bool value if it's possible, otherwise returns NULL
     *
     * @param $index
     * @param array $array
     * @return bool|null
     */
    public static function getBoolOrNull($index, array $array): ?bool
    {
        $value = self::getValue($index, $array);

        return (is_null($value))
            ? null
            : boolval($value);
    }

    /**
     * Returns real first array value, not with zero index
     *
     * @param array $array
     * @return mixed
     */
    public static function getFirstValue(array $array): mixed
    {
        return $array[self::getFirstIndex($array)];
    }

    /**
     * Returns real last array value, not with count($array)-1 index
     *
     * @param array $array
     * @return string|int|null
     */
    public static function getLastValue(array $array): string|int|null
    {
        return $array[self::getLastIndex($array)];
    }

    /**
     * Returns real first array element, not with zero index
     *
     * @param array $array
     * @return mixed
     */
    public static function getFirstIndex(array $array): mixed
    {
        if (empty($array)) return null;

        $keys = array_keys($array);

        return $keys[0];
    }

    /**
     * Returns real last array element, not with zero index
     *
     * @param array $array
     * @return string|int|null
     */
    public static function getLastIndex(array $array): string|int|null
    {
        if (empty($array)) return null;

        $keys = array_keys($array);

        return $keys[count($array) - 1];
    }

    /**
     * Returns index of max value in array
     *
     * @param array $array
     * @return string|int
     */
    public static function getMaxIndex(array $array): string|int
    {
        return array_keys($array, max($array))[0];
    }

    /**
     * Returns index of miv value in array
     *
     * @param array $array
     * @return string|int
     */
    public static function getMinIndex(array $array): string|int
    {
        return array_keys($array, min($array))[0];
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

    /**
     * Returns is array empty without NULL, '' and 0 values
     *
     * @param array $array
     * @return bool
     */
    public static function isEmpty(array $array): bool
    {
        return empty(array_filter($array));
    }

    /**
     * Returns is arrays are equal
     *
     * @param array $a
     * @param array $b
     * @return bool
     */
    public static function isEqual(array $a, array $b): bool
    {
        return empty(array_diff($a, $b));
    }
}