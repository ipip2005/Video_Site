<div class="row">
	<div class="belt">
		<h3>
			<b class="soft-text"><i class="icon-th"></i> 好友管理</b>
		</h3>
	</div>
</div>
<div class="row">
	<hr class="divider">
</div>
<div class="row">
	<div class="col-xs-3">
		<div class="row">
			<div class="col-xs-10">
				<button class="btn-primary border-0" onclick="show_group(1)">
					所有好友 <span class="badge">{{count(DB::table('urelation')->where('host','=',Auth::id())->
						where('group','=','1')->get())}}</span>
				</button>
			</div>
		</div>
		<div class="row">
			<hr class="divider">
		</div>
		@foreach($groups as $group)

		<div class="row">
			<div class="col-xs-10">
				<button class="btn-default border-0"
					onclick="show_group(<?php echo $group->id?>)">
					{{$group->name}} <span class="badge">{{count(DB::table('urelation')->where('host','=',Auth::id())->
						where('group','=',$group->id)->get())}}</span>
				</button>
			</div>
			<div class="col-xs-2">
				<button class="btn-danger border-0"
					onclick="delete_group(<?php echo $group->id?>)">X</button>
			</div>
		</div>
		<div class="row">
			<hr class="divider">
		</div>
		@endforeach
		<div class="row">
			<div class="col-xs-6">
				<button class="btn-success border-0 up-button" id="add-group">添加</button>
			</div>
			<div class="col-xs-6">
				<button class="btn-danger border-0 up-button" id="cancel-add-group">取消</button>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<input type="text" id="gname" class="margin-top-10"
					placeholder="group-name">
			</div>
		</div>
		<script>$("#gname").hide();$("#cancel-add-group").hide();</script>
	</div>
	<div class="col-xs-9" id="friend-blade">
		<div class="container-fluid margin-tb-10" id="friend">
			<div class="row">
				@foreach($friends as $user)
				<div class="col-xs-3">
					<div class="row text-center">
						<a href="/user?uid=<?php echo $user->id?>"> <img
							src="<?php echo $user->photoPath.'/photo.jpg'?>">
						</a>
					</div>
					<div class="row text-center">
						<h4>
							<a href="/user?uid=<?php echo $user->id?>"><?php
    
    if (empty($user->nickname))
        echo $user->username;
    else
        echo $user->nickname;
    ?></a>
						</h4>
					</div>
					<div class="row text-center">

						<a class="btn btn-default to-group" style="width: 90%"
							href="javascript:modal_active(<?php echo $user->id?>);">
					       <?php
            $cato = DB::table('urelation')->where('host', '=', Auth::id())
                ->where('group', '<>', '1')
                ->where('friend', '=', $user->id)
                ->get(array(
                'group'
            ));
            if (count($cato) == 0)
                echo "未分组";
            else
                for ($i = 0; $i < count($cato) && $i < 2; $i ++) {
                    if ($i > 0)
                        echo ' | ';
                    echo DB::table('groups')->where('id', '=', $cato[$i]->group)->first()->name;
                }
            if (count($cato) > 2)
                echo ' | ...';
            ?>
					   </a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@include('blades/grouping_dialog');
<script>
    var now = 1;
    var fid;
    $("#add-group").click(function(){add_group()});
    $("#cancel-add-group").click(function(){cancel_add_group()});
    
    function modal_active(id){
        fid = id;
        $("#grouping").modal("show");
        $.ajax({url:"/user/friends/groups-of-friend",data:{'fid':id},type:'post',
            success:function(res){
                $.each(res,function(i,item){
                    if (item=='1') {
                        $("#sg-"+i).addClass("btn-success");
                        $("#sg-"+i).removeClass("btn-default");
                    } else{
                        $("#sg-"+i).removeClass("btn-success");
                        $("#sg-"+i).addClass("btn-default");
                    }
                });
            }});
        //$(".modal-body").
    }
    
    function show_group(id){
        if (id == now) return;
        //alert(id);
    }
    function update_group(){
        var data = get_json_from_modal();
        $.ajax({url:"/user/friends/update-group",type:"post",async:"false",
            data:{"data":data,'fid':fid},success:function(){
                location=location;
            }
            });
    }
    function delete_group(id){
        if (!confirm("确定删除该组吗")) return;
        $.ajax({url:"/user/friends/del-group",type:"get",data:{"gid":id},
                success:function(){
                    location=location;
                }});
    }
    function add_group(){
        var gname = $("#gname").val();
        if (gname=="") {
            $("#gname").show(500);
            $("#cancel-add-group").show(500);
        } else{
        	$.ajax({url:"/user/friends/add-group",type:"get",data:{'gname':gname},
                    success:function(){
                        location=location;
                    }});
        }
    }
    function cancel_add_group(){
        $("#gname").val("");
        $("#gname").hide(500);
        $("#cancel-add-group").hide(500);
    }
</script>