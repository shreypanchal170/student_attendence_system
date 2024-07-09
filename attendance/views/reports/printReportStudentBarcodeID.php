<style>
@page
{
	margin: 0px;
}
</style>
<?php if(count($this->students) > 0): ?>
<?php foreach($this->students as $student): ?>
	<div style="float:left; margin: 20px; padding: 5px; width: 158px; border: 1px solid #000; border-radius: 5px; height: 233px;">
		<p style="padding: 5px; background-color: #193588 !important; font-size: 8px; font-weight: bold; text-align: center; color: #fff !important;">ID CARD</p>
		<p style="text-align: center">
			<img style='height: 80px' src="<?php echo URL . "public/"; ?><?php echo ($student['image'] != "") ? "uploads/student/" . $student['image'] : "no-image.gif"; ?>" />
		</p>
		<p style="margin-bottom: 10px; font-size: 8px; height: 20px; word-wrap: break-word; width: 100%; text-align: center; background-color: #c0c0c0 !important; padding: 5px; font-weight: bold; text-transform: uppercase;"><?php echo ucwords($student['lastname']); ?>, <?php echo ucwords($student['firstname']); ?><?php echo ucwords(($student['middlename'] != "") ? " " . substr($student['middlename'], 0, 1) . ". " : " "); ?></p>
		<p style="text-align: center; font-weight: bold; text-transform: uppercase; font-size: 8px;"><?php echo $student['course_name']; ?> <?php echo $student['year']; ?><?php echo $student['section']; ?></p>
		<p style="text-align: center;">
		<?php
		$barcode = new Code128();
		$barcode->setData($student['barcode']);
		$barcode->setDimensions(140, 25);
		$barcode->draw();
		echo "<img src='data:image/jpg;base64,".$barcode->base64()."'/>";
		?>
		</p>
		<p style="text-align: center; margin-bottom: 0px; font-size: 8px;">Student ID: <?php echo $student['barcode']; ?></p>
	</div>
<?php endforeach; ?>
<?php endif; ?>