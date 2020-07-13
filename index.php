<?php
session_start();

require_once("vendor/autoload.php");

use App\Controllers\ErrorController;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;


try {
    // $_POST, $_GET, $_SERVER
    $request = Request::createFromGlobals();

    $fileLocator = new FileLocator([__DIR__]);
    $loader = new YamlFileLoader($fileLocator);
    $routes = $loader->load('routes/routes.yaml');


    $context = new RequestContext('/');
    $context->fromRequest($request);

    // Routing can match routes with incoming requests
    $matcher = new UrlMatcher($routes, $context);

    $match = $matcher->matchRequest($request);
    $request->attributes->add($match);

    $controllerResolver = new ControllerResolver();
    $argumentResolver = new ArgumentResolver();

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    $response = call_user_func_array($controller, $arguments);

} catch (ResourceNotFoundException $e) {
    (new ErrorController())->notFound();
} catch (Exception $e) {
    dd($e);
//    (new ErrorController())->internalServerError();
}
