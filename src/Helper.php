<?php

namespace moxemus\array;

class Helper
{
    /**
     * Returns array value by index if it's possible, otherwise returns default.
     *
     * @param string|int|null $index
     * @param array $array
     * @param null $default
     *
     * @return mixed
     */
    public static function getValue(string|int|null $index, array $array, $default = null): mixed
    {
        return (key_exists($index, $array))
            ? $array[$index]
            : $default;
    }

    /**
     * Returns int value if it's possible, otherwise returns NULL.
     *
     * @param string|int|null $index
     * @param array $array
     *
     * @return int|null
     */
    public static function getIntOrNull(string|int|null $index, array $array): ?int
    {
        $value = self::getValue($index, $array);

        return (is_null($value))
            ? null
            : intval($value);
    }

    /**
     * Returns bool value if it's possible, otherwise returns NULL.
     *
     * @param string|int|null $index
     * @param array $array
     *
     * @return bool|null
     */
    public static function getBoolOrNull(string|int|null $index, array $array): ?bool
    {
        $value = self::getValue($index, $array);

        return (is_null($value))
            ? null
            : boolval($value);
    }

    /**
     * Returns real first array value, not with zero index.
     * If array is empty returns NULL.
     *
     * @param array $array
     *
     * @return mixed
     */
    public static function getFirstValue(array $array): mixed
    {
        return $array[self::getFirstIndex($array)] ?? null;
    }

    /**
     * Returns real last array value, not with just count()-1 index.
     * If array is empty returns NULL.
     *
     * @param array $array
     *
     * @return string|int|null
     */
    public static function getLastValue(array $array): string|int|null
    {
        return $array[self::getLastIndex($array)] ?? null;
    }

    /**
     * Returns real first array index, not with just 0 index.
     *
     * @param array $array
     *
     * @return string|int|null
     */
    public static function getFirstIndex(array $array): string|int|null
    {
        if (empty($array)) {
            return null;
        }

        $keys = array_keys($array);

        return $keys[0];
    }

    /**
     * Returns real last array index, not just count()-1.
     *
     * @param array $array
     *
     * @return string|int|null
     */
    public static function getLastIndex(array $array): string|int|null
    {
        if (empty($array)) {
            return null;
        }

        $keys = array_keys($array);

        return $keys[count($array) - 1];
    }

    /**
     * Returns index of max value in array.
     * If array is empty returns NULL.
     *
     * @param array $array
     *
     * @return string|int|null
     */
    public static function getMaxIndex(array $array): string|int|null
    {
        if (empty($array)) {
            return null;
        }

        return array_keys($array, max($array))[0];
    }

    /**
     * Returns index of miv value in array.
     * If array is empty returns NULL.
     *
     * @param array $array
     *
     * @return string|int|null
     */
    public static function getMinIndex(array $array): string|int|null
    {
        if (empty($array)) {
            return null;
        }

        return array_keys($array, min($array))[0];
    }

    /**
     * Returns linear array from multidimensional.
     *
     * @param array $array
     *
     * @return array
     */
    public static function getSimpleArray(array $array): array
    {
        $result = [];
        array_walk_recursive($array, function ($item, $key) use (&$result) {
            $result[] = $item;
        });

        return $result;
    }

    /**
     * Moves value on any new place in array.
     * If array have indexTo, values between indexes will swap.
     * If array don't have indexTo it will be added with value from indexFrom.
     *
     * @param array $array
     * @param string|int|null $indexFrom
     * @param string|int|null $indexTo
     *
     * @return mixed
     */
    public static function moveValue(array &$array, string|int|null $indexFrom, string|int|null $indexTo): bool
    {
        if (!key_exists($indexFrom, $array)) {
            return false;
        }

        if (key_exists($indexTo, $array)) {
            $array[$indexFrom] = self::getValue($indexTo, $array);
        }

        $array[$indexTo] = self::getValue($indexFrom, $array);

        return true;
    }

    /**
     * Returns is array empty without NULL, '' and 0 values.
     *
     * @param array $array
     *
     * @return bool
     */
    public static function isEmpty(array $array): bool
    {
        return empty(array_filter($array));
    }

    /**
     * Checks recursively if array contains subarray.
     *
     * @param array $subArray
     * @param array $array
     *
     * @return bool
     */
    public static function arrayContains(array $subArray, array $array): bool
    {
        foreach ($array as $value) {
            if (is_array($value)) {
                if ($value === $subArray || self::arrayContains($subArray, $value))
                    return true;
            }
        }

        return false;
    }
}