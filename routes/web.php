<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


// 路由群組 group
// prefix 是前綴 url
Route::prefix('dashboard/firstwebsite/public')->group(function (): void {
    Route::view('/', 'home')->name('home');
    Route::view('/contact', 'contact')->name('contact');
    // 使用 url 傳遞參數
    Route::get('/portfolio/{firstname}/{lastname}', function (string $firstname, string $lastname) {
        return $firstname . ' ' . $lastname;
    })->name('portfolio');

    // 命名路由
    Route::get('/test', function () {
        return 'This is a test.';
    })->name('testpage');

    // 驗證表單資料，並回傳姓名與電子郵件。
    Route::post('/formsubmitted', function (Request $request) {
        $request->validate([
            'fullname' => 'required|min:3|max:30',
            'email' => 'required|min:3|max:30|email',
        ]);

        $fullname = $request->input('fullname');
        $email = $request->input('email');

        return "Your fullname is $fullname, and your email is $email";
    })->name('formsubmitted');
});

// 路由群組
Route::prefix('portfolio')->group(function () {
    Route::get('/company', function () {
        return view('company');
    });
    Route::get('/organization', function () {
        return view('organization');
    });
});
