<?php

namespace App\Utils;

use IlluminateAgnostic\Arr\Support\Arr;

/**
 * Class Session
 */
class Session
{
    /**
     * @param $key
     * @param $value
     */
    public static function put(string $key, $value): void
    {
        Arr::set($_SESSION, $key, $value);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function get(string $key)
    {
        return Arr::get($_SESSION, $key);
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function pop(string $key)
    {
        return Arr::pull($_SESSION, $key);
    }

    /**
     * @param $key
     * @return bool
     */
    public static function has(string $key)
    {
        return Arr::has($_SESSION, $key);
    }

    /**
     * @param string $key
     */
    public static function remove(string $key)
    {
        Arr::forget($_SESSION, $key);
    }
}