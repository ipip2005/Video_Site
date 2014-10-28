<div class="btn-default img-rounded error-line text-center">
	<p><a href="/user?uid=<?php echo $video->user_id?>">{{User::find($video->user_id)->username.'('.User::find($video->user_id)->nickname.')'}}</a>不允许分组外的用户查看该视频</p>
</div>
<div class="error-line text-center">
	<p><a href="/">回到首页</a></p>
</div>