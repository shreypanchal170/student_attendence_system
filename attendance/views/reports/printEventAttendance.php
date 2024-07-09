<?php
$model = new Model();

$currentTime = time();
$startDate = strtotime($this->eventInfo['event_start_date'] . " 00:00:00");
$endDate = strtotime($this->eventInfo['event_end_date'] . " 00:00:00");
$countDays = 1;

if($startDate != $endDate):
	$countDays = $endDate - $startDate;
	$countDays = ($countDays / (60 * 60 * 24)) + 1;
endif;

$eventStartTimeAM = strtotime($this->eventInfo['event_starttime_am']);
$eventEndTimeAM = strtotime($this->eventInfo['event_endtime_am']);

$eventStartTimePM = strtotime($this->eventInfo['event_starttime_pm']);
$eventEndTimePM = strtotime($this->eventInfo['event_endtime_pm']);
?>
<table style="width: 100%; margin-bottom: 20px;">
	<tbody>
		<tr>
			<td class="text-right" style="width: 25%"><img style="width: 100px" src="<?php echo URL; ?>public/chmsclogo.png" /></td>
			<td style="width: 50%">
				<h2 class="text-center text-bold">Carlos Hilado Memorial State College</h2>
				<h3 class="text-center text-bold">Office of the Supreme Student Government</h3>
				<h3 class="text-center text-bold">AY: <?php echo $model->currentSchoolYear(); ?></h3>
				<h3 class="text-center text-bold"><?php echo $this->courseInfo['course_name']; ?> <?php echo $this->yearSection; ?></h3>
			</td>
			<td style="width: 25%"><img style="width: 100px" src="<?php echo URL; ?>public/logo.png" /></td>
		</tr>
	</tbody>
</table>
<table class="table table-responsive table-bordered no-margin">
	<tbody>
		<tr>
			<td style="width: 50%"><strong>Name of Event:</strong> <?php echo $this->eventInfo['event_name']; ?> <?php echo ($countDays == 1) ? "" : "(".$countDays . " Days)"; ?></td>
			<?php if($countDays == 1): ?>
			<td style="width: 25%"><strong>Date:</strong> <?php echo date("F d, Y", $startDate); ?></td>
			<?php else: ?>
			<td style="width: 25%"><strong>Date:</strong> <?php echo date("F d, Y", $startDate); ?> to <?php echo date("F d, Y", $endDate); ?></td>
			<?php endif; ?>
			<td style="width: 25%"><strong>Schedule: </strong> <?php echo ($this->eventInfo['status'] != "wholeday") ? "Half-day (".ucfirst($this->eventInfo['status']).")" : ucfirst($this->eventInfo['status']); ?></td>
		</tr>
	</tbody>
