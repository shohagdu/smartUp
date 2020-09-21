<div id="content" class="col-lg-10 col-sm-10">
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
	<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>library/voterAdd.js"></script>
	<style type="text/css"> 
		@-moz-document url-prefix() {
			.input-file-sm {
				height: auto;
				padding-top: 2px;
				padding-bottom: 1px;
			}
		}
		.medium-font{
			font-size: 13px;
			font-weight: normal;
		}
		.medium-font-inupt{
			font-size: 14px !important;
			letter-spacing: 0px;
			color: #333 !important;
		}
		.all-input-form label>span{
			color:red;
		}
	</style>
	<!-- some information query -->
	<div class="row">
		<div class="col-md-12"> 
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">আপনার ইউনিয়ন পরিষদের ভোটারের তথ্য যোগ করুন</div>
				<div class="panel-body all-input-form">
					<div class="row" style="margin-bottom: 10px;"> 
						<div class="col-sm-3 pull-right"> 
							<a href="Manage/unionPorishad">
								<button type="button" class="btn-success btn-sm pull-right">ভোটারদের তালিকা</button>
							</a>
						</div>
					</div>
					<form action="Manage/addVoter_action" method="post" onsubmit="return validation();" id="voterActionId" enctype="multipart/form-data" class="fixedInputTestClass form-horizontal">
						
						<div class="row"> 
							<div class="col-sm-12"> 
								<div class="form-group" id="img_div" style="display: none;"> 
									<div class="col-sm-6 col-sm-offset-3" id="UPLOAD"> 
										<img src="img/default/default.jpg" id="image" name="pic" class="img-thumbnail" style="height:180px;width:180px;" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Picture" class="col-sm-2 control-label">ছবি</label>
									<div class="col-sm-4">
										<input type="file" name="picture" id="pic" title="please select images" class="form-control input-file-sm" onchange="loadFile(event)" />
									</div>
									<label for="nid" class="col-sm-2 control-label">ন্যাশনাল আইডি  <span>*</span></label>
									<div class="col-sm-4"> 
										<input type="text" name="national_id" id="national_id" maxlength="17" minlength="17" class="form-control medium-font-inupt fixed_test_valid"   onkeypress="return checkaccnumber(event);" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Full Name Bangla" class="col-sm-2 control-label">নাম  (বাংলায়)<span>*</span></label>
									<div class="col-sm-4">
										<input type="text" name="bangla_name" id="full_name_bangla" class="form-control medium-font-inupt fixed_test_valid" placeholder="বাংলায় ভোটারের নাম প্রদান করূন" />
									</div>
									<label for="Full Name English" class="col-sm-2 control-label">নাম  (ইংরেজীতে)<span>*</span></label>
									<div class="col-sm-4"> 
										<input type="text" name="english_name" id="full_name_english" class="form-control medium-font-inupt fixed_test_valid" placeholder="ইংরেজীতে ভোটারের নাম প্রদান করূন"  />
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Father Name" class="col-sm-2 control-label">পিতা/স্বামীর নাম (বাংলায়)<span>*</span></label>
									<div class="col-sm-4">
										<input type="text" name="father_name" id="father_name" class="form-control medium-font-inupt fixed_test_valid" placeholder="পিতা/স্বামীর নাম নাম প্রদান করূন" />
									</div>
									<label for="Mother Name" class="col-sm-2 control-label">মাতার নাম (বাংলায়)<span>*</span></label>
									<div class="col-sm-4"> 
										<input type="text" name="mother_name" id="mother_name" class="form-control medium-font-inupt fixed_test_valid" placeholder="মাতার নাম প্রদান করূন"  />
									</div>
								</div>
							</div>
						</div>

						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Date of Birth" class="col-sm-2 control-label">জম্ম তারিখ  <span>*</span></label>
									<div class="col-sm-4"> 
										<input type='text' name='date_of_birth' id='dofb' class="form-control medium-font-inupt fixed_test_valid" placeholder="জম্ম তারিখ প্রদান করুন ।" />
									</div>
									<label for="Mobile Number" class="col-sm-2 control-label">মোবাইল</label>
									<div class="col-sm-4">
										<input type="text" name="mobile" id="mobile" class="form-control medium-font-inupt" placeholder="মোবাইল নম্বর ইংরেজীতে প্রদান করূন" maxlength="11"   onkeypress="return checkaccnumber(event);" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Basha Holding" class="col-sm-2 control-label">বাসা/হোল্ডিং <span>*</span></label>
									<div class="col-sm-4">
										<input type="text" name="basha" id="basha_holding" class="form-control medium-font-inupt fixed_test_valid" placeholder="" />
									</div>
									<label for="Word NO" class="col-sm-2 control-label">ওয়ার্ড নং <span>*</span></label>
									<div class="col-sm-4"> 
										<input type="text" name="word_no" id="word_no" class="form-control medium-font-inupt fixed_test_valid" placeholder="" onkeypress="return checkaccnumber(event);" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Gram" class="col-sm-2 control-label">গ্রাম <span>*</span></label>
									<div class="col-sm-4">
										<input type="text" name="gram" id="gram" class="form-control medium-font-inupt fixed_test_valid" placeholder="" />
									</div>
									<label for="Post Office" class="col-sm-2 control-label">পো: অফিস<span>*</span></label>
									<div class="col-sm-4"> 
										<input type="text" name="post_office" id="post_office" class="form-control medium-font-inupt fixed_test_valid" placeholder=""  />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Upzilla" class="col-sm-2 control-label">উপজেলা <span>*</span></label>
									<div class="col-sm-4">
										<input type="text" name="upzilla" id="upzilla" class="form-control medium-font-inupt fixed_test_valid" placeholder="" />
									</div>
									<label for="District" class="col-sm-2 control-label">জেলা <span>*</span></label>
									<div class="col-sm-4"> 
										<input type="text" name="district" id="district" class="form-control medium-font-inupt fixed_test_valid" placeholder=""  />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-offset-3 col-sm-1"> 
								<input type='submit' value="যোগ করুন" name="addVoter" class="btn btn-info btn-sm"/>
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
