<div class="row">
	<div class="col-md-12">
		<div class="box box-solid">
			<?php if(count($this->events) > 0): ?>
			<div class="box-body">
				<div class="row">
					<div class="col-md-7">
						<div class="box box-solid box-info">
							<div class="box-header with-border">
								<h4 class="box-title">Event</h4>
								<p class="no-margin pull-right">Officer Name: <?php echo ucwords(Session::get('firstname') . " " . Session::get('lastname')); ?></p>
							</div>
							<div class="box-body">
								<form method="post" action="<?php echo URL; ?>attendance/scan">
									<div class="form-group">
										<label class="control-label">Event Name</label>
										<?php if(count($this->events) == 1): ?>
										<input type="hidden" name="eventid" value="<?php echo $this->events[0]['eventid']; ?>" />
										<input type="text" readonly class="form-control" value="<?php echo $this->events[0]['event_name']; ?>" />
										<?php else: ?>
										<select class="form-control" name="eventid">
											<?php foreach($this->events as $event): ?>
											<option value="<?php echo $event['eventid']; ?>"><?php echo $event['event_name']; ?></option>
											<?php endforeach; ?>
										</select>
										<?php endif; ?>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="barcode" id="txtBarcode" />
									</div>
								</form>
								<div id="previewArea"></div>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="box box-solid box-success">
							<div class="box-header with-border">
								<h4 class="box-title">Students that has Logged In</h4>
							</div>
							<div class="box-body" id="studentsListsEventAttendance">
								<p class="alert alert-info no-margin">There are no students yet</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="overlay hidden">
				<i class="fa fa-refresh fa-spin"></i>
			</div>
			<?php else: ?>
			<p class="alert alert-info">There are no events for assigned for you</p>
			<?php endif; ?>
		</div>
	</div>
</div>