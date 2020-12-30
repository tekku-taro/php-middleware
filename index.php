<?php
/**
 * Middleware Library
 *
 * routing処理の際などに、アクションの前後で実行したい処理を
 * 登録できるライブラリです。
 *
 * ## 使い方
 * // BaseMiddlewareを継承したMiddlewareクラスを作成
 * // Taro\Middleware\BaseMiddleware\FirstMiddlewareを参照。
 *
 * // MiddlewareHandlerのインスタンス生成
 * $middlewareHandler = new MiddlewareHandler();
 *
 * // 作成したMiddlewareクラスのリストをhandlerのstackListメソッドに渡す。
 * $middlewareHandler->stackList($middlewares);
 *
 * // アクションのオブジェクトを渡して、handlerのhandleメソッドを実行。
 * $result = $middlewareHandler->handle($coreAction);
 *
 * @author tekku-taro @2021
 */

require_once "vendor/autoload.php";
use Taro\Application;
use Taro\Middleware\MiddlewareHandler;

$middlewareHandler = new MiddlewareHandler();
$app = new Application($middlewareHandler);


class CoreAction
{
    public $list;

    public function __invoke()
    {
        $this->list[] = 'core';
        return 'success';
    }
}

$coreAction = new CoreAction();

$response = $app->run($coreAction);
var_dump($response);
var_dump($coreAction);
