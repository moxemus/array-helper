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
        return $array[array_key_first($array)] ?? null;
    }

    /**
     * Returns real last array value, not with just count()-1 index.
     * If array is empty returns NULL.
     *
     * @param array $array
     *
     * @return mixed
     */
    public static function getLastValue(array $array): mixed
    {
        return $array[array_key_last($array)] ?? null;
    }

    /**
     * Returns first $count values from array
     *
     * @param array $array
     * @param int $count
     *
     * @return array
     */
    public static function getFirstValues(array $array, int $count): array
    {
        return array_slice($array, 0, $count, true);
    }

    /**
     * Returns last $count values from array
     *
     * @param array $array
     * @param int $count
     *
     * @return array
     */
    public static function getLastValues(array $array, int $count): array
    {
        return array_slice($array, count($array) - $count, $count, true);
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
        array_walk_recursive($array, function ($item) use (&$result) {
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
     * @return bool
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
     * Removes values from array by provided keys.
     *
     * @param array $array
     * @param array $keys
     *
     * @return mixed
     */
    public static function removeByKeys(array &$array, array $keys): bool
    {
        if (empty($array) || empty($keys)) {
            return false;
        }

        $array = array_diff_key($array, array_flip($keys));

        return true;
    }

    /**
     * Returns keys of all merged arrays
     *
     * @param array ...$arrays
     *
     * @return array
     */
    public static function getKeys(array ...$arrays): array
    {
        return array_keys($arrays);
    }

    /**
     * Returns values of all merged arrays
     *
     * @param array ...$arrays
     *
     * @return array
     */
    public static function getValues(array ...$arrays): array
    {
        return array_values($arrays);
    }

    /**
     * Returns keys of different values in array1 and array2.
     *
     * @param array $array1
     * @param array $array2
     *
     * @return array
     */
    public static function getKeysOfModifiedValues(array $array1, array $array2): array
    {
        return array_keys(array_diff_assoc($array1, $array2));
    }

    /**
     * Removes first array value.
     *
     * @param array $array
     *
     * @return mixed
     */
    public static function removeFirst(array &$array): bool
    {
        if (empty($array)) {
            return false;
        }

        unset($array[array_key_first($array)]);

        return true;
    }

    /**
     * Removes last array value.
     *
     * @param array $array
     *
     * @return mixed
     */
    public static function removeLast(array &$array): bool
    {
        if (empty($array)) {
            return false;
        }

        unset($array[array_key_last($array)]);

        return true;
    }

    /**
     * Removes all selected entries from array.
     *
     * @param array $array
     * @param mixed $value
     *
     * @return bool
     */
    public static function removeValue(array &$array, mixed $value): bool
    {
        if (empty($array)) {
            return false;
        }

        foreach (array_keys($array, $value, true) as $key) {
            unset($array[$key]);
        }

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
            if (!is_array($value)) {
                continue;
            }

            if ($value === $subArray || self::arrayContains($subArray, $value)) {
                return true;
            }
        }

        return false;
    }
}
