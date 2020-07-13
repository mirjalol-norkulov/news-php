<?php

namespace App\Controllers;

/**
 * Class ErrorController
 * @package App\Controllers
 */
class ErrorController extends BaseController
{
    public function notFound()
    {
        $this->render('errors/404.html.twig');
    }

    public function internalServerError()
    {
        $this->render('errors/500.html.twig');
    }
}