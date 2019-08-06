<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ["php-api" => "this service is deployed and dockerised with in PHP"];
});

Route::get('/health', function () {
    return ["status" => "healthy"];
});
