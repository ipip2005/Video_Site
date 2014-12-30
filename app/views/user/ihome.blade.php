<?php if (Auth::id()==$user->id) $pre = '我'; else $pre = 'TA'?>
<div class="margin-top-10">
	<div class="row clearfix">
		<!--VideoList-->
		<div class="col-xs-8">
			<!--已上传Title-->
			<div class="row clearfix margin-tb-10">
				<div class="col-xs-12">
					<div class="bg-success">
						<h3>&nbsp{{$pre}}发布了</h3>
					</div>
				</div>
			</div>
			<!--已上传Image-->
			<div class="row clearfix">
			    @if(count($videos)==0)
			    <div class="col-xs-12 text-center">
			        <h4 class="soft-text">{{$pre}}未发布过视频</h4>
			    </div>
			    @endif
			    @foreach($videos as $video)
				<div class="col-xs-4">
					<a href="/watch?vid=<?php echo $video->id?>" class="row ">
					   <img src="/video/<?php echo $video->id?>/_thumb.jpg" style="width: 100%; height: auto;"/>
					</a>
					<div class="row text-center margin-tb-0"><p class="soft-text margin-tb-0">{{$video->name}}</p></div>
					<div class="row text-center margin-tb-0">
						<span class="soft-text margin-tb-0">播放量:{{$video->view_count}}</span>
						<span class="soft-text margin-tb-0">&nbsp&nbsp评论:{{count($video->comments)}}条</span></div>
				</div>
				@endforeach
			</div>
			<!--已分享Title-->
			<div class="row clearfix margin-tb-10">
				<div class="col-xs-12">
					<div class="bg-info">
						<h3>&nbsp{{$pre}}分享了</h3>
					</div>
				</div>
			</div>
			<!--已分享Image-->
			<div class="row clearfix">
			    @if(count($shared_videos)==0)
			    <div class="col-xs-12 text-center">
			        <h4 class="soft-text">{{$pre}}未发布过视频</h4>
			    </div>
			    @endif
			    @foreach($shared_videos as $video)
				<div class="col-xs-4">
					<a href="/watch?vid=<?php echo $video->id?>" class="row ">
					   <img src="/video/<?php echo $video->id?>/_thumb.jpg" style="width: 100%; height: auto;"/>
					</a>
					<div class="row text-center margin-tb-0"><p class="soft-text margin-tb-0">{{$video->name}}</p></div>
					<div class="row text-center margin-tb-0">
						<span class="soft-text margin-tb-0">播放量:{{$video->view_count}}</span>
						<span class="soft-text margin-tb-0">&nbsp&nbsp评论:{{count($video->comments)}}条</span></div>
				</div>
				@endforeach
			</div>
			<!--系统推荐Title-->
			<div class="row clearfix margin-tb-10">
				<div class="col-xs-12">
					<div class="bg-primary">
						<h3>&nbsp推荐你看</h3>
					</div>
				</div>
			</div>
			<!--系统推荐Image-->
			<div class="row clearfix">
			    @if(count($recommend_videos)==0)
			    <div class="col-xs-12 text-center">
			        <h4 class="soft-text">{{$pre}}未发布过视频</h4>
			    </div>
			    @endif
			    @foreach($recommend_videos as $video)
				<div class="col-xs-4">
					<a href="/watch?vid=<?php echo $video->id?>" class="row ">
					   <img src="/video/<?php echo $video->id?>/_thumb.jpg" style="width: 100%; height: auto;"/>
					</a>
					<div class="row text-center margin-tb-0"><p class="soft-text margin-tb-0">{{$video->name}}</p></div>
					<div class="row text-center margin-tb-0">
						<span class="soft-text margin-tb-0">播放量:{{$video->view_count}}</span>
						<span class="soft-text margin-tb-0">&nbsp&nbsp评论:{{count($video->comments)}}条</span></div>
				</div>
				@endforeach
			</div>
			<div class="row">
				<div class="col-xs-12 divider img-rounded"></div>
			</div>

		</div>
		<!--Info-->
		<div class="col-xs-4">
			<div class="row clearfix bg-primary">
				<div class="col-xs-12">
					<div>个人信息</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-xs-8 line-lg">
					<div class="row">
						<div class="col-xs-12">
							<b>昵称：</b><span>{{$name}}</span>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<b>已发布视频数：</b><span>{{$user->videos()->count()}}</span>
						</div>
					</div>
				</div>
				<div class="col-xs-4">
					<div>
						<img class="photo"
							src="<?php echo $user->photoPath.'/photo.jpg'?>" />
						@if(Auth::id()!=$user->id)
						@if(DB::table('urelation')->where('host','=',Auth::id())->where('friend','=',$user->id)->count()==0)
					    <div style="width:100%" class="text-center">
					       <button class="btn-success border-0" onclick="pay_attension(<?php echo $user->id?>)" id="pay-button"><i class="icon-plus"></i> <b>关注</b></button>
					    </div>
					    @else
					    <div style="width:100%" class="text-center">
					       <button class="btn-success border-0" onclick="cancel_pay_attension(<?php echo $user->id?>)" id="pay-button"><i class="icon-minus"></i> <b>取消关注</b></button>
					    </div>
					    @endif
					    @endif
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-xs-12">
					<b>个人简介：</b> <span>{{$user->introduction}}</span>
				</div>
			</div>
		</div>
	</div>
</div>
