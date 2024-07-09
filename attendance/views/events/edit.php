<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Edit Event</h4>
		</div>
		<form id="frmUpdateEvent" method="post" action="<?php echo URL; ?>events/update/<?php echo $this->event['eventid']; ?>">
		<div class="modal-body">
			<div class="form-group">
					<label class="control-label">Name</label>
					<input type="text" class="form-control" name="event_name" value="<?php echo $this->event['event_name']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Place</label>
					<input type="text" class="form-control" name="event_place" value="<?php echo $this->event['event_place']; ?>" />
				</div>
				<div class="form-group">
					<label class="control-label">Status</label>
					<select name="status" class="form-control" id="eventStatusEdit">
						<option<?php echo ($this->event['status'] == "wholeday") ? " selected" : ""; ?> value="wholeday">Wholeday</option>
						<option<?php echo ($this->event['status'] == "morning") ? " selected" : ""; ?> value="morning">Half-day Morning</option>
						<option<?php echo ($this->event['status'] == "afternoon") ? " selected" : ""; ?> value="afternoon">Half-day Afternoon</option>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Event Date</label>
					<input type="text" id="eventDateEdit" class="form-control" name="event_date" value="<?php echo $this->event['event_start_date']; ?> - <?php echo $this->event['event_end_date']; ?>" />
				</div>
				<div class="form-group timeArea<?php echo ($this->event['status'] == "afternoon") ? " hidden" : ""; ?>" id="editTimemorning">
					<label class="control-label">Morning Schedule</label>
					<div class="row">
						<div class="col-md-6">
							<div class="bootstrap-timepicker">
				                <div class="form-group">
				                	<label class="control-label">Start Time</label>
				                	<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
										<input placeholder="Start Time" type="text" class="form-control timepickerMorning" name="event_starttime_am" value="<?php echo ($this->event['status'] == "wholeday" || $this->event['status'] == "morning") ? date("h:i A",strtotime($this->event['event_starttime_am'])) : "07:00 AM"; ?>" />
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
										<input placeholder="End Time" type="text" class="form-control timepickerMorning" name="event_endtime_am" value="<?php echo ($this->event['status'] == "wholeday" || $this->event['status'] == "morning") ? date("h:i A",strtotime($this->event['event_endtime_am'])) : "08:00 AM"; ?>" />
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
										<input placeholder="Start Time" type="text" class="form-control timepickerMorning" name="event_starttime_am_in" value="<?php echo ($this->event['status'] == "wholeday" || $this->event['status'] == "morning") ? date("h:i A",strtotime($this->event['event_starttime_am_in'])) : "07:00 AM"; ?>" />
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
										<input placeholder="End Time" type="text" class="form-control timepickerMorning" name="event_endtime_am_in" value="<?php echo ($this->event['status'] == "wholeday" || $this->event['status'] == "morning") ? date("h:i A",strtotime($this->event['event_endtime_am_in'])) : "08:00 AM"; ?>" />
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
										<input placeholder="Start Time" type="text" class="form-control timepickerMorning" name="event_starttime_am_out" value="<?php echo ($this->event['status'] == "wholeday" || $this->event['status'] == "morning") ? date("h:i A",strtotime($this->event['event_starttime_am_out'])) : "10:00 AM"; ?>" />
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
										<input placeholder="End Time" type="text" class="form-control timepickerMorning" name="event_endtime_am_out" value="<?php echo ($this->event['status'] == "wholeday" || $this->event['status'] == "morning") ? date("h:i A",strtotime($this->event['event_endtime_am_out'])) : "11:00 AM"; ?>" />
									</div>
				                </div>
				            </div>
						</div>
					</div>
				</div>
				<div class="form-group timeArea<?php echo ($this->event['status'] == "morning") ? " hidden" : ""; ?>" id="editTimeafternoon">
					<label class="control-label">Afternoon Schedule</label>
					<div class="row">
						<div class="col-md-6">
							<div class="bootstrap-timepicker">
				                <div class="form-group">
				                	<label class="control-label">Start Time</label>
				                	<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
										<input placeholder="Start Time" type="text" class="form-control timepickerAfternoon" name="event_starttime_pm" value="<?php echo ($this->event['status'] == "wholeday" || $this->event['status'] == "afternoon") ? date("h:i A",strtotime($this->event['event_starttime_pm'])) : "01:00 PM"; ?>" />
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
										<input placeholder="End Time" type="text" class="form-control timepickerAfternoon" name="event_endtime_pm" value="<?php echo ($this->event['status'] == "wholeday" || $this->event['status'] == "afternoon") ? date("h:i A",strtotime($this->event['event_endtime_pm'])) : "02:00 PM"; ?>" />
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
										<input placeholder="Start Time" type="text" class="form-control timepickerAfternoon" name="event_starttime_pm_in" value="<?php echo ($this->event['status'] == "wholeday" || $this->event['status'] == "afternoon") ? date("h:i A",strtotime($this->event['event_starttime_pm_in'])) : "03:00 PM"; ?>" />
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
										<input placeholder="End Time" type="text" class="form-control timepickerAfternoon" name="event_endtime_pm_in" value="<?php echo ($this->event['status'] == "wholeday" || $this->event['status'] == "afternoon") ? date("h:i A",strtotime($this->event['event_endtime_pm_in'])) : "04:00 PM"; ?>" />
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
										<input placeholder="Start Time" type="text" class="form-control timepickerAfternoon" name="event_starttime_pm_out" value="<?php echo ($this->event['status'] == "wholeday" || $this->event['status'] == "afternoon") ? date("h:i A",strtotime($this->event['event_starttime_pm_out'])) : "03:00 PM"; ?>" />
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
										<input placeholder="End Time" type="text" class="form-control timepickerAfternoon" name="event_endtime_pm_out" value="<?php echo ($this->event['status'] == "wholeday" || $this->event['status'] == "afternoon") ? date("h:i A",strtotime($this->event['event_endtime_pm_out'])) : "04:00 PM"; ?>" />
									</div>
				                </div>
				            </div>
						</div>
					</div>
				</div>
		</div>
		<div class="modal-footer text-right">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button class="btn btn-success">Update</button>
		</div>
		</form>
	</div>
</div>