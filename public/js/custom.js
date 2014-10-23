function checkMailFormat(mail){
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (filter.test(mail)) return true;
	return false;
}
function error_message(message){
	$("#error-message p").html(message);
	$("#error-message").delay(100).show(500, function(){
		$("#error-message").delay(3000).hide(500);
	});
}
function login(){
	var account = $(".account").val();
	var password = $('.password').val();
	if (account==""){
		error_message("账号不能为空");
		return;
	}
	if (password==""){
		error_message("密码不能为空");
		return;
	}
	$.ajax({ url:"/login", async:"false", type:"POST", data:{"account":account,"password":password},
		dataTpye:'json',
		success:function(response){
			var res = response.response;
			if (res=="ok")history.go(0); else{
				error_message("登陆失败");
			}
		},
	});
}

function register(){
	var account = $(".account").val();
	var password = $('.password').val();
	var confirm = $('.confirm-password').val();
	var mail = $('.mail-address').val();
	
	if (account=="" || password=="" || confirm=="" || mail=="") {
		error_message("不能有输入框为空");
		return;
	}
	if (password!=confirm){
		error_message("两次输入密码不一致，请重新输入");
		return;
	}
	if (password.length<6){
		error_message("密码长度太短");
		return;
	}
	if (!checkMailFormat(mail)){
		error_message("邮箱格式错误");
		return;
	}
	$.ajax({ url:"/register", async:"false", type:"POST", data:{"account":account,"password":password,"email":mail},
		dataTpye:'json',
		success:function(response){
			var res = response.error;
			if (res=="been_registered_username"){
				error_message("该账号已被注册");
				return;
			} 
			if (res=="been_registered_email"){
				error_message("该邮箱已被注册");
				return;
			}
			if (response.success!="success"){
				error_message("未知错误");
				return;
			}
			login();
		},
	});
}

function publish(){
	name = $("#pub-name").val();
	introduction = $('#pub-intro').val();
	if (name.length>50) {
		error_message("名字超过50字");
		return;
	}
	if (name.length==0) {
		error_message("名字不能为空");
		return;
	}
	if (introduction.length==0){
		error_message("描述不能为空");
		return;
	}
	if (introduction.length>50){
		error_message("描述超过250字");
		return;
	}
	$.ajax({ url:"/video/publish", async:"false", type:"POST", data:{"name":name,"introduction":introduction},
		dataTpye:'json',
		success:function(response){
			window.location.href="/user/podcast";
		},
	});
}
function delete_video(id){
	if (!confirm("确认删除吗")) return;
	$.ajax({ url:"/video/delete", async:"false", type:"POST", data:{"id":id}});
	$("#video-"+id).hide(500,function(){this.remove()});
}