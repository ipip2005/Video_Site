<ul class="nav nav-tabs" id="myTab">
	<li class="active">
	   <a href="#tab-videos" role="tab" data-toggle="tab">
	       <i class="icon-th"></i> 视频列表
	   </a>
	</li>
	<li>
	   <a href="#tab-comments" role="tab" data-toggle="tab">
	       <i class="icon-comments"></i> 评论列表
	   </a>
	</li>
	<li>
	   <a href="#tab-users" role="tab" data-toggle="tab">
	       <i class="icon-group"></i> 用户列表
	   </a>
	</li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="tab-videos">
  	  <?php $videos = Video::where('status','=','0')->orderBy('publishTime','desc')->get()?>
  	  
  </div>
  <div class="tab-pane" id="tab-comments">
  </div>
  <div class="tab-pane" id="tab-users">
  </div>
</div>