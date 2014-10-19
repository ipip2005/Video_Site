function login(){
	var account = $(".account").val();
	var password = $('.password').val();
	if (account=="" || password=="") return;
	$.ajax({ url:"/login", async:"false", type:"POST", data:{"account":account,"password":password},
		dataTpye:'json',
		success:function(response){
			var res = response.response;
			if (res=="ok")history.go(0); else{
				$("#error-message").show(500);
			}
		},
	});
}