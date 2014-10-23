{{ HTML::style('css/minimalist.css') }}
{{ HTML::script('js/flowplayer.min.js') }}
<div class="container">
    <div class="row margin-tb-10">
        <h1>{{$video->name}}</h1>
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
			<div><p>{{$video->introduction}}</p></div>
			<br/>
			<br/>
			<div>上传者:<?php $user = User::find($video->user_id);
			     if (empty($user->nickname))echo $user->username; else echo $user->nickname?></div>
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
			<div style="height:50px"></div>
			<div>
				<div class="row">
					<div class="col-md-3 text-center"><img style="width:80%" alt="140x140" src="/i/qvod.jpg" class="img-rounded"/></div>
					<div class="col-md-9"><div><a href="baidu.com">ipip</a></div>好好看啊好好看！</div><br/><div>30分钟前</div>
				</div>
				————————————————————————————————————————————————————
				<div class="row">
					<div class="col-md-3 text-center"><img style="width:80%" alt="140x140" src="/i/qvod.jpg" class="img-rounded"/></div>
					<div class="col-md-9"><div><a href="baidu.com">ipip</a></div>我来看看</div><br/><div>50分钟前</div>
				</div>
				————————————————————————————————————————————————————
			</div>
		</div>
		<div class="col-md-4">
			为您推荐：
			<div class="row">
				<div class="col-md-4 text-center"><img style="width:80%" alt="140x140" src="/i/qvod.jpg" class="img-rounded"/></div>
				<div class="col-md-8"><div><a href="baidu.com">快播1</a></div></div>
			</div>
			————————————————————————————————————————————————————
			<div class="row">
				<div class="col-md-4 text-center"><img style="width:80%" alt="140x140" src="/i/qvod.jpg" class="img-rounded"/></div>
				<div class="col-md-8"><div><a href="baidu.com">快播2</a></div></div><br/>
			</div>
			————————————————————————————————————————————————————
		</div>
	</div>
	</div>
