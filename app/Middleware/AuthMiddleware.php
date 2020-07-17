<?php

namespace App\Middleware;

use App\Auth\Auth;
use App\Middleware\Contracts\Middleware;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthMiddleware
 */
class AuthMiddleware implements Middleware
{

    public function handle(Request $request)
    {
        if (!Auth::isLoggedIn()) {
            header("Location:/login");
            exit(0);
        }
    }
}