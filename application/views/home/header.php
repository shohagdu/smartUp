<!---this is header content Start-->
<!DOCTYPE html>
<!--Head Start-->
<html lang="en" lang="bn">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<base href="<?php echo base_url();?>"></base>
    <meta http-equiv="X-UA-Compatible" content="IE=11" />


	<link rel="shortcut icon" href="pori/favicon.ico" type="image/x-icon" />
	<title><?php echo $all_data->full_name;?></title>
<!-- all css file---->	
    <link href="<?php echo base_url(); ?>all/assets/css/leapis_font.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>all/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>all/assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>all/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- all script file -->
	<script src="<?php echo base_url(); ?>all/assets/js/bootstrap.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">-->
	<script src="<?php echo base_url(); ?>all/assets/js/jquery-1.10.2.js"></script>
<!--    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>-->
	<script src="<?php echo base_url(); ?>all/assets/js/bootstrap-hover-dropdown.js"></script>
	<script src="<?php echo base_url(); ?>all/assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>all/assets/js/jquery.min.js"></script>

    <!-- jquery -->


	
<!--- form validation js and css---->
	<!---<link rel="stylesheet" href="validation/css/bootstrap.css"/>-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>validation/css/formValidation.css"/>

    <!---<script type="text/javascript" src="validation/js/jquery.min.js"></script>---->
    <!---<script type="text/javascript" src="validation/js/bootstrap.min.js"></script>-->

    <script type="text/javascript" src="<?php echo base_url(); ?>validation/js/formValidation.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>validation/js/js/bootstrap.js"></script>
	
	<!--- for datepicker ----------->
	<link href="<?php echo base_url(); ?>datepicker/jquery-ui.css" rel="stylesheet" media="screen,projection" type="text/css" />
	<script src="<?php echo base_url(); ?>datepicker/jquery-ui.js"></script>
	<!--<script src="datepicker/jquery-1.9.1.js"></script>--> 
	
	<!-- for bootstrap datepicker ------->
	<link href="<?php echo base_url(); ?>datepicker/bootstrap3/css/datepicker.min.css" rel="stylesheet" media="screen,projection" type="text/css" />
	<link href="<?php echo base_url(); ?>datepicker/bootstrap3/css/datepicker3.min.css" rel="stylesheet" media="screen,projection" type="text/css" />
	<script src="<?php echo base_url(); ?>datepicker/bootstrap3/js/bootstrap-datepicker.min.js"></script>

	<script>
		$(function() {
			var pickerOpts = {
					dateFormat: $.datepicker.ATOM
				};	
				$("#dofb").datepicker(pickerOpts);
		});
	</script>
<!-- end all script -->

    <!-- Owl Carousel Assets -->
    <link href="<?php echo base_url(); ?>owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>owl-carousel/owl.theme.css" rel="stylesheet">
	
	<!--- picture uplaod js ---->
	<script src="<?php echo base_url(); ?>library/upload/ajaxupload.js" type="text/javascript"></script>
	
	<!--- ajax request function for data serching----->
	<script src="<?php echo base_url(); ?>library/ajax_req.js" type="text/javascript"></script>
</head>
	
	<style>
		body{color:font-family:solaimanlipi, "Times New Roman", Times, serif !important; color:black !important;}
	</style>
