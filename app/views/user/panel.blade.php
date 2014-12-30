<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#tab-videos" role="tab" data-toggle="tab">
			<i class="icon-th"></i> 视频列表
	</a></li>
	<li><a href="#tab-comments" role="tab" data-toggle="tab"> <i
			class="icon-comments"></i> 评论列表
	</a></li>
	<li><a href="#tab-users" role="tab" data-toggle="tab"> <i
			class="icon-group"></i> 用户列表
	</a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane active" id="tab-videos">
  	  <?php $videos = Video::where('status','=','0')->orderBy('publishTime','desc')->get()?>
  	  <?php $first=false?>
		    @foreach($videos as $video)
		    @if($first)
		    <div class="row">
			<hr class="divider" id="divider-<?php echo $video->id?>">
		</div>
		    @else
		    <?php $first=true?>
		    @endif
			<div class="row clearfix margin-tb-10"
			id="video-<?php echo $video->id?>">
			<a class="col-md-3" href="/watch?vid=<?php echo $video->id?>"> <img
				src="<?php echo '/video/'.$video->id.'/_thumb.jpg'?>" alt="缩略图正在制作中"
				style="width: 100%; height: auto;">
			</a>
			<div class="col-md-8 text-left">
				<div class="row clearfix">
					<div class="col-md-2">
						<p>视频名称：</p>
					</div>
					<div class="col-md-7 soft-text editx"
						id="edit-name-<?php echo $video->id?>">
						<p>{{$video->name}}</p>
						<input type="text">
					</div>
					<div class="col-md-3 edit">
						<button class="btn-success border-0 edit-<?php echo $video->id?>"
							onclick="edit_name(<?php echo $video->id?>)">
							<i class="icon-edit"> </i>编辑
						</button>
						<button class="btn-success border-0 xedit-<?php echo $video->id?>"
							onclick="save_edit_name(<?php echo $video->id?>)">
							<i class="icon-edit"> </i>保存
						</button>
						<button class="btn-danger border-0 xedit-<?php echo $video->id?>"
							onclick="cancel_edit_name(<?php echo $video->id?>)">
							<i class="icon-remove-circle"> </i>取消
						</button>
					</div>
					<script>$(".edit .xedit-<?php echo $video->id?>").hide()</script>
				</div>
				<div class="row clearfix margin-top-10">
					<div class="col-md-2">
						<p>视频简介：</p>
					</div>
					<div class="col-md-7 soft-text editx"
						id="edit2-intr-<?php echo $video->id?>">
						<p>{{$video->introduction}}</p>
						<textarea rows="3" style="width: 100%"></textarea>
					</div>
					<div class="col-md-3 edit2">
						<button class="btn-success border-0 edit2-<?php echo $video->id?>"
							onclick="edit_intr(<?php echo $video->id?>)">
							<i class="icon-edit"> </i>编辑
						</button>
						<button
							class="btn-success border-0 xedit2-<?php echo $video->id?>"
							onclick="save_edit_intr(<?php echo $video->id?>)">
							<i class="icon-edit"> </i>保存
						</button>
						<button class="btn-danger border-0 xedit2-<?php echo $video->id?>"
							onclick="cancel_edit_intr(<?php echo $video->id?>)">
							<i class="icon-remove-circle"> </i>取消
						</button>
					</div>
					<script>$(".edit2 .xedit2-<?php echo $video->id?>").hide();
						        $("#edit2-intr-<?php echo $video->id?> textarea").hide();</script>
				</div>
				<script>$(".editx input").hide()</script>

				<div class="row clearfix margin-top-10">
					<div class="col-md-2">
						<p>点击数:</p>
					</div>
					<div class="col-md-2 soft-text">{{$video->view_count}}</div>
					<div class="col-md-2">
						<p>评分:</p>
					</div>
					<div class="col-md-2 soft-text">
					       @include("blades/rating_not")
					   </div>
					<div class="col-md-2">
						<p>评论数:</p>
					</div>
					<div class="col-md-2 soft-text">{{count($video->comments)}}</div>
				</div>
				<div class="row clearfix margin-top-10">
					<div class="col-md-2">
						<p>发布日期：</p>
					</div>
					<div class="col-md-3 soft-text">{{$video->publishTime}}</div>
					<div class="col-md-4 text-center">
						<span class="soft-text"><?php
						if (DB::table ( 'videorelation' )->where ( 'video_id', '=', $video->id )->count () > 0)
							echo "分组内可见";
						else
							echo "所有用户可见";
						?></span>
					</div>

					<div class="col-md-3">
						<button class="btn-danger border-0"
							onclick="javascript:delete_video(<?php echo $video->id?>)">
							<i class="icon-trash"></i> 删除
						</button>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
		@endforeach
	</div>
	<div class="tab-pane" id="tab-comments">
  	  <?php $comments = Comment::orderBy('created_at','desc')->get()?>
  	  @include('blades/comments')
  </div>
	<div class="tab-pane" id="tab-users">
  	  <?php $users = User::where('privilege','>','0')->get();?>
  	  <div class="row">
			@foreach($users as $user)
			<div class="col-xs-2">
				<div class="row user text-center">
					<a href="/user?uid=<?php echo $user->id?>"> <img
						src="<?php echo $user->photoPath.'/photo.jpg'?>">
					</a>
				</div>
				<div class="row text-center">
					<h4>
						<a href="/user?uid=<?php echo $user->id?>"><?php
						
						if (empty ( $user->nickname ))
							echo $user->username;
						else
							echo $user->nickname;
						?></a>

					</h4>
					<div class="dropdown privilege-<?php echo $user->privilege?>" id="dropdown-<?php echo $user->id?>">
						<button class="btn bg-primary dropdown-toggle" type="button"
							id="dropdownMenu1" data-toggle="dropdown">
							<span class="privilege"><?php switch($user->privilege){
								case 0: echo "管理员";break;
								case 1: echo "禁止发言";break;
								case 2: echo "禁止登陆";break;
								case 3: echo "禁止发布";break;
								case 4: echo "普通用户";break;
							}?></span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu"
							aria-labelledby="dropdownMenu1">
							<li class="text-center" role="presentation"><a role="menuitem" tabindex="-1" href="javascript:change_privilege(<?php echo $user->id?>,1)">禁止发言</a></li>
							<li class="text-center" role="presentation"><a role="menuitem" tabindex="-1" href="javascript:change_privilege(<?php echo $user->id?>,2)">禁止登陆</a></li>
							<li class="text-center" role="presentation"><a role="menuitem" tabindex="-1" href="javascript:change_privilege(<?php echo $user->id?>,3)">禁止发布</a></li>
							<li class="text-center" role="presentation"><a role="menuitem" tabindex="-1" href="javascript:change_privilege(<?php echo $user->id?>,4)">普通用户</a></li>
						</ul>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>