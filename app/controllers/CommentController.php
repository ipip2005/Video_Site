<?php
use Illuminate\Support\Facades\Redirect;

class CommentController extends \Controller
{

    public function __construct()
    {
        // updated: prevents re-login.
        $this->beforeFilter('auth');
    }
    /**
     * 添加一条评论
     */
    public function postAddComment(){
    	$uid = Auth::id();
    	$tid = Input::get('tid');
    	$vid = Input::get('vid');
    	$comment = Input::get('comment');
    	
    	$new_comment =[
    		'user_id'=>$uid,
    		'tid'=>$tid,
    		'comment'=>$comment,
    		'video_id'=>$vid
    	];
    	$new_comment = new Comment($new_comment);
    	$new_comment->save();
    	return Response::json(array('success'=>'1'));
    }
    /**
     * 获得一个comments试图模板
     */
    public function postBlade(){
    	$vid = Input::get('vid');
    	$comments = Video::find($vid)->comments()->orderBy('created_at','desc')->get();
    	return View::make('blades/comments')->with(compact('comments'));
    }
}