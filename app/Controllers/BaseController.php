<?php

namespace App\Controllers;

use App\Auth\Auth;
use App\Utils\Session;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class BaseController
 * @package App\Controllers
 */
abstract class BaseController
{
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('pages');
        $this->twig = new Environment($loader, [
//            'cache' => 'pages/cache',
        ]);
    }

    /**
     * @param $name
     * @param array $context
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render($name, array $context = [])
    {
        $user = Auth::user();
        $context = array_merge($context, [
            'user' => $user,
            'session' => new Session()
        ]);
        echo $this->twig->render($name, $context);
    }
}