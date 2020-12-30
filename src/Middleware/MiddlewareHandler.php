<?php
/**
 * Middleware Library
 *
 * routing処理の際などに、アクションの前後で実行したい処理を
 * 登録できるライブラリです。
 *
 * @author tekku-taro @2021
 */

namespace Taro\Middleware;

class MiddlewareHandler
{
    public $middlewares = [];
    public $first;
    
    public function __construct()
    {
        $this->first = $this->createCoreFunction();
    }

    public function add(BaseMiddleware $middleware)
    {
        $next = $this->first;
        $this->first = $this->createMiddlewareFunction($middleware, $next);
    }

    public function stackList(array $middlewares)
    {
        $middlewares = array_reverse($middlewares);
        foreach ($middlewares as $middleware) {
            if (!is_object($middleware)) {
                $middleware = new $middleware();
            }
            $this->add($middleware);
        }
    }
    
    protected function createCoreFunction()
    {
        return function ($coreAction) {
            return $coreAction();
        };
    }
    
    protected function createMiddlewareFunction($middleware, $next)
    {
        return function ($coreAction) use ($middleware,$next) {
            return $middleware->handle($coreAction, $next);
        };
    }

    public function handle($coreAction)
    {
        return call_user_func($this->first, $coreAction);
    }
}
