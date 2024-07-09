<div class="row">
	<div class="col-md-12">
		<div class="box box-solid">
			<div class="box-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Filename</th>
							<th>School Year</th>
							<th>Date and Time</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($this->backups as $backup): ?>
						<tr>
							<td><?php echo $backup['filename']; ?></td>
							<td><?php echo $backup['schoolyear']; ?></td>
							<td><?php echo date("F d, Y h:i A",strtotime($backup['backup_date'])); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>