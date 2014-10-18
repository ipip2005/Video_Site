<!--<div class="container">
	<div class="row">
		<div class="col-md-6">
			<img src="/i/qvod.jpg" style="width:100%;height:auto;"/>
		</div>
		<div class="col-md-6">
			<div class="tabbable" id="mytab">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#login" data-toggle="tab">登录</a>
					</li>
					<li>
						<a href="#register" data-toggle="tab">注册</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="login">
						<br/>
						<br/>
						<br/>
						<div class="row">
							<div class="col-md-4 text-right">
								<label>用 户 名</label>
								<br/>
								<br/>
								<label>密&nbsp&nbsp&nbsp&nbsp码</label>
							</div>
							<div class="col-md-2"></div>
							<div class="col-md-4 text-left">
								<input type="text" name="lname" id="lname" />
								<br/>
								<br/>
								<input type="password" name="lpass" id="lpass" />
							</div>
							<div class="col-md-2"></div>
						</div>
						<br/>
						<div class="text-center"><button type="button" class="btn btn-primary">登录</button></div>
						<br/>
					</div>
					<div class="tab-pane" id="register">
						<br/>
						<br/>
						<br/>
						<div class="row">
							<div class="col-md-4 text-right">
								<label>用 户 名</label>
								<br/>
								<br/>
								<label>密&nbsp&nbsp&nbsp&nbsp码</label>
								<br/>
								<br/>
								<label>确认密码</label>
								<br/>
								<br/>
								<label>邮&nbsp&nbsp&nbsp&nbsp箱</label>
							</div>
							<div class="col-md-2"></div>
							<div class="col-md-4 text-left">
								<input type="text" name="rname" id="rname" />
								<br/>
								<br/>
								<input type="password" name="rpass" id="rpass" />
								<br/>
								<br/>
								<input type="password" name="rpass2" id="rpass2" />
								<br/>
								<br/>
								<input type="text" name="email" id="email" />
							</div>
							<div class="col-md-4"></div>
						</div>
						<br/>
						<div class="text-center"><button type="button" class="btn btn-danger">注册</button></div>
						<br/>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>-->
<a class="btn" data-toggle="popover"  title="请登录" data-placement="bottom"
	data-content="
        <br/>
        <div class='input-group'>
		<span class='input-group-addon'>用户名</span> <input type='text'
			class='form-control' placeholder='Username'>
	</div>
	<br />
	<div class='input-group'>
		<span class='input-group-addon'>密&nbsp&nbsp&nbsp&nbsp码</span> <input
			type='password' class='form-control' placeholder='Password'>
	</div>
	<div class='text-center'>
		<br />
		<br />
		<button type='button' class='btn btn-primary'>登录</button>
	</div>
	">
	登录</a>
<script>$(function(){$("[data-toggle='popover']").popover({html:true}); })</script>