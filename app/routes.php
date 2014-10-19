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
Route::post('/register', array('before' =>'guest', function(){
    if(User::where('username','=',Input::get('account'))->count()>0) 
        return Response::json(array('error'=>'been_registered_username'));
    if(User::where('email','=',Input::get('email'))->count()>0)
        return Response::json(array('error'=>'been_registered_email'));
    $user = array(
            'username' => Input::get('account'),
            'password' => Hash::make(Input::get('password')),
            'email' => Input::get('email'),
            'privilege' => '4',
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        );
    DB::table('users')->insert($user);
    return Response::json(array('success'=>'success'));
}));
Route::controller('/user', 'UserController');
Route::controller('/', 'HomeController');
