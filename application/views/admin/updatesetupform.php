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
		.sub-hints{
			font-size: 13px;
			color: red;
			font-style:italic;
		}
	</style>
	
	<!-- search user name-----------unique-->
	<script type="text/javascript">
		function validation(){
			var full_name=document.getElementById('full_name').value.trim();
			var full_name_english=document.getElementById('full_name_english').value.trim();
			var gram=document.getElementById('gram').value.trim();
			var gram_english=document.getElementById('gram_english').value.trim();
			var thana=document.getElementById('thana').value.trim();
			var thana_english=document.getElementById('thana_english').value.trim();
			var district=document.getElementById('district').value.trim();
			var district_english=document.getElementById('district_english').value.trim();
			var postal_code=document.getElementById('postal_code').value.trim();
			var union_code=document.getElementById('union_code').value.trim();
			var mobile=document.getElementById('mobile').value.trim();
			var phone=document.getElementById('phone').value.trim();
			var email=document.getElementById('email').value.trim();
			var web_link=document.getElementById('web_link').value.trim();
			var pattern = /^[\s()+-]*([0-9][][০-৯][\s()+-]*){6,20}$/;

			if(full_name==''){
				document.getElementById('error').innerHTML='ইউনিয়ন পরিষদের নাম প্রদান করূন';
				return false;
			}
			else if(full_name_english==''){
				document.getElementById('error').innerHTML='ইউনিয়ন পরিষদের নাম  ইংরেজিতে  প্রদান করূন';
				return false;
			}
			else if(gram==''){
				document.getElementById('error').innerHTML="গ্রাম/Area প্রদান করূন ";
				return false;
			}
			else if(gram_english==''){
				document.getElementById('error').innerHTML="গ্রাম/Area ইংরেজিতে প্রদান করূন ";
				return false;
			}
			else if(thana==''){
				document.getElementById('error').innerHTML="থানা / উপজেলা প্রদান করূন ";
				return false;
			}
			else if(thana_english==''){
				document.getElementById('error').innerHTML="থানা / উপজেলা প্রদান ইংরেজিতে করূন ";
				return false;
			}
			else if(district==''){
				document.getElementById('error').innerHTML="জেলা প্রদান করূন ";
				return false;
			}
			else if(district_english==''){
				document.getElementById('error').innerHTML="জেলা ইংরেজিতে প্রদান করূন ";
				return false;
			}
			else if(postal_code==''){
				document.getElementById('error').innerHTML="পোস্টাল কোড ইংরেজিতে প্রদান করূন";
				return false;
			}
			else if(union_code==''){
				document.getElementById('error').innerHTML="ইউনিয়ন কোড ইংরেজিতে প্রদান করূন";
				return false;
			}
			else if(mobile==''){
				document.getElementById('error').innerHTML='মোবাইল নম্বর ইংরেজিতে  প্রদান করূন';
				return false;
			}

			/* else if (!(pattern.test(mobile))) {
				document.getElementById('error').innerHTML='মোবাইল নম্বর Invalid';
				return false;
			} */
			else if(phone==''){
				document.getElementById('error').innerHTML='ফোন নম্বর ইংরেজিতে প্রদান করূন';
				return false;
			}

			else if(email==''){
			document.getElementById('error').innerHTML= 'ই-মেইল প্রদান করূন';
			return false;
			}


			else if(web_link==''){
				document.getElementById('error').innerHTML='ওয়েব সাইট ‍ লিঙ্ক প্রদান করূন';
				return false;
			}
			
			else {
				
				document.getElementById('error').innerHTML='';
				$.post(
				"index.php/Setup/setupUpdate",
				$("#validall").serialize(),
				function(data){
					if(data==1)
					{
						alert('Update Successfully');
						window.location="index.php/Setup/updatesetupform";
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
	
		$("document").ready(function(){
			$("#union_code").change(function(){
				var union_code=$("#union_code").val();
				$.ajax({
					url:"setup/searchUnionCode?id=1",
					data:{union_code:union_code},
					type:"GET",
					success:function(hr){
						//var result=hr.responseText;
						if(hr==1){
							document.getElementById('error1').innerHTML=" দু:খিত!!! Union code পূর্বে ব্যবহৃত হযেছে। ";
							document.getElementById('error2').innerHTML="";
						}
						else {
							//return true;
							document.getElementById('error2').innerHTML="ধন্যবাদ, Union code টি পূর্বে ব্যবহৃত হয় নি।";
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
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">আপনার ইউনিয়ন পরিষদের সেট আপ তথ্য সঠিক ভাবে আপডেট করুন </div>
				<div class="panel-body all-input-form">
				<label for="">
					<p class="hints-heading small-font red-color ">প্রয়োজনীয় তথ্য নির্দেশনা  অনুযায়ী প্রদান করুন। এই গুলো আপনার প্রয়োজনীয় সনদপত্রের জন্য প্রয়োজন হবে।</p>
				</label>
					<form action="" method="post" onsubmit="return validation();" id="validall" enctype="multipart/form-data" class="form-horizontal">
					
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Full Name" class="col-sm-3 col-sm-offset-1 control-label">ইউনিয়ন পরিষদের নাম (বাংলায়)</label>
									<div class="col-sm-6">
										<input type="text" name="full_name" id="full_name" class="form-control medium-font-inupt"placeholder="ইউনিয়ন পরিষদের নাম প্রদান করূন" value="<?php echo $setup_info->full_name;?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Full name English" class="col-sm-3 col-sm-offset-1 control-label">ইউনিয়ন পরিষদের নাম (ইংরেজীতে) </label>
									<div class="col-sm-6">
										<input type="text" name="full_name_english" id="full_name_english" class="form-control medium-font-inupt" placeholder="ইউনিয়ন পরিষদের নাম  ইংরেজিতে  প্রদান করূন" onkeypress="return only_chareter(this.value);" value="<?php echo $setup_info->full_name_english;?>" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Village" class="col-sm-3 col-sm-offset-1 control-label">গ্রাম/Area (বাংলায়)</label>
									<div class="col-sm-6">
										<input type="text" name="gram" id="gram" class="form-control medium-font-inupt" placeholder="গ্রাম/area প্রদান করূন" value="<?php echo $setup_info->gram;?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Village" class="col-sm-3 col-sm-offset-1 control-label">গ্রাম/Area (ইংরেজীতে)</label>
									<div class="col-sm-6">
										<input type="text" name="gram_english" id="gram_english" class="form-control medium-font-inupt" placeholder="গ্রাম/area ইংরেজিতে  প্রদান করূন" value="<?php echo $setup_info->gram_english;?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Thana" class="col-sm-3 col-sm-offset-1 control-label">থানা/উপজেলা (বাংলায়)</label>
									<div class="col-sm-6">
										<input type="text" name="thana" id="thana" class="form-control medium-font-inupt" placeholder="থানা / উপজেলা প্রদান করূন" value="<?php echo $setup_info->thana;?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Thana English" class="col-sm-3 col-sm-offset-1 control-label">থানা/উপজেলা (ইংরেজীতে)</label>
									<div class="col-sm-6">
										<input type="text" name="thana_english" id="thana_english" class="form-control medium-font-inupt" placeholder="থানা/উপজেলা ইংরেজিতে  প্রদান করূন" value="<?php echo $setup_info->thana_english;?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="District" class="col-sm-3 col-sm-offset-1 control-label">জেলা (বাংলায়)</label>
									<div class="col-sm-6">
										<input type="text" name="district" id="district" class="form-control medium-font-inupt" placeholder="জেলা প্রদান করূন" value="<?php echo $setup_info->district;?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="District English" class="col-sm-3 col-sm-offset-1 control-label">জেলা (ইংরেজীতে)</label>
									<div class="col-sm-6">
										<input type="text" name="district_english" id="district_english" class="form-control medium-font-inupt" placeholder="জেলা ইংরেজিতে  প্রদান করূন" value="<?php echo $setup_info->district_english;?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Postal code" class="col-sm-3 col-sm-offset-1 control-label"> পোস্টাল কোড (ইংরেজীতে)</label>
									<div class="col-sm-6">
										<input type="text" name="postal_code" id="postal_code" class="form-control medium-font-inupt" placeholder="পোস্টাল কোড  প্রদান করূন" value="<?php echo $setup_info->postal_code;?>" />
										<span class="sub-hints">যেমন: সানুড়া-২২০০</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Union code" class="col-sm-3 col-sm-offset-1 control-label"> ইউনিয়ন কোড (ইংরেজীতে)</label>
									<div class="col-sm-6">
										<input type="text" name="union_code" id="union_code" class="form-control medium-font-inupt" placeholder="আপনার ইউনিয়ন পরিষদের ইউনিক কোড প্রদান করুন " onkeypress="return isNumber(event);" value="<?php echo $setup_info->union_code;?>" />
										<span class="sub-hints"> জেলা কোড, উপজেলা কোড, ইউনিয়ন কোড এক সাথে। যেমন: 1252929</span>
									</div>
									<div class="col-sm-2"> 
										<span id="error1" style="color:red;font-size:14px;"></span>
										<span id="error2" style="color:green;font-size:14px;"></span>
									</div>
								</div>
							</div>
						</div>
							<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Union code" class="col-sm-3 col-sm-offset-1 control-label"> উপজেলা কোড (ইংরেজীতে)</label>
									<div class="col-sm-6">
										<input type="text" name="upazila_code" id="union_code" class="form-control medium-font-inupt" placeholder="আপনার উপজেলা কোড প্রদান করুন " onkeypress="return isNumber(event);" maxlength='7' minlength='4' value="<?php echo $setup_info->upazila_code;?>" />
										<span class="sub-hints">যেমন: জেলা কোড, উপজেলা কোড এক সাথে।যেমন: 2529</span>
									</div>
									
									<div class="col-sm-2"> 
										<span id="error1" style="color:red;font-size:14px;"></span>
										<span id="error2" style="color:green;font-size:14px;"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Mobile" class="col-sm-3 col-sm-offset-1 control-label">চেয়ারম্যান এর মোবাইল নাম্বার (ইংরেজীতে)</label>
									<div class="col-sm-6">
										<input type="text" name="mobile" id="mobile" class="form-control medium-font-inupt" placeholder="মোবাইল নম্বর  প্রদান করূন" maxlength="11" value="<?php echo $setup_info->mobile;?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Phone" class="col-sm-3 col-sm-offset-1 control-label">সচিব  এর মোবাইল নাম্বার(ইংরেজীতে)  </label>
									<div class="col-sm-6">
										<input type="text" name="phone" id="phone" class="form-control medium-font-inupt" placeholder="ফোন নম্বর প্রদান করূন" maxlength="11" value="<?php echo $setup_info->phone;?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Email" class="col-sm-3 col-sm-offset-1 control-label">ই-মেইল  </label>
									<div class="col-sm-6">
										<input type="text" name="email" id="email" class="form-control medium-font-inupt" placeholder="ই-মেইল প্রদান করূন" value="<?php echo $setup_info->email;?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Web link" class="col-sm-3 col-sm-offset-1 control-label">ওয়েব সাইট লিঙ্ক(ইংরেজীতে)</label>
									<div class="col-sm-6">
										<input type="text" name="web_link" id="web_link" class="form-control medium-font-inupt" placeholder="ওয়েব সাইট ‍ লিঙ্ক প্রদান করূন" value="<?php echo "www.".$this->web->getUrl();?>" readonly />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-offset-4 col-sm-1">
								<input type="hidden" name="id" value="<?php echo $setup_info->id;?>" />
								<input type='submit' value="আপডেট করুন" name='submit_btn' class="btn btn-info btn-sm"/>
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