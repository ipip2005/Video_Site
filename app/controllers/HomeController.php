<?php
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Collection;
class HomeController extends BaseController
{
    
    /*
     * |--------------------------------------------------------------------------
     * | Default Home Controller
     * |--------------------------------------------------------------------------
     * |
     * | You may wish to use controllers instead of, or in addition to, Closure
     * | based routes. That's great! Here is an example controller method to
     * | get you started. To route to this controller, just add the route:
     * |
     * |	Route::get('/', 'HomeController@showWelcome');
     * |
     */
    public function __construct()
    {
        // updated: prevents re-login.
        $this->beforeFilter('guest', [
            'only' => [
                'getLogin',
                'getRegister'
            ]
        ]);
        $this->beforeFilter('auth', [
            'only' => [
                'getLogout'
            ]
        ]);
    }

    public function getIndex()
    {
        $videos = Video::where('status', '=', '0')->orderBy('publishTime', 'Desc')
            ->take(12)
            ->get();
        $recommend_videos = Video::where('status', '=', 0)->where('system_recommend', '<>', '0000-00-00 00:00:00')
            ->orderBy('system_recommend', 'desc')
            ->take(12)
            ->get();
        $scored_videos = Video::where('status', '=', 0)->take(12)->get();
        foreach($scored_videos as $video){
            $vid = $video->id;
            $sum = 0;
            $num = 0;
            $votes = DB::table("scores")->where("vid", "=", $video->id)->get();
            foreach ($votes as $vote) {
                $num ++;
                $sum += $vote->score;
            }
            if ($num == 0)
                $video->score = 0;
            else
                $video->score = ((int)($sum/$num*100)/100);
        } 
        $scored_videos->sort(function($a, $b){
            $a = $a->score;
            $b = $b->score;
            if ($a === $b){
                return 0;
            }
            return ($a < $b) ? 1:-1;
        });       
        $hot_videos = new Collection(array());
        foreach($scored_videos as $video){
            if ($video->score>0)
                $hot_videos->add($video);
        }
        $most_watched_videos = Video::where('status', '=', 0)->where('view_count', '>', 0)->
            orderBy('view_count','desc')->take(12)->get();
        
        $this->layout->title = "FduVideoSite";
        $this->layout->main = View::make('home')->with(compact('videos', 'recommend_videos', 'hot_videos','most_watched_videos'));
    }

    public function getWatch()
    {
        $this->layout->title = "video"; // video_name;
        $video = Video::find(Input::get("vid"));
        if (Auth::check()) {
            $id = Auth::id();
            if ($id != $video->user_id) {
                $flag = false;
                if (DB::table('videorelation')->where('video_id', '=', $video->id)->count() == 0) {
                    $flag = true;
                } else
                    foreach (DB::table('videorelation')->where('video_id', '=', $video->id)->get() as $relation) {
                        $gid = $relation->group_id;
                        if (DB::table('urelation')->where('host', '=', $video->user_id)
                            ->where('friend', '=', $id)
                            ->where('group', '=', $gid)
                            ->count() > 0) {
                            $flag = true;
                            break;
                        }
                    }
                if (! $flag) {
                    $this->layout->main = View::make('no_permission')->with(compact('video'));
                    return;
                }
            }
        }
        $comments = $video->comments()
            ->orderBy('created_at', 'desc')
            ->get();
        $video->view_count++;
        $video->save();
        $this->layout->main = View::make('video')->with(compact('video', 'comments'));
    }

    public function getLogout()
    {
        Auth::Logout();
        return Redirect::to('/');
    }
}
