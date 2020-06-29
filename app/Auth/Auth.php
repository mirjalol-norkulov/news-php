<?php


namespace App\Auth;

use App\Utils\Session;

/**
 * Class Auth
 * @package App\Auth
 */
class Auth
{
    const SESSION_KEY = "user";

    /**
     * @return bool
     */
    public static function isLoggedIn(): bool
    {
        return Session::has(self::SESSION_KEY);
    }
}