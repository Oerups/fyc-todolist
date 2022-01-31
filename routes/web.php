<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('/login', 'AuthController@login');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/', 'TodoListController@index');
    $router->get('/{id}', 'TodoListController@show');
    $router->post('/', 'TodoListController@store');
    $router->put('/{id}', 'TodoListController@update');
    $router->delete('/{id}', 'TodoListController@destroy');
});
