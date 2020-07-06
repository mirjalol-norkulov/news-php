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
    public function put(string $key, $value): void
    {
        Arr::set($_SESSION, $key, $value);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return Arr::get($_SESSION, $key);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function pop(string $key)
    {
        return Arr::pull($_SESSION, $key);
    }

    /**
     * @param $key
     * @return bool
     */
    public function has(string $key)
    {
        return Arr::has($_SESSION, $key);
    }

    /**
     * @param string $key
     */
    public function remove(string $key)
    {
        Arr::forget($_SESSION, $key);
    }
}