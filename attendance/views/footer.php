	<script src="<?php echo URL; ?>public/assets/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo URL; ?>public/assets/adminlte/plugins/jQueryUI/jquery-ui.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo URL; ?>public/assets/adminlte/bootstrap/js/bootstrap.min.js"></script>
	<?php if(Session::get('loggedIn')): ?>
	<!-- For Logged In -->
	<script>$.widget.bridge('uibutton', $.ui.button);</script>
	<script src="<?php echo URL; ?>public/assets/adminlte/dist/js/app.min.js"></script>
	<!-- SlimScroll -->
	<script src="<?php echo URL; ?>public/assets/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo URL; ?>public/assets/adminlte/plugins/fastclick/fastclick.js"></script>
	<script src="<?php echo URL; ?>public/assets/sweet-alert/sweetalert.min.js"></script>
	<script src="<?php echo URL; ?>public/assets/adminlte/plugins/iCheck/icheck.min.js"></script>
	<script src="<?php echo URL; ?>public/assets/general.js"></script>
	<?php endif; ?>
	<!-- End For Logged In -->
<?php 
if (isset($this->jslibrary)) 
{
	echo "\n";
	foreach ($this->jslibrary as $js)
	{
		echo "\t<script type='text/javascript' src='".URL."public/assets/".$js.".js'></script>\n";
	}
}
?>
<?php 
if (isset($this->customlibrary)) 
{
	echo "\n";
	foreach ($this->customlibrary as $js)
	{
		echo "\t<script type='text/javascript' src='".URL."views/".$js.".js'></script>\n";
	}
}
?>
<div id="mainModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<p class="text-center no-margin">
					<i class="fa fa-refresh fa-spin"></i>
				</p>
			</div>
		</div>
	</div>
</div>
<div id="processModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<p class="text-center no-margin">
					<i class="fa fa-refresh fa-spin"></i>
				</p>
			</div>
		</div>
	</div>
</div>
<div id="generalModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<p class="text-center no-margin">
					<i class="fa fa-refresh fa-spin"></i>
				</p>
			</div>
		</div>
	</div>
</div>
</body>
</html>