<div class="row">
	<div class="col-md-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h4 class="box-title">Manage Student Data</h4>
			</div>
			<div class="box-body">
				<div class="box-group" id="accordion">
					<div class="panel box box-primary">
						<div class="box-header with-border">
		                    <h4 class="box-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Add Student</a></h4>
		                </div>
		                <div id="collapseOne" class="panel-collapse collapse in">
		                	<form id="frmAddStudent" method="post" action="<?php echo URL; ?>students/add">
		                	<div class="box-body">
								<input type="hidden" name="image" value="" />
								<div class="form-group">
									<label class="control-label">ID Number</label>
									<input type="text" class="form-control" name="idnumber" />
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
									<label class="control-label">Department</label>
									<select class="form-control" name="departmentid">
										<option value="">Select Department</option>
										<?php foreach($this->departments as $department): ?>
										<option value="<?php echo $department['departmentid']; ?>"><?php echo $department['department_name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Course</label>
									<select class="form-control" name="courseid">
										<option value="">Select Course</option>
										<?php foreach($this->courses as $course): ?>
										<option class="hidden" data-departmentid="<?php echo $course['departmentid']; ?>" value="<?php echo $course['courseid']; ?>"><?php echo $course['course_name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Year</label>
									<select class="form-control" name="year">
										<option value="">Select Year</option>
										<option value="1">First Year</option>
										<option value="2">Second Year</option>
										<option value="3">Third Year</option>
										<option value="4">Fourth Year</option>
										<option value="5">Fifth Year</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Section</label>
									<input type="text" class="form-control" name="section" />
								</div>
								<div class="form-group">
									<label class="control-label">Mobile Number</label>
									<input type="text" class="form-control" name="mobile" />
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
								<a class="btn btn-default" href="<?php echo URL; ?>students">Cancel</a>
								<button class="btn btn-success">Submit</button>
							</div>
							</form>
			            </div>
					</div>
					<div class="panel box box-warning">
						<div class="box-header with-border">
		                    <h4 class="box-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Import Student</a></h4>
		                </div>
		                <div id="collapseTwo" class="panel-collapse collapse">
		                	<form id="frmImportStudent" method="post" action="<?php echo URL; ?>students/import">
		                	<div class="box-body">
								<div class="form-group">
									<label class="control-label">Select File</label>
									<input type="file" class="form-control" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
								</div>
			                </div>
							<div class="box-footer text-right">
								<a class="btn btn-default" href="<?php echo URL; ?>students">Cancel</a>
								<button class="btn btn-success">Submit</button>
							</div>
							</form>
			            </div>
					</div>
				</div>
			</div>
			<div class="overlay hidden">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
		</div>
	</div>
</div>