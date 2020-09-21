<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>
<script type="text/javascript">
	$("document").ready(function(){
	$('#validall').submit(function() {
		document.getElementById('submitId').disabled="disabled";
	$.post(
			"index.php/Setup_section/rateSheet_action",
			$("#validall").serialize(),
			function(data){
				//alert(data);
				if(data==1){
					$('#hidemessage').fadeIn('slow').delay(1000).fadeOut('slow');
					setTimeout(function(){					
						window.location="index.php/setup_section/rateSheet";
					},1000)
				}
				else if(data==55){ 
					$('#hidemessage1').fadeIn('slow').delay(1000).fadeOut('slow');
					setTimeout(function(){					
						window.location="index.php/setup_section/rateSheet";
					},1000)
				}
				else if(data==2){ 
					$('#hidemessage2').fadeIn('slow').delay(1000).fadeOut('slow');
					setTimeout(function(){					
						window.location="index.php/setup_section/rateSheet";
					},1000)
				}
				else{
					alert(data);
					document.getElementById('submitId').disabled=false;
				}
		});
	return false;
	});
	});
</script>
<script type="text/javascript"> 
	$("document").ready(function(){
		$("#licenseType").keyup(function(){
			var licenseType=$("#licenseType").val().trim();
			
			if(licenseType==''){
				document.getElementById('error1').innerHTML="";
				document.getElementById('error2').innerHTML="";
				document.getElementById('error3').innerHTML="দয়া করে লাইন্সেসের ধরন লিখুন";exit;
			}
			//alert(licenseType);
			$.ajax({
				url:"Setup_section/checkLicense?id=1",
				data:{licenseType:licenseType},
				type:"GET",
				success:function(hr){
					//alert(hr);exit;
					if(hr==10){
						document.getElementById('error1').innerHTML="Opps!! এই ধরনটি যোগ করা হয়েছে ";
						document.getElementById('error2').innerHTML="";
						document.getElementById('error3').innerHTML="";
						document.getElementsByName("submitform")[0].type = "button";
					}
					else{
						// return ture
						document.getElementById('error2').innerHTML="Thanks,Valid .";
						document.getElementById('error1').innerHTML="";
						document.getElementById('error3').innerHTML="";
						document.getElementsByName("submitform")[0].type = "submit";
					}
					
				}
			});
		});
	});
</script>
<script type="text/javascript"> 
function checkaccnumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
}
</script>

<div id="content" class="col-lg-10 col-sm-10">
	<div class="panel panel-default">
		<div class="panel-heading">নতুন ট্রেড লাইন্সেস রেট যোগ করুন</div>
		<div class="panel-body">
			<div class="col-lg-12 col-sm-12"> 
				<form action="index.php/Setup_section/rateSheet_action" method="post" id="validall" class="daily form-horizontal" role="form">
					<div class="form-group">
						<label class="control-label col-sm-2" for="Tradelicence Type">ট্রেড লাইন্সেসের ধরন</label>
						<div class="col-sm-5"> 
							<input type="text" required class="form-control" name="licenseType" id="licenseType" placeholder="Ex: ঔষধের দোকান "/>
						</div>
						<div class="col-sm-3"> 
							<span id="error1" style="color:red;font-size:12px;"></span>
							<span id="error2" style="color:green;font-size:12px;"></span>
							<span id="error3" style="color:red;font-size:12px;"></span>
						</div>
						<div class="clearfix" style="margin-top:50px;"></div>
						<label class="control-label col-sm-2" for="Amount"> টাকার পরিমাণ </label>
						<div class="col-sm-5"> 
							<input type="text" required class="form-control" name="amount" id="amount" placeholder="ইংরেজীতে টাকার পরিমান প্রদান করুন " onkeypress="return checkaccnumber(event);" />
						</div>
						
					</div>
					
					<div class="clearfix"></div>
					<div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-1" style="position: relative; margin-left: 160px;">
							<div class="col-sm-12">
								<input type="submit" name="submitform" id="submitId" value="যোগ করুন" class="btn btn-info "/>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="row">
								<div class="col-md-12" style="min-height:30px;display:none;" id="hidemessage">
									<div class="alert alert-success alert-sm" >
										<strong>Successfully! add tradelicense type... </strong>
									</div>
							   </div>
							   <div class="col-md-12" style="min-height:30px;display:none;" id="hidemessage1">
									<div class="alert alert-danger alert-sm" >
										<strong>Sorry!! fill up form..... </strong>
									</div>
							   </div>
							   <div class="col-md-12" style="min-height:30px;display:none;" id="hidemessage2">
									<div class="alert alert-danger alert-sm" >
										<strong>Sorry! Not Inserted </strong>
									</div>
							   </div>
							   
							   
						   </div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
		
		
		
		
		
			<!-- bank transfer list show ----------->
	<div class="panel panel-default">
		<div class="panel-heading">ট্রেড লাইন্সেস রেট সীট</div>
		<div class="panel-body">			
			<div class="col-lg-12 col-sm-12"> 
				<script type="text/javascript"> 
					$(document).ready(function() {
						$('#example').DataTable( {
							"lengthMenu": [[ 30, 50,100, -1], [ 30, 50,100, "All"]]
						} );
					} );
				</script>
				
				
				
				<div style="padding:4px;width:100%;font-family:tahoma;" class="table-responsive">
					
					<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>  
								<th width="20">ক্র.নং</th>
								<th>লাইন্সেসের ধরন</th>
								<th>টাকার পরিমান</th>
								<th>Status</th>
								<th>সর্বশেষ আপডেট</th>	    
								<th>Action</th>	    
								
							</tr>
						</thead>
						<tbody>
							<?php 
								$nr1=1;
								$query=$this->db->query("SELECT * from rate_sheet order by rid desc");
								$res=$query->result();
								foreach ($res as $row):
							?>
							<tr>
								<td><?php echo $nr1++; ?></td>
								<td><?php echo $row->licence_type ?></td>
								<td><?php echo $row->amount ?></td>
								<td><?php echo $this->setup->statusFunction($row->status); ?></td>
								<td><?php echo date('d-m-Y g:i:A',strtotime($row->up_date))?></td>
								<td>
									<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="modelStatus('<?php echo $row->rid; ?>')" data-target="#modelStatus@" ><i class="glyphicon glyphicon-pencil"></i></button>
								</td>
							</tr>
							<?php  endforeach;?>
						</tbody>
						
						
					</table>
					<!--<a href="index.php/Transfer/bankreports" class="btn btn-primary" style="float:right;">Print</a>-->
				</div>
			</div>
		<!--- end bank transer list -------->
		</div> <!-- /row box -->
		</div>
	</div><!--/#content.col-md-0-->



