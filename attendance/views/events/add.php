<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Add Event</h4>
		</div>
		<form id="frmAddEvent" method="post" action="<?php echo URL; ?>events/add">
		<div class="modal-body">
			<div class="form-group">
				<label class="control-label">Name</label>
				<input type="text" class="form-control" name="event_name" />
			</div>
			<div class="form-group">
				<label class="control-label">Place</label>
				<input type="text" class="form-control" name="event_place" />
			</div>
			<div class="form-group">
				<label class="control-label">Status</label>
				<select name="status" class="form-control" id="eventStatus">
					<option value="wholeday">Wholeday</option>
					<option value="morning">Half-day Morning</option>
					<option value="afternoon">Half-day Afternoon</option>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label">Event Date</label>
				<input type="text" id="eventDate" class="form-control" name="event_date" defaultDate="<?php echo date("Y-m-d"); ?> - <?php echo date("Y-m-d"); ?>" />
			</div>
			<div class="form-group timeArea" id="timemorning">
				<label class="control-label">Morning Schedule</label>
				<div class="row">
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
			                <div class="form-group">
			                	<label class="control-label">Start Time</label>
			                	<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
									<input placeholder="Start Time" type="text" class="form-control timepickerMorning" name="event_starttime_am" value="07:00 AM" />
								</div>
			                </div>
			            </div>
					</div>
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
							<label class="control-label">End Time</label>
			                <div class="form-group">
			                	<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
									<input placeholder="End Time" type="text" class="form-control timepickerMorning" name="event_endtime_am" value="11:00 AM" />
								</div>
			                </div>
			            </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
			                <div class="form-group">
			                	<label class="control-label">Attendance Time In</label>
			                	<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
									<input placeholder="Start Time" type="text" class="form-control timepickerMorning" name="event_starttime_am_in" value="07:00 AM" />
								</div>
			                </div>
			            </div>
					</div>
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
							<label class="control-label">&nbsp;</label>
			                <div class="form-group">
			                	<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
									<input placeholder="End Time" type="text" class="form-control timepickerMorning" name="event_endtime_am_in" value="08:00 AM" />
								</div>
			                </div>
			            </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
			                <div class="form-group">
			                	<label class="control-label">Attendance Time Out</label>
			                	<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
									<input placeholder="Start Time" type="text" class="form-control timepickerMorning" name="event_starttime_am_out" value="10:00 AM" />
								</div>
			                </div>
			            </div>
					</div>
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
							<label class="control-label">&nbsp;</label>
			                <div class="form-group">
			                	<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
									<input placeholder="End Time" type="text" class="form-control timepickerMorning" name="event_endtime_am_out" value="11:00 AM" />
								</div>
			                </div>
			            </div>
					</div>
				</div>
			</div>
			<div class="form-group timeArea" id="timeafternoon">
				<label class="control-label">Afternoon Schedule</label>
				<div class="row">
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
			                <div class="form-group">
			                	<label class="control-label">Start Time</label>
			                	<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
									<input placeholder="Start Time" type="text" class="form-control timepickerAfternoon" name="event_starttime_pm" value="01:00 PM" />
								</div>
			                </div>
			            </div>
					</div>
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
			                <div class="form-group">
			                	<label class="control-label">End Time</label>
			                	<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
									<input placeholder="End Time" type="text" class="form-control timepickerAfternoon" name="event_endtime_pm" value="04:00 PM" />
								</div>
			                </div>
			            </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
			                <div class="form-group">
			                	<label class="control-label">Attendance Time In</label>
			                	<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
									<input placeholder="Start Time" type="text" class="form-control timepickerAfternoon" name="event_starttime_pm_in" value="01:00 PM" />
								</div>
			                </div>
			            </div>
					</div>
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
							<label class="control-label">&nbsp;</label>
			                <div class="form-group">
			                	<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
									<input placeholder="End Time" type="text" class="form-control timepickerAfternoon" name="event_endtime_pm_in" value="02:00 PM" />
								</div>
			                </div>
			            </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
			                <div class="form-group">
			                	<label class="control-label">Attendance Time Out</label>
			                	<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
									<input placeholder="Start Time" type="text" class="form-control timepickerAfternoon" name="event_starttime_pm_out" value="03:00 PM" />
								</div>
			                </div>
			            </div>
					</div>
					<div class="col-md-6">
						<div class="bootstrap-timepicker">
							<label class="control-label">&nbsp;</label>
			                <div class="form-group">
			                	<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
									<input placeholder="End Time" type="text" class="form-control timepickerAfternoon" name="event_endtime_pm_out" value="04:00 PM" />
								</div>
			                </div>
			            </div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer text-right">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button class="btn btn-success">Submit</button>
		</div>
		</form>
	</div>
</div>