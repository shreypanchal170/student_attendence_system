<p class="text-center"><img style="width: 150px" src="<?php echo URL; ?>public/logo.png" /></p>
<h3 class="text-bold text-center">Sanction Lists</h3>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Item Name</th>
			<th>No of Absences</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($this->sanctions as $sanction): ?>
		<tr>
			<td><?php echo $sanction['item_name']; ?></td>
			<td><?php echo $sanction['no_of_absences']; ?></td>
		</tr>
	</tbody>
	<?php endforeach; ?>
</table>