<?php

use Illuminate\Http\Request;

Route::post('guest', 'Auth\LoginController@gust');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth:api'], function() {

	Route::get('/user', function (Request $request) {
    	return $request->user();
    });

    Route::put('task/{id}', 'TaskController@update');

    Route::post('transaction', 'TransactionsController@store');
});
