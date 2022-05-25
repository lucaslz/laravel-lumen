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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

$router->get('/', function (Request $request) use ($router) {
    dd(route("users.list"), url("/"), app('url')->forceRootUrl(env('APP_URL')), env('APP_NAME'), URL::to('users.list'));
    return $router->app->version();
});

$router->group(['namespace' => 'Api'], function () use ($router) {
    $router->group(['prefix' => 'api'], function () use ($router) {
        $router->group(['prefix' => 'client'], function () use ($router) {
            $router->get('/clients', ['as' => 'clients', 'uses' => 'ClientController@index']);
        });

        // Route::resource('users', 'UserController');
        $router->group(['prefix' => 'users'], function () use ($router) {
            $router->get('/', [ 'as' => 'users.list', 'uses' => 'UserController@index']);
            $router->post('/', [ 'as' => 'users.store', 'uses' => 'UserController@store']);
            $router->get('/{id}', [ 'as' => 'users.show', 'uses' => 'UserController@show']);
            $router->addRoute(['PUT', 'PATCH'], '/{id}', [ 'as' => 'users.update', 'uses' => 'UserController@update']);
            $router->delete('/users/{id}', [ 'as' => 'users.delete', 'uses' => 'UserController@destroy']);
            $router->get('/user/verify/{token}', [ 'as' => 'verification_account' , 'uses' => 'UserController@verify']);
            $router->post('/login', [ 'as' => 'verification_account' , 'uses' => 'UserController@login']);
            $router->post('refresh', ['middleware' => 'auth', 'uses' => 'UserController@refresh']);
        });
    });
});

// $router->group(['prefix' => 'api'], function () use ($router) {
    // $router->post('/users', [ 'as' => 'users.store', 'uses' => 'Api\UserController@store']);
    // $router->get('/users', [ 'as' => 'users.list', 'uses' => 'Api\UserController@index']);
    // $router->get('/users/{id}', [ 'as' => 'users.show', 'uses' => 'Api\UserController@show']);
    // $router->addRoute(['PUT', 'PATCH'], '/users/{id}', [ 'as' => 'users.update', 'uses' => 'Api\UserController@update']);
    // $router->delete('/users/{id}', [ 'as' => 'users.delete', 'uses' => 'Api\UserController@destroy']);
    // $router->get('/user/verify/{token}', [ 'as' => 'verification_account' , 'uses' => 'Api\UserController@verify']);
    // $router->post('/login', [ 'as' => 'verification_account' , 'uses' => 'Api\UserController@login']);
    // $router->post('refresh', ['middleware' => 'auth', 'uses' => 'Api\UserController@refresh']);

    // $router->group(['middleware' => ['auth', 'user-is-verified', 'token-expirated']], function () use ($router) {
        // $router->get('/clients', ['as' => 'clients', 'uses' => 'Api\ClientController@index']);
    // });
// });
