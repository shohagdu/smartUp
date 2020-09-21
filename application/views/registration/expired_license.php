<?php
 	$check_registration = $this->app_license->registration();
 	$file_info = $this->app_license->file_info();
 	if((!$check_registration) && (!$file_info)):exit('No direct script access allowed');endif;

	$data_info = $this->app_license->get_regis_data();
?>

<?php
	$glue = $this->uri->segment(3);
	if( $glue == 'invalid' ):
		$msg = "Invalid License Key";
	endif;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Application License Expired</title>
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
				<div class="panel-heading">License Key</div>
				<div class="panel-body">
					<form action="registration/new_license_key" method="post" role="form">
						<div class="form-group">
							<label for="app_name">Application Name : </label>
							<span><?php echo $data_info->app_name ?></span>
						</div>
						<div class="form-group">
							<label for="app_name">Username : </label>
							<span><?php echo $data_info->user_name ?></span>
						</div>
						<div class="form-group">
							<label for="app_name">New License Key : </label>
							<input type="text" name="key" id="key" class="form-control" />
							<span class="error"><?php echo form_error("key"); if( isset($msg) ):echo $msg;endif; ?></span>
						</div>
						<div class="form-group">
							<button class="btn btn-success" name="validate" type="submit">Validate</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</body>
</html>