	<div id="content" class="col-lg-10 col-sm-10">
		<script type="text/javascript">
			$(document).ready(function(){
				$('#nagorickGenarate').submit(function() {
					$.post(
					"Genarate/nagorickGenarate_action",
					$("#nagorickGenarate").serialize(),
					function(data){
						if(data==1)
						{
							alert('Confirm page problem!!!!!!!!!!!!!!!!!!!');
						}
						if(data==3){
							window.location='Confirm/nagorikConfirm';
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
				<h3 class="tit" style="margin-top:0px;margin-bottom: 20px;background:lightgray;padding:5px;text-align:center;">নাগরিক সনদ  ফি ফরম </h3>
				<form action="Genarate/nagorickGenarate_action" method="post" id="nagorickGenarate" enctype="multipart/form-data" class="form-horizontal" role="form">
					<div class="form-group"> 
						<div class="col-sm-6 col-sm-offset-2"> 
							<img src="<?php echo $row->profile?>" width="160" height="150"/>
							<input type="hidden" name="profile" value="<?php echo $row->profile?>"/>
						</div>
						<div class="clearfix"></div>
					</div>
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
							<input type="text" class="form-control highlisht_font" name="name" id="name" value="<?php echo $row->name?>" readonly />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="father name">পিতার নাম :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" name="bfname" id="efname" value="<?php echo $row->bfname?>" readonly />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="father name">হোল্ডিং নম্বর  :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" name="holding_no" id="holding_no" value="<?php echo $row->holding_no; ?>" readonly />
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
						<label class="control-label col-sm-2 highlisht_font" for="attachment">সংযুক্তি :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" name="attachment" id="attachment" value="<?php echo $row->attachment?>"  />
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
							<input type="text" class="form-control highlisht_font"  name="fee" id="fee" value="0.00"  style="color: red;"/>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="issu date">ইস্যুকৃত তারিখ :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font"  value="<?php echo date('d-m-Y');?>" id="dofb" name="payment_date"/>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
							<input type="submit"  value="Generate" class="btn btn-info btn-sm"/>
							<input type="hidden" name="uid" value="<?php echo $row->id;?>">
							<input type="hidden" name="gentype" value="Generate">
						</div>
					</div>
				</form>
			</div><!--- /col-lg-12 col-sm-12-------->	
		</div> <!-- /row -->
	</div><!--/#content.col-md-10-->