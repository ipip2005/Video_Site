<ul class="nav nav-tabs">
	<li class="active"><a href="#Podcast" role="tab" data-toggle="tab">已发布视频</a></li>
	<li><a href="#Upload" role="tab" data-toggle="tab">上传视频</a></li>
</ul>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade in active" id="Podcast">
		<div class="container">
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
	<div class="tab-pane fade in" id="Upload">
		<div class="container">
			<div class="row">
				<a href="#" id="browseButton">Select files</a>

				<script src="/js/resumable.js"></script>
				<script>
function upload_to(url){
var r = new Resumable({
  target:url
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
  });
r.on('complete', function(){
    //console.debug();
  });
r.on('progress', function(){
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
}
</script>
				<!--{{'/video/id'}}-->
			</div>
		</div>
	</div>
</div>
