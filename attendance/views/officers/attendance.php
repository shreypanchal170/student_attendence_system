<div class="row">
	<div class="col-md-12">
		<p class="text-right">
			<a class="btn btn-success" target="_blank" href="<?php echo URL; ?>officers/printEvents/<?php echo $this->officerInfo['userid']; ?>"><i class="fa fa-print"></i> Print</a>
		</p>
		<div class="box box-solid box-success">
			<div class="box-header">
				<h4 class="box-title">Name: <?php echo ucwords($this->officerInfo['firstname']); ?><?php echo ($this->officerInfo['middlename'] != "") ? " " . strtoupper(substr($this->officerInfo['middlename'], 0, 1)) . ". " : " "; ?><?php echo ucwords($this->officerInfo['lastname']); ?></h4>
				<span class="pull-right">Position: <?php echo ucwords($this->officerInfo['position']); ?></span>
			</div>
			<div class="box-body">
				<table class="table table-striped table-responsive no-margin">
					<thead>
						<tr>
							<th>Event</th>
							<th>Date</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($this->events as $event): ?>
						<tr>
							<td><?php echo $event['event_name']; ?></td>
							<td>
								<?php
								$time = time();
								if($event['status'] == "wholeday"):
									$time = strtotime($event['event_end_date'] . " " . $event['event_endtime_pm']);
									echo date("M d, Y h:i A", strtotime($event['event_start_date'] . " " . $event['event_starttime_am'])); ?> to <?php echo date("M d, Y h:i A", $time);
								else:
									if($event['status'] == "morning"):
										$time = strtotime($event['event_end_date'] . " " . $event['event_endtime_am']);
										echo date("M d, Y h:i A", strtotime($event['event_start_date'] . " " . $event['event_starttime_am'])); ?> to <?php echo date("M d, Y h:i A", $time);
									else:
										$time = strtotime($event['event_end_date'] . " " . $event['event_endtime_pm']);
										echo date("M d, Y h:i A", strtotime($event['event_start_date'] . " " . $event['event_starttime_pm'])); ?> to <?php echo date("M d, Y h:i A", $time);
									endif;
								endif;
								?>									
							</td>
							<td><?php echo ($time <= time()) ? "Done" : "On Going"; ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>