<div class="row">
	<div class="col-md-12">
		<p>
			<a href="<?php echo URL; ?>students/new" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
			<?php if(!$this->checkIfYearLevelIsUpdatedForCurrentSchoolYear): ?>
			<a href="<?php echo URL; ?>students/updateYearLevel" id="btnUpdateYearLevel" class="btn btn-success pull-right"><i class="fa fa-cog"></i> Update Students Year Level</a>
			<?php endif; ?>
		</p>  
		<div class="box box-solid">
			<div class="box-body">
				<table id="tblLists" class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Course Year & Section</th>
							<th></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>