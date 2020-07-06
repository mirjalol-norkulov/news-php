<?php
session_start();

require_once("vendor/autoload.php");

use App\Controllers\NotFoundController;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$request = Request::createFromGlobals();


$fileLocator = new FileLocator([__DIR__]);
$loader = new YamlFileLoader($fileLocator);
$routes = $loader->load('routes/routes.yaml');

$context = new RequestContext('/');
$context->fromRequest($request);

// Routing can match routes with incoming requests
$matcher = new UrlMatcher($routes, $context);


try {
    $match = $matcher->matchRequest($request);
} catch (ResourceNotFoundException $e) {
    (new NotFoundController())->notFound();
}

$class = $match['_controller'];
$method = $match['_action'];

if (class_exists($class)) {
    var_dump($match);
    $controller = new $class(); // $controller = new LoginController();
    $controller->{$method}();  // $controller->login();
}


