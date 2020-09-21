<div id="content" class="col-lg-10 col-sm-10">
	<style type="text/css"> 
		#view{
			float: right;
			color: #F92121;
			display: block;
			font-size: 14px;
			font-weight: normal;
		}
	</style>
	<script type="text/javascript"> 
		$(document).ready(function() {
			$('#example').DataTable( {
				"lengthMenu": [[ 20, 50,100,1000,2000, -1], [ 20, 50,100,1000,2000, "All"]]
			});
		});
		$(function() {
			$("#dofb").datepicker({ dateFormat: 'yy-mm-dd' });
		});
		
		function filterTradelicense(gid){
			$("#showdata").empty().append('<p align="center" style="margin-top:20%"><img src="library/ajax-loader.gif" style=""></p>');
			var url="Applicant/tradelicenseapplicantReport?napply=5&opt="+gid;
			$("#showdata").load(url);
			if(gid==2){
				$("#view").html('সর্বশেষ দুই দিন');
			}
			else if(gid==7){
				$("#view").html('সর্বশেষ এক সপ্তাহ');
			}
			else if(gid == 30){
				$("#view").html('সর্বশেষ এক মাস');
			}
			else if(gid == 1000){
				$("#view").html('সকল সনদ');
			}
			else if(gid != ''){
				var dofb = document.getElementById('dofb').value;
				document.getElementById('view').innerHTML=dofb;
			}
			
		}
	</script>
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<button class="btn btn-custom-head btn-block btn-sm " style="font-size:16px;margin-bottom:10px;"> <?php if($_GET['napply']=='5'){?>ট্রেড লাইসেন্স  সনদ গ্রহনকারীগণের তালিকা <span id="view"></span><?php } else if($_GET['napply']=='expire'){ ?> মেয়াদ উত্তীর্ণ ট্রেড লাইসেন্সসমূহ <?php } else{?>ট্রেড লাইসেন্স আবেদনকারীগণের তালিকা<?php }?></button>
		</div>
		<?php if($_GET['napply']=='5'):?>
		<div class="col-lg-12 col-sm-12 col-xs-12" style="margin:10px 0px;">
			<div class="col-lg-6 col-sm-6 col-xs-6">
				<div class="col-lg-7 col-sm-7 col-xs-6">
					<input type="text" name="payment_date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="dofb" >
				</div>
				<div class="col-lg-5 col-sm-5 col-xs-6">
					<input type="button" value="Search" name='today'  onclick="filterTradelicense(dofb.value);" class="btn btn-info btn-sm" />
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-6">
				<button type="button" value="2" name='lastToday' onclick="filterTradelicense(this.value);" class='btn btn-success btn-sm'>সর্বশেষ দুই দিন</button>
				<button type="button" value="7" name='lastweek' onclick="filterTradelicense(this.value);" class='btn btn-primary btn-sm'>সর্বশেষ এক সপ্তাহ</button>
				<button type="button" value="30" name='lastweek' onclick="filterTradelicense(this.value);" class='btn btn-warning btn-sm'>সর্বশেষ এক মাস</button>
				<button type="button" value="1000" name="allData" onclick="filterTradelicense(this.value);" class='btn btn-danger btn-sm'>সকল সনদ</button>
			</div>
		</div>
		<?php endif;?>
	</div>
	
	<div style="padding:4px;width:100%;" id="showdata">
		<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

			<thead>
				<tr style="font-size: 13px !important; font-family: SolaimanLipi;font-style: normal;">
					<th>ছবি</th>
					<th>নাম</th>
					
					<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
					<th>ট্র্যাকিং নং</th>
					<?php endif;?>
					
					<?php if(($_GET['napply']=='5') || ($_GET['napply']=='expire')):?>
						<th>সনদ নং</th>
					<?php endif;?>
					
					<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
					<th>সরবরাহের ধরণ </th>
					<?php endif;?>
					
					<th>মোবাইল</th>
					<th>প্রতিষ্ঠানের নাম</th>
					
					<?php if($_GET['napply']=='new'):?>
						<th>আবেদনের তারিখ</th>
					<?php endif;?>
					<?php if($_GET['napply']=='5'):?>
						<th>জেনারেট তারিখ</th>
					<?php endif;?>
					
					<?php if($_GET['napply']=='expire'): ?>
					<th>ইস্যুকৃত তারিখ</th>
					<th>মেয়াদ উত্তীর্ণ তারিখ</th>
					<?php endif;?>
					
					
					<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
					<th>সার্টিফিকেট</th>
					<?php endif;?>
					
					<?php if($_GET['napply']=='expire'): ?>
					<th>অ্যকশন</th>
					<?php endif;?>
					
					<?php if($_GET['napply']=='5'):?>
						<th>মানি রিসিট</th>
					<?php endif;?>
				</tr>
			</thead>
			
			<tbody>
			<?php
				foreach($query as $row):
			?>
				<tr style="font-size: 13px !important; font-family: SolaimanLipi;font-style: normal;">
					<td>
						<img src="<?php if($row->profile !=''): echo $row->profile; else: echo "default.jpg";endif;?>" height='40' width='45'/>
					</td>
					<td style="white-space:normal;">
						<a href="Update/tradelicenseInfo?id=<?php echo md5($row->id)?>" <?php $this->chk->acl('tradelicenseInfo'); ?> target=""><?php echo $row->bwname?></a>
					</td>
					<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
					<td>
						<a href="Update/tradelicenseInfo?id=<?php echo md5($row->id)?>" <?php $this->chk->acl('tradelicenseInfo'); ?> target=""><?php echo $row->trackid?></a>
					</td>
					<?php endif;?>
					
					<?php if(($_GET['napply']=='5') || ($_GET['napply']=='expire')):?>
						<td>
							<?php echo $row->sno?>
						</td>
					<?php endif;?>
					<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
					<td>
						<?php 
						if($row->delivery_type==1) $dtype="জরুরী"; 
						if($row->delivery_type==2) $dtype="অতি জরুরী"; 
						if($row->delivery_type==3) $dtype="সাধারন"; echo $dtype;
						?>
					</td>
					<?php endif;?>
					<td>
						<?php echo @$row->mobile?>
					</td>
					<td style="white-space:normal;">
						<?php echo $row->bcomname?>
					</td>
					
					<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
					<td>
						<?php echo date('d M, Y',strtotime($row->utime));?>
					</td>
					<?php endif;?>
					
					<?php if($_GET['napply']=='expire'): ?>
					<td style="color: gray;font-weight: bolder;">
						<?php echo date('d M, Y',strtotime($row->issue_date));?>
					</td>
					<td style="color: red; font-weight: bolder;">
						<?php echo date('d M, Y',strtotime($row->expire_date));?>
					</td>
					<?php endif;?>
					
					<?php if(($_GET['napply']=='new') || ($_GET['napply']=='5')):?>
					<td>
						<?php if($this->applicant->rePrint($row->trackid)=='Print'){?>
							<a href='Certificate/tradelicenseBangla?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('tradelicenseBangla'); ?> target='_blank' class="btn btn-primary btn-sm">বাংলা </a>
							<a href='Certificate/tradelicenseEnglish?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('tradelicenseEnglish'); ?> target='_blank' class="btn btn-info btn-sm">ইংরেজী</a>
						<?php } else {?>
							<a href='Genarate/tradelicenseGenarate?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('tradelicenseGenarate'); ?> class="btn btn-info btn-sm"><?php echo $this->applicant->rePrint($row->trackid)?></a>
						<?php }?>
					</td>
					<?php endif;?>
					<?php if($_GET['napply']=='5'):?>
						<td>
							<a href='Money_receipt/tradelicenseMoneyReceipt?id=<?php echo sha1($row->trackid)?>' <?php $this->chk->acl('tradelicenseMoneyReceipt'); ?> class="btn btn-success btn-sm" target='_blank'>Print</a>
						</td>
					<?php endif;?>
					
					<?php if($_GET['napply']=='expire'): ?>
					<td>
						<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="viewStatus(<?php echo $row->id ?>)" data-target="#upDateCustomLogo" ><i class="glyphicon glyphicon-envelope"></i></button>
						<a href='index.php/RenewTradeLicense/RenewTradeLicenGenerate?id=<?php echo sha1($row->trackid)?>'  class="btn btn-success btn-sm">Re Genarate</a>
					</td>
					<?php endif;?>
				</tr>
			<?php 
				endforeach;
			?>	
			</tbody>
		</table>
	</div>
