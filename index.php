<?php
session_start();

require_once("vendor/autoload.php");

use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$uri = $request->server->get('REQUEST_URI');

switch ($uri) {
    case "/login":
        require "./pages/login.php";
        break;
    case "/":
        require "./pages/homepage.php";
        break;
    default:
        require "./pages/404.php";
        break;
}


