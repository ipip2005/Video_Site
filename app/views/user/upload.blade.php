<ul class="nav nav-tabs" id="myTab">
	<li <?php if ($default_page=='podcast')echo 'class="active"'?>><a href="#Podcast" role="tab" data-toggle="tab">已发布视频</a></li>
	<li <?php if ($default_page=='upload')echo 'class="active"'?>><a href="#Upload" role="tab" data-toggle="tab">上传视频</a></li>
</ul>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade in <?php if ($default_page=='podcast')echo "active"?>" id="Podcast">
		<div class="container-fluid margin-tb-10">
		    <?php $first=false?>
		    @foreach(Auth::user()->videos as $video)
		    @if($first)
		    <div class="divider">
		    </div>
		    @else
		    <?php $first=true?>
		    @endif
			<div class="row clearfix margin-tb-10" id="video-<?php echo $video->id?>">
				<a class="col-md-3" href="/watch?vid=<?php echo $video->id?>">
					<img src="<?php echo '/video/'.$video->id.'/_thumb.jpg'?>" style="width: 100%; height: auto;">
				</a>
				<div class="col-md-7 text-left">
					<div class="row clearfix">
						<div class="col-md-3"><p>视频名称：</p></div>
						<div class="col-md-6 soft-text">{{$video->name}}</div>
						<div class="col-md-3">
						    <button class="btn-success border-0"><i class="icon-edit"> </i>编辑</button>
						    
						</div>
					</div>
					<div class="row clearfix margin-top-10">
						<div class="col-md-3"><p>视频简介：</p></div>
						<div class="col-md-6 soft-text">{{$video->introduction}}</div>
						<div class="col-md-3">
						    <button class="btn-success border-0"><i class="icon-edit"> </i>编辑</button>
						    
						</div>
					</div>
					<div class="row clearfix margin-top-10">
					   <div class="col-md-3"><p>发布日期：</p></div>
					   <div class="col-md-6 soft-text">{{$video->publishTime}}</div>				   
					</div>
					<div class="row clearfix margin-top-10">
					   <div class="col-md-3"><p>点击数:</p></div>
					   <div class="col-md-3 soft-text">{{$video->view_count}}</div>
					   <div class="col-md-3"><p>平均分:</p></div>
					   <div class="col-md-3 soft-text">
					       <?php if ($video->score_count==0) echo"暂无打分"; else
					           echo $video->score/$video->score_count;?>
					   </div>						   
					</div>
				</div>
				<div class="col-md-2">
				    <button class="btn-danger border-0" onclick="javascript:delete_video(<?php echo $video->id?>)">删除
				    </button>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	<div class="tab-pane fade in <?php if ($default_page=='upload')echo "active"?>" id="Upload">
		<div class="container-fluid">
			<div class="row text-center">
				<a href="javascript:;" id="browseButton"><img src="/i/upload.png" alt="upload"></a>
				<script src="/js/resumable.js"></script>
				<script>
var r = new Resumable({
  target:'/video/upload',
  query:{user_id:'<?php echo $user->id?>'}
});
  
r.assignBrowse(document.getElementById('browseButton'));

r.on('fileSuccess', function(file){
    console.debug(file);
  });
r.on('fileProgress', function(file){
    console.debug(file);
  });
r.on('fileAdded', function(file, event){
	name = file.name||file.fileName;
	$.ajax({ url:"/video/create", async:"false", type:"GET", data:{"file_name":name},
		dataTpye:'json',
		success:function(response){
			if (response.error=="have unuploaded video")
			{
				error_message("你有未完成上传的其他视频，请继续上传或者删除该未上传的视频后再上传新的视频。");
				r.cancel();
				$(".up-hide").hide();
			    $("#browseButton").show();
				return;
			}
		},
	});
    r.upload();
    //console.debug(file, event);
  });
r.on('filesAdded', function(array){
    //console.debug(array);
  });
r.on('fileRetry', function(file){
    //console.debug(file);
  });
r.on('fileError', function(file, message){
    //console.debug(file, message);
  });
r.on('uploadStart', function(file){
    //console.debug();
    $(".up-hide").show();
    $("#browseButton").hide(500);
  });
r.on('complete', function(){
    //console.debug();
  });
r.on('progress', function(){
	now = Math.round(r.progress()*1000000)/10000;
	$(".progress-bar").attr({"aria-valuenow":now,"style":"width: "+now+"%"});
	$(".progress-bar span").html(""+now+"% Complete");
    //console.debug();
  });
r.on('error', function(message, file){
    //console.debug(message, file);
  });
r.on('pause', function(){
    //console.debug();
  });
r.on('cancel', function(){
    //console.debug();
  });
</script>
				<!--{{'/video/id'}}-->
			</div>
			<div class="row up-hide">
			    <div class="col-xs-6">
			     
			    </div>
			    <div class="col-xs-6">
			    </div>
			</div>
			<div class="row">
				<div class="progress col-xs-8 col-xs-offset-2 up-hide">
					<div class="progress-bar progress-bar-primary progress-bar-striped"
						role="progressbar" aria-valuenow="0" aria-valuemin="0"
						aria-valuemax="100" style="width: 0%;">
						<span>0% Complete</span>
					</div>
				</div>
				<script>$(".up-hide").hide()</script>
			</div>
			<div class="row">
			    <div class="col-xs-12 text-center">
			        
			    </div>
			    <div class="col-xs-12 text-center">
			        <label>视频名称:</label>
			        <input type="text" placeholder="视频名称(不超过50字)..." class="half-width" id="pub-name">
			    </div>
			    <div class="col-xs-12 text-center margin-top-10">
			        <label>视频简介:</label>
			        <textarea rows="4" cols="50" placeholder="视频介绍(不超过250字)..." 
			             class="half-width vertical-center" id="pub-intro"></textarea>
			    </div>
			    <div class="col-xs-12 text-center">
			        <button class="btn-primary border-0 up-button" onclick="publish()">发布视频</button>
			    </div>
			</div>
			
			<div class="row">
			    <div class="col-xs-12">
			        <div class='text-center' id='error-message' style='display:none'>
					    <p class='text-danger'></p>
					</div>
			    </div>
			</div>
		</div>
	</div>
</div>
