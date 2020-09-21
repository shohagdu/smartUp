<?php 
	$db = $this->app_license->check_offline_database();
	if( $db ):
		$check_registration = $this->app_license->registration(); 
		$file_info = $this->app_license->file_info();
 		
 		if((!$check_registration) && (!$file_info)):exit('No direct script access allowed');endif;
 	endif; 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Application Registration</title>
	<base href="<?php echo base_url(); ?>" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<script type="text/javascript" scr="assets/js/bootstrap.js"></script>
	<script type="text/javascript" scr="assets/js/bootstrap.min.js"></script>

	<style type="text/css">
		.error{color:red;}
	</style>

</head>


<body>
	<section>
		<div class="row">
			<div class="panel panel-success col-md-8" style="margin:30px 15%;">
				<div class="panel-heading">Registration</div>
				<div class="panel-body">
					<form action="registration/registered" method="post">
						<!-- application name -->
						<div class="form-group">
							<label for="app_name">Application Name :</label>
							<input type="text" name="app_name" id="app_name" class="form-control" />
							<span class="error"><?php echo form_error("app_name"); ?></span>
						</div>
						<!-- user name -->
						<div class="form-group">
							<label for="username">Username :</label>
							<input type="text" name="username" id="username" class="form-control" />
							<span class="error"><?php echo form_error("username"); ?></span>
						</div>

						<!-- address -->
						<div class="form-group">
							<label for="address">Address :</label>
							<input type="text" name="address" id="address" class="form-control" />
							<span class="error"><?php echo form_error("address"); if(isset($msg)):echo $msg;endif;  ?></span>
						</div>

						<div>
							<button class="btn btn-primary" name="register">Register</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</section>
</body>
</html>