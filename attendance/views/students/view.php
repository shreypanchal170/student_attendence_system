<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-body">
			<p class="text-center">
				<img style='height: 300px' src="<?php echo URL; ?>public/<?php echo ($this->student['image'] != "") ? "uploads/student/" . $this->student['image'] : "no-image.gif"; ?>" />
			</p>
			<h4 class="text-center"><?php echo ucwords($this->student['firstname']); ?><?php echo ucwords(($this->student['middlename'] != "") ? " " . $this->student['middlename'] . " " : " "); ?><?php echo ucwords($this->student['lastname']); ?></h4>
			<h5 class="text-center"><?php echo $this->student['course_name']; ?> <?php echo $this->student['year']; ?>-<?php echo $this->student['section']; ?></h5>
			<p class="text-center">
			<?php
				$barcode = new Code128();
				$barcode->setData($this->student['barcode']);
				$barcode->setDimensions(300, 75);
				$barcode->draw();
				echo "<img src='data:image/jpg;base64,".$barcode->base64()."'/>";
			?>
			</p>
			<p class="text-center">Student ID: <?php echo $this->student['barcode']; ?></p>
		</div>
		<div class="modal-footer text-right">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>