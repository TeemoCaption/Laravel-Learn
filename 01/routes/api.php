<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    return [
        ['id' => 1, 'name' => 'Tanjiro'],
        ['id' => 2, 'name' => 'Mitsuri'],
    ];
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
