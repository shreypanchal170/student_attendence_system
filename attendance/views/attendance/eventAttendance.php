<?php if($this->attendance != null): ?>
<ul class="list-group no-margin">
<?php foreach($this->attendance as $attendance): ?>
	<?php $middlename = ($attendance['middlename'] != "") ? " " . strtoupper((substr($attendance['middlename'], 0, 1))) . ". " : " "; ?>
	<li class="list-group-item"><?php echo $attendance['firstname'] . $middlename . $attendance['lastname']; ?>: Logged <?php echo ucfirst($attendance['status']); ?> at <?php echo date("h:i A", strtotime($attendance['dateadded'])); ?></li>
<?php endforeach; ?>
</ul>
<?php else: ?>
<p class="alert alert-info no-margin">There are no students yet</p>
<?php endif; ?>