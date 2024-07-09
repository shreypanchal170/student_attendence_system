<div class="row">
	<div class="col-md-12">
		<div class="box box-solid">
			<form id="frmUpdateStudent" method="post" action="<?php echo URL; ?>students/update/<?php echo $this->student['studentid']; ?>">
			<input type="hidden" name="image" value="" />
			<div class="box-body">
				<div class="form-group">
					<label class="control-label">ID Number</label>
					<input type="text" class="form-control" name="idnumber" value="<?php echo $this->student['barcode']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Firstname</label>
					<input type="text" class="form-control" name="firstname" value="<?php echo $this->student['firstname']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Middlename</label>
					<input type="text" class="form-control" name="middlename" value="<?php echo $this->student['middlename']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Lastname</label>
					<input type="text" class="form-control" name="lastname" value="<?php echo $this->student['lastname']; ?>" />
				</div>

				<div class="form-group">
					<label class="control-label">Department</label>
					<select class="form-control" name="departmentid">
						<option value="">Select Department</option>
						<?php foreach($this->departments as $department):
						$selected = ($this->student['departmentid'] == $department['departmentid']) ? " selected" : "";
						?>
						<option<?php echo $selected; ?> value="<?php echo $department['departmentid']; ?>"><?php echo $department['department_name']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Course</label>
					<select class="form-control" name="courseid">
						<option value="">Select Course</option>
						<?php foreach($this->courses as $course):
						$selected = ($this->student['courseid'] == $course['courseid']) ? " selected" : "";
						$hidden = ($this->student['departmentid'] == $course['departmentid']) ? "" : ' class="hidden"';
						?>
						<option<?php echo $selected; ?><?php echo $hidden; ?> data-departmentid="<?php echo $course['departmentid']; ?>" value="<?php echo $course['courseid']; ?>"><?php echo $course['course_name']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Year</label>
					<select class="form-control" name="year">
						<option value="">Select Year</option>
						<option<?php echo ($this->student['year'] == 1) ? " selected" : ""; ?> value="1">First Year</option>
						<option<?php echo ($this->student['year'] == 2) ? " selected" : ""; ?> value="2">Second Year</option>
						<option<?php echo ($this->student['year'] == 3) ? " selected" : ""; ?> value="3">Third Year</option>
						<option<?php echo ($this->student['year'] == 4) ? " selected" : ""; ?> value="4">Fourth Year</option>
						<option<?php echo ($this->student['year'] == 5) ? " selected" : ""; ?> value="5">Fifth Year</option>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Section</label>
					<input type="text" class="form-control" name="section" value="<?php echo $this->student['section']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Mobile Number</label>
					<input type="text" class="form-control" name="mobile" value="<?php echo $this->student['mobile']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Image</label>
					<button type="button" class="btn btn-block btn-info" id="btnCapture"><i class="fa fa-camera"></i> Capture Image</button>
				</div>
				<div class="form-group">
					<label class="control-label">Or Select a File</label>
					<input type="file" class="form-control" id="selectFile" accept="image/png,image/jpeg,image/jpg" />
				</div>
				<?php if($this->student['image'] != ""): ?>
				<div class="form-group currentImagePreview">
					<label class="control-label">Current Image</label>
					<img class="img-responsive img-bordered" style="margin: 0 auto" src="<?php echo URL; ?>public/uploads/student/<?php echo $this->student['image']; ?>" />
				</div>			
				<?php endif; ?>
				<div class="form-group imagePreview hidden">
					<label class="control-label">Preview Image</label>
				</div>
			</div>
			<div class="box-footer text-right">
				<a href="<?php echo URL; ?>students" class="btn btn-default">Cancel</a>
				<button class="btn btn-success">Update</button>
			</div>
			</form>
		</div>
	</div>
</div>