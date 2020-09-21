<style type="text/css"> 
.count-voterList{
	margin-bottom: 20px;
}
.count-voterList h4{
	font-size: 18px;
	font-family: SolaimanLipi;
}
.count-voterList span{
	color: green;
	font-weight: bolder;
	font-size: 20px;
	background: lightgray;
	border-radius: 10px;
	padding: 5px;
}
</style>


 
 
 
 
<!-- some information query -->
<!--<link rel="stylesheet" href="datatables/css/bootstrap.min.css" />-->
<link rel="stylesheet" href="datatables/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="datatables/css/responsive.bootstrap.min.css" />
<!--<script type="text/javascript" src="datatables/js/jquery-1.11.3.min.js"></script>--->
<script type="text/javascript" src="datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="datatables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="datatables/js/dataTables.responsive.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function() {
	$('#example').DataTable();
} );


</script>

<div class="main_con"><!--Content Start-->
	<div class="row"><!--- row start--->
		<div class="col-md-9 left_con"><!-- left Content Start-->
			<div class="row">
				<div class="col-md-12"> 
					<div class="panel panel-primary">
						<div class="panel-heading" style="font-weight: bold; font-size: 20px;background:#004884;text-align:center;">বিস্তারিত</div>
						<div class="panel-body"  style="min-height:580px;">
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12"> 
									<div class="count-voterList"> 
										<h3 style="color:#0404B4;font-size: 20px;"><p style="text-decoration: underline;display:inline;color: #B02929;font-size: 25px;">শিরোনামঃ</p> <?php echo $news->title; ?></h3>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">  
									<h3 style="color:#B02929;text-decoration: underline;font-size: 25px;">বিস্তারিতঃ<h3>
									<div style="padding:4px;width:100%;">
										<?php echo $news->descrip; ?>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div><!-- row end--->
		</div><!-- left Content End-->