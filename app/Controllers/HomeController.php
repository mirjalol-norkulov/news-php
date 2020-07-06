<?php

namespace App\Controllers;

use App\Auth\Auth;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class HomeController
 * @package Controllers
 */
class HomeController extends BaseController
{
    public function index()
    {
        $user = Auth::user();
        $this->render('index.html.twig', ['user' => $user]);
    }
}