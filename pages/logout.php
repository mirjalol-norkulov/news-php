<?php

require "../vendor/autoload.php";

use App\Utils\Session;

session_start();

// Auth::logout();
Session::remove("user");

// Redirect("/")
// Redirect()->back();
header("Location:{$_SERVER['HTTP_REFERER']}");