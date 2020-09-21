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

function checkaccnumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return false;
    }
    return true;
}

function getHoldingAmount(hrid,nr){
	$.ajax({
		url:"Setup_section/getAmount",
		type:"POST",
		data:{hrid:hrid},
		success:function( data ){
			document.getElementById("showAmount"+nr).value=data;
		}
	});
}
 
	function assesmentForm(holdingid){
		alert(holdingid);
	}
	
	
	function singleSave(rowid){
		var holdingType = $("#holdingType"+rowid).val();
		var amount = $("#showAmount"+rowid).val();
		var tbl_row_id = $("#rowid"+rowid).val();
		var assid = $("#assid"+rowid).val();
		
		$.ajax({
			url: "Setup_section/assesment_action",
			type: "POST",
			data: {holding:holdingType,amount:amount,rowid:tbl_row_id,assid:assid},
			success:function(response){
				if(response==1){
					alert("Successfully added in assesment form");
				}
				else if(response==2){
					alert("Successfully updated");
				}
				else if(response==10){
					alert("Opps!! problem");
				}
				else{
					alert(response);
				}
			}
		});
		
	}
	
</script>
<div id="content" class="col-lg-10 col-sm-10">
			<!-- bank transfer list show ----------->
	<div class="panel panel-default">
		<div class="panel-heading">এ্যাসেসমেন্ট  ফরম</div>
		<div class="panel-body">			
			<div class="col-lg-12 col-sm-12"> 
				<script type="text/javascript"> 
					$(document).ready(function() {
						$('#example').DataTable( {
							"lengthMenu": [[ 100,200, -1], [ 100,200, "All"]]
						} );
					} );
				</script>
				
				
				
				<div style="padding:4px;width:100%;font-family:tahoma;" class="table-responsive">
					
					<table id="example" class="table table-striped table-bordered  nowrap" cellspacing="0" width="100%">
						<thead>
							<tr>  
								<th width="20">ক্র.নং</th>
								<th>হোল্ডিং নম্বর</th>
								<th>ওয়ার্ড নং</th>
								<th>মালিকের নাম</th>
								<th>বাড়ির ধরন</th>	    
								<th>ধার্যকৃত কর</th>	    
								<th>Action</th>	    
								
							</tr>
						</thead>
						<tbody>
							<?php
								$holdingType = $this->db->query("SELECT * FROM holding_rate_sheet order by hrid desc")->result();
								
								$nr=1;
								$query=$this->db->select("hld.id,hld.name,hld.holding_no,hld.wordno,ass.assid,ass.status,hrate.hrid,hrate.amount")
													->join("tbl_assesment ass","hld.id = ass.hinfoid","left")
													->join("holding_rate_sheet hrate","hrate.hrid = ass.htype_rate_id","left")
													->get("holdingclientinfo hld");
								$res=$query->result();
								
								
								foreach ($res as $row):
							?>
							<!-- <form action="index.php/setup_section/assesemnt_action" method="post" id="assForm<?php echo $row->id;?>" onsubmit="return assesmentForm(<?php echo $row->id; ?>);"> -->
							<tr>
								<td><?php echo $nr; ?></td>
								<td><?php echo $row->holding_no ?></td>
								<td><?php echo $row->wordno ?></td>
								<td><?php echo $row->name?></td>
								<td>
									<select name="holdingType" id="holdingType<?php echo $nr ?>" onchange="getHoldingAmount(this.value,<?php echo $nr;?>)">
										<option value="0">-----select----</option>
											<?php 
												foreach($holdingType as $hinfo){
											?>
											<option value="<?php echo $hinfo->hrid;?>" <?php if($hinfo->hrid == $row->hrid){echo 'selected';} ?> ><?php echo $hinfo->holding_type;?></option>
											<?php 
												}
											?>
									</select>
								</td>
								<td><input type="text" name="amount" id="showAmount<?php echo $nr; ?>" value="<?php echo $row->amount ?>" readonly /></td>
								<td>
									<input type="hidden" name="rowid" id="rowid<?php echo $nr ?>" value="<?php echo $row->id ?>" />
									<input type="hidden" name="assid" id="assid<?php echo $nr ?>" value="<?php echo $row->assid ?>" />
									<button type="button" name="submit" id="assSubmit<?php echo $row->id?>" class="btn btn-primary btn-sm" onclick="singleSave(<?php echo $nr ?>)" >Save <?php if($row->status==1):?><i class="glyphicon glyphicon-ok"></i><?php endif;?></button>
								</td>
							</tr>
							</form>
							<?php  
								$nr++;
								endforeach;
							
							?>
						</tbody>
						
						
					</table>
					
				</div>
			</div>
		<!--- end bank transer list -------->
		</div> <!-- /row box -->
	</div>