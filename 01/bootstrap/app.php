<?php
// 這個檔案是 Laravel 應用程式的啟動配置文件
// 它負責全局配置應用程式的路由、中介層和例外處理

use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);

        $middleware->web(append: [
            // 這個 Middleware 會處理外觀設定
            HandleAppearance::class,
            // 這個 Middleware 會處理 Inertia 的請求
            HandleInertiaRequests::class,
            // 這個 Middleware 會在 Vite 編譯時自動加入<link>標籤
            AddLinkHeadersForPreloadedAssets::class,
        ]);

        // 為自訂 Middleware 建立簡短的別名，讓 Route 可以使用 role/admin。
        $middleware->alias([
            'role' => EnsureUserHasRole::class,
            'admin' => EnsureUserIsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn(Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
