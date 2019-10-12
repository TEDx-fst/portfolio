<?php

Route::group([
    'namespace' => 'auth'
        ], function () {

    Route::get('/login', [
        'uses' => 'LoginController@getLogin',
        'as' => 'login'
    ]);

    Route::post('/login', [
        'uses' => 'LoginController@postLogin',
        'as' => 'login'
    ]);

    Route::post('/logout', [
        'uses' => 'LoginController@logout',
        'as' => 'logout'
    ]);
});

Route::group(['middleware' => 'guest'], function() {

    Route::get('/home', [
        'uses' => 'HomeController@index',
        'as' => 'home'
    ]);

    Route::resource('team', 'TeamController');

    Route::resource('speakers', 'SpeakersController');

    Route::resource('partners', 'PartnersController');

    Route::resource('talks', 'TalksController');
});

Route::get('/', function () {

    return view('welcome');
});

