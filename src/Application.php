<?php
namespace Taro;

use Taro\Middleware\MiddlewareHandler;

/**
 * ミドルウェアを呼び出すアプリケーションクラスの例
 */
class Application
{
    protected $middlewareHandler;
    
    /**
     * 登録したいミドルウェアクラスを配列に格納
     *
     * @var array
     */
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
