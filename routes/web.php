<?php

use App\Enums\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// 首頁提供給尚未登入的使用者，並作為登入版面的 home route。
Route::get('/', function () {
    return 'Laravel + Vue 學習系統';
})->name('home');

Route::get('/categories/{category}', function (Category $category) {
    // Laravel 會把 URL 的值自動轉換成 Category Enum
    return $category->value;
});

// Dashboard 仍然需要先通過 auth middleware。
Route::middleware('auth')->group(function () {
    // 登入後顯示 Dashboard 頁面。
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

});

// --------------------------------------------------
// 管理員路由
// --------------------------------------------------
// 不使用預設 auth middleware，改由自訂 admin middleware 判斷權限。
Route::middleware('admin')->group(function () {
    // 顯示管理員頁面。
    Route::get('/admin', function () {
        return Inertia::render('Admin/Index');
    })->name('admin.index');

    // 管理員提交測試訊息。
    // POST Request 會受到 Laravel CSRF Protection 保護。
    Route::post('/admin/message', function (Request $request) {
        return back()->with(
            'success',
            "收到管理員訊息：{$request->input('message')}",
        );
    })->name('admin.message');
});

// 使用者相關 Route 不要求登入，
// 每位使用者每分鐘最多只能存取 10 次。
Route::middleware('throttle:users')->group(function () {
    // 顯示使用者列表頁面。
    Route::get('/users', function (Request $request) {
        return Inertia::render('Users/Index');
    })->name('users.index');

    // 依照網址中的 user ID 自動查詢使用者並顯示詳細資料。
    Route::get('/users/{user}', function (
        Request $request,
        User $user,
    ) {
        return Inertia::render('Users/Show', [
            // 將 Laravel 查詢到的 User 資料傳給 Vue 頁面。
            'user' => $user,
        ]);
    })->name('users.show');
});

// 將舊的會員網址重新導向新的使用者列表。
Route::redirect('/members', '/users');

// 載入設定頁面的 Profile、Security 與 Appearance routes。
require __DIR__ . '/settings.php';

// 當上面的所有 Route 都無法匹配時，顯示自訂 404 頁面。
// fallback 通常應該放在路由檔案的最後面。
Route::fallback(function () {
    return Inertia::render('Errors/NotFound');
});
