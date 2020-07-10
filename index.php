<?php
session_start();

require_once("vendor/autoload.php");

use App\Auth\Auth;
use App\Controllers\NotFoundController;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

// $_POST, $_GET, $_SERVER
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
    $request->attributes->add($match);
} catch (ResourceNotFoundException $e) {
    (new NotFoundController())->notFound();
}

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$controller = $controllerResolver->getController($request);
$arguments = $argumentResolver->getArguments($request, $controller);

$response = call_user_func_array($controller, $arguments);