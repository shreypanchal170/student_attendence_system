<div class="row">
	<div class="col-md-12">
		<div class="box box-solid">
			<form id="frmUpdateOfficer" method="post" action="<?php echo URL; ?>officers/update/<?php echo $this->officer['userid']; ?>">
			<div class="box-body">
				<div class="form-group">
					<label class="control-label">Username</label>
					<input type="text" class="form-control" name="username" value="<?php echo $this->officer['username']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Password</label>
					<input type="password" class="form-control" name="password" />
				</div>
				<div class="form-group">
					<label class="control-label">Firstname</label>
					<input type="text" class="form-control" name="firstname" value="<?php echo $this->officer['firstname']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Middlename</label>
					<input type="text" class="form-control" name="middlename" value="<?php echo $this->officer['middlename']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Lastname</label>
					<input type="text" class="form-control" name="lastname" value="<?php echo $this->officer['lastname']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Mobile Number</label>
					<input type="text" class="form-control" name="mobile" value="<?php echo $this->officer['mobile']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Position</label>
					<input type="text" class="form-control" name="position_description" value="<?php echo $this->officer['position_description']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Image</label>
					<button type="button" class="btn btn-block btn-info" id="btnCapture"><i class="fa fa-camera"></i> Capture Image</button>
				</div>
				<div class="form-group">
					<label class="control-label">Or Select a File</label>
					<input type="file" class="form-control" id="selectFile" accept="image/png,image/jpeg,image/jpg" />
				</div>
				<?php if($this->officer['image'] != ""): ?>
				<div class="form-group imagePreview">
					<label class="control-label">Current Image</label>
					<img class="img-responsive img-bordered" style="margin: 0 auto" src="<?php echo URL; ?>public/uploads/user/<?php echo $this->officer['image']; ?>" />
				</div>
				<?php else: ?>
				<div class="form-group imagePreview hidden">
					<label class="control-label">Preview Image</label>
				</div>
				<?php endif; ?>
			</div>
			<div class="box-footer text-right">
				<input type="hidden" name="image" value="" />
				<a href="<?php echo URL; ?>officers" class="btn btn-default">Cancel</a>
				<button class="btn btn-success">Update</button>
			</div>
			</form>
		</div>
	</div>
</div>