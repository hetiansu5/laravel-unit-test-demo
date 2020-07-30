<?php

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

/**
 * @var \Laravel\Lumen\Routing\Router $router
 */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => '/users'], function () use ($router) {
    $router->post('/', ['uses' => 'UserController@create']);
    $router->get('/{id}', ['uses' => 'UserController@retrieveOne']);
    $router->put('/{id}', ['uses' => 'UserController@update']);
    $router->delete('/{id}', ['uses' => 'UserController@delete']);
});
