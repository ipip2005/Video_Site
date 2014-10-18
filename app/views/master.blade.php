<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
@section('title')
<title>{{{$title}}}</title> @show {{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/custom.css') }} {{
HTML::style('css/font-awesome.css') }}
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
{{ HTML::script('./js/bootstrap.min.js') }}
</head>
<body>
	<header>
		<nav class="master-nav">
			<div class="master-nav-content">
				<div class="row">
					<div class="master-nav-item logo col-xs-1">
						<a href="/">LOGO</a>
					</div>
					<div class="master-nav-item search-box col-xs-7">
						<div class="input-group">
							<input type="text"
								class="form-control search-content" placeholder="Ipip2005">
							<div class="input-group-btn">
							    <button class="btn btn-primary ">
								    <i class="icon-search"></i>
							    </button>
							</div>
						</div>
					</div>
					<div class="master-nav-item col-xs-2">
					   <button class="btn-success up-button">上传视频 </button>
					</div>
					<div class="master-nav-item logreg col-xs-2">
						@if(Auth::check()) @else <a href="/logreg#login">登陆</a>
						<p>/</p>
						<a href="/logreg#register">注册</a> @endif
					</div>
				</div>
			</div>
		</nav>
	</header>
	<div class="main-wrap">
		<div class="row">
		   {{$main}}
		</div>
	</div>
	<footer class="footer text-center"> This_is_Footer </footer>
	{{ HTML::script('./js/custom.js') }}
</body>
</html>