<?php

namespace App\Middleware;

use App\Auth\Auth;
use App\Middleware\Contracts\Middleware;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RoleMiddleware
 * @package App\Middleware
 */
class RoleMiddleware implements Middleware
{

    public function handle(Request $request)
    {
    }
}