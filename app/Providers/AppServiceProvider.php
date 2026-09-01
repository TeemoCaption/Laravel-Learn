<?php

namespace App\Providers;

use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
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
    }
}
