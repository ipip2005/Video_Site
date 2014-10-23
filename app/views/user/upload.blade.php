<ul class="nav nav-tabs" id="myTab">
	<li <?php if ($default_page=='podcast')echo 'class="active"'?>><a href="#Podcast" role="tab" data-toggle="tab">已发布视频</a></li>
	<li <?php if ($default_page=='upload')echo 'class="active"'?>><a href="#Upload" role="tab" data-toggle="tab">上传视频</a></li>
</ul>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade in <?php if ($default_page=='podcast')echo "active"?>" id="Podcast">
		<div class="container-fluid">
			<div class="row clearfix">
				<div class="col-md-3">
					<img src="*.jpg" style="width: 100%; height: auto;">
				</div>
				<div class="col-md-6">
					<div class="row clearfix">
						<div class="col-md-3">视频名称：</div>
						<div class="col-md-6">Wild China</div>
						<div class="col-md-3">修改</div>
					</div>
					<div class="row clearfix">
						<div class="col-md-3">视频简介：</div>
						<div class="col-md-6">《美丽中国》是一部有关中国自然主题的6集自然纪录
							片，由英国广播公司自然历史部、中视传媒与Travel Channel合作拍摄完成，整部影片采用高清格>
							式制作。2008年5月11日在英国广播公司第二台首播。英国广播公司持有本片在英国的著作权，其他 地区著作权由中视传媒持有。</div>
						<div class="col-md-3">修改</div>
					</div>
				</div>
				<div class="col-md-3">删除</div>
			</div>
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
r.on('uploadStart', function(){
    //console.debug();
    $(".progress").show();
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
			<div class="row">
				<div class="progress col-xs-8 col-xs-offset-2">
					<div class="progress-bar progress-bar-primary progress-bar-striped"
						role="progressbar" aria-valuenow="0" aria-valuemin="0"
						aria-valuemax="100" style="width: 0%;">
						<span>0% Complete</span>
					</div>
				</div>
				<script>$(".progress").hide()</script>
			</div>
		</div>
	</div>
</div>
