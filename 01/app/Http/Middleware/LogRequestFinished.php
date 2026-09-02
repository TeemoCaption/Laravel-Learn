<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequestFinished
{
    /**
     * 處理進入 Laravel 的 HTTP Request。
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 這裡不阻擋 Request，
        // 直接讓 Request 繼續進入下一個 Middleware 或 Route。
        return $next($request);
    }

    /**
     * Response 送到瀏覽器之後執行收尾工作。
     */
    public function terminate(Request $request, Response $response): void
    {
        // 記錄這次 Request 已經處理完成。
        Log::info('HTTP Request 已完成', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'status' => $response->getStatusCode(),
        ]);
    }
}
