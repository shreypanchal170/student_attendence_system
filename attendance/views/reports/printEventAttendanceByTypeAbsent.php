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
			<td class="text-right" style="width: 10%"><img style="width: 100px" src="<?php echo URL; ?>public/chmsclogo.png" /></td>
			<td style="width: 80%">
				<h2 class="text-center text-bold">Carlos Hilado Memorial State College</h2>
				<h3 class="text-center text-bold">Office of the Supreme Student Government</h3>
				<h3 class="text-center text-bold">AY: <?php echo $model->currentSchoolYear(); ?></h3>
			</td>
			<td style="width: 10%"><img style="width: 100px" src="<?php echo URL; ?>public/logo.png" /></td>
		</tr>
	</tbody>
</table>
<table class="table table-responsive table-bordered">
	<tbody>
		<tr>
			<td style="width: 50%"><strong>Name of Event:</strong> <?php echo $this->eventInfo['event_name']; ?> <?php echo ($countDays == 1) ? "" : "(".$countDays . " Days)"; ?></td>
			<?php if($countDays == 1): ?>
			<td style="width: 50%"><strong>Date:</strong> <?php echo date("F d, Y", $startDate); ?></td>
			<?php else: ?>
			<td style="width: 50%"><strong>Date:</strong> <?php echo date("F d, Y", $startDate); ?> to <?php echo date("F d, Y", $endDate); ?></td>
			<?php endif; ?>
		</tr>
	</tbody>
</table>
<h4 class="text-center"><?php echo $this->printTitle; ?> (<?php echo ($this->eventInfo['status'] == "wholeday") ? strtoupper($this->session) : (($this->eventInfo['status'] == "morning") ? "AM" : "PM") ; ?>)</h4>
<?php
if($countDays == 1):
?>
<table class="table table-striped table-responsive table-bordered no-margin">
<thead>
	<tr>
		<th style="vertical-align: middle">Name</th>
		<th style="vertical-align: middle">Course, Year and Section</th>
		<th class="text-center">In</th>
		<th class="text-center">Out</th>
	</tr>
</thead>
<tbody>
	<?php
		$currentDateEventTimeAM = strtotime($this->eventInfo['event_start_date'] . " " . $this->eventInfo['event_endtime_am']);
		$currentDateEventTimePM = strtotime($this->eventInfo['event_start_date'] . " " . $this->eventInfo['event_endtime_pm']);
		foreach($this->students as $student):
			$in = 0;
			$out = 0;

			foreach($this->attendances as $attendance):
				if($attendance['eventid'] == $this->eventInfo['eventid'] && $attendance['studentid'] == $student['studentid']):
					if($this->session == "am" || $this->eventInfo['status'] == "morning"):
						if($attendance['status'] == "in" && $attendance['time_status'] == "morning"):
							$in = 1;
						endif;
						if($attendance['status'] == "out" && $attendance['time_status'] == "morning"):
							$out = 1;
						endif;
					endif;
					if($this->session == "pm" || $this->eventInfo['status'] == "afternoon"):
						if($attendance['status'] == "in" && $attendance['time_status'] == "afternoon"):
							$in = 1;
						endif;
						if($attendance['status'] == "out" && $attendance['time_status'] == "afternoon"):
							$out = 1;
						endif;
					endif;
				endif;
			endforeach;
		?>
			<tr>
				<td><?php echo ucwords($student['lastname']); ?>, <?php echo ucwords($student['firstname']); ?><?php echo ($student['middlename'] != "") ? " " . strtoupper(substr($student['middlename'], 0, 1)) . ". " : " "; ?></td>
				<td><?php echo $student['course_name']; ?> <?php echo $student['year']; ?><?php echo $student['section']; ?></td>
				<?php if($this->session == "am"): ?>
				<?php if($currentTime > $currentDateEventTimeAM): ?>
				<td class="text-center"><?php echo ($in == 0) ? '<span class="text-red"><i class="fa fa-circle"></i></span>' : ''; ?></td>
				<td class="text-center"><?php echo ($out == 0) ? '<span class="text-red"><i class="fa fa-circle"></i></span>' : ''; ?></td>
				<?php else: ?>
				<td class="text-center"></td>
				<td class="text-center"></td>	
				<?php endif; ?>
				<?php endif; ?>
				<?php if($this->session == "pm"): ?>
				<?php if($currentTime > $currentDateEventTimePM): ?>
				<td class="text-center"><?php echo ($in == 0) ? '<span class="text-red"><i class="fa fa-circle"></i></span>' : ''; ?></td>
				<td class="text-center"><?php echo ($out == 0) ? '<span class="text-red"><i class="fa fa-circle"></i></span>' : ''; ?></td>
				<?php else: ?>
				<td class="text-center"></td>
				<td class="text-center"></td>	
				<?php endif; ?>
				<?php endif; ?>
			</tr>
		<?php
		endforeach;
