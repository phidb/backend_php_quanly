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

// $prefix_admin=config('zvn.url.prefix_admin');
$prefix_admin=Config::get('zvn.url.prefix_admin', 'admin123');

Route::get('/', function () {
    return view('home');
});


Route::prefix($prefix_admin)->group(function () {

    // =========== DASHBOARD ==========
    $prefix         = 'dashboard';
    $controllerName = 'dashboard';
    Route::prefix($prefix)->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                             $controller . 'index')          ->name('dashboard');
    });

    // =========== SLIDER ==========
    $prefix         = 'slider';
    $controllerName = 'slider';
    Route::prefix($prefix)->group(function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                             $controller . 'index')          ->name('slider');
        Route::get('form/{id?}',                    $controller . 'form')           ->name($controllerName. '/form');
        Route::get('delete/{id}',                   $controller . 'delete')         ->name($controllerName. '/delete')  ->where('id', '[0-9]+');;
        Route::get('change-status-{status}/{id}',   $controller . 'status')         ->name($controllerName. '/status')  ->where('id', '[0-9]+');;

    });
    
});