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
	<link rel="stylesheet" href="<?php echo URL . "public" ?>/assets/general.css">
	<style>
		@media print
		{
			@page {	
				size: <?php echo $this->orientation; ?>;
			}
			
			html
			{
				zoom: <?php echo $this->printZoom; ?>%;
			}

			input
			{
				border: none;
				padding: 0 5px;
				border-bottom: 1px solid #000;
			}

			textarea
			{
				border: none;
				resize: none;
			}
		}
		table { page-break-inside:auto !important; }
	    tr    { page-break-inside:auto !important; page-break-after:auto !important; }
	    table tr td { page-break-inside:auto !important; page-break-after:auto !important; }
	    table tr td table { page-break-inside:auto !important; page-break-after:auto !important; }
	    table tr td table tr { page-break-inside:auto !important; page-break-after:auto !important; }
	    table tr td table tr td { page-break-inside:auto !important; page-break-after:auto !important; }
	    table tr td table tr td table { page-break-inside:auto !important; page-break-after:auto !important; }
	    input { text-align: center; }
	</style>
</head>
<body>
<div class="wrapper">