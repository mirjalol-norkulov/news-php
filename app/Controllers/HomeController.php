<?php

namespace App\Controllers;

use App\Auth\Auth;
use App\DB\Models\News;

/**
 * Class HomeController
 * @package Controllers
 */
class HomeController extends BaseController
{
    public function index()
    {
        $this->render('index.html.twig');
    }
}