<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::post('/login', array('before' => 'guest', function(){
    $credentials =[
        'username' => Input::get('account'),
        'password' => Input::get('password')
    ];
    if (Auth::attempt($credentials))
        return Response::json(array('response'=>'ok'));else
            return Response::json(array('response' => 'Unauthorized'));
}));
Route::controller('/user', 'UserController');
Route::controller('/', 'HomeController');