</table>
<?php if($this->students != null): ?>
<table class="table table-striped table-responsive table-bordered no-margin">
	<thead>
		<?php
		if($countDays == 1):
			$currentDateEventTimeAM = strtotime($this->eventInfo['event_start_date'] . " " . $this->eventInfo['event_endtime_am']);
			$currentDateEventTimePM = strtotime($this->eventInfo['event_start_date'] . " " . $this->eventInfo['event_endtime_pm']);
		?>
		<tr>
			<th rowspan="<?php echo ($this->eventInfo['status'] == "wholeday") ? 4 : 2; ?>" style="vertical-align: middle;">Name</th>
			<?php if(($this->eventInfo['status'] == "wholeday") && ($currentTime > $currentDateEventTimeAM)): ?>
			<th class="text-center" colspan="2">AM</th>
			<?php endif; ?>
			<?php if(($this->eventInfo['status'] == "wholeday") && ($currentTime > $currentDateEventTimePM)): ?>
			<th class="text-center" colspan="2">PM</th>
			<?php endif; ?>
			<?php if(($this->eventInfo['status'] == "morning") && ($currentTime > $currentDateEventTimeAM)): ?>
			<th class="text-center">In</th>
			<th class="text-center">Out</th>
			<?php endif; ?>
			<?php if(($this->eventInfo['status'] == "afternoon") && ($currentTime > $currentDateEventTimePM)): ?>
			<th class="text-center">In</th>
			<th class="text-center">Out</th>
			<?php endif; ?>
			<?php if((($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "morning") && ($currentTime > $currentDateEventTimeAM)) || (($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "afternoon") && ($currentTime > $currentDateEventTimePM))): ?>
			<td class="text-center text-bold" rowspan="<?php echo ($this->eventInfo['status'] == "wholeday") ? 2 : 1; ?>" style="vertical-align: middle;">Total Absences</td>
			<?php else: ?>
			<td class="text-center"></td>
			<?php endif; ?>
		</tr>
		<tr>
			<?php if(($this->eventInfo['status'] == "wholeday") && ($currentTime > $eventEndTimeAM)): ?>
			<th class="text-center">In</th>
			<th class="text-center">Out</th>
			<?php endif; ?>
			<?php if(($this->eventInfo['status'] == "wholeday") && ($currentTime > $eventEndTimePM)): ?>
			<th class="text-center">In</th>
			<th class="text-center">Out</th>
			<?php endif; ?>
		</tr>
		<?php else: ?>
		<tr>
			<th rowspan="3" style="vertical-align: middle;;">Name</th>
			<?php
			for($i = 1; $i <= $countDays; $i++):
			$currentDateEventTime = strtotime($this->eventInfo['event_start_date']);
			
			if($i > 1):
				$currentDateEventTime = $currentDateEventTime + ((60 * 60 * 24) * ($i - 1));
			endif;

			$currentDateEventTimeAM = strtotime($currentDateEventTime . " " . $this->eventInfo['event_endtime_am']);
			$currentDateEventTimePM = strtotime($currentDateEventTime . " " . $this->eventInfo['event_endtime_pm']);

			$currentDateEventTime = strtotime(date('Y-m-d', $currentDateEventTime));

			if($currentDateEventTime <= time()):
			?>
			<th class="text-center" colspan="<?php echo ($this->eventInfo['status'] == "wholeday") ? 4 : 2; ?>">Day <?php echo $i; ?> (<?php echo date('F d, Y', $currentDateEventTime); ?>)</th>	
			<?php
			endif;
			endfor;
			?>
			<?php if((($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "morning") && ($currentTime > $currentDateEventTimeAM)) || (($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "afternoon") && ($currentTime > $currentDateEventTimePM))): ?>
			<td class="text-center text-bold" rowspan="<?php echo ($this->eventInfo['status'] == "wholeday") ? 3 : 2; ?>" style="vertical-align: middle;">Total Absences</td>
			<?php else: ?>
			<td class="text-center"></td>
			<?php endif; ?>
		</tr>
		<?php if($this->eventInfo['status'] == "wholeday"): ?>
		<tr>
			<?php
			for($i = 1; $i <= $countDays; $i++):
			$currentDateEventTime = strtotime($this->eventInfo['event_start_date']);
			
			if($i > 1):
				$currentDateEventTime = $currentDateEventTime + ((60 * 60 * 24) * ($i - 1));
			endif;

			$currentDateEventTimeAM = strtotime($currentDateEventTime . " " . $this->eventInfo['event_endtime_am']);
			$currentDateEventTimePM = strtotime($currentDateEventTime . " " . $this->eventInfo['event_endtime_pm']);

			$currentDateEventTime = strtotime(date('Y-m-d', $currentDateEventTime));

			if($currentDateEventTime <= time()):
			?>
			<?php if(($this->eventInfo['status'] == "wholeday") && ($currentTime > $currentDateEventTimeAM)): ?>
			<th class="text-center" colspan="2">AM</th>
			<?php endif; ?>
			<?php if(($this->eventInfo['status'] == "wholeday") && ($currentTime > $currentDateEventTimePM)): ?>
			<th class="text-center" colspan="2">PM</th>
			<?php endif; ?>
			<?php
			endif;
			endfor;
			?>
		</tr>
		<?php endif; ?>
		<tr>
			<?php
			for($i = 1; $i <= $countDays; $i++):
			$currentDateEventTime = strtotime($this->eventInfo['event_start_date']);
			
			if($i > 1):
				$currentDateEventTime = $currentDateEventTime + ((60 * 60 * 24) * ($i - 1));
			endif;

			$currentDateEventTimeAM = strtotime($currentDateEventTime . " " . $this->eventInfo['event_endtime_am']);
			$currentDateEventTimePM = strtotime($currentDateEventTime . " " . $this->eventInfo['event_endtime_pm']);

			$currentDateEventTime = strtotime(date('Y-m-d', $currentDateEventTime));

			if($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "morning")
			{
				$currentDateEventTime += strtotime($eventEndTimeAM);
			}

			if($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "afternoon")
			{
				$currentDateEventTime += strtotime($eventEndTimePM);
			}
			
			if($currentDateEventTime <= time()):
			?>
			<?php if(($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "morning") && ($currentTime > $currentDateEventTimeAM)): ?>
			<th class="text-center">In</th>
			<th class="text-center">Out</th>
			<?php endif; ?>
			<?php if(($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "afternoon") && ($currentTime > $currentDateEventTimePM)): ?>
			<th class="text-center">In</th>
			<th class="text-center">Out</th>
			<?php endif; ?>
			<?php
			endif;
			endfor;
			?>
		</tr>
		<?php endif; ?>
	</thead>
	<tbody>
	<?php
	if($countDays == 1):	

		$currentDateEventTime = strtotime($this->eventInfo['event_start_date']);

		$currentDateEventTime = strtotime(date('Y-m-d', $currentDateEventTime));

		$currentDateEventTimeAM = strtotime($this->eventInfo['event_start_date'] . " " . $this->eventInfo['event_endtime_am']);
		$currentDateEventTimePM = strtotime($this->eventInfo['event_start_date'] . " " . $this->eventInfo['event_endtime_pm']);

		foreach($this->students as $student):
			$totalAbsences = ($this->eventInfo['status'] == "wholeday") ? (($currentTime > $currentDateEventTimePM) ? 4 : 2) : 2;
			$morningIn = 0;
			$morningOut = 0;
			$afternoonIn = 0;
			$afternoonOut = 0;

			foreach($this->attendances as $attendance):
				if($attendance['eventid'] == $this->eventInfo['eventid'] && $attendance['studentid'] == $student['studentid']):
					if($attendance['status'] == "in" && $attendance['time_status'] == "morning"):
						$morningIn = 1;
						$totalAbsences--;
					endif;
					if($attendance['status'] == "out" && $attendance['time_status'] == "morning"):
						$morningOut = 1;
						$totalAbsences--;
					endif;
					if($attendance['status'] == "in" && $attendance['time_status'] == "afternoon"):
						$afternoonIn = 1;
						$totalAbsences--;
					endif;
					if($attendance['status'] == "out" && $attendance['time_status'] == "afternoon"):
						$afternoonOut = 1;
						$totalAbsences--;
					endif;
				endif;
			endforeach;
		?>
			<tr>
				<td><?php echo ucwords($student['lastname']); ?>, <?php echo ucwords($student['firstname']); ?><?php echo ($student['middlename'] != "") ? " " . strtoupper(substr($student['middlename'], 0, 1)) . ". " : " "; ?></td>
				<?php
				if(($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "morning") && ($currentTime > $currentDateEventTimeAM)):
					echo ($morningIn == 0) ? '<td class="text-center"><span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span></td>';
				endif;
				?>
				<?php
				if(($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "morning") && ($currentTime > $currentDateEventTimeAM)):
					echo ($morningOut == 0) ? '<td class="text-center"><span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span></td>';
				endif;
				?>
				<?php
				if(($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "afternoon") && ($currentTime > $currentDateEventTimePM)):
					echo ($afternoonIn == 0) ? '<td class="text-center"><span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span></td>';
				endif;
				?>
				<?php
				if(($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "afternoon") && ($currentTime > $currentDateEventTimePM)):
					echo ($afternoonOut == 0) ? '<td class="text-center"><span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span></td>';
				endif;
				?>
				<?php if((($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "morning") && ($currentTime > $currentDateEventTimeAM)) || (($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "afternoon") && ($currentTime > $currentDateEventTimePM))): ?>
				<td class="text-center"><?php echo $totalAbsences; ?></td>
				<?php else: ?>
				<td class="text-center">------</td>
				<?php endif; ?>
			</tr>
		<?php
		endforeach;
	else:
		foreach($this->students as $student):
	?>
		<tr>
			<td><?php echo ucwords($student['lastname']); ?>, <?php echo ucwords($student['firstname']); ?><?php echo ($student['middlename'] != "") ? " " . strtoupper(substr($student['middlename'], 0, 1)) . ". " : " "; ?></td>
	<?php
		$totalAbsences = 0;

		for($i = 1; $i <= $countDays; $i++):

			$currentEventDateTime = strtotime($this->eventInfo['event_start_date']);
			
			
			if($i > 1):
				$currentEventDateTime = $currentEventDateTime + ((60 * 60 * 24) * ($i - 1));
			endif;

			$currentEventDate = date("Y-m-d", $currentEventDateTime);

			$currentDateEventTimeAM = strtotime($currentEventDate . " " . $this->eventInfo['event_endtime_am']);
			$currentDateEventTimePM = strtotime($currentEventDate . " " . $this->eventInfo['event_endtime_pm']);

			if(($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "morning") && ($currentTime > $currentDateEventTimeAM))
			{
				$totalAbsences += 2;
			}

			if(($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "afternoon") && ($currentTime > $currentDateEventTimePM))
			{
				$totalAbsences += 2;
			}

			if($currentEventDateTime <= time()):

			$morningIn = 0;
			$morningOut = 0;
			$afternoonIn = 0;
			$afternoonOut = 0;

			foreach($this->attendances as $attendance):
				$attendanceDate = date("Y-m-d", strtotime($attendance['dateadded']));
				if($attendance['eventid'] == $this->eventInfo['eventid'] && $attendanceDate == $currentEventDate && $attendance['studentid'] == $student['studentid']):
					if($attendance['status'] == "in" && $attendance['time_status'] == "morning"):
						$morningIn = 1;
						$totalAbsences--;
					endif;
					if($attendance['status'] == "out" && $attendance['time_status'] == "morning"):
						$morningOut = 1;
						$totalAbsences--;
					endif;
					if($attendance['status'] == "in" && $attendance['time_status'] == "afternoon"):
						$afternoonIn = 1;
						$totalAbsences--;
					endif;
					if($attendance['status'] == "out" && $attendance['time_status'] == "afternoon"):
						$afternoonOut = 1;
						$totalAbsences--;
					endif;
				endif;
			endforeach;

			if(($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "morning") && ($currentTime > $currentDateEventTimeAM)):
				echo ($morningIn == 0) ? '<td class="text-center"><span class="text-red"><i class="fa fa-times"></i></span></td>' : '<td class="text-center"><span class="text-green"><i class="fa fa-check"></i></span></td>';
				echo ($morningOut == 0) ? '<td class="text-center"><span class="text-red"><i class="fa fa-times"></i></span></td>' : '<td class="text-center"><span class="text-green"><i class="fa fa-check"></i></span></td>';
			else:
				echo "<td></td><td></td>";
			endif;

			if(($this->eventInfo['status'] == "wholeday" || $this->eventInfo['status'] == "afternoon") && ($currentTime > $currentDateEventTimePM)):
				echo ($afternoonIn == 0) ? '<td class="text-center"><span class="text-red"><i class="fa fa-times"></i></span></td>' : '<td class="text-center"><span class="text-green"><i class="fa fa-check"></i></span></td>';
				echo ($afternoonOut == 0) ? '<td class="text-center"><span class="text-red"><i class="fa fa-times"></i></span></td>' : '<td class="text-center"><span class="text-green"><i class="fa fa-check"></i></span></td>';
			else:
				echo "<td></td><td></td>";
			endif;

			endif;
		endfor;
	?>
			<td class="text-center"><?php echo $totalAbsences; ?></td>
		</tr>
	<?php
		endforeach;	
	endif;
	?>
	</tbody>
</table>
<table style="width: 100%; margin-top: 40px;">
	<tbody>
		<tr>
			<td class="text-bold">Assignatory:</td>
			<td class="text-bold text-right">Prepared by: <?php echo Session::get('firstname'); ?> <?php echo Session::get('lastname'); ?></td>
		</tr>
	</tbody>
</table>
<?php else: ?>
<p>No Students</p>
<?php endif; ?>