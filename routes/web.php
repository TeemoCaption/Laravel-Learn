<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    // 使用者 GET / 時，回傳簡單文字
    return 'Laravel + Vue 學習系統';
});

Route::get('/users', function (Request $request) {
    // Laravel Service Container 會自動注入目前的 Request
    // 因此不需要自己寫 new Request()

    return Inertia::render('Users/Index');
});

Route::get('/users/{id}', function (Request $request, string $id) {
    // Request 是 Laravel Service Container 自動注入的 Dependency
    // $id 則來自網址中的 {id}

    return Inertia::render('Users/Show', [
        // 將 Route Parameter 傳給 Vue Page
        'userId' => $id,
    ]);
})
    // 限制 {id} 必須是數字，否則 Laravel 回傳 404
    ->whereNumber('id');

// 將舊的會員網址重新導向新的 /users
Route::redirect('/members', '/users');

require __DIR__ . '/settings.php';
