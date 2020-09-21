<?php
	// some execution here...........
	$sk=$this->input->get('sk');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<base href="<?php echo base_url();?>">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="en" />
		<meta name="robots" content="noindex,nofollow" />
		<link rel="stylesheet" media="screen,projection" type="text/css" href="library/admin/css/reset.css" />
		<link rel="stylesheet" media="screen,projection" type="text/css" href="library/admin/css/login.css" />
		<link rel="shortcut icon" href="img/favicon.ico">
		<title>Login: Administrator</title>
		<script type="text/javascript">
			function disableSelection(e){if(typeof e.onselectstart!="undefined")e.onselectstart=function(){return false};else if(typeof e.style.MozUserSelect!="undefined")e.style.MozUserSelect="none";else e.onmousedown=function(){return false};e.style.cursor="default"}window.onload=function(){disableSelection(document.body)}
		</script>

		<script type="text/javascript">
			document.oncontextmenu=function(e){var t=e||window.event;var n=t.target||t.srcElement;if(n.nodeName!="A")return false};
			document.ondragstart=function(){return false};
		</script>

		<script type="text/javascript">
			window.addEventListener("keydown",function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==70||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){e.preventDefault()}});document.keypress=function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==70||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){}return false}
		</script>

		<script type="text/javascript">
			document.onkeydown=function(e){e=e||window.event;if(e.keyCode==123||e.keyCode==18){return false}}
		</script>
		<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<div id="wrapper">
			<div class="login">
				<h2>Administration</h2>
					<?php if ($sk=="empty") {?>
				<div class="notice warn">Enter a valid username &amp; password</div>
					<?php } else if($sk=='invalid') { ?>
				<div class="notice error">Invalid username or password</div>
					<?php } else if($sk=='logout') { ?>
				<div class="notice done">You have successfully loged out</div>
					<?php } else {?>
				<div class="notice info">Please enter username &amp; password</div>
					<?php } ?>
				<form action="mms24" method="post">
					<table>
						<tr><td>Username</td></tr>
						<tr><td><input type="text" name="username"></td></tr>
						<tr><td>Password</td></tr>
						<tr><td><input type="password" name="password"></td></tr>
						<tr><td><input type="submit" class="submit" value="Login" name='loginform'></td></tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>