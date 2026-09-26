<?php

use Illuminate\Support\Facades\Route;

// 匹配請求的本機子路徑並傳回對應的 Blade 視圖。
Route::prefix('dashboard/firstwebsite/public')->group(function (): void {
    Route::view('/', 'home')->name('home');
    Route::view('/contact', 'contact')->name('contact');
});
