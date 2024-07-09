<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Edit Sanction</h4>
		</div>
		<form id="frmUpdateSanction" method="post" action="<?php echo URL; ?>sanction/update/<?php echo $this->sanction['sanction_id']; ?>">
		<div class="modal-body">
			<div class="form-group">
				<label class="control-label">Item Name</label>
				<input type="text" class="form-control" name="item_name" value="<?php echo $this->sanction['item_name']; ?>" />
			</div>
			<div class="form-group">
				<label class="control-label">No Of Absences</label>
				<input type="text" class="form-control" name="no_of_absences" value="<?php echo $this->sanction['no_of_absences']; ?>" />
			</div>
		</div>
		<div class="modal-footer text-right">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button class="btn btn-success">Update</button>
		</div>
		</form>
	</div>
</div>