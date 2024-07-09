<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<link rel="icon" href="<?php echo URL . "public" ?>/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo URL . "public" ?>/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo URL . "public" ?>/favicon.ico">

	<title><?php echo ESTABLISHMENT; ?><?php echo isset($this->title) ? " - " . $this->title: ""; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo URL . "public" ?>/assets/adminlte/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo URL . "public" ?>/assets/font-awesome-4.7.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo URL . "public" ?>/assets/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo URL . "public" ?>/assets/adminlte//dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo URL . "public" ?>/assets/adminlte/dist/css/skins/_all-skins.min.css">
	<?php if(Session::get('loggedIn')): ?>
	<link rel="stylesheet" href="<?php echo URL . "public" ?>/assets/sweet-alert/sweetalert.css">
	<link rel="stylesheet" href="<?php echo URL . "public" ?>/assets/adminlte/plugins/iCheck/all.css">
	<?php endif; ?>
	<!-- Page specific css's -->
<?php 
if (isset($this->csslibrary)) 
{
	echo "\n";
	foreach ($this->csslibrary as $css)
	{
		echo "\t".'<link rel="stylesheet" href="'.URL.'public/assets/'.$css.'.css" type="text/css" />'."\n";
	}
}
?>
	<link rel="stylesheet" href="<?php echo URL . "public" ?>/assets/general.css">
	<script>window.siteurl='<?php echo URL; ?>';</script>
</head>
<body class="hold-transition sidebar-none sidebar-collapse"><?php echo "\n"; ?>
<div class="wrapper">