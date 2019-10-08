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
    return [
        "php-api" => "this service is a deployed and dockerised php REST Service",
        "DB_PASSWORD" => env('DB_PASSWORD'),
    ];
});

Route::get('/health', function () {
    return ["status" => "happy-and-cool"];
});

Route::get('/kevin', function () {
    return ["status" => "bad-ass"];
});

Route::get('/providers', function () {
    return ["providers" => [
            [
                "name" => "John Doe",
                "npi" => "12346355"
            ],
            [
                "name" => "Jane Doe",
                "npi" => "123463523"
            ],
            [
                "name" => "Mic Doeser",
                "npi" => "123451234"
            ],
            [
                "name" => "CatMan Shulzy",
                "npi" => "734562342"
            ],
            [
                "name" => "McFarlin Catz",
                "npi" => "123476355"
            ],
            [
                "name" => "Dog Bog",
                "npi" => "3463456345"
            ],
            [
                "name" => "Cool Hand Luke",
                "npi" => "234352345"
            ],
            [
                "name" => "Bob The Biznessman",
                "npi" => "73456463"
            ],
        ]
    ];
});
