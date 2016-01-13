<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Authentication routes...




Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/home', function() {
        return view('home');
    });
    Route::get('/cards', 'CardController@index' );
    Route::post('/card', 'CardController@store' );
    Route::delete('/card/{card}', 'CardController@destroy' );

    Route::resource('tag', 'TagController' );
//    Route::get('/tags', 'TagController@index' );
//    Route::post('/tag', 'TagController@store' );
//    Route::delete('/tag/{tag}', 'TagController@destroy' );
});
