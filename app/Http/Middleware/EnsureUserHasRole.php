<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * 處理進入應用程式的 HTTP Request。
     *
     * $role 是從 Route Middleware 傳進來的角色參數。
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(
        Request $request,
        Closure $next,
        string $role
    ): Response {
        // 這裡暫時使用 email 模擬角色，
        // 目的是先學習 Middleware Parameters。
        //
        // 後面學 Authorization / Database 時，
        // 再改成真正的角色與權限系統。
        $currentRole = $request->user()?->email === 'admin@example.com'
            ? 'admin'
            : 'member';

        // 如果目前使用者的角色與 Route 要求的角色不同，
        // 就直接阻止 Request 繼續執行。
        if ($currentRole !== $role) {
            abort(403, '你沒有權限進入這個頁面。');
        }

        // 權限符合，讓 Request 繼續進入 Route。
        return $next($request);
    }
}
