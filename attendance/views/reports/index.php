<div class="row">
	<div class="col-md-6">
		<div class="box box-solid">
			<form id="frmPrintReport" target="_blank" method="post" action="<?php echo URL; ?>reports/printReport">
			<div class="box-body">
				<div class="form-group">
					<label class="control-label">Select School Year:</label>
					<select id="selectSchoolYear" name="schoolyear" required class="form-control">
						<option value="<?php echo $this->currentSY; ?>"><?php echo $this->currentSY; ?></option>
						<?php foreach($this->schoolYears as $year): ?>
						<option value="<?php echo $year['schoolyear']; ?>"><?php echo $year['schoolyear']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Select Report Type:</label>
					<select id="selectReportType" name="report_type" required class="form-control">
						<option value=""></option>
						<option value="print-student-barcode">Student Barcode ID</option>
						<option value="print-student-attendance">Student Attendance</option>
						<option value="print-event-attendance">Event Attendance</option>
					</select>
				</div>
				<div class="form-group hidden">
					<label class="control-label">Select Event:</label>
					<select id="selectEvent" name="eventid" class="form-control"<?php echo ($this->events == null) ? " disabled": ""; ?>>
						<?php foreach($this->events as $event): ?>
						<option data-status="<?php echo $event['status']; ?>" value="<?php echo $event['eventid']; ?>"><?php echo $event['event_name']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div id="printStatus" class="hidden">
					<div class="form-group">
						<label class="control-label">Print Status:</label>

						<label>
		            		<input type="radio" name="print-status" value="all" checked> All
		                </label>
		                <label>
		                	<input type="radio" name="print-status" value="present"> Present
		                </label>
		                <label>
		                	<input type="radio" name="print-status" value="absent"> Absent
		                </label>
					</div>
					<div class="form-group hidden" id="printSession">
						<label class="control-label">Select Session:</label>
						<label>
		            		<input type="radio" name="print-session" class="flat-red" value="am" checked> AM
		                </label>
		                <label>
		            		<input type="radio" name="print-session" class="flat-red" value="pm"> PM
		                </label>
					</div>
				</div>
				<div class="form-group hidden">
					<label class="control-label">Select Department:</label>
					<select id="selectDepartment" name="departmentid" class="form-control">
						<?php foreach($this->departments as $department): ?>
						<option value="<?php echo $department['departmentid']; ?>"><?php echo $department['department_name']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group hidden">
					<label class="control-label">Select Course:</label>
					<select id="selectCourse" name="courseid" class="form-control">
						<?php foreach($this->courses as $course): ?>
						<option data-departmentid="<?php echo $course['departmentid']; ?>" value="<?php echo $course['courseid']; ?>"><?php echo $course['course_name']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group hidden">
					<label class="control-label">Select Year:</label>
					<select id="selectYear" name="year" class="form-control">
						<option value="1">First Year</option>
						<option value="2">Second Year</option>
						<option value="3">Third Year</option>
						<option value="4">Fourth Year</option>
						<option value="5">Fifth Year</option>
					</select>
				</div>
				<div class="form-group hidden">
					<label class="control-label">Select Section:</label>
					<select id="selectSection" name="section" class="form-control" disabled></select>
				</div>
			</div>
			<div class="box-footer text-right">
				<button class="btn btn-success" disabled>Print</button>
			</div>
			</form>
		</div>
	</div>
</div>