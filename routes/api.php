<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/health', function (Request $request) {
    return ["status" => "healthy"];
});

Route::middleware('auth:api')->get('/providers', function (Request $request) {
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
