<?php

class FriendsController extends Controller
{

    public function __construct()
    {
        $this->beforeFilter('auth');
    }
    /**
     * 增加好友
     */
    public function postAddFriend()
    {
        $user = Auth::user();
        $id = Input::get('fid');
        if (User::where('id', '=', $id)->count() == 0)
            return Response::json(array(
                'error' => 'no_such_user'
            ));
        if ($user->id == $id) return Response::json(array('error'=>'cannot add yourself as friend'));
        
        if (DB::table('urelation')->where('friend', '=', $id)
            ->where('host', '=', $user->id)
            ->count() > 0)
            return Response::json(array(
                'error' => 'been_added_friend'
            ));
        $urelation = array(
            'host' => $user->id,
            'friend' => $id,
            'group' => 1,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );
        DB::table('urelation')->insert($urelation);
        return Response::json(array(
            'success' => '1'
        ));
    }
    /**
     * 删除好友以及所有的好友关系
     */
    public function postDelFriend()
    {
        $user = Auth::user();
        $id = Input::get('fid');
        if (User::where('id', '=', $id)->count() == 0)
            return Response::json(array(
                'error' => 'no_such_user'
            ));
        if ($user->id == $id) return Response::json(array('error'=>'cannot delete yourself'));
    
        if (DB::table('urelation')->where('friend', '=', $id)
            ->where('host', '=', $user->id)
            ->count() == 0)
                return Response::json(array(
                    'error' => 'not_been_friend_yet'
                ));
        DB::table('urelation')->where('friend', '=', $id)->where('host', '=', $user->id)
                ->delete();
        return Response::json(array(
            'success' => '1'
        ));
    }
    /**
     * 把好友添加到固定分组
     */
    public function postAddFriendToGroup()
    {
        if (Input::get('group') == '1')
            return Response::json(array(
                'error' => 'op_on_default_group'
            ));
        if (DB::table('users')->where('id', '=', Input::get('friend'))->count() == 0)
            return Response::json(array(
                'error' => 'no_such_friend'
            ));
        if (DB::table('groups')->where('id', '=', Input::get('group'))->count() == 0)
            return Response::json(array(
                'error' => 'no_such_group'
            ));
        $user = Auth::user();
        if (DB::table('urelation')->where('host', '=', $user->id)
            ->where('friend', '=', Input::get('friend'))
            ->where('group', '=', Input::get('group'))
            ->count() > 0)
            return Response::json(array(
                'error' => 'been_added_relation'
            ));
        $urelation = array(
            'host' => $user->id,
            'friend' => Input::get('friend'),
            'group' => Input::get('group'),
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );
        DB::table('urelation')->insert($urelation);
        return Response::json(array(
            'success' => 'success'
        ));
    }
    /**
     * 根据json数据，重新设置某个好友的分组
     * $gid=>$data:
     * $data = 1, 把好友添加到$gid组
     * $data = 0, 把好友从$gid组移除
     */
    public function postUpdateGroup(){
        $json = json_decode(Input::get('data'),true);
        $fid = Input::get('fid');
        foreach($json as $gid=>$data){
            $count = count(DB::table('urelation')->where('host','=',Auth::id())->
                    where('friend','=',$fid)->where('group','=',$gid)->get());
            if ($data=='0'){
                if ($count>0)
                 DB::table('urelation')->where('host','=',Auth::id())->
                    where('friend','=',$fid)->where('group','=',$gid)->delete();
            } else{
                if ($count==0){
                    $relation=[
                      'host'=>Auth::id(),
                      'friend'=>$fid,
                      'group'=>$gid  
                    ];
                    DB::table('urelation')->insert($relation);
                }
                  
            }
        }
        return Response::json(array('success'=>'1'));
    }
    /**
     * 获取某个好友的所在组情况
     */
    public function postGroupsOfFriend(){
        $id = Auth::id();
        $fid = Input::get('fid');
        $groups = DB::table('groups')->where('user_id','=',$id)->get();
        $ret = [];
        foreach($groups as $group){
            $relation = [
                'host' => $id,
                'friend' => $fid,
                'group' => $group->id
            ];
            if (count(DB::table('urelation')->where($relation)->get())>0)
                $ret[$group->id] = '1'; else
                $ret[$group->id] = '0';
        }
        return Response::json($ret);
    }
    /**
     * 添加一个分组
     */
    public function getAddGroup()
    {
        $name = Input::get('gname');
        if ($name == 'default')
            return Response::json(array(
                'error' => 'op_on_default_group'
            ));
        if (DB::table('groups')->where('user_id', '=', Auth::id())
            ->where('name', '=', $name)
            ->count() > 0)
            return Response::json(array(
                'error' => 'been_added_group'
            ));
        $group = array(
            'user_id' => Auth::id(),
            'name' => $name,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        );
        DB::table('groups')->insert($group);
        return Response::json(array(
            'success' => 'success'
        ));
    }
    /**
     * 从分组中删除一个好友
     */
    public function postDelFriendFromGroup()
    {
        if (Input::get('group') == '1')
            return Response::json(array(
                'error' => 'op_on_default_group'
            ));
        $user = Auth::user();
        $urelation = array(
            'host' => $user->id,
            'friend' => Input::get('friend'),
            'group' => Input::get('group')
        );
        if (DB::table('urelation')->where($urelation)->count() == 0)
            return Response::json(array(
                'error' => 'no_such_relation'
            ));
        
        DB::table('urelation')->where($urelation)->delete();
        return Response::json(array(
            'success' => 'success'
        ));
    }
    /**
     * 删除一个分组，同时删除对应的关系
     */
    public function getDelGroup()
    {
        $gid = Input::get('gid');
        if ($gid == '1')
            return Response::json(array(
                'error' => 'op_on_default_group'
            ));
        DB::table('urelation')->where('group', '=', $gid)
            ->delete();
        DB::table('groups')->where('id','=',$gid)->delete();
        return Response::json(array(
            'success' => 'success'
        ));
    }
}
