<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class HandleAppearance
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 新使用者預設使用淺色主題，仍允許透過 cookie 切換外觀
        View::share('appearance', $request->cookie('appearance') ?? 'light');

        return $next($request);
    }
}
