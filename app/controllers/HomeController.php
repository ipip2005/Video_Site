<?php

use Illuminate\Http\Response;
class HomeController extends BaseController {

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
        $this->beforeFilter ( 'guest', [
            'only' => [
                'getLogin',
                'getRegister'
            ]
        ] );
        $this->beforeFilter ( 'auth', [
            'only' => [
                'getLogout'
            ]
        ] );
    }
    public function getIndex(){
        $this->layout->title="FduVideoSite";
        $this->layout->main=View::make('home');
    }
    public function getWatch(){
        $video = Video::find(Input::get("vid"));
        $this->layout->title="video";//video_name;
        $this->layout->main=View::make('video')->with(compact('video'));
    }
    public function getLogout(){
        Auth::Logout();
        return Redirect::to('/');
    }
}
