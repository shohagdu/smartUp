	<div id="content" class="col-lg-10 col-sm-10">
		<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
		<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.warishGenarate').submit(function() {
					$.post(
					"Genarate/warishGenarate_action",
					$(".warishGenarate").serialize(),
					function(data){
						if(data==1)
						{
							alert('Confirm page problem!!!!!!!!!!!!!!!!!!!');
						}

						if(data==3){
							window.location='Confirm/warishConfirm';
						}
						else {alert(data);}
					});

					return false;
				});
			});


			$(function() {
				$("#dofb").datepicker();
			});
		</script>
		<style type="text/css"> 
			.highlisht_font{
				font-size: 16px;
				font-style: normal;
			}
		</style>
		<!-- Content (Right Column)-->
		<div class="row">
			<div class="col-lg-12 col-sm-12">
				<h3 class="tit" style="margin-top:0px;margin-bottom: 20px;background:lightgray;padding:5px;text-align:center;">ওয়ারিশ সনদ  ফি ফরম </h3>
				<form action="Genarate/warishGenarate_action" method="post" id="validall" enctype="multipart/form-data" class="warishGenarate form-horizontal" role="form">
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="traking no">ট্র্যাকিং নং :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" name="trackid" id="trackid" value="<?php echo $row->trackid?>" readonly />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="name">নাম :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" name="name" id="name" value="<?php echo $row->bname?>" readonly />	
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="father name">পিতার নাম :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" name="bfname" id="bfname" value="<?php echo $row->bfname?>" readonly />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="mobile no">মোবাইল নং :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" name="mobile" id="mobile" maxlength="11" value="<?php echo $row->mobile?>" readonly />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="Verification">তদন্তকারী :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" name="verifier_name" id="verifier_name"  value=""  />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="Payment Type">Payment Type:</label>
						<div class="col-sm-4"> 
							<select name='acno' class="form-control highlisht_font">
								<?php 
									$Qy=$this->db->get("acinfo");
									foreach ($Qy->result() as $arow):
								?>
								<option value='<?php echo $arow->acno?>'><?php echo $arow->acname?>&nbsp;(&nbsp;<?php echo $arow->acno?>&nbsp;)</option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="form-group" style="color: red;">
						<label class="control-label col-sm-2 highlisht_font" for="fee">ফি :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" name="fee" id="fee" value="0.00" style="color: red;" />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="issu date">ইস্যুকৃত তারিখ :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" id="dofb" name="payment_date" value="<?php echo date('d-m-Y');?>"/>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit" class="btn btn-info btn-sm" value="Generate" />
							<input type="hidden" name="uid" value="<?php echo $row->id;?>"/>
							<input type='hidden' name='apno' value='<?php echo $row->id;?>'/>
							<input type="hidden" name="gentype" value="Generate">
						</div>
					</div>
				</form>
			</div><!--- /col-lg-12 col-sm-12-------->	
		</div> <!-- /row -->
	</div><!--/#content.col-md-10-->