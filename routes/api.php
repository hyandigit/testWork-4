<?php

use App\Http\Middleware\CookieMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(CookieMiddleware::class)->prefix('cart')->group(function () {
    Route::get('/', '\App\Http\Controllers\CartController@list');
    Route::post('/update/{product}', '\App\Http\Controllers\CartController@update');
    Route::post('/user', '\App\Http\Controllers\CartController@addUser');
});
