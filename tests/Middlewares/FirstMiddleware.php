<?php
namespace Tests\Middlewares;

use Taro\Middleware\BaseMiddleware;

class FirstMiddleware extends BaseMiddleware
{
    public function before($object)
    {
        $object->list[] = 1;
    }
    
    public function after($object)
    {
        $object->list[] = 3;
    }
}
