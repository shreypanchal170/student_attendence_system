<div class="row">
	<div class="col-md-12">
		<div class="box box-solid">
			<div class="box-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th></th>
							<th>Name</th>
							<th>Description</th>
							<th>Date and Time</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($this->logs as $log): ?>
						<tr>
							<td><?php echo $log['datelog']; ?></td>
							<td><?php echo $log['firstname'] . " " . $log['lastname']; ?></td>
							<td><?php echo $log['description']; ?></td>
							<td><?php echo date("F d, Y h:i A",strtotime($log['datelog'])); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>