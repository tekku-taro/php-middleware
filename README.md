# Php Middleware

フレームワーク内などで利用するミドルウェアライブラリです。 routing処理の際などに、アクションの前後で実行したい処理を登録して順に実行することができます。

## Middlewareとは

ウェブアップリケーション開発で、コアとなるリクエストの処理の前後に、何らかの前処理・後処理を加えたいことはあると思います。こうした処理は、様々なリクエストの際に共通に行いたい場合は、コントローラ等に記述するよりも、独立したクラスにして、必要なタイミングで呼び出したいでしょう。そういった際に、ミドルウェアの仕組みは役に立ちます。

### ミドルウェアの概念図

<img src=".\middleware.png" width="500">



上図のように、リクエストを処理するアクションを包むように、各ミドルウェアが配置されます。リクエストを受信時には、まず一番外側のミドルウェアが処理を実行、続いて内側のミドルウェアが処理を行い、コアのリクエスト処理を行うという流れになります。その後に、今度は逆に内側のミドルウェアの処理、外側のミドルウェアの処理がされて、レスポンスとしてクライアントに送信されます。

## ファイルの構成

```
src
├── Middleware					# ライブラリ本体 (ここのファイルのみ必須)
│   ├── BaseMiddleware.php        # ミドルウェアの雛形クラス
│   └── MiddlewareHandler.php     # ミドルウェアの登録、スタック全体の実行
├── Middlewares                   # 登録したいミドルウェアを配置
│   ├── FirstMiddleware.php       # ミドルウェアの見本
│   ... etc
... etc
└── index.php
```



## 使い方

### BaseMiddlewareを継承したMiddlewareクラスを作成

例としてCSRF処理用のミドルウェアを作成したもの。

```php
// Taro\Middleware\BaseMiddleware\FirstMiddlewareを参照。
<?php
namespace Taro\Middlewares;

use Taro\Middleware\BaseMiddleware;

class CsrfMiddleware extends BaseMiddleware
{
    // アクション実行前に実行する処理
    public function before($request)
    {
		// csrf token をチェック
    }
    
    // アクション実行後に実行する処理
    public function after($request, $response)
    {
		// csrf tokenをレスポンスに含める
    }
}
```

### MiddlewareHandlerのインスタンス生成

```php
$middlewareHandler = new MiddlewareHandler();
```

### 作成したMiddlewareクラスのリストをhandlerのstackListメソッドに渡す。

```php
 $middlewareHandler->stackList($middlewares);
```

### アクションのオブジェクトを渡して、handlerのhandleメソッドを実行。

```php
$result = $middlewareHandler->handle($coreAction);
```



## ライセンス (License)

**Php Middleware**は[MIT license](https://opensource.org/licenses/MIT)のもとで公開されています。

**Php Middleware** is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).# Php Middleware