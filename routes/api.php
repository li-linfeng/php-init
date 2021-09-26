<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

$api = app('Dingo\Api\Routing\Router');


$api->version('v1', function($api){
    $api->get('/', function(){
        return 123;
    });

    /**
     * 无需登录的接口
     */
    $api->group([
        'namespace' => 'App\Http\Controllers',
        'middleware' => ['api']
    ],function($api){
        $api->get('/auth/oauth', 'AuthController@oauth');
        $api->get('/auth/callback', 'AuthController@callback');
        $api->post('/social/login', 'AuthController@login');
    });


    /**
     * 需要登录的接口
     */


    $api->group([
        'namespace' => 'App\Http\Controllers',
        'middleware' => ['api','auth.jwt']
    ],function($api){
        $api->get('/info', 'UserController@info');
    });

});

