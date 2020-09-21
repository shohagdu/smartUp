	<div id="content" class="col-lg-10 col-sm-10">
		<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
		<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>
		<style type="text/css"> 
			@-moz-document url-prefix() {
				.input-file-sm {
					height: auto;
					padding-top: 2px;
					padding-bottom: 1px;
				}
			}
			.medium-font{
				font-size: 15px;
				font-weight: normal;
			}
			.medium-font-inupt{
				font-size: 16px !important;
				letter-spacing: 1px;
				color: #333 !important;
			}
		</style>
		
		<!-- search user name-----------unique-->
		<script type="text/javascript">
			function validation(){
				var username=document.getElementById('username').value.trim();
				var pass=document.getElementById('pass').value.trim();
				var url=document.getElementById('url').value.trim();
				var api_key=document.getElementById('api_key').value.trim();


				if(username==''){
					document.getElementById('error').innerHTML='Enter Your User Name';
					return false;
				}

				else if(pass==''){
					document.getElementById('error').innerHTML='Please Enter Your Password';
					return false;
				}
           else if(url==''){
					document.getElementById('error').innerHTML='Please Enter API URL';
					return false;
				}
          else if(api_key==''){
					document.getElementById('error').innerHTML='Please Enter API Key';
					return false;
				}

				else {
					
					document.getElementById('error').innerHTML='';
					$.post(
					"index.php/Setup/sms_config_sub",
					$("#validall").serialize(),
					function(data){
						if(data==1)
						{
							alert('Configuration Successfull');
							window.location="index.php/Admin";
						}
						else if(data==2)
						{
							alert('Please Fill up All Input box!!');
						}
						else
						{
							alert(data);
							
						}	
						
					});

					return false;
					
					
					return true;
				}
			}
			// some validation function .............
			function only_chareter(v){
				if((event.keyCode==32) && (v=='')){
					return false;
				}
				else if ((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 96 && event.keyCode < 123) || event.keyCode == 8 || event.keyCode==32)
				{
					return true;
				} 
				else
				{
					return false;
				}
			}



			function isNumber(evt){
				evt = (evt) ? evt : window.event;
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode > 31 && (charCode < 48 || charCode > 57) && event.keyCode != 46) {
					return false;
				}
				return true;
			}

		</script>
		<?php
   $key="LUMIA520";
		?>
		<!-- some information query -->
		<div class="row">
			<div class="col-md-12"> 
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">Type of Messages</div>
					<div class="panel-body all-input-form">
						<form action="setup/update_message_type/<?php echo $this->encrypt->encode($row->id,$key)?>" method="post" onsubmit="return validation();" id="validall" enctype="multipart/form-data" class="form-horizontal">
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="sms_type" class="col-sm-3 col-sm-offset-1 control-label">Type </label>
										<div class="col-sm-6">
											<select name='sms_type' id='sms_type' class="form-control highlisht_font" required>
											  <option value=''>---Select---</option>
											  <option value='1' <?php if($row->sms_type==1):echo "SELECTED";endif;?>>নাগরিক/ওয়ারিশ/ট্রেড লাইসেন্স আবেদন</option>
											  <option value='2' <?php if($row->sms_type==2):echo "SELECTED";endif;?>>নাগরিক/ওয়ারিশ/ট্রেড লাইসেন্স  সনদ তৈরি</option>
											  <option value='3' <?php if($row->sms_type==3):echo "SELECTED";endif;?>> ট্রেড লাইসেন্স  নবায়ন</option>
											  <option value='4' <?php if($row->sms_type==4):echo "SELECTED";endif;?>> ট্রেড লাইসেন্স  নবায়ন নোটিশ</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="pass" class="col-sm-3 col-sm-offset-1 control-label">Message</label>
										<div class="col-sm-6">
											<textarea name="msg" id="message" class="form-control highlisht_font" cols='10' rows='10' required><?php echo $row->msg?></textarea>
										</div>
									</div>
								</div>
							</div>
							
							
							
							<div class="row">
								<div class="col-sm-offset-4 col-sm-1"> 
									<input type='submit' value="UPDATE"  class="btn btn-info btn-sm"/>
									
								</div>
								<div class="col-sm-6 pull-left"> 
									&nbsp;<span id="error" style="font-size:18px;font-family:comicsans-ms;color:red;"></span>
								</div>
							</div>
						</form>
					</div>
				</div><!--- / panel primary----->
			</div>
		</div><!-- row end--->
	</div><!--/#content.col-md-10-->
</div><!--/fluid-row-->
