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
						<div class="panel-heading" style="font-weight: bold; font-size: 20px;background:#004884;text-align:center;">সকল খবর</div>
						<div class="panel-body"  style="min-height:580px;">
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12"> 
									<div class="count-voterList"> 
										<h3>সকল খবর</h3>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">  
									<div style="padding:4px;width:100%;">
										<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="color: #000102;font-weight:bolder;">
										
											<thead>
												<tr>
													<th>ক্রমিক নং</th>
													<th>শিরোনাম</th>
													<th>বিস্তারিত</th>
												</tr>
											</thead>
											
											<tbody>
												<?php 
													$num=0;
													$current_year=date("Y");
													foreach($all_news as $value):
													$num++;
												?>
												<tr>
													<td><?php echo $num;?></td>
													<td>
														<?php
															if(strlen(@$value->title)>270){
																echo substr((@$value->title),0,270)."......";
															}
															else{
																echo substr((@$value->title),0,270);
															}
														?>
													</td>
													<td><a href="home/bistarito?id=<?php echo md5($value->id);?>">বিস্তারিত দেখুন</a></td>
												</tr>
												<?php 
													endforeach;
												?>
											</tbody>
										</table>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div><!-- row end--->
		</div><!-- left Content End-->