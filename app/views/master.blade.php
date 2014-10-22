<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
@section('title')
<title>{{{$title}}}</title> 
@show 
{{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/custom.css') }} 
{{ HTML::style('css/font-awesome.css') }}
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
{{ HTML::script('./js/bootstrap.min.js') }}
</head>
<body>
	<header>
		<nav class="master-nav">
			<div class="master-nav-content">
				<div class="row">
					<div class="master-nav-item logo col-xs-1">
						<!-- logo -->
						<a href="/">LOGO</a>
					</div>
					<div class="master-nav-item search-box col-xs-6">
						<!-- Search -->
						<div class="input-group">
							<input type="text" class="form-control search-content"
								placeholder="Ipip2005">
							<div class="input-group-btn">
								<button class="btn btn-primary ">
									<i class="icon-search"></i>
								</button>
							</div>
						</div>
					</div>
					
					<div class="master-nav-item logreg col-xs-3">
						@if(Auth::check()) 
						<?php 
						  $name = Auth::user()->nickname;
						  if (mb_strlen($name)==0) $name=Auth::user()->username;
						?>
						<a href="/user/ihome" data-toggle="popover" data-placement="bottom" id="ihome"
							data-trigger="hover" data-content="<?php echo$name?>"><span>
						<i class="icon-user icon-x"></i>
						<?php
						  if (mb_strlen($name)>=12) $name = mb_substr($name, 0, 9, 'utf-8')."...";
						  echo $name; 
						?></span></a>
						<b>|</b>
						<a href="/logout">退出</a>
						@else 
						<a href="javascript:void(0)" data-toggle="popover" title="请登录" data-placement="bottom"
							id="login" data-trigger="click" data-content="
						<div class='pop-content' id='p-login'>
						    <div class='input-group'>
								<span class='input-group-addon'>账号</span> <input type='text'
									class='form-control catch-focus account' placeholder='Username or Mail-Address'>
							</div>
							<div class='input-group margin-top-10'>
								<span class='input-group-addon'>密码</span> <input
									type='password' class='form-control password' placeholder='Password'>
							</div>
							<div class='text-center'>
								<button type='button' class='btn btn-primary' onclick='login()'>登录</button>
							</div>
					        <div class='text-center' id='error-message' style='display:none'>
					           <p class='text-danger'></p>
					        </div>
					   </div>
					       ">
					       <span>登陆</span>
					   </a>

					<b>|</b>
					<a href="javascript:void(0)" data-toggle="popover" title="请注册" data-placement="bottom"
							id="register" data-trigger="click" data-content="
						<div class='pop-content' id='p-register'>
						    <div class='input-group'>
								<span class='input-group-addon'>账号</span> <input type='text'
									class='form-control catch-focus account' placeholder='Username'>
							</div>
							<div class='input-group margin-top-10'>
								<span class='input-group-addon'>密码</span> <input
									type='password' class='form-control password' placeholder='Password'>
							</div>
							<div class='input-group margin-top-10'>
								<span class='input-group-addon'>重复</span> <input
									type='password' class='form-control confirm-password' placeholder='Confirm Password'>
							</div>
							<div class='input-group margin-top-10'>
								<span class='input-group-addon'>邮箱</span> <input
									type='text' class='form-control mail-address' placeholder='Mail-Address'>
							</div>
							<div class='text-center'>
								<button type='button' class='btn btn-primary' onclick='register()'>注册</button>
							</div>
					        <div class='text-center' id='error-message' style='display:none'>
					           <p class='text-danger'></p>
					        </div>
					   </div>
					       ">
					       <span>注册</span>
					   </a>
					@endif
					
				</div>
				<div class="master-nav-item col-xs-2">
						<!-- upload video -->
						<button class="btn-success up-button" onclick="javascript:window.location.href='/user/upload';">上传视频</button>
				</div>
				</div>
			</div>
		</nav>
	</header>
	@if(Session::has("needlogin"))
    <script>
		$(function () {
			  function hideot(e){
				  e = window.event || e;
				  obj = $(e.srcElement || e.target);
				  var click_where=0;
				  if ($(obj).is("#login, #login *")) click_where=1;
				  if ($(obj).is("#register, #register *")) click_where=2;
	            	  if ((!$(obj).is(".popover, .popover *")&&click_where==0)){
	            		   $("[data-toggle='popover'").popover("hide");
	            		   $(document).unbind("click");
	            		   
	            	  } 
	            	  if (click_where==1) $("#register").popover("hide"); 
            		   if (click_where==2) $("#login").popover("hide");
			  }
			  $("#ihome").popover({html:false});
			  $("#login").popover({html:true});
			  $("#login").popover("show");
			  $(document).click(function(e){hideot(e)});
			  $("#register").popover({html:true});
			  $("[data-toggle='popover']").click(function(){
				  if ($(".popover").length>0){
					  $(".popover .catch-focus").focus();
					  $(document).unbind('click').click(function(e){hideot(e)});
				  } else $(document).unbind("click");
			  });
		});
	</script>
	@else
	<script>
		$(function () {
			  $("#ihome").popover({html:false});
			  $("#login").popover({html:true});
			  $("#register").popover({html:true});
			  $("[data-toggle='popover']").click(function(){
				  if ($(".popover").length>0){
					  $(".popover .catch-focus").focus();
					  $(document).unbind('click').click(function(e){
						  e = window.event || e;
						  obj = $(e.srcElement || e.target);
						  var click_where=0;
						  if ($(obj).is("#login, #login *")) click_where=1;
						  if ($(obj).is("#register, #register *")) click_where=2;
			            	  if ((!$(obj).is(".popover, .popover *")&&click_where==0)){
			            		   $("[data-toggle='popover'").popover("hide");
			            		   $(document).unbind("click");
			            		   
			            	  } 
			            	  if (click_where==1) $("#register").popover("hide"); 
		            		   if (click_where==2) $("#login").popover("hide");
					  });
				  } else $(document).unbind("click");
			  });
		});
	</script>
	@endif
	<script>
	   $(function(){
		   $("header").on("keypress", ".form-control", function(event){
			   if (event.keyCode=="13"){
				   $(".popover button").trigger("click");
			   }
		   });
	   });
	</script>
	<div class="main-footer-wrap">
	   @if(isset($user_nav))
	   {{$user_nav}}
	   @endif
	   <div class="main-wrap">
		  <div class="container-fluid">{{$main}}</div>
	   </div>
	   <footer class="footer text-center"> This_is_Footer </footer>
	</div>
	{{ HTML::script('./js/custom.js') }}
</body>
</html>