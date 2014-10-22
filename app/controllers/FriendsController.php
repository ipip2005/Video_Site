<?php

class FriendsController extends Controller {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function postAddFriend() {
	if (DB::table('users')->where('id','=',Input::get('friend'))->count()==0)
		return Response::json(array('error'=>'no_such_friend'));
	if (DB::table('urelation')->where('friend','=',Input::get('friend'))->count()>0)
		return Response::json(array('error'=>'been_added_friend'));
        $user = Auth::user();
        $urelation = array(
                        'host' => $user->id,
                        'friend' => Input::get('friend'),
                        'group' => 1,
                        'created_at' => DB::raw('NOW()'),
                        'updated_at' => DB::raw('NOW()'),
                     );
        DB::table('urelation')->insert($urelation);
        return Response::json(array('success'=>'success'));
    }

    public function postAddFriendToGroup() {
        if (Input::get('group')=='1')
		return Response::json(array('error'=>'op_on_default_group'));
	if (DB::table('users')->where('id','=',Input::get('friend'))->count()==0)
		return Response::json(array('error'=>'no_such_friend'));
	if (DB::table('groups')->where('id','=',Input::get('group'))->count()==0)
		return Response::json(array('error'=>'no_such_group'));
        $user = Auth::user();
	if (DB::table('urelation')->where('host','=',$user->id)
                                  ->where('friend','=',Input::get('friend'))
		                  ->where('group','=',Input::get('group'))->count()>0)
		return Response::json(array('error'=>'been_added_relation'));
        $urelation = array(
                        'host' => $user->id,
                        'friend' => Input::get('friend'),
                        'group' => Input::get('group'),
                        'created_at' => DB::raw('NOW()'),
                        'updated_at' => DB::raw('NOW()'),
                     );
        DB::table('urelation')->insert($urelation);
        return Response::json(array('success'=>'success'));        
    }

    public function postAddGroup() {
        if (Input::get('group')=='default')
		return Response::json(array('error'=>'op_on_default_group'));
        $user = Auth::user();
	if (DB::table('groups')->where('user_id','=',$user->id)
		               ->where('name','=',Input::get('group'))->count()>0)
		return Response::json(array('error'=>'been_added_group'));
        $user = Auth::user();
        $group = array(
                    'user_id' => $user->id,
                    'name' => Input::get('group'),
                    'created_at' => DB::raw('NOW()'),
                    'updated_at' => DB::raw('NOW()'),
                 );
        DB::table('groups')->insert($group);
        return Response::json(array('success'=>'success'));        
    }

    public function postDelFriendFromGroup() {
        if (Input::get('group')=='1')
		return Response::json(array('error'=>'op_on_default_group'));
        $user = Auth::user();
        $urelation = array(
                        'host' => $user->id,
                        'friend' => Input::get('friend'),
                        'group' => Input::get('group'),
                     );
	if (DB::table('urelation')->where($urelation)->count()==0)
		return Response::json(array('error'=>'no_such_relation'));

        DB::table('urelation')->where($urelation)->delete();
        return Response::json(array('success'=>'success'));        
    }

    public function postDelGroup() {
        if (Input::get('group')=='default')
		return Response::json(array('error'=>'op_on_default_group'));
        $user = Auth::user();
        $group = array(
                    'user_id' => $user->id,
                    'name' => Input::get('group'),
                 );
	if (DB::table('groups')->where($group)->count()==0)
		return Response::json(array('error'=>'no_such_group'));
        $user = Auth::user();
        DB::table('groups')->where($group)->delete();
        return Response::json(array('success'=>'success'));        
    }
}
