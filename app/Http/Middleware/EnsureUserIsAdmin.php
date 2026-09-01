<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * 處理進入應用程式的 HTTP Request。
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 檢查目前登入的使用者是不是管理員。
        //
        // 這裡暫時使用 email 判斷，只是為了學習 Middleware。
        // 後面學 Authorization / Policy 時會使用更正式的權限管理方式。
        if ($request->user()?->email !== 'admin@example.com') {
            abort(403, '你沒有權限進入管理員頁面。');
        }

        // 通過 Middleware 後，
        // 把 Request 繼續傳給下一個 Middleware 或 Route。
        return $next($request);
    }
}
