	<div class="login-box">
		<div class="login-logo"><img src="<?php echo URL; ?>public/logo.png" /></div>
	<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Sign in to start your session</p>

			<form action="login/run" method="post">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="username" required placeholder="Username">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password" required placeholder="Password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
					<!-- /.col -->
				</div>
			</form>

			<div class="social-auth-links text-center"><?php if(isset($_GET['hasError'])): ?><p class="alert alert-danger">Login Error!</p><?php endif; ?></div>
			<!-- /.social-auth-links -->
		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->