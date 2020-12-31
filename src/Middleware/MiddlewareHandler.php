<?php
/**
 * Middleware Library
 *
 * Middlewareクラスを登録し、アクションの前後で実行するクラス
 *
 * routing処理の際などに、アクションの前後で実行したい処理を
 * 登録できるライブラリです。
 *
 * @author tekku-taro @2021
 */

namespace Taro\Middleware;

use Closure;

class MiddlewareHandler
{
    public $middlewares = [];
    public $first;
    
    public function __construct()
    {
        $this->first = $this->createCoreFunction();
    }

    /**
     * ミドルウェアを登録
     *
     * @param BaseMiddleware $middleware
     * @return void
     */
    public function add(BaseMiddleware $middleware)
    {
        $next = $this->first;
        $this->first = $this->createMiddlewareFunction($middleware, $next);
    }

    /**
     * ミドルウェアの配列を登録
     *
     * @param BaseMiddleware[] $middlewares
     * @return void
     */
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
    
    /**
     * アクションを実行する関数を作成
     * TODO 実際の利用に合わせて内容を編集
     *
     * @return Closure
     */
    protected function createCoreFunction()
    {
        return function ($coreAction) {
            return $coreAction();
        };
    }
    
    /**
     * ミドルウェアを実行する関数を作成
     *
     * @param BaseMiddleware $middleware
     * @param Closure $next
     * @return Closure
     */
    protected function createMiddlewareFunction($middleware, Closure $next)
    {
        return function ($coreAction) use ($middleware,$next) {
            return $middleware->handle($coreAction, $next);
        };
    }

    /**
     * アクションと登録したミドルウェアの実行
     *
     * @param mixed $coreAction
     * @return mixed
     */
    public function handle($coreAction)
    {
        return call_user_func($this->first, $coreAction);
    }
}
