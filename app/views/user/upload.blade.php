<ul class="nav nav-tabs" id="myTab">
	<li <?php if ($default_page=='podcast')echo 'class="active"'?>>
	   <a href="#Podcast" role="tab" data-toggle="tab">
	       <i class="icon-facetime-video"></i> 已发布视频
	   </a>
	</li>
	<li <?php if ($default_page=='upload')echo 'class="active"'?>>
	   <a href="#Upload" role="tab" data-toggle="tab">
	       <i class="icon-upload"></i> 上传视频
	   </a>
	</li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade in <?php if ($default_page=='podcast')echo "active"?>" id="Podcast">
		<div class="container-fluid margin-tb-10">
		    <?php $first=false?>
		    @foreach($videos as $video)
		    @if($first)
		    <div class="row"><hr class="divider" id="divider-<?php echo $video->id?>">
		    </div>
		    @else
		    <?php $first=true?>
		    @endif
			<div class="row clearfix margin-tb-10" id="video-<?php echo $video->id?>">
				<a class="col-md-3" href="/watch?vid=<?php echo $video->id?>">
					<img src="<?php echo '/video/'.$video->id.'/_thumb.jpg'?>" alt="缩略图正在制作中" style="width: 100%; height: auto;">
				</a>
				<div class="col-md-8 text-left">
					<div class="row clearfix">
						<div class="col-md-2"><p>视频名称：</p></div>
						<div class="col-md-7 soft-text editx" id="edit-name-<?php echo $video->id?>"><p>{{$video->name}}</p><input type="text"></div>
						<div class="col-md-3 edit">
						    <button class="btn-success border-0 edit-<?php echo $video->id?>" onclick="edit_name(<?php echo $video->id?>)"><i class="icon-edit"> </i>编辑</button>
						    <button class="btn-success border-0 xedit-<?php echo $video->id?>"onclick="save_edit_name(<?php echo $video->id?>)"><i class="icon-edit"> </i>保存</button>
						    <button class="btn-danger border-0 xedit-<?php echo $video->id?>" onclick="cancel_edit_name(<?php echo $video->id?>)"><i class="icon-remove-circle"> </i>取消</button>
						</div>
						<script>$(".edit .xedit-<?php echo $video->id?>").hide()</script>
					</div>
					<div class="row clearfix margin-top-10">
						<div class="col-md-2"><p>视频简介：</p></div>
						<div class="col-md-7 soft-text editx" id="edit2-intr-<?php echo $video->id?>"><p>{{$video->introduction}}</p><textarea rows="3" style="width:100%"></textarea></div>
						<div class="col-md-3 edit2">
						    <button class="btn-success border-0 edit2-<?php echo $video->id?>" onclick="edit_intr(<?php echo $video->id?>)"><i class="icon-edit"> </i>编辑</button>
						    <button class="btn-success border-0 xedit2-<?php echo $video->id?>"onclick="save_edit_intr(<?php echo $video->id?>)"><i class="icon-edit"> </i>保存</button>
						    <button class="btn-danger border-0 xedit2-<?php echo $video->id?>" onclick="cancel_edit_intr(<?php echo $video->id?>)"><i class="icon-remove-circle"> </i>取消</button>
						</div>
						<script>$(".edit2 .xedit2-<?php echo $video->id?>").hide();
						        $("#edit2-intr-<?php echo $video->id?> textarea").hide();</script>
					</div>
					<script>$(".editx input").hide()</script>
					
					<div class="row clearfix margin-top-10">
					   <div class="col-md-2"><p>点击数:</p></div>
					   <div class="col-md-2 soft-text">{{$video->view_count}}</div>
					   <div class="col-md-2"><p>评分:</p></div>
					   <div class="col-md-2 soft-text">
					       <?php if ($video->score_count==0) echo"暂无打分"; else
					           echo $video->score/$video->score_count;?>
					   </div>	
					   <div class="col-md-2"><p>评论数:</p></div>
					   <div class="col-md-2 soft-text">{{count($video->comments)}}</div>					   
					</div>
					<div class="row clearfix margin-top-10">
					   <div class="col-md-2"><p>发布日期：</p></div>
					   <div class="col-md-3 soft-text">{{$video->publishTime}}</div>	
					   <div class="col-md-4 text-center">
					   	   <button class="btn-primary border-0" onclick="manage_group(<?php echo $video->id;?>)">
					   	   	   <i class="icon-th"></i> 管理分组
					   	   </button>
					   	   <span class="soft-text"><?php
					   	   	   if (DB::table('videorelation')->where('video_id','=',$video->id)->count()>0) echo "分组内可见"; else
					   	   	   	 echo "所有用户可见"; 
					   	   ?></span>
					   </div>
					   
					   <div class="col-md-3">
					       <button class="btn-danger border-0" onclick="javascript:delete_video(<?php echo $video->id?>)">
			                   <i class="icon-trash"></i> 删除
				           </button>
				       </div>			   
					</div>
				</div>
				<div class="col-md-1">
				    
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
var fname="";
r.assignBrowse(document.getElementById('browseButton'));

