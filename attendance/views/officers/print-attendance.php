<p class="text-center"><img style="width: 150px" src="<?php echo URL; ?>public/logo.png" /></p>
<h4 class="text-bold text-center">SSG Officer Profile</h4>
<h5 class="text-bold">Name: <?php echo ucwords($this->officerInfo['firstname']); ?><?php echo ($this->officerInfo['middlename'] != "") ? " " . strtoupper(substr($this->officerInfo['middlename'], 0, 1)) . ". " : " "; ?><?php echo ucwords($this->officerInfo['lastname']); ?></h5>
<h5>Position: <?php echo ucwords($this->officerInfo['position']); ?></h5>
<table class="table table-striped table-bordered no-margin">
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