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
			.all-input-form label>span{
				color:red;
			}
		</style>
		<script type="text/javascript">
			// for validation .............
			function validation(){
				var full_name=document.getElementById('full_name').value;
				var father_name=document.getElementById('father_name').value;
				var gram=document.getElementById('gram').value;
				var word_no=document.getElementById('word_no').value;
				var dofb=document.getElementById('dofb').value;
				var pattern = /^[\s()+-]*([0-9][][০-৯][\s()+-]*){6,20}$/;

				if(full_name==''){
					document.getElementById('error').innerHTML='দয়া করে নাম প্রদান করূন';
					return false;
				}
				else if(father_name==''){
					document.getElementById('error').innerHTML="দয়া করে পিতার নাম প্রদান করুন";
					return false;
				}
				else if(gram==''){
					document.getElementById('error').innerHTML="দয়া করে গ্রামের নাম প্রদান করুন";
					return false;
				}
				else if(word_no==''){
					document.getElementById('error').innerHTML="দয়া করে ওয়ার্ড নং প্রদান করুন";
					return false;
				}
				else if(dofb==''){
					document.getElementById('error').innerHTML='দয়া করে জম্ম তারিখ প্রদান করুন ।';
					return false;
				}


				else {
					return true;
				}
			}
			
			// for images upload........
			var loadFile=function(event){
				var output=document.getElementById("image");
				output.src=URL.createObjectURL(event.target.files[0]);
			};
		</script>
		<script>
			$(function() {
				$( "#dofb" ).datepicker({
					changeMonth: true,
					changeYear: true,
					autoSize: true,
					dateFormat: 'dd-mm-yy'
				});
			});
		</script>
		<!-- some information query -->
		<div class="row">
			<div class="col-md-12"> 
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">আপনার ইউনিয়ন পরিষদের বয়স্ক ভাতা প্রাপ্তদের তথ্য যোগ করুন</div>
					<div class="panel-body all-input-form">
						<div class="row" style="margin-bottom: 10px;"> 
							<div class="col-sm-3 pull-right"> 
								<a href="Manage/unionPorishad">
									<button type="button" class="btn-success btn-sm pull-right">বয়স্ক ভাতা প্রাপ্তদের তালিকা</button>
								</a>
							</div>
						</div>
						<form action="Manage/addOldmanstipend_action" method="post" onsubmit="return validation();" id="fixedInputTest" enctype="multipart/form-data" class="form-horizontal">
							
							<div class="row"> 
								<div class="col-sm-12"> 
									<div class="form-group"> 
										<div class="col-sm-6 col-sm-offset-3" id="UPLOAD"> 
											<img src="img/default/default.jpg" id="image" name="pic" class="img-thumbnail" style="height:160px;width:180px;" />
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Picture" class="col-sm-3 control-label">ছবি</label>
										<div class="col-sm-6">
											<input type="file" name="picture" id="pic" title="please select images" class="form-control input-file-sm" onchange="loadFile(event)" />
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Full Name" class="col-sm-3 control-label">নাম  <span>*</span></label>
										<div class="col-sm-6">
											<input type="text" name="full_name" id="full_name" class="form-control medium-font-inupt fixed_test_valid"placeholder=" নাম প্রদান করূন" />
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Father Name" class="col-sm-3 control-label">পিতার নাম  <span>*</span></label>
										<div class="col-sm-6">
											<input type="text" name="father_name" id="father_name" class="form-control medium-font-inupt fixed_test_valid" placeholder=" পিতার নাম প্রদান করূন " />
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="National id" class="col-sm-3 control-label">জাতীয় পরিচয়পত্র নং</label>
										<div class="col-sm-6">
											<input type="text" name="n_id" id="n_id"  class="form-control medium-font-inupt" placeholder="জাতীয় পরিচয় পত্র  নম্বর   প্রদান করূন"  />
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Village" class="col-sm-3 control-label">গ্রাম(বাংলায়)<span>*</span></label>
										<div class="col-sm-6">
											<input type="text" name="gram" id="gram"  class="form-control medium-font-inupt fixed_test_valid" placeholder="গ্রাম প্রদান করূন"  />
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Word no" class="col-sm-3 control-label">ওয়ার্ড নং<span>*</span></label>
										<div class="col-sm-6">
											<input type="text" name="word_no" id="word_no"  class="form-control medium-font-inupt fixed_test_valid" placeholder="ওয়ার্ড নং প্রদান করূন"  />
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Mobile" class="col-sm-3 control-label">মোবাইল  </label>
										<div class="col-sm-6">
											<input type="text" name="mobile" id="mobile" class="form-control medium-font-inupt" placeholder="মোবাইল নম্বর  প্রদান করূন" maxlength="11" />
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Date of birth" class="col-sm-3 control-label">জম্ম তারিখ   <span>*</span></label>
										<div class="col-sm-6">
											<input type='text' name='dofb' id='dofb' class="form-control medium-font-inupt fixed_test_valid" placeholder="01-01-1980 জম্ম তারিখ প্রদান করুন ।" />
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-offset-3 col-sm-1"> 
									<input type='submit' value="যোগ করুন" name='oldmanstipend_add' class="btn btn-info btn-sm"/>
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
