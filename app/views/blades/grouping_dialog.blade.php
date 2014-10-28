<div class="modal fade grouping" tabindex="-1" role="dialog" id="grouping"
	aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
	    
		<div class="modal-content">
		  <div class="modal-header">
	        <h1 class="modal-title"><b class="soft-text">选择该好友的分组</b></h1>
	      </div>
		  <div class="modal-body container-fluid">
		      <div class="row" data-toggle="buttons" id="group-buttons">   
		      @foreach($groups as $group)
		          <div class="col-xs-3">
	               <button id="sg-<?php echo $group->id?>" class="btn btn-default col-xs-3" style="width:100%"
	                   onclick="switch_button('#sg-<?php echo $group->id?>')">
	                  {{$group->name}}
	               </button>
	              </div>
	          @endforeach
		      </div>
		      <div class="row">
		          <hr class="divider">
		      </div>
		      <div class="row">
		          <div class="col-xs-4 col-xs-offset-2 text-center">
		              <button class="btn btn-primary" onclick="update_group()">提交</button>
		          </div>
		          <div class="col-xs-4 text-center">
		              <button class="btn btn-danger" onclick="$('#grouping').modal('hide');">取消</button>
		          </div>
		      </div>
		  </div>
		</div>
	</div>
</div>