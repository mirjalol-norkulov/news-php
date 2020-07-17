<?php

namespace App\Middleware\Contracts;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface Middleware
 * @package App\Middleware\Contracts
 */
interface Middleware
{
    public function handle(Request $request);
}