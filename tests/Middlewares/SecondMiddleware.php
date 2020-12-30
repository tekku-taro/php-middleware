<?php
namespace Tests\Middlewares;

use Taro\Middleware\BaseMiddleware;

class SecondMiddleware extends BaseMiddleware
{
    public function before($object)
    {
        $object->list[] = 2;
    }
    
    public function after($object)
    {
        $object->list[] = 4;
    }
}
