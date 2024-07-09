</div>
<script src="<?php echo URL; ?>public/assets/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo URL; ?>public/assets/adminlte/plugins/jQueryUI/jquery-ui.min.js"></script>
<?php 
if (isset($this->jslibrary)) 
{
	echo "\n";
	foreach ($this->jslibrary as $js)
	{
		echo "\t<script type='text/javascript' src='".URL."public/assets/".$js.".js'></script>\n";
	}
}
?>
<?php 
if (isset($this->customlibrary)) 
{
	echo "\n";
	foreach ($this->customlibrary as $js)
	{
		echo "\t<script type='text/javascript' src='".URL."views/".$js.".js'></script>\n";
	}
}
?>
<script type="text/javascript">
window.onload = function() { window.print(); setInterval(function() { window.close(); }, 300); }
</script>
</body>
</html>