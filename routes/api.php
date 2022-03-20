<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group([

    'middleware' => 'api',

], function ($router) {

	Route::group([

	    'prefix' => 'auth',

	], function ($router) {
	    Route::post('login', 'App\Http\Controllers\AuthController@login');
	    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
	    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
	    Route::post('me', 'App\Http\Controllers\AuthController@me');
    });

	Route::group([

	    'middleware' => 'jwt.verify'

	], function ($router) {
		
		Route::apiResource('personas', 'App\Http\Controllers\PersonaController');
		Route::apiResource('citas', 'App\Http\Controllers\CitaController');
		
	});
});
//Route::apiResource('personas', 'App\Http\Controllers\PersonaController');
//Route::apiResource('citas', 'App\Http\Controllers\CitaController');