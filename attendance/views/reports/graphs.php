<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label">Select School Year:</label>
			<select id="selectSchoolYear" name="schoolyear" required class="form-control">
				<option<?php echo ($this->selectedSchoolYear == $this->currentSY) ? " selected": ""; ?> value="<?php echo $this->currentSY; ?>"><?php echo $this->currentSY; ?></option>
				<?php foreach($this->schoolYears as $year): ?>
				<option<?php echo ($this->selectedSchoolYear == $year['schoolyear']) ? " selected": ""; ?> value="<?php echo $year['schoolyear']; ?>"><?php echo $year['schoolyear']; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="box box-solid box-success">
			<div class="box-header">
				<h4 class="box-title">Statistics of Students Status by Course (Present)</h4>
			</div>
			<div class="box-body">
				<canvas id="pieChart1" style="height:250px"></canvas>
				<div class="box box-solid box-success no-margin">
					<div class="box-header">
						<h4 class="box-title">Legend</h4>
					</div>
					<div class="box-body">
						<ul class="list-group no-margin">
							<?php
							foreach($this->piegraph['presentData'] as $graph):
							?>
							<li class="list-group-item text-bold"><i style="display: inline-block; width: 16px; height: 16px; background: <?php echo $graph['color']; ?>;"></i> <?php echo $graph['label']; ?> (<?php echo $graph['value']; ?>)</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-solid box-danger">
			<div class="box-header">
				<h4 class="box-title">Statistics of Students Status by Course (Absent)</h4>
			</div>
			<div class="box-body">
				<canvas id="pieChart2" style="height:250px"></canvas>
				<div class="box box-solid box-danger no-margin">
					<div class="box-header">
						<h4 class="box-title">Legend</h4>
					</div>
					<div class="box-body">
						<ul class="list-group no-margin">
							<?php
							foreach($this->piegraph['absentData'] as $graph):
							?>
							<li class="list-group-item text-bold"><i style="display: inline-block; width: 16px; height: 16px; background: <?php echo $graph['color']; ?>;"></i> <?php echo $graph['label']; ?> (<?php echo $graph['value']; ?>)</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-solid box-primary">
			<div class="box-header">
				<h4 class="box-title">Bar Graph for Number of Presents On Every Event by Year Level</h4>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-9">
						<canvas id="barChart" style="height:230px"></canvas>
					</div>
					<div class="col-md-3">
						<div class="box box-solid box-primary no-margin">
							<div class="box-header">
								<h4 class="box-title">Legend</h4>
							</div>
							<div class="box-body">
								<ul class="list-group no-margin">
									<?php
									foreach($this->bargraph['datasets'] as $graph):
									$totalData = 0;
									foreach($graph['data'] as $data):
										$totalData += $data;
									endforeach;
									?>
									<li class="list-group-item text-bold"><i style="display: inline-block; width: 16px; height: 16px; background: <?php echo $graph['fillColor']; ?>;"></i> <?php echo $graph['label']; ?> (<?php echo $totalData; ?>)</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
window.PieDataPresent = <?php echo json_encode($this->piegraph['presentData']); ?>;
window.PieDataAbsent = <?php echo json_encode($this->piegraph['absentData']); ?>;
window.barChartData = <?php echo json_encode($this->bargraph); ?>;
</script>