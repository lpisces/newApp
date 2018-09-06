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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function($api) {
  $api->post('login', 'App\Http\Controllers\API\AuthController@login');
});

$api->version('v1', ['middleware' => 'api.auth'], function ($api) {
  $api->get('whoami', 'App\Http\Controllers\API\AuthController@me');

	$api->put('user', 'App\Http\Controllers\API\UserController@store');
});
