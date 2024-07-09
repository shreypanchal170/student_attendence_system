<?php
$startDate = strtotime($this->event['event_start_date'] . " 00:00:00");
$endDate = strtotime($this->event['event_end_date'] . " 00:00:00");
$countDays = 1;

if($startDate != $endDate):
	$countDays = $endDate - $startDate;
	$countDays = ($countDays / (60 * 60 * 24)) + 1;
endif;
?>
<div class="modal-dialog" style="width: 800px">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Edit Event Officers</h4>
		</div>
		<form id="frmAssignOfficer" method="post" action="<?php echo URL; ?>events/assignOfficer/<?php echo $this->event['eventid']; ?>">
		<div class="modal-body">
			<?php if(count($this->officers) > 0): ?>
				<ul class="list-group">
					<?php foreach($this->officers as $key => $officer): ?>
					<?php
					$status = "";
					$daysArr = array();

					foreach($this->eventOfficers as $eventOfficer)
					{
						if($eventOfficer['userid'] == $officer['userid'])
						{
							$status = $eventOfficer['status'];
							$daysArr = explode("||", $eventOfficer['days']);
							break;
						}
					}
					?>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-2">
								<img src="<?php echo URL . "public/"; ?><?php echo ($officer['image'] != "") ? "uploads/user/" . $officer['image'] : "no-image.gif"; ?>" class="img-responsive" />
							</div>
							<div class="col-sm-4">
								<h5 class="list-group-item-heading"><?php echo $officer['lastname']; ?>, <?php echo $officer['firstname']; ?><?php echo ($officer['middlename'] != "") ? " " . $officer['middlename'] : ""; ?></h5>
								<h5 class="list-group-item-heading"><?php echo $officer['position_description']; ?></h5>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input type="hidden" name="userid[]" value="<?php echo $officer['userid']; ?>" />
									<select class="form-control changeAssignedStatus" name="status[]">
										<option value="unassigned">Unassigned</option>
										<?php if($this->event['status'] == "wholeday"): ?>
										<option<?php echo ($status == "wholeday") ? " selected" : ""; ?> value="wholeday">Wholeday</option>
										<?php endif; ?>
										<?php if($this->event['status'] == "wholeday" || $this->event['status'] == "morning"): ?>
										<option<?php echo ($status == "morning") ? " selected" : ""; ?> value="morning">Half-day Morning</option>
										<?php endif; ?>
										<?php if($this->event['status'] == "wholeday" || $this->event['status'] == "afternoon"): ?>
										<option<?php echo ($status == "afternoon") ? " selected" : ""; ?> value="afternoon">Half-day Afternoon</option>
										<?php endif; ?>
									</select>
								</div>
								<?php if($countDays == 1): ?>
								<input type="hidden" name="officerDay<?php echo $officer['userid']; ?>[]" value="1" />
								<?php else: ?>
								<div class="form-group text-right no-margin assignDayArea<?php echo ($status == "") ? " hidden" : ""; ?>">
									<?php for($i = 1; $i <= $countDays; $i++): ?>
									<label>
					                	<input<?php echo (in_array($i, $daysArr)) ? " checked" : ""; ?> type="checkbox" name="officerDay<?php echo $officer['userid']; ?>[]" value="<?php echo $i; ?>" class="minimal"> Day <?php echo $i; ?>
					                </label>
									<?php endfor; ?>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			<?php else: ?>
				<p class="alert alert-info">There are no officers to assign on the said event</p>
			<?php endif; ?>
		</div>
		<div class="modal-footer text-right">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-success">Assign Officer(s)</button>
		</div>
		</form>
	</div>
</div>