<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($this->session->userdata['user_id'])) {
	header("location: " . base_url());
}

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>EvalCourse (Sakai release) <?php echo "location: " . base_url(); ?></title>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>

	<link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css" rel="stylesheet"/>

	
	<script type="text/javascript" src="<?php echo base_url("assets/js/vis.min.js"); ?>"></script>
	<link rel="stylesheet" href="<?php echo base_url("assets/css/vis.css"); ?>" />
</head>
<body>
<div class="container">