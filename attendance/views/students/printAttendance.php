<?php
$currentTime = time();
$totalPresent = 0;
$totalAbsent = 0;
?>
<p class="text-center"><img style="width: 150px" src="<?php echo URL; ?>public/logo.png" /></p>
<h3 class="text-bold text-center">SSG Student Attendance Profile</h3>
<h4 class="text-bold">Name: <?php echo ucwords($this->studentInfo['lastname']); ?>, <?php echo ucwords($this->studentInfo['firstname']); ?><?php echo ($this->studentInfo['middlename'] != "") ? " " . strtoupper(substr($this->studentInfo['middlename'], 0, 1)) . ". " : " "; ?></h4>
<table class="table table-striped table-responsive no-margin">
	<thead>
		<tr>
			<th>Event</th>
			<th colspan="4" class="text-center">Status</th>
			<th class="text-center">Total No. of Present</th>
			<th class="text-center">Total No. of Absent</th>
		</tr>
		<tr>
			<th></th>
			<th class="text-center">AM In</th>
			<th class="text-center">AM Out</th>
			<th class="text-center">PM In</th>
			<th class="text-center">PM Out</th>
			<th class="text-center"></th>
			<th class="text-center"></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($this->events as $event):
		$startDate = strtotime($event['event_start_date'] . " 00:00:00");
		$endDate = strtotime($event['event_end_date'] . " 00:00:00");
		$countDays = 1;

		if($startDate != $endDate):
			$countDays = $endDate - $startDate;
			$countDays = ($countDays / (60 * 60 * 24)) + 1;
		endif;

		if($countDays == 1):

			$currentDateEventTimeAM = strtotime($event['event_start_date'] . " " . $event['event_endtime_am']);
			$currentDateEventTimePM = strtotime($event['event_start_date'] . " " . $event ['event_endtime_pm']);

			$currentTotalPresent = 0;
			$currentTotalAbsent = 0;

			if($currentTime > $currentDateEventTimeAM && $event['status'] == "wholeday")
			{
				$currentTotalAbsent += 2;
			}

			if($currentTime > $currentDateEventTimePM && $event['status'] == "wholeday")
			{
				$currentTotalAbsent += 2;
			}

			if($currentTime > $currentDateEventTimeAM && $event['status'] == "morning")
			{
				$currentTotalAbsent = 2;
			}

			if($currentTime > $currentDateEventTimePM && $event['status'] == "afternoon")
			{
				$currentTotalAbsent = 2;
			}

			$morningIn = 0;
			$morningOut = 0;
			$afternoonIn = 0;
			$afternoonOut = 0;

			foreach($this->attendances as $attendance):
				if($attendance['eventid'] == $event['eventid']):
					if($attendance['status'] == "in" && $attendance['time_status'] == "morning"):
						$morningIn = 1;
						$currentTotalPresent++;
						$currentTotalAbsent--;
					endif;
					if($attendance['status'] == "out" && $attendance['time_status'] == "morning"):
						$morningOut = 1;
						$currentTotalPresent++;
						$currentTotalAbsent--;
					endif;
					if($attendance['status'] == "in" && $attendance['time_status'] == "afternoon"):
						$afternoonIn = 1;
						$currentTotalPresent++;
						$currentTotalAbsent--;
					endif;
					if($attendance['status'] == "out" && $attendance['time_status'] == "afternoon"):
						$afternoonOut = 1;
						$currentTotalPresent++;
						$currentTotalAbsent--;
					endif;
				endif;
			endforeach;
	?>
		<tr>
			<td><?php echo $event['event_name']; ?></td>
			<td class="text-center">
			<?php
			if($currentTime > $currentDateEventTimeAM && $event['status'] == "wholeday"):
				echo ($morningIn == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
			else:
				if($currentTime > $currentDateEventTimeAM && $event['status'] == "morning"):
					echo ($morningIn == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
				else:
					echo "-----";
				endif;
			endif;
			?>
			</td>
			<td class="text-center">
			<?php
			if($currentTime > $currentDateEventTimeAM && $event['status'] == "wholeday"):
				echo ($morningOut == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
			else:
				if($currentTime > $currentDateEventTimeAM && $event['status'] == "morning"):
					echo ($morningOut == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
				else:
					echo "-----";
				endif;
			endif;
			?>
			</td>
			<td class="text-center">
			<?php
			if($currentTime > $currentDateEventTimePM && $event['status'] == "wholeday"):
				echo ($afternoonIn == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
			else:
				if($currentTime > $currentDateEventTimePM && $event['status'] == "afternoon"):
					echo ($afternoonIn == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
				else:
					echo "-----";
				endif;
			endif;
			?>
			</td>
			<td class="text-center">
			<?php
			if($currentTime > $currentDateEventTimePM && $event['status'] == "wholeday"):
				echo ($afternoonOut == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
			else:
				if($currentTime > $currentDateEventTimePM && $event['status'] == "afternoon"):
					echo ($afternoonOut == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
				else:
					echo "-----";
				endif;
			endif;

			$totalPresent += $currentTotalPresent;
			$totalAbsent += $currentTotalAbsent;
			?>	
			</td>
			<td class="text-center"><?php echo $currentTotalPresent; ?></td>
			<td class="text-center"><?php echo $currentTotalAbsent; ?></td>
		</tr>
	<?php
		else:
			for($i = 1; $i <= $countDays; $i++):
			$currentTotalPresent = 0;
			$currentTotalAbsent = 0;

			$currentEventDateTime = strtotime($event['event_start_date']);

			if($i > 1):
				$currentEventDateTime = $currentEventDateTime + ((60 * 60 * 24) * ($i - 1));
			endif;

			$currentEventDate = date("Y-m-d", $currentEventDateTime);

			$currentDateEventTimeAM = strtotime($currentEventDate . " " . $event['event_endtime_am']);
			$currentDateEventTimePM = strtotime($currentEventDate . " " . $event ['event_endtime_pm']);

			if($currentTime > $currentDateEventTimeAM && $event['status'] == "wholeday")
			{
				$currentTotalAbsent += 2;
			}

			if($currentTime > $currentDateEventTimePM && $event['status'] == "wholeday")
			{
				$currentTotalAbsent += 2;
			}

			if($currentTime > $currentDateEventTimeAM && $event['status'] == "morning")
			{
				$currentTotalAbsent = 2;
			}

			if($currentTime > $currentDateEventTimePM && $event['status'] == "afternoon")
			{
				$currentTotalAbsent = 2;
			}

			$totalEventAttendanceCount = 0;
			$eventAttendanceCount = 0;

			$morningIn = 0;
			$morningOut = 0;
			$afternoonIn = 0;
			$afternoonOut = 0;
			
			foreach($this->attendances as $attendance):
				$attendanceDate = date("Y-m-d", strtotime($attendance['dateadded']));

				if($attendance['eventid'] == $event['eventid'] && $attendanceDate == $currentEventDate):
					if($attendance['status'] == "in" && $attendance['time_status'] == "morning"):
						$morningIn = 1;
						$currentTotalPresent++;
						$currentTotalAbsent--;
					endif;
					if($attendance['status'] == "out" && $attendance['time_status'] == "morning"):
						$morningOut = 1;
						$currentTotalPresent++;
						$currentTotalAbsent--;
					endif;
					if($attendance['status'] == "in" && $attendance['time_status'] == "afternoon"):
						$afternoonIn = 1;
						$currentTotalPresent++;
						$currentTotalAbsent--;
					endif;
					if($attendance['status'] == "out" && $attendance['time_status'] == "afternoon"):
						$afternoonOut = 1;
						$currentTotalPresent++;
						$currentTotalAbsent--;
					endif;
				endif;
			endforeach;
	?>
		<tr>
			<td><?php echo $event['event_name']; ?> Day <?php echo $i; ?></td>
			<td class="text-center">
			<?php
			if($currentTime > $currentDateEventTimeAM && $event['status'] == "wholeday"):
				echo ($morningIn == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
			else:
				if($currentTime > $currentDateEventTimeAM && $event['status'] == "morning"):
					echo ($morningIn == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
				else:
					echo "-----";
				endif;
			endif;
			?>
			</td>
			<td class="text-center">
			<?php
			if($currentTime > $currentDateEventTimeAM && $event['status'] == "wholeday"):
				echo ($morningOut == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
			else:
				if($currentTime > $currentDateEventTimeAM && $event['status'] == "morning"):
					echo ($morningOut == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
				else:
					echo "-----";
				endif;
			endif;
			?>
			</td>
			<td class="text-center">
			<?php
			if($currentTime > $currentDateEventTimePM && $event['status'] == "wholeday"):
				echo ($afternoonIn == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
			else:
				if($currentTime > $currentDateEventTimePM && $event['status'] == "afternoon"):
					echo ($afternoonIn == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
				else:
					echo "-----";
				endif;
			endif;
			?>
			</td>
			<td class="text-center">
			<?php
			if($currentTime > $currentDateEventTimePM && $event['status'] == "wholeday"):
				echo ($afternoonOut == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
			else:
				if($currentTime > $currentDateEventTimePM && $event['status'] == "afternoon"):
					echo ($afternoonOut == 0) ? '<span class="text-red"><i class="fa fa-times"></i></span>' : '<span class="text-green"><i class="fa fa-check"></i></span>';
				else:
					echo "-----";
				endif;
			endif;

			$totalPresent += $currentTotalPresent;
			$totalAbsent += $currentTotalAbsent;
			?>	
			</td>
			<td class="text-center"><?php echo $currentTotalPresent; ?></td>
			<td class="text-center"><?php echo $currentTotalAbsent; ?></td>
		</tr>
	<?php
			endfor;
		endif;
	endforeach;
	?>
	</tbody>
	<?php
	$sanctionsLists = array();
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
	?>
	<tfoot>
		<tr>
			<th colspan="5"></th>
			<th colspan="2">Remarks/Sanction</th>
		</tr>
		<tr>
			<th colspan="5"></th>
			<th colspan="2"><?php echo ucwords(implode(", ", $sanctionsLists)); ?></th>
		</tr>
	</tfoot>
</table>