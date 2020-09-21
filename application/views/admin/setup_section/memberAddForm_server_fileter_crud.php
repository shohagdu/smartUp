<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	$('#validall').submit(function() {
		document.getElementById('submitId').disabled='disabled';
	$.post(
			"index.php/setup_section/word_member_action",
			$("#validall").serialize(),
			function(data){
				//alert(data);
				if(data==1){
					$('#hidemessage').fadeIn('slow').delay(1000).fadeOut('slow');
					setTimeout(function(){					
						window.location="index.php/setup_section/memberAddForm";
					},1000)
				}
				else if(data==55){ 
					$('#hidemessage1').fadeIn('slow').delay(1000).fadeOut('slow');
					setTimeout(function(){					
						window.location="index.php/setup_section/memberAddForm";
					},1000)
				}
				else if(data==2){ 
					$('#hidemessage2').fadeIn('slow').delay(1000).fadeOut('slow');
					setTimeout(function(){					
						window.location="index.php/setup_section/memberAddForm";
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
		$("#word_no").keyup(function(){
			var word_no=$("#word_no").val().trim();
			
			if(word_no==''){
				document.getElementById('error1').innerHTML="";
				document.getElementById('error2').innerHTML="";
				document.getElementById('error3').innerHTML="দয়া করে ওয়ার্ড নং লিখুন";exit;
			}
			//alert(word_no);
			$.ajax({
				url:"Setup_section/checkWordNo?id=1",
				data:{word_no:word_no},
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
		<div class="panel-heading">নতুন ওয়ার্ড এবং মেম্বার  যোগ করুন</div>
		<div class="panel-body">
			<div class="col-lg-12 col-sm-12"> 
				<form action="index.php/setup_section/word_member_action" method="post" id="validall" class="daily form-horizontal" role="form">
					<div class="form-group">
						<label class="control-label col-sm-2" for="Word no">ওয়ার্ড নং</label>
						<div class="col-sm-5"> 
							<input type="text" required class="form-control" name="word_no" id="word_no" onkeypress="return checkaccnumber(event);" placeholder="ইংরেজীতে প্রদান করুন Ex: 07"/>
						</div>
						<div class="col-sm-3"> 
							<span id="error1" style="color:red;font-size:12px;"></span>
							<span id="error2" style="color:green;font-size:12px;"></span>
							<span id="error3" style="color:red;font-size:12px;"></span>
						</div>
						<div class="clearfix" style="margin-top:50px;"></div>
						<label class="control-label col-sm-2" for="Member name">মেম্বারে নাম</label>
						<div class="col-sm-5"> 
							<input type="text" required class="form-control" name="memberName" id="memberName" placeholder="" />
						</div>
						<div class="clearfix" style="margin-top:50px;"></div>
						<label class="control-label col-sm-2" for="Member Father name">মেম্বারের পিতার নাম</label>
						<div class="col-sm-5"> 
							<input type="text" required class="form-control" name="memberFather" id="memberFather" placeholder="" />
						</div>
						
					</div>
					
					<div class="clearfix"></div>
					<div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-1" style="position: relative; margin-left: 160px;">
							<div class="col-sm-12">
								<input type="submit" id="submitId" name="submitform" value="যোগ করুন" class="btn btn-info "/>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="row">
								<div class="col-md-12" style="min-height:30px;display:none;" id="hidemessage">
									<div class="alert alert-success alert-sm" >
										<strong>Successfully! added member..... </strong>
									</div>
							   </div>
							   <div class="col-md-12" style="min-height:30px;display:none;" id="hidemessage1">
									<div class="alert alert-danger alert-sm" >
										<strong>Sorry! fill up form.....</strong>
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
		<div class="panel-heading">ওয়ার্ড মেম্বারের তালিকা</div>
		<div class="panel-body">			
			<div class="col-lg-12 col-sm-12"> 
				<script type="text/javascript"> 
					$(document).ready(function() {
						var dataTable = $('#example').DataTable({
							//"lengthMenu": [[ 30, 50,100, -1], [ 30, 50,100, "All"]]
							"processing":true,
							"serverSide":true,
							"order":[],
							"ajax":{
								url:"setup_section/info_word_member_table_server",
								type:"POST"
							},
							columnDefs:[
								{
									"targets":[0,3,4],
									"orderable":false
								}
							],
							"columns": [
								{ "data": "id" },
								{ "data": "word_no" },
								{ "data": "member_name" },
								{ "data": "member_father" }
							] 
						});
					});
				</script>
				
				
				
				<div style="padding:4px;width:100%;font-family:tahoma;" class="table-responsive">
					
					<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>  
								<th width="20">ক্র.নং</th>
								<th>ওয়ার্ড নং</th>
								<th>মেম্বারের নাম</th>
								<th>মেম্বারের পিতার নাম</th>
								<th>Status</th>	    
								<th>Action</th>	    
								
							</tr>
						</thead>
						
						
						
					</table>
					<!--<a href="index.php/Transfer/bankreports" class="btn btn-primary" style="float:right;">Print</a>-->
				</div>
			</div>
		<!--- end bank transer list -------->
		</div> <!-- /row box -->
	</div><!--/#content.col-md-0-->



<script>
function modelStatus(fieldData){
	//alert(fieldData);
	$.ajax({
		url:"index.php/House/editHouseInfo",
		data:{fieldData:fieldData},
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
					<label class="col-sm-4">House Name </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="titleShow" id="titleShow" >
					</div>
				</div>	
				<div class="col-sm-12" style="margin-top:5px;">
					<label class="col-sm-4">House Address </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="addressShow" id="addressShow" >
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