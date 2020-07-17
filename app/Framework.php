<?php

namespace App;

use App\Controllers\ErrorController;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;

/**
 * Class Framework
 * @package App
 */
class Framework
{
    protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;

    protected $middlewareMap = [
        'auth' => AuthMiddleware::class,
        'role' => RoleMiddleware::class
    ];

    /**
     * Framework constructor.
     * @param $matcher
     * @param $controllerResolver
     * @param $argumentResolver
     */
    public function __construct(UrlMatcher $matcher, ControllerResolver $controllerResolver, ArgumentResolver $argumentResolver)
    {
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    public function handle(Request $request)
    {
        try {
            $this->matcher->getContext()->fromRequest($request);
            $match = $this->matcher->matchRequest($request);

            if (isset($match['_middlewares']) && is_array($match['_middlewares'])) {
                $middlewares = $match['_middlewares'];
                foreach ($middlewares as $middleware) {
                    $Middleware = $this->middlewareMap[$middleware];
                    (new $Middleware())->handle($request);
                }
            }
            $request->attributes->add($match);
            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);
            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $e) {
            return (new ErrorController())->notFound();
        } catch (\Exception $e) {
            dd($e);
//            return (new ErrorController())->internalServerError();
        }
    }
}