</div><!--/#content.col-md-0-->

<script>
	$(document).ready(function(){
		 $('#formid').submit(function() {
		 document.getElementById('submitId').disabled="disabled";
		  $.post(
				"index.php/RenewTradeLicense/sendSMStrade",
				$("#formid").serialize(),
				function(data){
				if(data==1){
					  $('#hidemessage').fadeIn('slow').delay(1000).fadeOut('slow');
						setTimeout(function(){
						    location.reload();
						//window.location="index.php/Ads/ads_entry";
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

<script>
	function viewStatus(tId){
		//alert(tId);
		$.ajax({
		url:"index.php/RenewTradeLicense/smsInformation",
		data:{tId:tId},
		type:"POST",
		success:function(hr){
			//alert(hr);exit;
			var d=hr.split("+&+&");
			document.getElementById('orgName').value=d[0];
			document.getElementById('sno').value=d[1];
			document.getElementById('mobile').value=d[2];
			document.getElementById('tradeId').value=d[3];
		}
		
	});
}
</script>
<div class="modal fade" id="upDateCustomLogo" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content" style="padding-bottom:50px;">
			<div class="col-sm-12" style="margin-top:40px;">
				<div class="col-sm-12">
					 <button type="button" class="btn btn-default btn-block" style="background:#eee;">Send Sms for expired tradelicense notification </button>
				</div>
				<!--<div class="col-sm-1">
					 <button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>-->
			</div>
			<div class="col-md-12" style="margin-top:10px;">
				<div class="col-md-12" style="min-height:20px;display:none;" id="hidemessage">
					<div class="alert alert-success alert-sm" >
						<strong>Successfully! Send your SMS</strong>
					</div>
			   </div>
		   </div>
			
			<form action="index.php/RenewTradeLicense/sendSMStrade" enctype='multipart/form-data' method="post" id="formid">
				
				<div class="col-sm-12" style="margin-top:5px;margin-bottom:5px;">
					<div class="col-sm-4" style="text-align:right;padding-top:5px;"><b>প্রতিষ্ঠানের নাম</b> </div>
					<div class="col-sm-8">
						<input type="text" name="orgName" id="orgName" required class="form-control input-text-sm" placeholder="Enter Organization Name">
					</div>
				</div>
				<div class="col-sm-12" style="margin-top:5px;margin-bottom:5px;">
					<div class="col-sm-4" style="text-align:right;padding-top:5px;"><b>লাইসেন্স নং</b> </div>
					<div class="col-sm-8">
						<input type="text" name="sno" id="sno" required class="form-control input-text-sm" placeholder="Enter" readonly>
					</div>
				</div>
				<div class="col-sm-12" style="margin-top:5px;margin-bottom:5px;">
					<div class="col-sm-4" style="text-align:right;padding-top:5px;"><b>মোবাইল নং</b> </div>
					<div class="col-sm-8">
						<input type="text" name="mobile" id="mobile" required class="form-control input-text-sm" placeholder="Enter  ">
					</div>
				</div>
				<div class="col-sm-12" style="margin-top:5px;margin-bottom:5px;">
					<div class="col-sm-4" style="text-align:right;padding-top:5px;"><b>বার্তা</b> </div>
					<div class="col-sm-8">
						<textarea class="form-control" name="msg" cols="2" placeholder="Enter your message" required></textarea>
					</div>
				</div>
				<div class="col-sm-12" style="margin-top:5px;">
					<label class="col-sm-4"></label>
					<div class="col-sm-8">
						<input type="submit" name="updateNow" value="Send SMS" id="submitId" class="btn btn-success btn-sm">
						<input type="hidden" name="tradeId" id="tradeId">
						 <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
					</div>
				</div>	
			</form>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>