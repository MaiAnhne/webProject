<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/store', 'App\Http\Controllers\apiResMaiAnh@store');

Route::post('/postUser', 'App\Http\Controllers\apiResMaiAnh@postUser');

