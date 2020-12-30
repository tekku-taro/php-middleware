<?php
namespace Taro\Middlewares;

use Taro\Middleware\BaseMiddleware;

class FirstMiddleware extends BaseMiddleware
{
    public function before($coreAction)
    {
        $coreAction->list[] = 1;
    }
    
    public function after($coreAction)
    {
        $coreAction->list[] = 3;
    }
}
