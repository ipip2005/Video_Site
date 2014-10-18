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
        <nav class="nav text-center">
            <div class="nav-content">
                <div class="nav-item logo">
                   <p>LOGO</p>
                </div>
                <div class="nav-item search-box">
                </div>
                <div class="nav-item">
                </div>
                <div class="nav-item logreg">
                @if(Auth::check())
                @else
                    <a href="/logreg#login">登陆</a>
                    <p>/</p>
                    <a href="/logreg#register">注册</a>
                @endif
                </div>
            </div>
        </nav>
    </header>
    <div class="header-blank">
        
    </div>
    <div class="main-wrap">
        <div class="row">
            {{$main}}
        </div>
    </div>
    <footer class="text-center">
        This_is_Footer
    </footer>
    {{ HTML::script('./js/custom.js') }}
</body>
</html>