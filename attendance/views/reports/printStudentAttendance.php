<table style="width: 100%; margin-bottom: 20px;">
	<tbody>
		<tr>
			<td style="width: 200px"><img style="width: 200px" src="<?php echo URL; ?>public/chmsclogo.png" /></td>
			<td>
				<h2 class="text-center text-bold">Carlos Hilado Memorial State College</h2>
				<h3 class="text-center text-bold">Office of the Supreme Student Government</h3>
				<h3 class="text-center text-bold"><?php echo $this->courseInfo['course_name']; ?> <?php echo $this->yearSection; ?></h3>
			</td>
			<td style="width: 200px"><img style="width: 200px" src="<?php echo URL; ?>public/logo.png" /></td>
		</tr>
	</tbody>
</table>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Total No. of Events</th>
			<th>Total No. of Days</th>
			<th>Total No. of Present</th>
			<th>Total No. of Absent</th>
			<th>Sanctions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($this->students as $student):
		$totalPresent = 0;
		$totalAbsent = 0;
		$totalDays = 0;
		foreach($this->events as $event):
			$totalEventAttendanceCount = 0;
			$eventAttendanceCount = 0;
			foreach($this->attendances as $attendance):
				if($event['eventid'] == $attendance['eventid'] && $student['studentid'] == $attendance['studentid']):
					$eventAttendanceCount++;
				endif;
			endforeach;

			$countDays = 1;

			$startDate = strtotime($event['event_start_date'] . " 00:00:00");
			$endDate = strtotime($event['event_end_date']. " 00:00:00");

			if($startDate != $endDate):
				$countDays = $endDate - $startDate;
				$countDays = ($countDays / (60 * 60 * 24)) + 1;
			endif;

			$totalDays += $countDays;
			
			$totalEventAttendanceCount = ($event['status'] == "wholeday") ? ($countDays * 4): ($countDays * 2);

			$totalPresent += $eventAttendanceCount;
			$totalAbsent += ($totalEventAttendanceCount - $eventAttendanceCount);
		endforeach;

		$sanctionsLists = array();

		if($totalAbsent > 0):
			$totalSanctionCount = 0;
			foreach($this->sanctions as $sanction):
				if($sanction['no_of_absences'] < $totalAbsent):
					$totalSanctionCount += $sanction['no_of_absences'];
					$sanctionsLists[] = $sanction['item_name'];
				endif;
				
				if($sanction['no_of_absences'] == $totalAbsent):
					$sanctionsLists = array($sanction['item_name']);
					break;
				endif;

				if($totalSanctionCount >= $totalAbsent):
					break;
				endif;
			endforeach;
		endif;
	?>
		<tr>
			<td><?php echo ucwords($student['lastname']); ?>, <?php echo ucwords($student['firstname']); ?><?php echo ($student['middlename'] != "") ? " " . strtoupper(substr($student['middlename'], 0, 1)) . ". " : " "; ?></td>
			<td><?php echo count($this->events); ?></td>
			<td><?php echo $totalDays; ?></td>
			<td><?php echo $totalPresent; ?></td>
			<td><?php echo $totalAbsent; ?></td>
			<td><?php echo ($totalAbsent > 0) ? ucwords(implode(", ", $sanctionsLists)) : "None"; ?></td>
		</tr>
	<?php endforeach; ?>
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