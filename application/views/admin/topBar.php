<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Union Parishad Application Datacenter Banladesh">
    <meta name="author" content="Datacenter Banladesh">
	<base href="<?php echo base_url();?>" />
    <!-- The styles -->
	<link href="css/bootstrap-cerulean.min.css" id="bs-css" rel="stylesheet">
	<!----<link rel="stylesheet" href="datatables/css/bootstrap.min.css" />-->
    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
<!--    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>-->
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>
    <link rel="shortcut icon" href="img/favicon.ico">
	
	<!---- data tables ------------>
	
	<!--<link rel="stylesheet" href="datatables/css/bootstrap.min.css" />-->
	<link rel="stylesheet" href="datatables/css/dataTables.bootstrap.min.css" />
	<link rel="stylesheet" href="datatables/css/responsive.bootstrap.min.css" />
	<!--<script type="text/javascript" src="datatables/js/jquery-1.11.3.min.js"></script>--->
	<script type="text/javascript" src="datatables/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="datatables/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="datatables/js/dataTables.responsive.min.js"></script> 
	<!-- update by shohag----->
	<script type="text/javascript" src="js/callfunction.js"></script>
	<!-- update by shohag----->
	
	<!----- date picker css and js------------>
	
	<link rel="stylesheet" media="screen,projection" type="text/css" href="datepicker/jquery-ui.css" />
	<!--<script src="datepicker/jquery-1.9.1.js"></script>--> 
	<script src="datepicker/jquery-ui.js"></script>
	
	
	<!--- picture uplaod js ---->
	<script type="text/javascript" src="library/upload/ajaxupload.js"></script>
	<script type="text/javascript" src="assets/sweet_alert/sweetalert.min.js"></script>

	
	<!--- coustom css--------->
	<link rel="stylesheet" href="css/custom.css" class="css" />
	
	<!-- libary js link--------->
	<script type="text/javascript" src="library/loader.js"></script>
	
	<!--- ajax request function for data serching----->
	<script type="text/javascript" src="library/ajax_req.js"></script>
    <!--- Custom js----->
    <script type="text/javascript" src="library/customize.js"></script>

	<!-- for bootstrap Validate--------->
	<link rel="stylesheet" href="validation/css/formValidation.css"/>
	<script type="text/javascript" src="validation/js/formValidation.js"></script>
	<script type="text/javascript" src="validation/js/js/bootstrap.js"></script>
	
	
	
	<!-- for roshid tab left menu load--------->
	<script type="text/javascript"> 
		function tablclick(ar2){
			$('#'+ar2).trigger( "click" );			
			return false; //cancel navigation

		}
	</script>
	
	<!---This is for show active tap------start---->
	<script type="text/javascript">
		$(document).ready(function(){
			$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
				localStorage.setItem('activeTab', $(e.target).attr('href'));
			});
			var activeTab = localStorage.getItem('activeTab');
			if(activeTab){
				$('#myTab a[href="' + activeTab + '"]').tab('show');
				$('#myTab a[href="' + activeTab + '"]').trigger('click');
			}
		});
	</script>
	<!---This is for show active tap------end---->
</head>

<body onload="">
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="Admin"> <img alt="Datacenter" src="img/logo20.png" class="hidden-xs"/>
                <span style="font-style:normal;font-family:sans-serif;">Administration</span></a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo $this->session->userdata('username');?></span>
                    <span class="caret" style="border-top-color: #84154D"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="setup_section/adminProfile" <?php $this->chk->acl('adminProfile'); ?>>Profile</a></li>
                    <li class="divider"></li>
					<li><a href="index.php/setup_section/changePassword" <?php $this->chk->acl('changePassword'); ?>>Password Change</a></li>
                    <li class="divider"></li>
                    <li><a href="mms24?sessionend=<?php echo $this->session->userdata('sid')?>" id="logout">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <!-- theme selector starts
            <div class="btn-group pull-right theme-container animated tada">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-tint"></i><span
                        class="hidden-sm hidden-xs"> Change Theme / Skin</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="themes">
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
                    <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
                    <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
                    <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
                    <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
                    <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
                    <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>
                </ul>
            </div>
             theme selector ends -->
			
        </div>
    </div>
    <!-- topbar ends -->