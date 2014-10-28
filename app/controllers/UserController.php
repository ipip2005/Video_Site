<?php

use Illuminate\Database\Eloquent\Collection;
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
        if (Auth::id() == Input::get('uid')) return $this->getIhome();
        $user = User::findOrFail(Input::get("uid"));
        $name = $user->nickname;
        $videos = Video::where('user_id','=',$user->id)->orderBy('publishTime','desc')
        ->take(9)->get();
        if (empty($name)) $name = $user->username;
        $this->layout->title=$name."\'s home";
        $this->layout->main=View::make('user/ihome')->with(compact('user','name','videos'));
    }
    public function getIhome(){
        $user = Auth::user();
        $name = $user->nickname;
        $videos = Video::where('user_id','=',$user->id)->where('status','=','0')->orderBy('publishTime','desc')
            ->take(9)->get();
        $active = 'ihome';
        if (empty($name)) $name = $user->username;
        $this->layout->title="My Home";
        $this->layout->user_nav=View::make('user/index')->with(compact('active'));
        $this->layout->main=View::make('user/ihome')->with(compact('user','name','videos'));
    }
    public function getPodcast(){
        $user = Auth::user();
        $name = $user->nickname;
        $active = 'upload';
        $videos = $user->videos()->where('status','=','0')->orderBy('publishTime','Desc')->get();
        if (empty($name)) $name = $user->username;
        $this->layout->title="My Home-Video";
        $this->layout->user_nav=View::make('user/index')->with(compact('active'));
        $default_page = 'podcast';
        $this->layout->main=View::make('user/upload')->with(compact('user','name','default_page','videos'));
    }
    public function getUpload(){
        $user = Auth::user();
        $name = $user->nickname;
        $active = 'upload';
        $videos = $user->videos()->where('status','=','0')->orderBy('publishTime','Desc')->get();
        if (empty($name)) $name = $user->username;
        $this->layout->title="My Home-Video";
        $this->layout->user_nav=View::make('user/index')->with(compact('active'));
        $default_page = 'upload';
        $this->layout->main=View::make('user/upload')->with(compact('user','name','default_page','videos'));
    }
    public function getFriends(){
        $user = Auth::user();
        $fids = DB::table('urelation')->where('host','=',$user->id)->where('group','=','1')
            ->get(array('friend'));
        $friends = new Collection();
        foreach ($fids as $value){
            $friends->add(User::find($value->friend));
        }
        $groups = DB::table('groups')->where('user_id','=',$user->id)->where('id','<>','1')->get();
        $active = 'friends';
        $this->layout->title="My Home-Friends";
        $this->layout->user_nav=View::make('user/index')->with(compact('active'));
        $this->layout->main=View::make('user/friends')->with(compact('user','friends','groups'));
    }
    public function getSettings(){
        $user = Auth::user();
        $active = 'settings';
        $this->layout->title="My Home-Setting";
        $this->layout->user_nav=View::make('user/index')->with(compact('active'));
        $this->layout->main=View::make('user/settings')->with(compact('user'));
    }
    public function getPanel(){
    	$user = Auth::user();
        $active = 'panel';
        $this->layout->title="My Home-Dashboard";
        $this->layout->user_nav=View::make('user/index')->with(compact('active'));
        $this->layout->main=View::make('user/panel')->with(compact('user'));
    }
    public function postChangeSetting(){
        $user = Auth::user();
        $user->nickname = Input::get('nickname');
        $password = Input::get('password');
        if (!empty($password)) $user->password = Hash::make($password);
        $user->email = Input::get('email');
        $user->introduction = Input::get('introduction');
        $user->save();
        return Response::json(array('success'=>'1'));
    }
}
