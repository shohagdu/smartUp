<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<style type="text/css"> 
		h1{
			font-size: 25px;
			color: red;
			text-align:center;
		}
	</style>
</head>
<body>
	<h1> checking page redirect </h1>
	<?php 
		//$status = array("logged_status" => TRUE);
		//$this->session->set_userdata($status);
		echo '<pre>';
		print_r($r);
	?>
	<a href="Admin">dashboard</a>
</body>
</html>