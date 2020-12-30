<?php
namespace Taro\Middleware;

use Closure;

/**
 * BaseMiddleware class
 * このクラスを継承して、ミドルウェアクラスを作成する
 */
abstract class BaseMiddleware
{
    /**
     * ミドルウェアの処理内容
     *
     * @param mixed $coreAction
     * @param Closure $next
     * @return mixed
     */
    public function handle($coreAction, Closure $next)
    {
        $this->before($coreAction);
        $response = $next($coreAction);
        $this->after($coreAction);
        
        return $response;
    }
    
    /**
     * アクション実行前に実行する処理
     *
     * @param mixed $coreAction
     * @return void
     */
    public function before($coreAction)
    {
    }
   
    /**
     * アクション実行後に実行する処理
     *
     * @param mixed $coreAction
     * @return void
     */
    public function after($coreAction)
    {
    }
}
