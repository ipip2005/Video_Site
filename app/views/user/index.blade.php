<div class="user-nav">
    <div class="container">
        <div class="row" id="navbar">
            <ul class="nav">
                <li class="col-xs-2 text-center <?php if($active=="ihome") echo "active"?>" id="ihome">
                    <a href="/user/ihome">我的首页</a>
                </li>
                <li class="col-xs-2 text-center <?php if($active=="upload") echo "active"?>" id="upload">
                    <a href="/user/upload">我的视频</a>
                </li>
                <li class="col-xs-2 text-center <?php if($active=="message") echo "active"?>" id="message">
                    <a href="/user/message">消息管理</a>
                </li>
                <li class="col-xs-2 text-center <?php if($active=="friends") echo "active"?>" id="friends">
                    <a href="/user/friends">好友管理</a>
                </li>
                <li class="col-xs-2 text-center <?php if($active=="settings") echo "active"?>" id="settings">
                    <a href="/user/settings">个人设置</a>
                </li>
            </ul>
        </div>
    </div>
</div>
