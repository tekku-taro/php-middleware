<?php
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
var_dump($action);
