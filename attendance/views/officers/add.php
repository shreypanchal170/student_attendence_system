<div class="row">
	<div class="col-md-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h4 class="box-title">Add Officer</h4>
			</div>
			<form id="frmAddOfficer" method="post" action="<?php echo URL; ?>officers/add">
			<div class="box-body">
				<div class="form-group">
					<label class="control-label">Username</label>
					<input type="text" class="form-control" name="username" />
				</div>
				<div class="form-group">
					<label class="control-label">Password</label>
					<input type="password" class="form-control" name="password" />
				</div>
				<div class="form-group">
					<label class="control-label">Firstname</label>
					<input type="text" class="form-control" name="firstname" />
				</div>
				<div class="form-group">
					<label class="control-label">Middlename</label>
					<input type="text" class="form-control" name="middlename" />
				</div>
				<div class="form-group">
					<label class="control-label">Lastname</label>
					<input type="text" class="form-control" name="lastname" />
				</div>
				<div class="form-group">
					<label class="control-label">Mobile Number</label>
					<input type="text" class="form-control" name="mobile" />
				</div>
				<div class="form-group">
					<label class="control-label">Position</label>
					<input type="text" class="form-control" name="position_description" />
				</div>
				<div class="form-group">
					<label class="control-label">Image</label>
					<button type="button" class="btn btn-block btn-info" id="btnCapture"><i class="fa fa-camera"></i> Capture Image</button>
				</div>
				<div class="form-group">
					<label class="control-label">Or Select a File</label>
					<input type="file" class="form-control" id="selectFile" accept="image/png,image/jpeg,image/jpg" />
				</div>
				<div class="form-group imagePreview hidden">
					<label class="control-label">Preview Image</label>
				</div>
			</div>
			<div class="box-footer text-right">
				<input type="hidden" name="image" value="" />
				<a class="btn btn-default" href="<?php echo URL ;?>officers">Cancel</a>
				<button class="btn btn-success">Submit</button>
			</div>
			</form>
		</div>
	</div>
</div>