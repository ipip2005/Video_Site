<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#friends" role="tab" data-toggle="tab">我的好友</a></li>
	<li><a href="#groups" role="tab" data-toggle="tab">我的分组</a></li>
</ul>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade in active" id="friends">
		<div class="container-fluid margin-tb-10">
		   <div class="row">
		   @foreach($friends as $user)
		      <div class="col-xs-3">
		          <div class="row text-center">
		              <img src="<?php echo $user->photoPath.'/photo.jpg'?>">
		          </div>
		          <div class="row text-center">
		              <a href="/user?uid=<?php echo $user->id?>"><h4><?php if (empty($user->nickname)) 
		                      echo $user->username; else echo $user->nickname;?></h4></a>
		          </div>
		      </div>   
		   @endforeach
		   </div>
		</div>
	</div>
	<div class="tab-pane fade in" id="groups">
		<div class="container-fluid margin-tb-10">
		</div>
	</div>
</div>

<form method="POST" action="friends/add-friend">
	Friend ID: <input type="text" name="fid">
	<input type="submit" name="submit" value="添加">
</form>
<form method="POST" action="friends/add-friend-to-group">
	Friend ID: <input type="text" name="fid">
	Group ID: <input type="text" name="gid">
	<input type="submit" name="submit" value="添加">
</form>
<form method="POST" action="friends/add-group">
	Group Name: <input type="text" name="gid">
	<input type="submit" name="submit" value="添加">
</form>
<form method="POST" action="friends/del-friend-from-group">
	Friend ID: <input type="text" name="fid">
	Group ID: <input type="text" name="gid">
	<input type="submit" name="submit" value="删除">
</form>
<form method="POST" action="friends/del-group">
	Group Name: <input type="text" name="gid">
	<input type="submit" name="submit" value="删除">
</form>