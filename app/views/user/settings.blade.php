<div class="row">
    <div class="col-xs-6 text-left">
        <h1 class="soft-text"><a href="/user/ihome">{{$user->username}}</a>
        </h1>    
    </div>
    <div class="col-xs-6 text-right">
        <h2 class="soft-text"><i class="icon-cog"></i> Settings</h2>
    </div>
</div>
<div class="row">
    <hr class="divider">
</div>
<div class="row setting-item">
    <div class="col-xs-2 text-right">
        <h3 class="soft-text">
                                            用户名
        </h3>
    </div>
    <div class="col-xs-1">
    </div>
    <div class="col-xs-9">
        <h3>
            {{$user->username}}
        </h3>
    </div>
</div>

<div class="row setting-item">
    <div class="col-xs-2 text-right">
        <h3 class="soft-text">
                                            昵称
        </h3>
    </div>
    <div class="col-xs-1">
    </div>
    <div class="col-xs-9 margin-fix-h">
        <input name="nickname" value="<?php echo $user->nickname?>">
    </div>
</div>

<div class="row setting-item">
    <div class="col-xs-2 text-right">
        <h3 class="soft-text">
                                            密码 
        </h3>
    </div>
    <div class="col-xs-1">
    </div>
    <div class="col-xs-9 margin-fix-h">
        <input type="password" name="password" value="">
    </div>
</div>
<div class="row setting-item">
    <div class="col-xs-2 text-right">
        <h3 class="soft-text">
                                          确认密码
        </h3>
    </div>
    <div class="col-xs-1">
    </div>
    <div class="col-xs-9 margin-fix-h">
        <input type="password" name="confirm-password" value="">
    </div>
</div>

<div class="row setting-item">
    <div class="col-xs-2 text-right">
        <h3 class="soft-text">
                                         邮箱
        </h3>
    </div>
    <div class="col-xs-1">
    </div>
    <div class="col-xs-9 margin-fix-h">
        <input name="email" value="<?php echo $user->email?>">
    </div>
</div>

<div class="row setting-item">
    <div class="col-xs-2 text-right">
        <h3 class="soft-text">
                                            简介
        </h3>
    </div>
    <div class="col-xs-1">
    </div>
    <div class="col-xs-9 margin-fix-h">
        <textarea name="introduction" rows="3">{{$user->introduction}}</textarea>
    </div>
</div>

<div class="row text-center">
    <button class="btn-primary border-0 up-button" id="settings-submit">提交</button>
</div>
<div class="row text-center" id="error-message" style="height:40px">
    <p class="text-danger" style="line-height: 40px"></p>
</div>
<script>
$("#error-message p").hide();
$("#settings-submit").click(function(){
	$nickname = $("input[name='nickname']").val();
	$password = $("input[name='password']").val();
	$confirm = $("input[name='confirm-password']").val();
	$email = $("input[name='email']").val();
	$introduction = $("textarea[name='introduction']").val();
	if ($password != $confirm) {
		error_message("两次输入的密码不一致");
		return;
	}
	if (!checkMailFormat($email)) {
		error_message("邮箱格式错误");
		return;
	}
	$.ajax({ url:"/user/change-setting", async:"false", type:"POST", data:{
		"nickname":$nickname,
		"password":$password,
		"email":$email,
		"introduction":$introduction
		},success:function(response){
			var res = response.success;
			if (res=="1")history.go(0); else{
				error_message("登陆失败");
			}
		}
	});
});
</script>