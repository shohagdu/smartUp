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

<style>
  
  .dataTable > thead > tr > th[class*="sort"]:after{
   content: "" !important;
  }
  .wholeDiv a{
   outline:0;
  }
  .dataTables_filter{display:none;}
  .dataTables_length{}
  .dataTables_info{padding-left:15px;font-size:12px;}
  #example_paginate{padding-right:15px;font-size:12px;}
 </style>
 
 <script type="text/javascript"> 
  $(document).ready(function() {
   $('#example'). DataTable( {
    "lengthMenu": [[ 25, 50,100,200, -1], [ 25, 50,100,200, "All"]]
   }
   );
  } );
 
 </script>
 
 <script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=600,width=1000');
        mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>
 
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
						<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">ভোটারদের তালিকা</div>
						<div class="panel-body"  style="min-height:310px;">
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12"> 
									<div class="count-voterList"> 
										<h4>এই ওয়েব সাইটে  <span><?php echo $this->setup->count_voter();?></span> জন ভোটার এর তথ্য যোগ করা হয়েছে । আরো অনেকে থাকতে পারে পরর্বতীতে তাদের তথ্য প্রদান করা হবে।</h4>
										<!--<input type="button" value="Print" onclick="PrintElem('#mydiv')" />-->
										<p style="font-size: 16px;">তালিকাটি  প্রিন্ট করতে  চাইলে প্রিন্ট বাটনে ক্লিক করুন  
											<a href='Home/printVoterList' target='_blank' class="btn btn-primary btn-sm">Print</a>
										</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">  
									<div style="padding:4px;width:100%;">
									<div id="">
										<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="color: #000102;font-weight:bolder;">
										
											<thead>
												<tr>
													<th>ক্রমিক নং</th>
													<th>ন্যাশানাল আইডি</th>
													<th>নাম</th>
													<th>পিতার/ স্বামীর নাম</th>
													<th>ওয়ার্ড নং</th>
													<th>বয়স</th>
												</tr>
											</thead>
											
											<tbody>
												<?php
													$num=0;
													$current_year=date("Y");
													foreach($voterInfo as $value):
													$num++;
												?>
												<tr>
													<td><?php echo $num;?></td>
													<td><?php echo @$value->national_id;?></td>
													<td><?php echo @$value->bangla_name;?></td>
													<td><?php echo @$value->father_name;?></td>
													<td><?php echo @$value->word_no;?></td>
													<td>
														<?php
															$age=date("Y",strtotime($value->date_of_birth));
															echo $show_age=$current_year-$age;
														?>
													</td>
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
				</div>
			</div><!-- row end--->
		</div><!-- left Content End-->