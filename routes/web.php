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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home']);

Route::get('/template', function(){
    return view('template');
});

Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])
    ->middleware(\App\Http\Middleware\OnlyGuestMiddleware::class);
Route::post('/login', [\App\Http\Controllers\UserController::class, 'doLogin'])
    ->middleware(\App\Http\Middleware\OnlyGuestMiddleware::class);
Route::post('/logout', [\App\Http\Controllers\UserController::class, 'doLogout'])
    ->middleware(\App\Http\Middleware\OnlyMemberMiddleware::class);

Route::controller(\App\Http\Controllers\TodolistController::class)->middleware([\App\Http\Middleware\OnlyMemberMiddleware::class])->group(function(){
    Route::get('/todolist', 'todolist');
    Route::post('/todolist', 'addTodo');
    Route::post('/todolist/{id}/delete', 'removeTodo');
});
