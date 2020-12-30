<?php
namespace Taro;

use Taro\Middleware\MiddlewareHandler;

class Application
{
    protected $middlewareHandler;
    
    public $middlewares = [
        \Taro\Middlewares\FirstMiddleware::class,
        \Taro\Middlewares\SecondMiddleware::class,
    ];

    public function __construct(MiddlewareHandler $middlewareHandler)
    {
        $this->middlewareHandler = $middlewareHandler;
        $this->middlewareHandler->stackList($this->middlewares);
    }

    public function run($coreAction)
    {
        return $this->middlewareHandler->handle($coreAction);
    }
}
