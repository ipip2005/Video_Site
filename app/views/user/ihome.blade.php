<div class="margin-top-10">
	<div class="row clearfix">
		<!--VideoList-->
		<div class="col-xs-8">
			<!--已上传Title-->
			<div class="row clearfix margin-tb-10">
				<div class="col-xs-12">
					<div class="bg-success">
						<h3>&nbspTA发布了</h3>
					</div>
				</div>
			</div>
			<!--已上传Image-->
			<div class="row clearfix">
			    @foreach($videos as $video)
				<div class="col-xs-4">
					<a href="/watch?vid=<?php echo $video->id?>">
					   <img src="/video/<?php echo $video->id?>/_thumb.jpg" style="width: 100%; height: auto;" />
					</a>
					<div>{{$video->name}}</div>
					<div>播放量：{{$video->view_count}}</div>
				</div>
				@endforeach
			</div>

			<div class="row">
				<div class="col-xs-12 divider img-rounded"></div>
			</div>
			<!--已分享Title-->
			<div class="row clearfix margin-tb-10">
				<div class="col-xs-12">
					<div class="bg-info">
						<h3>&nbspTA分享了</h3>
					</div>
				</div>
			</div>
			<!--已分享Image-->
			<div class="row clearfix ">
				<div class="col-xs-3">
					<img src="*.jpg" style="width: 100%; height: auto;" />
					<div>Wild China</div>
					<div>播放量：14万</div>
				</div>
				<div class="col-xs-3">
					<img src="*.jpg" style="width: 100%; height: auto;" />
					<div>Wild China</div>
					<div>播放量：14万</div>
				</div>
				<div class="col-xs-3">
					<img src="*.jpg" style="width: 100%; height: auto;" />
					<div>Wild China</div>
					<div>播放量：14万</div>
				</div>
				<div class="col-xs-3">
					<img src="*.jpg" style="width: 100%; height: auto;" />
					<div>Wild China</div>
					<div>播放量：14万</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-xs-3">
					<img src="*.jpg" style="width: 100%; height: auto;" />
					<div>Wild China</div>
					<div>播放量：14万</div>
				</div>
				<div class="col-xs-3">
					<img src="*.jpg" style="width: 100%; height: auto;" />
					<div>Wild China</div>
					<div>播放量：14万</div>
				</div>
				<div class="col-xs-3">
					<img src="*.jpg" style="width: 100%; height: auto;" />
					<div>Wild China</div>
					<div>播放量：14万</div>
				</div>
				<div class="col-xs-3">
					<img src="*.jpg" style="width: 100%; height: auto;" />
					<div>Wild China</div>
					<div>播放量：14万</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 divider img-rounded"></div>
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
				<div class="col-xs-3">
					<img src="*.jpg" style="width: 100%; height: auto;" />
					<div>Wild China</div>
					<div>播放量：14万</div>
				</div>
				<div class="col-xs-3">
					<img src="*.jpg" style="width: 100%; height: auto;" />
					<div>Wild China</div>
					<div>播放量：14万</div>
				</div>
				<div class="col-xs-3">
					<img src="*.jpg" style="width: 100%; height: auto;" />
					<div>Wild China</div>
					<div>播放量：14万</div>
				</div>
				<div class="col-xs-3">
					<img src="*.jpg" style="width: 100%; height: auto;" />
					<div>Wild China</div>
					<div>播放量：14万</div>
				</div>
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
