<?php

Route::group([
    'namespace' => 'auth'
        ], function () {

    Route::group(['middleware' => 'guest'], function () {

        Route::get('/login', [
            'uses' => 'LoginController@getLogin',
            'as' => 'login'
        ]);

        Route::post('/login', [
            'uses' => 'LoginController@postLogin',
            'as' => 'login'
        ]);
    });

    Route::post('/logout', [
        'uses' => 'LoginController@logout',
        'as' => 'logout'
    ]);
});

Route::resource('team', 'TeamController');

use App\Mail\userEmail;

Route::get('/email', function() {
    Sentinel::getRoleRepository()->create([
        'name' => 'Admins',
        'slug' => 'admin',
    ]);


//    return new userEmail();
});



Route::get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('admin');

Route::get('/moderator/dashboard', function() {
    return view('moderator.dashboard');
})->name('moderator.dashboard');

Route::get('/user/dashboard', function() {
    return view('user.dashboard');
})->name('user.dashboard');


Route::get('/home', function() {
    return view('home');
})->name('home');

Route::get('/', function () {

    return view('welcome');
});

