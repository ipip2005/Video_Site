<div class="row">
	<div class="col-xs-8">

		@foreach($comments as $comment)
		<div id="comment-<?php echo $comment->id?>">
			<div class="row">
				<hr class="divider">
			</div>
			<div class="row comment">
		<?php $uid = $comment->user_id?>
		<a class="col-xs-3 text-center" href="/user?uid=<?php echo $uid?>"> <img
					alt="commenter"
					src="<?php echo User::find($uid)->photoPath.'/photo.jpg' ?> ">
				</a>
				<div class="col-xs-9">
					<div class="row">
						<div class="at-left">
							<span class="soft-text"><?php
							
							if (empty ( User::find ( $uid )->nickname ))
								echo User::find ( $uid )->username;
							else
								echo User::find ( $uid )->nickname?> <i class="icon-comment"></i></span>
						</div>
						<div class="at-right">
							@if(Auth::check() && Auth::user()->privilege==0)
							<button class="btn-danger"
								onclick="delete_comment(<?php echo $comment->id?>)">删除</button>
							@endif <span class="soft-text">{{$comment->created_at}}</span>
						</div>
					</div>
					<div class="row">
						<hr class="divider">
					</div>
					<div class="row">
						@if($comment->tid>0) <a
							href="/user?uid=<?php echo $comment->tid?>">{{'@'.User::find($comment->tid)->nickname}}</a>
						@endif
						<p class="intr-text">
							{{$comment->comment}} <a class="btn-primary border-0"
								href="javascript:add_reply(<?php echo $comment->user_id.',\''.User::find($comment->user_id)->nickname?>')"><span>回复TA</span></a>
						</p>
					</div>
				</div>
			</div>
		</div>
		@endforeach

	</div>
</div>
