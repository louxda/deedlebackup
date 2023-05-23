<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', \App\Http\Controllers\Home::class)->name("home")->middleware('hasCookie');
Route::get('/deedlercount/{deedleid}', [\App\Http\Controllers\Home::class,'getdeedlercount'])->name("home")->middleware('hasCookie');
Route::post("/deedle-completed",\App\Http\Controllers\DeedleCompleted::class)->middleware("hasCookie");
