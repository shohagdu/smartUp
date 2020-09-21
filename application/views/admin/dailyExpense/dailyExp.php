<div id="content" class="col-lg-10 col-sm-10">
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
	<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('.daily').submit(function() {
				$("#load").empty().append('<img src="library/img/ajaxloader.gif">');
				$.post(
				"Admin/dailyExpense_action",
				$(".daily").serialize(),
				function(data){
					var d=data.split("+&+");
					if(d[0]==1){
						document.getElementById('button_id').type='button';
						alert('Added Succssfully.');
						window.location='Admin/dailyExp';
						window.open('Money_receipt/dailyExpenseMoneyReceipt?id='+d[1],'_blank');
						}
					else{alert(data);}			
				});
				return false;
			});
		});
		$(function() {
			$("#dofb").datepicker();
		});
	</script>
	
	<script>
		$("document").ready(function(){
			$("#amount").change(function(){
				var acc_no=$("#acc_no").val();
				var amount=$("#amount").val();
				// exit;
				$.ajax({
					url:"index.php/Admin/checkBalance",
					data:{acc_no:acc_no,amount:amount},
					type:"GET",
					success:function(hr){
						//var result=hr.responseText;
						//alert(hr);exit;
						if(hr=='accEmpty'){
							document.getElementById("blanceCheck").innerHTML="<div style='font-size:14px;color:red;' >Opps ! Please Entry Amount</div>";
						}
						else if(isNaN(hr)==false){
							document.getElementById("blanceCheck").innerHTML="<div style='font-size:14px;color:red;' >Opps! Balance is not available. Account Balance is="+hr+"</div>" ;
							$("#amount").val('');
						}
						else if(hr=='ValidBalance'){
							document.getElementById("blanceCheck").innerHTML="<div style='font-size:14px;color:green;' >Thanks,Total Balance is available this Account</div>";
						}
						else if(hr=='empyAcc'){
							document.getElementById("blanceCheck").innerHTML="<div style='font-size:14px;color:red;' >Opps! Please Select Account</div>";
							// $("#amount").val('');
						}
						else{
							document.getElementById("blanceCheck").innerHTML="";
						
						}
					}
				});
			});
		});
	
	</script>
	
	<!-- Content (Right Column)-->
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<!-- Form -->
			<h3 class="tit" style="margin-top:0px;margin-bottom: 30px;background:lightgray;padding:5px;text-align:center;"> দৈনিক খরচ </h3>
			<form action="index.php/Admin/dailyExpense_action" method="post" id="validall" class="daily" style="border: 1px solid #ddd; padding: 10px;box-sizing: border-box;" autocomplete="off">
				<div class="form-group">
					<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="transaction no">ট্রানজেকশন নং</label>
					<div class="col-sm-4">
						<input type="text"  style="border:none;font-size:20px; text-align:center;" name='tid' readonly value='<?php echo $trans;?>'/>
					</div>
					<label class="control-label col-sm-2 midum-font" for="boucher no">ভাউচার নং</label>
					<div class="col-sm-3">
						<input type="text"  name='vouchno' style="border:none;font-size:20px; text-align:center;" readonly value="<?php echo $voucher;?>"/>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="form-group">
					<label for="Fund Type" class="control-label col-sm-2 col-sm-offset-1 midum-font">ফান্ড টাইপ</label>
					<div class="col-sm-9" style="font-size: 18px;">
						<label class="radio-inline">
							&nbsp;&nbsp;<input type='radio' name='fund_id' value='1' onchange="addinfo('Admin/daily_exp_ctg','f='+this.value);"/>&nbsp;Development
						</label>
						<label class="radio-inline">
							<input type='radio' name='fund_id' value='2' onchange="addinfo('Admin/daily_exp_ctg','f='+this.value);"/>Personal
						</label>
					</div>
					<div class="clearfix"></div>
				</div>
				<div id="txtwr">
				
				</div>
				<div class="clearfix"></div>
				<div class="form-group" style="margin-top: 10px;">
					<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="Description">বর্ণনা</label>
					<div class="col-sm-9">
						<textarea class="form-control" rows="5" name='describe'></textarea>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2 col-sm-offset-1 midum-font" for="accounts">ব্যাংক সমূহ</label>
					<div class="col-sm-4"> 
						<select name="accounts" id="acc_no" onchange="htmlData('Admin/daily_sContent','id='+this.value)" class="form-control">
							<option value='-1'>--Select---</option>
							<?php
								$aquery=$this->db->query("SELECT * from acinfo");
								$aresult=$aquery->result();
								foreach ($aresult as $row):
							?>
							<option value="<?php echo $row->acname;?>"><?php echo $row->acname;?>(&nbsp;<?php echo $this->web->acBalance($row->acno);?>&nbsp;)</option>
							
							<?php endforeach;?>
						</select>
					</div>
					<div id="txtResult"> 
					
					</div>
					<div class="clearfix"></div>
				</div>
				<div id="slip"> 
				
				</div>
				<!---------cheque ------->

				<!---------pay order------->

				<!---------DD order------->

				<!---------TT order------->
				<input type="hidden" name="invoice" value="<?php echo $invoice;?>"/>
				
				<div class="form-group">
					<label for="Amount" class="control-label col-sm-2 col-sm-offset-1  midum-font">টাকার পরিমান</label>
					<div class="col-sm-4" style="font-size: 18px;">
						<input type="text" name="amount" class="form-control"  id="amount" placeholder="Enter Your Amount" />
					</div>
					<div class="col-sm-5" style="font-size: 18px;">
						<div id="blanceCheck"></div>
					</div>
					
					<div class="clearfix"></div>
				</div>
				<div class="form-group">
					<label for="issu Date" class="control-label col-sm-2 col-sm-offset-1 midum-font">ইস্যুকৃত তারিখ</label>
					<div class="col-sm-4 col-xs-8" style="font-size: 18px;">
						<input type="text" name="payment_date" id="dofb" class="form-control" value="<?php echo date('m/d/Y'); ?>" />
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class=" col-sm-2  col-sm-offset-3"> 
					<div class="form-group">
						<div>
							<input type="submit" id="button_id" value="Confirm" onclick=" return confirm('Are you confirm');" class="btn btn-info btn-sm"/>
							<span id="load"></span>
						</div>
					</div>
				</div>
				<table style="font-size:18px;width:100%">	</table>	
			</form>
		</div><!--- /col-lg-12 col-sm-12-------->	
	</div> <!-- /row -->
</div><!--/#content.col-md-0-->