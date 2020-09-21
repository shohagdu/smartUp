<?php $check_registration = $this->app_license->registration(); if(!$check_registration) exit('No direct script access allowed');

$data_info = $this->app_license->get_regis_data();
$regis = $this->app_license->get_license_info( $data_info->app_id );

?>

<!DOCTYPE html>
<html>
<head>
	<title> Registration Complete </title>
	<base href="<?php echo base_url(); ?>" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<script type="text/javascript" scr="assets/js/bootstrap.js"></script>
	<script type="text/javascript" scr="assets/js/bootstrap.min.js"></script>


</head>
<body>
	<section>
		<div class="row">
			<div class="panel panel-success col-md-8" style="margin:30px 15%;">
				<div class="panel-heading">Registration Complete</div>
				<div class="panel-body">
					<pre>
						<p style="white-space:normal;">
							Application Code : <?php echo $data_info->app_id; ?><br/>
							Application Name :<?php echo $data_info->app_name ?><br/>
							Username : <?php echo $data_info->user_name ?><br/>
							Address : <?php echo $data_info->address ?><br/>
							Key : <?php echo $regis->license_key ?>
						</p>
					</pre>
					<a href="<?php echo base_url(); ?>">
						<button class="btn btn-info">Go Home</button>
					</a>
				</div>
			</div>
		</div>
	</section>
</body>
</html>