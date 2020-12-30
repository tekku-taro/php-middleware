<?php
namespace Taro\Middleware;

use Closure;

abstract class BaseMiddleware
{
    public function handle($coreAction, Closure $next)
    {
        $this->before($coreAction);
        $response = $next($coreAction);
        $this->after($coreAction);
        
        return $response;
    }
    
    public function before($coreAction)
    {
    }
    
    public function after($coreAction)
    {
    }
}
