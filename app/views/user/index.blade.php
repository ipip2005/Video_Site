<div class="user-nav">
    <div class="container">
        <div class="row" id="navbar">
            <ul class="nav">
                <li class="col-xs-2 text-center <?php if($active=="ihome") echo "active"?>" id="ihome">
                    <a href="/user/ihome"><i class="icon-home"></i> 我的首页</a>
                </li>
                <li class="col-xs-2 text-center <?php if($active=="upload") echo "active"?>" id="upload">
                    <a href="/user/podcast"><i class="icon-facetime-video"></i> 我的视频</a>
                </li>
                <li class="col-xs-2 text-center <?php if($active=="message") echo "active"?>" id="message">
                    <a href="/user/message"><i class="icon-comments"></i> 消息管理</a>
                </li>
                <li class="col-xs-2 text-center <?php if($active=="friends") echo "active"?>" id="friends">
                    <a href="/user/friends"><i class="icon-group"></i> 好友管理</a>
                </li>
                <li class="col-xs-2 text-center <?php if($active=="settings") echo "active"?>" id="settings">
                    <a href="/user/settings"><i class="icon-cog"></i> 个人设置</a>
                </li>
                @if(Auth::user()->priviledge==0)
                <li class="col-xs-2 text-center <?php if($active=="panel") echo "active"?>" id="panel">
                    <a href="/user/panel"><i class="icon-dashboard"></i> 控制面板</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
