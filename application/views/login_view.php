<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>EvalCourse (Sakai release)</title>		
		

		<!-- All the files that are required -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		
		<script type="text/javascript" src="<?php echo base_url("assets/js/login-form.js"); ?>"></script>
		<link rel="stylesheet" href="<?php echo base_url("assets/css/login-form.css"); ?>" />		
		
</head>
<body>	
	<div class="container">
		<!-- Where all the magic happens -->
		<!-- LOGIN FORM -->
		<div class="text-center" style="padding:50px 0">
			<div class="logo">login</div>
			<!-- Main Form -->
			<div class="login-form-1">
				<form id="login-form" class="text-left" method="post" action="<?php echo base_url(); ?>index.php/access/check">
					<div class="login-form-main-message">
					</div>
					<div class="main-login-form">
						<div class="login-group">
							<div class="form-group">
								<label for="lg_username" class="sr-only">Username</label>
								<input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="username">
							</div>
							<div class="form-group">
								<label for="lg_password" class="sr-only">Password</label>
								<input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
							</div>
							<div class="form-group login-group-checkbox">
								<input type="checkbox" id="lg_remember" name="lg_remember">
								<label for="lg_remember">remember</label>
							</div>
						</div>
						<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
					</div>
				</form>
			</div>
			
			<?php
				if (isset($msg))
					echo "<p style=\"color:red; font-weight: bold;\">$msg</p>";
			?>
			<!-- end:Main Form -->
		</div>
	</div> <!-- end:container -->
</body>