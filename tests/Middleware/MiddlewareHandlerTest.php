<?php
require_once "vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use Taro\Middleware\MiddlewareHandler;

class CoreAction
{
    public $list;

    public function __invoke()
    {
        $this->list[] = 'core';
        return 'success';
    }
}

class MiddlewareHandlerTest extends TestCase
{
    public $middlewares = [
        \Tests\Middlewares\FirstMiddleware::class,
        \Tests\Middlewares\SecondMiddleware::class,
    ];
    /** @var MiddlewareHandler */
    public $middlewareHandler;


    public function setUp():void
    {
        $this->middlewareHandler = new MiddlewareHandler();
    }


    public function testStackList()
    {
        $this->middlewareHandler->stackList($this->middlewares);

        $first = new \Tests\Middlewares\FirstMiddleware();
        $second = new \Tests\Middlewares\SecondMiddleware();

        $coreFunc = function ($coreAction) {
            return $coreAction();
        };
        $next = function ($coreAction) use ($second,$coreFunc) {
            return $second->handle($coreAction, $coreFunc);
        };
        
        $expected = function ($coreAction) use ($first,$next) {
            return $first->handle($coreAction, $next);
        };
        
        $this->assertEquals($expected, $this->middlewareHandler->first);
    }

    public function testHandle()
    {
        $this->middlewareHandler->stackList($this->middlewares);
    
        $coreAction = new CoreAction();
        $result = $this->middlewareHandler->handle($coreAction);
        
        $expected = [
            1,2,'core',4,3
        ];

        $this->assertEquals($expected, $coreAction->list);
        $this->assertEquals('success', $result);
    }
}
