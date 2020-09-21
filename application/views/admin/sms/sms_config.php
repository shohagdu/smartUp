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
	<!-- some information query -->
	<div class="row">
		<div class="col-md-12"> 
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">SMS Configuration</div>
				<div class="panel-body all-input-form">
					<form action="" method="post" onsubmit="return validation();" id="validall" enctype="multipart/form-data" class="form-horizontal">
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="username" class="col-sm-3 col-sm-offset-1 control-label">User Name</label>
									<div class="col-sm-6">
										<input type="text" name="username" id="username" class="form-control medium-font-inupt"placeholder="Enter your user name" value="<?php echo $row->username?>"/>
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="pass" class="col-sm-3 col-sm-offset-1 control-label">Password</label>
									<div class="col-sm-6">
										<input type="text" name="pass" id="pass" class="form-control medium-font-inupt" placeholder="Enter your password" value="<?php echo $row->pass?>" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="url" class="col-sm-3 col-sm-offset-1 control-label">API URL</label>
									<div class="col-sm-6">
										<input type="text" name="api_url" id="url" class="form-control medium-font-inupt" placeholder="Enter your API URL" onkeypress="return only_chareter(this.value);" value="<?php echo $row->api_url?>" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="pass" class="col-sm-3 col-sm-offset-1 control-label">API Key</label>
									<div class="col-sm-6">
										<input type="text" name="api_key" id="api_key" class="form-control medium-font-inupt" placeholder="Enter your API Key" onkeypress="return only_chareter(this.value);" value="<?php echo $row->api_key?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="pass" class="col-sm-3 col-sm-offset-1 control-label">Credit</label>
									<div class="col-sm-6">
										<input type="text" name="credit" id="credit" class="form-control medium-font-inupt" placeholder="Enter your API Key"  value="<?php echo $row->credit?>" />
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-offset-4 col-sm-1"> 
								<input type="hidden" name="hid" value="<?php echo $row->id;?>" />
								<input type='submit' value="UPDATE" name='submit_btn' class="btn btn-info btn-sm"/>
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
