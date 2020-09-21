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
	<script type="text/javascript">
		function validation(){
			var full_name=document.getElementById('full_name').value;
			var user_name=document.getElementById('user_name').value;
			var password=document.getElementById('password').value;
			var cpassword=document.getElementById('cpassword').value;
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

else if(cpassword==''){
				document.getElementById('error').innerHTML='Please Enter Re-Password';
				return false;
			}
			else if(cpassword!==password)
			{
				alert('Sorry Password Not Match');
				return false;
			}


			else {
				return true;
			}
		}
	</script>
	<!-- search user name-----------unique-->
	<script type="text/javascript">
		$("document").ready(function(){
			$("#user_name").keyup(function(){
				var user_name=$("#user_name").val();
				$.ajax({
					url:"Confirm/searchUser?id=1",
					data:{user_name:user_name},
					type:"GET",
					success:function(hr){
						//var result=hr.responseText;
						
						if(hr==1){
							document.getElementById('error1').innerHTML=" দু:খিত!!! User Name পূর্বে ব্যবহৃত হযেছে। ";
							document.getElementById('user_name').value="";
							document.getElementById('error2').innerHTML="";
						}
						else {
							//return true;
							document.getElementById('error2').innerHTML="ধন্যবাদ, User Name টি পূর্বে ব্যবহৃত হয় নি।";
							document.getElementById('error1').innerHTML="";
						}
					}
				});
			});
		});
	</script>
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
					<form action="Manage/employeeAdd" method="post" onsubmit="return validation();" id="validall" enctype="multipart/form-data" class="form-horizontal">
					
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Full Name" class="col-sm-3 control-label">নাম</label>
									<div class="col-sm-6">
										<input type="text" name="full_name" id="full_name" class="form-control medium-font-inupt"placeholder="Enter your full name" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Designation" class="col-sm-3 control-label">পদবী</label>
									<div class="col-sm-6">
										<input type="text" name="designation" id="desig" class="form-control medium-font-inupt" placeholder="Enter Designation" />
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

												foreach ($query->result() as $row) {
													echo "<option value='$row->role_id' >$row->role_name</option>";
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
										<input type="text" name="mobile" id="phone" class="form-control medium-font-inupt" placeholder="Enter phone number" maxlength="11" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="email" class="col-sm-3 control-label">ই-মেইল  </label>
									<div class="col-sm-6">
										<input type="email" name="email" id="email" class="form-control medium-font-inupt" placeholder="Enter your email" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="User Name" class="col-sm-3 control-label">User Name</label>
									<div class="col-sm-6">
										<input type="text" name="user_name" id="user_name" class="form-control medium-font-inupt" placeholder="Enter User Name" />
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
									<label for="password" class="col-sm-3 control-label">Password</label>
									<div class="col-sm-6">
										<input type="password" name="password" id="password" class="form-control medium-font-inupt" placeholder="Enter password" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="password" class="col-sm-3 control-label">Confirm Password</label>
									<div class="col-sm-6">
										<input type="password" name="cpassword" id="cpassword" class="form-control medium-font-inupt" placeholder="Enter Re-password" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="picture" class="col-sm-3 control-label">ছবি  </label>
									<div class="col-sm-6">
										<input type="file" name="picture" id="pic" class="form-control medium-font-inupt input-file-sm" />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-offset-3 col-sm-1"> 
								<input type='submit' value="যোগ করুন" name='submit_btn' class="btn btn-info btn-sm"/>
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