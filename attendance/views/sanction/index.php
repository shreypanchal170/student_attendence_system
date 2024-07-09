<div class="row">
	<div class="col-md-4">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h4 class="box-title">Add Sanction</h4>
			</div>
			<form id="frmAddSanction" method="post" action="<?php echo URL; ?>sanction/add">
			<div class="box-body">
				<div class="form-group">
					<label class="control-label">Item Name</label>
					<input type="text" class="form-control" name="item_name" />
				</div>
				<div class="form-group">
					<label class="control-label">No Of Absences</label>
					<input type="text" class="form-control" name="no_of_absences" />
				</div>
			</div>
			<div class="box-footer">
				<button class="btn btn-success pull-right">Submit</button>
			</div>
			</form>
		</div>
	</div>
	<div class="col-md-8">
		<div class="box box-solid">
			<div class="box-body">
				<table id="tblLists" class="table table-striped">
					<thead>
						<tr>
							<th>Item Name</th>
							<th>No of Absences</th>
							<th></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>