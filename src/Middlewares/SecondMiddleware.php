<?php
namespace Taro\Middlewares;

use Taro\Middleware\BaseMiddleware;

class SecondMiddleware extends BaseMiddleware
{
    public function before($coreAction)
    {
        $coreAction->list[] = 2;
    }
    
    public function after($coreAction, $response)
    {
        $coreAction->list[] = 4;
    }
}
