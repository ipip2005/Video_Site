<?php

class UserController extends BaseController {

    /*
     |--------------------------------------------------------------------------
     | Default Home Controller
     |--------------------------------------------------------------------------
     |
     | You may wish to use controllers instead of, or in addition to, Closure
     | based routes. That's great! Here is an example controller method to
     | get you started. To route to this controller, just add the route:
     |
     |	Route::get('/', 'HomeController@showWelcome');
     |
     */
    public function __construct() {
        // updated: prevents re-login.
        $this->beforeFilter ( 'auth' ,array('except' => 'getIndex'));
    }
    public function getIndex(){
        $user = User::findOrFail(Input::get("uid"));
        $name = $user->nickname;
        if (empty($name)) $name = $user->username;
        $this->layout->title=$name."\'s home";
        $this->layout->main=View::make('user/ihome')->with(compact('user','name'));
    }
    public function getIhome(){
        $user = Auth::user();
        $name = $user->nickname;
        $active = 'ihome';
        if (empty($name)) $name = $user->username;
        $this->layout->title="My Home";
        $this->layout->user_nav=View::make('user/index')->with(compact('active'));
        $this->layout->main=View::make('user/ihome')->with(compact('user','name'));
    }
}
