<?php

/**
 * Class Session
 */
class Session
{
    /**
     * @param $key
     * @param $value
     */
    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function pop($key)
    {
        $value = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $value;
    }

    /**
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        // $key = "errors.email";
        $keys = explode(".", $key); // ["errors", "email"]

        $value = $_SESSION;
        foreach ($keys as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                return false;
            }
        }

        if (!$value) {
            return false;
        }

        return true;
    }
}