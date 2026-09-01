<?php

namespace App\Providers;

use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * 註冊應用程式服務。
     */
    public function register(): void
    {
        //
    }

    /**
     * 啟動應用程式服務。
     */
    public function boot(): void
    {
        // 明確指定 {user} Route Parameter
        // 應該綁定到 User Model
        Route::model('user', User::class);

        // 建立名稱為 users 的 Rate Limiter。
        RateLimiter::for('users', function (Request $request) {
            // 每位使用者每分鐘最多存取 10 次。
            return Limit::perMinute(10)
                // 已登入時使用 User ID 區分；
                // 未登入時則使用 IP 位址區分。
                ->by($request->user()?->id ?: $request->ip());
        });
    }
}
