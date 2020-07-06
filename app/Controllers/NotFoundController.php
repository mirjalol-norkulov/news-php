<?php

namespace App\Controllers;

/**
 * Class NotFoundController
 * @package App\Controllers
 */
class NotFoundController extends BaseController
{
    public function notFound()
    {
        $this->render('404.html.twig');
    }
}