<body onload="onload_hide_fun();">
<div class="main">
	<!-- Main Start-->
		<div class="menu"> <!-- Menu Start-->
			<div class="navbar navbar-default navbar-static-top" role="navigation">
				<div class="container" style="background-color:#003A6A;width:100%;">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					
					<div class="navbar-collapse collapse" id="menubar">
						<ul class="nav navbar-nav nav" >
							<li><a href="show"><i class="fa fa-home fa-lg" style="font-size:15px;vertical-align: 0px;"> &nbsp;প্রথম পাতা</i> &nbsp; </a></li>
					
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">আবেদন পত্র &nbsp;
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="home/nagorikapplication">নাগরিক আবেদন</a></li>
									<li class="divider"></li>
									<li><a href="home/tradelicenseapplication">ট্রেড লাইসেন্স আবেদন</a></li>
									<li class="divider"></li>
									<li><a href="home/oarishapplication">ওয়ারিশ সনদের আবেদন</a></li>
									<li class="divider"></li>
									<li><a href="home/otherService">অন্যান্য সনদের আবেদন ফরম  </a></li>
									<li class="divider"></li>
								</ul>
							</li>
						
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">অন্যান্য সেবাসমূহ &nbsp;
									<b class="caret"></b>
								</a>
								
								<ul class="dropdown-menu">
								<?php 
									$qy = $this->db->select("id,listName")->from("otherservicelist")->where("status",1)->order_by("id","asc")->get();
									
									$service12 = $qy->result();
									foreach($service12 as $serviceShow):
								?>
									<li><a href="home/otherService?service=<?php echo $serviceShow->id;?>"><?php echo $serviceShow->listName;?></a></li>
									<li class="divider"></li>
								<?php 
									endforeach;
								?>	
								</ul>
							</li>
							<!---
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">অন্যান্য সেবাসমূহ &nbsp;
									<b class="caret"></b>
								</a>
								
								<ul class="dropdown-menu">
								
									<li><a href="home/otherService?service=1">মৃত্যু সনদ</a></li>
									<li class="divider"></li>
									<li><a href="home/otherService?service=2">চারিত্রিক সনদ</a></li>
									<li class="divider"></li>
									<li><a href="home/otherService?service=3">অবিবাহিত সনদ</a></li>
									<li class="divider"></li>
									<li><a href="home/otherService?service=4">ভূমিহীন সনদ</a></li>
									<li class="divider"></li>
									<li><a href="home/otherService?service=5">পুনঃ বিবাহ না হওয়া সনদ</a></li>
									<li class="divider"></li>
									<li><a href="home/otherService?service=6">বার্ষিক আয়ের প্রত্যয়ন</a></li>
									<li class="divider"></li>
									<li><a href="home/otherService?service=7">একই নামের প্রত্যয়ন</a></li>
									<li class="divider"></li>
									<li><a href="home/otherService?service=8">প্রকৃত বাকঁ ও শ্রবন প্রতিবন্ধী</a></li>
									<li class="divider"></li>
									<li><a href="home/otherService?service=9">সনাতন ধর্ম  অবলম্বী</a></li>
									<li class="divider"></li>
									<li><a href="home/otherService?service=10">অনুমতি পত্র</a></li>
									<li class="divider"></li>
									<li><a href="home/otherService?service=11">প্রত্যয়ন পত্র</a></li>
									<li class="divider"></li>
								</ul>
							</li>-->
							
							<li class="dropdown ">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">আবেদন যাচাই করুন &nbsp;
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="home/filternagorikapplication">নাগরিক আবেদন যাচাই</a></li>
									<li class="divider"></li>
									<li><a href="home/filtertradeapplication">ট্রেড লাইসেন্স আবেদন যাচাই</a></li>
									<li class="divider"></li>
									<li><a href="home/filteroarishapplication">ওয়ারিশ সনদের আবেদন  যাচাই</a></li>
									<li class="divider"></li>
									<li><a href="home/filterOtherServiceApplication">অন্যান্য সেবাসমূহর আবেদন  যাচাই</a></li>
									<li class="divider"></li>
								</ul>
							</li>
							
							<li class="dropdown ">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">সনদপত্র যাচাই করুন &nbsp;
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="home/filternagorikcertificate">নাগরিক  সনদপত্র  যাচাই </a></li>
									<li class="divider"></li>
									<li><a href="home/filtertradecertificate">ট্রেড লাইসেন্স সনদপত্র  যাচাই </a></li>
									<li class="divider"></li>
									<li><a href="home/filteroarishcertificate">ওয়ারিশ সনদপত্র যাচাই </a></li>
									<li class="divider"></li>
									<li><a href="home/filterOtherServiceCertificate">অন্যান্য সেবাসমূহর সনদপত্র যাচাই </a></li>
									<li class="divider"></li>
									<li><a href="home/jacaiMamlaNotice">মামলার নোটিশ যাচাই</a></li>
									<li class="divider"></li>
									<li><a href="home/verify_holding_tax">হোল্ডিং ট্যাক্স যাচাই</a></li>
									<li class="divider"></li>
								</ul>
							</li>
							
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">ইউনিয়ন পরিষদ &nbsp;
								<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="home/voterList">ভোটার তালিকা</a></li>
									<li class="divider"></li>
									<li><a href="home/fighters">মুক্তিযোদ্ধা তালিকা</a></li>
									<li class="divider"></li>
									<li><a href="home/poorman">দুস্থদের তালিকা </a></li>
									<li class="divider"></li>
									<li><a href="home/widow">বিধবাদের তালিকা </a></li>
									<li class="divider"></li>
									<li><a href="home/foreignMan">প্রবাসীদের তালিকা </a></li>
									<li class="divider"></li>
									<li><a href="home/oldmanStipend">বয়স্কভাতা</a></li>
									<li class="divider"></li>
									<li><a href="home/motherVata">মাতৃত্বকালীন ভাতা </a></li>
									<li class="divider"></li>
									<li><a href="home/autistic">প্রতিবন্ধী ভাতা</a></li>
									<li class="divider"></li>
									<li><a href="home/autisticStudent">প্রতিবন্ধী ছাত্র/ছাত্রী</a></li>
									<li class="divider"></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			function isNumber(evt){
				evt = (evt) ? evt : window.event;
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode > 31 && (charCode < 48 || charCode > 57)) {
					return false;
				}
				return true;
			}
		</script>

	<!--this is header content End -->	
	