?>
</tbody>
</table>
<?php
	else:
	for($i = 1; $i <= $countDays; $i++):
	$currentEventDateTime = strtotime($this->eventInfo['event_start_date']);
	if($i > 1):
		$currentEventDateTime = $currentEventDateTime + ((60 * 60 * 24) * ($i - 1));
	endif;
	$currentEventDate = date("Y-m-d", $currentEventDateTime);

	$currentDateEventTimeAM = strtotime($currentEventDate . " " . $this->eventInfo['event_endtime_am']);
	$currentDateEventTimePM = strtotime($currentEventDate . " " . $this->eventInfo['event_endtime_pm']);

	if($currentEventDateTime <= time()):	
?>
<h4>Day <?php echo $i; ?></h4>
<table class="table table-striped table-responsive table-bordered no-margin">
<thead>
	<tr>
		<th style="vertical-align: middle">Name</th>
		<th style="vertical-align: middle">Course, Year and Section</th>
		<th class="text-center">In</th>
		<th class="text-center">Out</th>
	</tr>
</thead>
<tbody>
<?php foreach($this->students as $student): ?>
	<?php
	$in = 0;
	$out = 0;

	foreach($this->attendances as $attendance):
		$attendanceDate = date("Y-m-d", strtotime($attendance['dateadded']));

		if($attendance['eventid'] == $this->eventInfo['eventid'] && $attendanceDate == $currentEventDate && $attendance['studentid'] == $student['studentid']):
			if($this->session == "am" || $this->eventInfo['status'] == "morning"):
				if($attendance['status'] == "in" && $attendance['time_status'] == "morning"):
					$in = 1;
				endif;
				if($attendance['status'] == "out" && $attendance['time_status'] == "morning"):
					$out = 1;
				endif;
			endif;
			if($this->session == "pm" || $this->eventInfo['status'] == "afternoon"):
				if($attendance['status'] == "in" && $attendance['time_status'] == "afternoon"):
					$in = 1;
				endif;
				if($attendance['status'] == "out" && $attendance['time_status'] == "afternoon"):
					$out = 1;
				endif;
			endif;
		endif;
	endforeach;
	?>
	<tr>
		<td><?php echo ucwords($student['lastname']); ?>, <?php echo ucwords($student['firstname']); ?><?php echo ($student['middlename'] != "") ? " " . strtoupper(substr($student['middlename'], 0, 1)) . ". " : " "; ?></td>
		<td><?php echo $student['course_name']; ?> <?php echo $student['year']; ?><?php echo $student['section']; ?></td>
		<?php if($this->session == "am"): ?>
		<?php if($currentTime > $currentDateEventTimeAM): ?>
		<td class="text-center"><?php echo ($in == 0) ? '<span class="text-red"><i class="fa fa-circle"></i></span>' : ''; ?></td>
		<td class="text-center"><?php echo ($out == 0) ? '<span class="text-red"><i class="fa fa-circle"></i></span>' : ''; ?></td>
		<?php else: ?>
		<td class="text-center"></td>
		<td class="text-center"></td>	
		<?php endif; ?>
		<?php endif; ?>
		<?php if($this->session == "pm"): ?>
		<?php if($currentTime > $currentDateEventTimePM): ?>
		<td class="text-center"><?php echo ($in == 0) ? '<span class="text-red"><i class="fa fa-circle"></i></span>' : ''; ?></td>
		<td class="text-center"><?php echo ($out == 0) ? '<span class="text-red"><i class="fa fa-circle"></i></span>' : ''; ?></td>
		<?php else: ?>
		<td class="text-center"></td>
		<td class="text-center"></td>	
		<?php endif; ?>
		<?php endif; ?>
	</tr>
<?php
	endforeach;
?>
	</tbody>
</table>
<?php	
	endif;
	endfor;
endif;
?>
<table style="width: 100%; margin-top: 40px;">
	<tbody>
		<tr>
			<td class="text-bold">Assignatory:</td>
			<td class="text-bold text-right">Prepared by: <?php echo Session::get('firstname'); ?> <?php echo Session::get('lastname'); ?></td>
		</tr>
	</tbody>
</table>