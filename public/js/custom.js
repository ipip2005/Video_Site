﻿function checkMailFormat(mail){
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (filter.test(mail)) return true;
	return false;
}
function error_message(message){
	$("#error-message p").html(message);
	$("#error-message p").delay(100).show(500, function(){
		$("#error-message p").delay(3000).hide(500);
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
		success:function(response){
			var res = response.response;
			if (res=="ok") location=location; else{
				if (response.response=="")
					error_message("登陆失败"); else
					error_message(response.response);
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
		success:function(res){
			$.ajax({ url:"/video/make", async:"true", type:"post", data:{"filename":fname, "id":res.id}});
			window.location.href="/user/podcast";
		},
	});
}
function delete_video(id){
	if (!confirm("确认删除吗")) return;
	$.ajax({ url:"/video/delete", async:"false", type:"POST", data:{"id":id}});
	$("#video-"+id).hide(500,function(){this.remove()});
	$("#divider-"+id).hide(500,function(){this.remove()});
}
function edit_name(id){
	$(".edit .edit-"+id).hide(200);
	$(".edit .xedit-"+id).delay(200).show(300);
	text = $("#edit-name-"+id+" p").html();
	$("#edit-name-"+id+" p").hide();
	$("#edit-name-"+id+" input").attr({"value":text});
	$("#edit-name-"+id+" input").show();
}
function cancel_edit_name(id){
	$(".edit .xedit-"+id).hide(200);
	$(".edit .edit-"+id).delay(200).show(300);
	$("#edit-name-"+id+" input").hide();
	$("#edit-name-"+id+" p").show();
}
function save_edit_name(id){
	text = $("#edit-name-"+id+" input").val();
	//ajax
	$.ajax({ url:"/video/change-name", async:"false", type:"POST", data:{"name":text,"id":id},
		dataTpye:'json',
		success:function(response){
			if (reponse.error.length>0) {
				alert("修改失败");
				return;
			}
		},
	});
	$(".edit .xedit-"+id).hide(200);
	$(".edit .edit-"+id).delay(200).show(300);
	$("#edit-name-"+id+" p").html(text);
	$("#edit-name-"+id+" input").hide();
	$("#edit-name-"+id+" p").show();
}
function edit_intr(id){
	$(".edit2 .edit2-"+id).hide(200);
	$(".edit2 .xedit2-"+id).delay(200).show(300);
	text = $("#edit2-intr-"+id+" p").html();
	$("#edit2-intr-"+id+" p").hide();
	$("#edit2-intr-"+id+" textarea").val(text);
	$("#edit2-intr-"+id+" textarea").show(300);
}
function cancel_edit_intr(id){
	$(".edit2 .xedit2-"+id).hide(200);
	$(".edit2 .edit2-"+id).delay(200).show(300);
	$("#edit2-intr-"+id+" textarea").hide();
	$("#edit2-intr-"+id+" p").show();
}
function save_edit_intr(id){
	text = $("#edit2-intr-"+id+" textarea").val();
	//ajax
	$.ajax({ url:"/video/change-intr", async:"false", type:"POST", data:{"intr":text,"id":id},
		dataTpye:'json',
		success:function(response){
			if (reponse.error.length>0) {
				alert("修改失败");
				return;
			}
		},
	});
	$(".edit2 .xedit2-"+id).hide(200);
	$(".edit2 .edit2-"+id).delay(200).show(300);
	$("#edit2-intr-"+id+" p").html(text);
	$("#edit2-intr-"+id+" textarea").hide();
	$("#edit2-intr-"+id+" p").show();
}
function upload_pause(){
	r.pause();
	$("#pause-button").html("续传");
	$("#pause-button").attr({"onclick":"upload_restart()"})
	$("#pause-button").attr({"id":"restart-button"});
}
function delete_unpublished_video(id){
	$.ajax({url:"/video/clear",type:"get",data:{"id":id},async:false});
}
function upload_cancel(id){
	if (confirm("确认取消当前上传中的视频吗")){
		r.cancel();
		delete_unpublished_video(id);
		location=location;
	}
}
function upload_restart(){
	$("#restart-button").html("暂停");
	$("#restart-button").attr({"onclick":"upload_pause()"})
	$("#restart-button").attr({"id":"pause-button"});
	r.upload();
}

function pay_attension(id){
	$.ajax({url:"/user/friends/add-friend",type:'post',async:false,
		data:{'fid':id},success:function(res){
			if (res.success=='1')
				$("#pay-button").attr('onclick','cancel_pay_attension('+id+')');
				$("#pay-button i").toggleClass("icon-plus").toggleClass("icon-minus");
				$("#pay-button b").html('取消关注');
		}
	});
}
function cancel_pay_attension(id){
	if (!confirm("取消关注会删除所有已有的联系，确认？")) return;
	$.ajax({url:"/user/friends/del-friend",type:'post',async:false,
		data:{'fid':id},success:function(res){
			if (res.success=='1')
				$("#pay-button").attr('onclick','pay_attension('+id+')');
				$("#pay-button i").toggleClass("icon-plus").toggleClass("icon-minus");
				$("#pay-button b").html('关注');
		}
	});
}
function refresh_comments(vid){
	$("#tab-comments").load("/comment/blade",{'vid': vid});
	$("#blade-comments").load("/comment/blade",{'vid': vid});
}

function switch_button(bid){
    $(bid).toggleClass("btn-default");
    $(bid).toggleClass("btn-success");
}
function get_json_from_modal(){
	var data = '{';
    $(".modal .btn-default").each(function(){
        data+=('"'+$(this).attr("id").substring(3)+'":0,');
    });
    $(".modal .btn-success").each(function(){
        data+=('"'+$(this).attr("id").substring(3)+'":1,');
    })
    if (data.charAt(data.length-1) == ',')
        data = data.substring(0,data.length-1);
    data+='}';
    return data;
}
function add_reply(uid, name){
	reply_to = uid;
	$("#comment-input span").html("@"+name);
	return;
}
function recommend(vid){
	$.ajax({url:"/video/recommend",type:"get",data:{'vid':vid},success:function(){
		alert('推荐成功');
	}})
}
function delete_comment(cid){
	$.ajax({url:"/comment/delete",type:"get",data:{'cid':cid},success:function(res){
		if (res.success=="1") $("#comment-"+cid).hide(500,function(){refresh_comments(0);});
	}})
}
function change_privilege(uid, privilege){
    domid = "#dropdown-"+uid;
    $.ajax({url:"/user/modify-privilege",type:"post",async:false,data:{'uid':uid,'privilege':privilege},
    	success:function(res){
    		if (res.error=="undefined") {
    			alert(res.error);
    			return;
    		}
    		$(domid).removeClass("privilege-1").removeClass("privilege-2")
    			.removeClass("privilege-3").removeClass("privilege-4").addClass('privilege-'+privilege);
    		var str = "管理员";
    		switch (privilege){
    		case 1: str="禁止发言";break;
    		case 2: str="禁止登陆";break;
    		case 3: str="禁止发布";break;
    		case 4: str="普通用户";break;
    		}
    		$(domid+" button .privilege").html(str);
    		
    	}});
}
function rate(rating, vid){
	$.ajax({url:"/video/rating",type:"post",async:false,data:{'score': rating,'vid': vid},
    	success:function(res){
    		if (res.success == "1"){
    			$(".rating-blade").load("/video/rating-blade",{"vid": vid});
    			$("#rating-success").show(500).delay(1000).hide(500);
    		} else {
    			alert("未登录或未知错误！！");
    		}
    	}});
}
function share(vid){
	$.ajax({url:"/video/share",type:"post",async:false,data:{'vid': vid},
    	success:function(res){
    		if (res.error == 'already shared'){
    			alert("不能重复分享...");
    		}
    		if (res.success == "1"){
    			alert("分享成功！！！");
    		} else {
    			alert("未登录或未知错误！！");
    		}
    	}});
}