<script>
function modelStatus(rid){
	//alert(fieldData);
	$.ajax({
		url:"index.php/Setup_section/editRateSheetInfo",
		data:{rid:rid},
		type:"POST",
		success:function(hr){
			//alert(hr); exit;
			var d=hr.split("%+%+");
			document.getElementById('titleShow').value=d[0];
			document.getElementById('addressShow').value=d[3];
			document.getElementById('titleId').value=d[2];
			if(d[1]==2){
				document.getElementById('statusShow').innerHTML="<option value='2'>Disable</option><option value='1'>Enable</option>";
			}else{
				document.getElementById('statusShow').innerHTML="<option value='1'>Enable</option><option value='2'>Disable</option>";
			}
		}
	});
}
</script>

<script type="text/javascript">
	$("document").ready(function(){
		$("#titleShow").keyup(function(){
			var titleShow=$("#titleShow").val();
			//alert(titleShow);exit;
			$.ajax({
				url:"House/searchName?id=1",
				data:{houseName:titleShow},
				type:"GET",
				success:function(hr){
					//alert(hr);
					if(hr==10){
						document.getElementById('error8').innerHTML="Opps!! This  title already use.";
						document.getElementById('error9').innerHTML="";
						document.getElementsByName("updateNow")[0].type = "button";
					}
					else {
						//return true;
						document.getElementById('error9').innerHTML="Thanks,Valid title";
						document.getElementById('error8').innerHTML="";
						document.getElementsByName("updateNow")[0].type = "submit";
					}
				}
			});
		});
	});
</script>


<div class="modal fade" id="modelStatus" role="dialog">
    <div class="modal-dialog">
		<div class="modal-content" style="padding-bottom:50px;">
			<div class="col-sm-12" style="margin-top:30px;">
				<div class="col-sm-11">
					 <button type="button" class="btn btn-default btn-block" style="background:#eee;">Update Information</button>
				</div>
				<div class="col-sm-1">
					 <button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			</div>
			<form action="index.php/House/submitHouseData" enctype='multipart/form-data' method="post">
				
				<div class="col-sm-12" style="margin-top:20px;">
					<label class="col-sm-4">ট্রেড লাইন্সেসের ধরন</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="m_tradelicenseType" id="m_tradelicenseType" >
					</div>
				</div>	
				<div class="col-sm-12" style="margin-top:5px;">
					<label class="col-sm-4"> টাকার পরিমাণ </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="m_amount" id="m_amount" >
					</div>
				</div>	
				
				<div class="col-sm-12" style="margin-top:5px;">
					<label class="col-sm-4">Status</label>
					<div class="col-sm-8">
						<select class="form-control" id="statusShow" name="status"  >
							
						</select>
					</div>
				</div>
				
				<div class="col-sm-12" style="margin-top:5px;">
					<label class="col-sm-4"></label>
					<div class="col-sm-4">
						<input type="hidden" name="titleId" id="titleId">
						<input type="submit" name="updateNow" value="Update" class="btn btn-success btn-sm">
						 <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
					</div>
					<div class="col-sm-4"> 
						<span id="error8" style="color:red;font-size:12px;"></span>
						<span id="error9" style="color:green;font-size:12px;"></span>
					</div>
				</div>	
			</form>
			<div class="modal-footer">
			</div>
		</div>
     </div>
 </div>