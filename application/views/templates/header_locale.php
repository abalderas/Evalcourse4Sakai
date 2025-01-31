<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>EvalCourse (Sakai release)</title>
	
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.1.1.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/moment-with-locales.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/vis.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap-datetimepicker.js"); ?>"></script>
	<script type="text/javascript">
		jQuery.fn.extend({
			size: function() {
				return $(this).length;
			}
		});
	</script>
	
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/extra.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/vis.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-datetimepicker.css"); ?>" />
</head>
<body>
<div class="container">