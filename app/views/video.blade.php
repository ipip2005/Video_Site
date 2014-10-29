{{ HTML::style('css/minimalist.css') }}
{{ HTML::script('js/flowplayer.min.js') }}
<div class="container">
    <div class="row margin-tb-10">
        <h1><a href="/watch?vid=<?php echo $video->id?>">{{$video->name}}</a>
        	<?php if (!file_exists($video->path)) echo "正在转码，请等待服务器转码成功,所需时间和视频大小有关"?>
        </h1>
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
			<div class="row"><p>简介：</p><p class="soft-text intr-text">{{$video->introduction}}</p></div>
			<div class="row"><p>上传者: <a href="/user?uid=<?php echo $video->user_id?>"><?php $user = User::find($video->user_id);
			     if (empty($user->nickname))echo $user->username; else echo $user->nickname?></a></p></div>
			<div class="row"><p>点击量：{{$video->view_count}}</p></div>
			<div class="row"><p>☆☆☆☆</p></div>
			<div class="row"><button class="btn btn-primary">分享</button></div>
			@if (Auth::check() && Auth::user()->privilege==0)
			<div class="row"><button class="btn btn-danger" onclick="recommend(<?php echo $video->id?>)">推荐</button></div>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="input-group" id="comment-input">
			    <span class="input-group-addon">@</span>
				<input type="text"	class="form-control" placeholder="有什么想说的吗？快来评论吧！">
				<div class="input-group-btn">
				    <button class="btn btn-primary " type="button">评论</button>
				</div>
			</div>
		</div>
	</div>
	<script>
	var reply_to = 0;
	$("#comment-input").on("keypress", ".form-control", function(event){
		   if (event.keyCode=="13"){
			   $("#comment-input button").get(0).click();
		   }
	});
	$("#comment-input button").click(function(){
		var text = $("#comment-input input").val();
		if (text.length>300) {
			alert('内容过长,300字数限制');
			return;
		}
		if (text.length==0){
			alert('请输入评论内容');
			return;
		}
	    $.ajax({url:'/comment/add-comment',type:'post',async:'false',data:{
		    'vid':'<?php echo $video->id?>',
		    'tid':reply_to,
		    'comment':text},success:function(res){
			    	if (res.success=='1'){
						refresh_comments(<?php echo $video->id?>);
						reply_to=0;
						$("#comment-input input").val("");
						$("#comment-input span").html("@");    	
			    	} else alert("评论失败，请重试,你可能被管理员封禁");
		    	},error:function(XMLHttpRequest){
			    	if (XMLHttpRequest.status=="401"){
			    		$("#login").get(0).click();
			    	}
		    	}
	    	});
		});
	</script>
	<div id="blade-comments">
		@include('blades/comments')
	</div>
</div>