r.on('fileSuccess', function(file){
	now = 100;
	$(".progress-bar").attr({"aria-valuenow":now,"style":"width: "+now+"%"});
	$(".progress-bar span").html(""+now+"% Complete");
    console.debug(file);
  });
r.on('fileProgress', function(file){
    console.debug(file);
  }); 
r.on('fileAdded', function(file, event){
	fname = file.name||file.fileName;
	var fileName = fname.split('.');
    var type = fileName[fileName.length-1].toLowerCase();
	$.ajax({ url:"/video/create", async:"false", type:"GET", data:{"file_name":fname,'file_type':type},
		dataTpye:'json',
		success:function(response){
			if (response.error=="have unuploaded video")
			{
				error_message("你有未完成上传的其他视频，请继续上传或者删除该未上传的视频后再上传新的视频。");
				r.cancel();
				$(".up-hide").hide();
			    $("#browseButton").show();
				return;
			} else
			if (response.error=="not supported type")
			{
				error_message("请检查视频格式是否符合要求");
				r.cancel();
				$(".up-hide").hide();
			    $("#browseButton").show();
			    return;
			} else
			if (response.error=="no_permission")
			{
				error_message("你的发布视频权限被封禁，请联系管理员");
				r.cancel();
				$(".up-hide").hide();
			    $("#browseButton").show();
			    return;
			}
			if (response.success=="new" || response.success=="continue")
				r.upload();
		},
	});
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
			    <div class="col-xs-6 text-right">
			         <button class="btn-primary border-0" onclick="upload_pause()" id="pause-button">暂停</button>
			    </div>
			    <div class="col-xs-6 text-left">
			         <button class="btn-danger border-0" onclick="upload_cancel(<?php echo Auth::id();?>)" id="cancel-button">取消</button>
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
			        <div class="text-center" id="error-message" style="height:40px">
					    <p class="text-danger" style="line-height:40px"></p>
					</div>
			    </div>
			</div>
			<script>$("#error-message p").hide()</script>
		</div>
	</div>
</div>
@include('blades/grouping_dialog')
<script>
var vid = 1;
function manage_group(id){
	vid = id;
	$("#grouping #group-buttons button").removeClass('btn-success').addClass('btn-default');
	$("#grouping").modal("show");
	$.ajax({url:"/video/groups",data:{'vid':id},type:'post',
        success:function(res){
            $.each(res,function(i,item){
                if (item=='1') {
                    $("#sg-"+i).addClass("btn-success");
                    $("#sg-"+i).removeClass("btn-default");
                } else{
                    $("#sg-"+i).removeClass("btn-success");
                    $("#sg-"+i).addClass("btn-default");
                }
            });
        }});
}
function update_group(){
	var data = get_json_from_modal();
	$.ajax({url:"/video/update-group",type:"post",async:"false",
        data:{"data":data,'vid':vid},success:function(){
            location=location;
        }
        });
}
</script>