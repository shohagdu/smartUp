	<div id="content" class="col-lg-10 col-sm-10">
		<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
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
			.lb-lg {
  font-size: 20px;
  
}
.q{
    background: #C3BDD6 !important;
    color:#C3BDD6;
    text-shadow:0 1px 0 rgba(0,0,0,1.7);
}
option:not(:checked) { 
    background-color: white; 
    color:#000;
}
		</style>
		<script type="text/javascript">
			function validation(){
				var full_name=document.getElementById('full_name').value;
				var user_name=document.getElementById('user_name').value;
				var password=document.getElementById('password').value;
				var desig=document.getElementById('desig').value;
				var user_role=document.getElementById('user_role').value;
				var phone=document.getElementById('phone').value;
				var email=document.getElementById('email').value;
				var pic=document.getElementById('pic').value;
				var pattern = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/;

				if(full_name==''){
					document.getElementById('error').innerHTML='Empty Full Name';
					return false;
				}

				else if(desig==''){
					document.getElementById('error').innerHTML='Empty Designation';
					return false;
				}

				else if(user_role==''){
					document.getElementById('error').innerHTML='Empty Role';
					return false;
				}


				else if(phone==''){
					document.getElementById('error').innerHTML='Empty Phone Number';
					return false;
				}

				else if (!(pattern.test(phone))) {
					document.getElementById('error').innerHTML='Phone Number in Invalid';
					return false;
				}

				else if(email==''){
					document.getElementById('error').innerHTML='Empty Email';
					return false;
				}
				else if(user_name==''){
					document.getElementById('error').innerHTML='Empty User Name';
					return false;
				}
				else if(password==''){
					document.getElementById('error').innerHTML='Empty Password';
					return false;
				}



				else {
					return true;
				}
			}
			function verfication(number)
			{
				window.location='Security/mobile_verfication_code/'+number;
			}
			
			function valid_code(mobile,code)
			{
				$.ajax({
				type: 'POST', 
				url: 'Security/valid_code',      
				data: {mobile:mobile,code:code},         
				success: function (data)
				{
				alert(data);
				}
				});   
			}

     
</script>
		
	<?php 
	extract($this->session->all_userdata());
	?>	
		<!-- some information query -->
		<div class="row">
			<div class="col-md-12"> 
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">কর্মকর্তা ও কর্মচারীর তথ্য যোগ করুন</div>
					<div class="panel-body all-input-form">
						<div class="row" style="margin-bottom: 10px;"> 
							<div class="col-sm-3 pull-right"> 
								<a href="Manage/employeeList" <?php $this->chk->acl('employeeList'); ?>>
									<button type="button" class="btn-success btn-sm pull-right">কর্মকর্তা ও কর্মচারীর তালিকা</button>
								</a>
							</div>
						</div>
						<form action="Security/update_security_submit" method="post"  id="validall" enctype="multipart/form-data" class="form-horizontal">
						
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Full Name" class="col-sm-3 control-label">নাম</label>
										<div class="col-sm-6">
											<input type="text" name="full_name" id="full_name" class="form-control medium-font-inupt"placeholder="Enter your full name" value="<?php echo $row->fullname;?>" />
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="User Name" class="col-sm-3 control-label">User Name</label>
										<div class="col-sm-6">
											<input type="text" readonly disabled name="user_name" id="user_name" class="form-control medium-font-inupt" placeholder="Enter User Name" value="<?php echo $row->username; ?>" />
										</div>
										<div class="class-col-sm3"> 
											<span id="error1" style="color:red;font-size:14px;"></span>
											<span id="error2" style="color:green;font-size:14px;"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Designation" class="col-sm-3 control-label">পদবী</label>
										<div class="col-sm-6">
											<input type="text" name="designation" id="desig" class="form-control medium-font-inupt" placeholder="Enter Designation" value="<?php echo $row->desig; ?>" />
										</div>
									</div>
								</div>
							</div>
						
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Role" class="col-sm-3 control-label">Role</label>
										<div class="col-sm-6">
											<select name="user_role" id="user_role" class="form-control medium-font-inupt">
												<option value="" style="" >Select Role</option>
												<?php
													$this->db->select("role_id,role_name");
													$this->db->from("acl");
													$query=$this->db->get();
													
													foreach ($query->result() as $value) {
														if($row->role_id==$row->role_id)
														{
															$select="selected";
														}
														else
														{
															$select="";
														}	
														echo "<option $select value='$value->role_id' >$value->role_name</option>";
													}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Mobile" class="col-sm-3 control-label">মোবাইল  </label>
										<div class="col-sm-6">
											<input type="text" name="mobile" id="mobile" <?php if($verify_mobile=='0'):echo "readonly"; endif;?>class="form-control medium-font-inupt" placeholder="Enter phone number" maxlength="11" value="<?php echo $row->mobile; ?>" />					
										</div><?php if($verify_mobile=='0'):?><a  href="javascript:void(0);" onclick="verfication(mobile.value)" class='btn btn-primary'>Verify</a><?php endif;?>
									</div>
								</div>
							</div>
							<?php if($verify_mobile=='0'):?>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Mobile" class="col-sm-3 control-label">Verification Code</label>
										<div class="col-sm-6">
											<input type="text" name="verify_mobile" id="vmobile" class="form-control medium-font-inupt" placeholder="Enter Mobile Verification Code" maxlength="11"  onchange="valid_code(mobile.value,this.value)" />
										</div>
									</div>
								</div>
							</div>
							<?php endif;?>
							<?php if($verify_email=='0'):?>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="email" class="col-sm-3 control-label">ই-মেইল  </label>
										<div class="col-sm-6">
											<input type="text" name="email" id="email" class="form-control medium-font-inupt" placeholder="Enter your email" value="<?php echo $row->email; ?>" />
										</div><span class='btn btn-primary'>Verify Email</span>
									</div>
								</div>
							</div>
			               <?php endif;?>
							
							<div class="row">
								<div class="col-sm-offset-3 col-sm-1"> 
									<input type="hidden" name="id" value="<?php echo $row->id;?>" />
									<input type='submit' value="আপডেট করুন" name='submit_btn' class="btn btn-info btn-sm"/>
								</div>
								<div class="col-sm-6 pull-left"> 
									<span id="error" style="font-size:18px;font-family:comicsans-ms;color:red;"></span>
								</div>
							</div>
						</form>
					</div>
				</div><!--- / panel primary----->
			</div>
		</div><!-- row end--->
	</div><!--/#content.col-md-10-->
</div><!--/fluid-row-->
