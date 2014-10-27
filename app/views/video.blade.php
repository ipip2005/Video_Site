{{ HTML::style('css/minimalist.css') }}
{{ HTML::script('js/flowplayer.min.js') }}
<div class="container">
    <div class="row margin-tb-10">
        <h1><a href="/watch?vid=<?php echo $video->id?>">{{$video->name}}</a></h1>
    </div>
	<div class="row">
		<div class="col-md-8">
			<div class="flowplayer" style="background-color:black;width:100%;height:450px;">
				<video src="<?php echo '/'.$video->path?>">
					您的浏览器不支持播放插件
				</video>
			</div>	
		</div>
		<div class="col-md-4">
			<div><p>简介：</p><p class="soft-text intr-text">{{$video->introduction}}</p></div>
			<br/>
			<br/>
			<div>上传者: <a href="/user?uid=<?php echo $video->user_id?>"><?php $user = User::find($video->user_id);
			     if (empty($user->nickname))echo $user->username; else echo $user->nickname?></a></div>
			<br/>
			<br/>
			<div>点击量：{{$video->view_count}}</div>
			<br/>
			<br/>
			<div>☆☆☆☆☆</div>
			<br/>
			<br/>
			<div><button class="btn btn-primary">分享</button></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="input-group">
				<input type="text"	class="form-control search-content" placeholder="有什么想说的吗？快来评论吧！">
				<div class="input-group-btn">
				    <button class="btn btn-primary ">评论</button>
				</div>
			</div>
			
		</div>
	</div>
	</div>
