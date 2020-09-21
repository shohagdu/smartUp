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
			var full_name=document.getElementById('full_name').value.trim();
			//var n_id=document.getElementById('n_id').value;
			var desi=document.getElementById('desi').value.trim();
			var mobile=document.getElementById('mobile').value.trim();
			var dofb=document.getElementById('dofb').value.trim();
			var district=document.getElementById('district').value.trim();
			//var qualification=document.getElementById('qualification').value;
			var ac=document.getElementById('status1');
			var dac=document.getElementById('status2');
			var pattern = /^[\s()+-]*([0-9][][০-৯][\s()+-]*){6,20}$/;
			
			if(full_name==''){
				document.getElementById('error').innerHTML='দয়া করে আপনার নাম প্রদান করূন';
				return false;
			}
			else if(desi==''){
				document.getElementById('error').innerHTML= "দয়া করে পদবী/Designation সিলেক্ট করুন ।";
				return false;
			}	
			else if(ac.checked==false && dac.checked==false){
				document.getElementById('error').innerHTML=" দয়া করে Active, Inactive সিলেক্ট করুন ।";
				return false;
			}		
			else if(mobile==''){
				document.getElementById('error').innerHTML='মোবাইল নম্বর  প্রদান করূন';
				return false;
			}
			else if(dofb==''){
				document.getElementById('error').innerHTML='দয়া করে জম্ম তারিখ প্রদান করুন ।';
				return false;
			}

			/* else if (!(pattern.test(mobile))) {
			document.getElementById('error').innerHTML='মোবাইল নম্বর Invalid';
			return false;
			} */

			else if(district==''){
				document.getElementById('error').innerHTML="জেলা প্রদান করূন ";
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
			$( "#dofb,#dofb1" ).datepicker({
				changeMonth: true,
				changeYear: true,
				autoSize: true,
				dateFormat: 'dd-mm-yy'
			});
		});
	</script>
	<script type="text/javascript"> 
		$(document).ready(function(){
			$("#desi").change(function(){
				var designation = $("#desi").val();
				//alert(designation);
				if(designation==2){
					$("#barea_control").hide();
					$("#barea_control input:text").val("");
					$("#vno_control").hide();
					$("#vno_control input:text").val("");
				}
				else if(designation==4){
					$("#barea_control").hide();
					$("#barea_control input:text").val("");
					$("#vno_control").hide();
					$("#vno_control input:text").val("");
				}
				else if(designation==5){
					$("#barea_control").hide();
					$("#barea_control input:text").val("");
					$("#vno_control").hide();
					$("#vno_control input:text").val("");
				}
				else{
					$("#barea_control").show();
					$("#vno_control").show();
				}
			});
		});
	</script>
	<!-- some information query -->
	<div class="row">
		<div class="col-md-12"> 
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">ইউপি চেয়ারম্যান, মেম্বার ও কর্মচারীরদের তথ্য যোগ করুন</div>
				<div class="panel-body all-input-form">
					<div class="row" style="margin-bottom: 10px;"> 
						<div class="col-sm-3 pull-right"> 
							<a href="Manage/webSiteUpMemberList">
								<button type="button" class="btn-success btn-sm pull-right">ইউপি কর্মকর্তা ও কর্মচারীর তালিকা</button>
							</a>
						</div>
					</div>
					<form action="Manage/webSiteUpMemberAdd_action" method="post" onsubmit="return validation();" id="fixedInputTest" enctype="multipart/form-data" class="form-horizontal">
						
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
										<input type="text" name="full_name" id="full_name" class="form-control medium-font-inupt fixed_test_valid"placeholder="নাম প্রদান করূন" />
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
									<label for="Designation" class="col-sm-3 control-label">পদবী  <span>*</span></label>
									<div class="col-sm-4">
										<select name="designation" id="desi" class="form-control medium-font-inupt fixed_test_valid">
											<option value="" style="" >পদবী/Designation সিলেক্ট করুন </option>
											<option value="1"> ইউপি চেয়ারম্যান </option>
											<option value="2">সচিব</option>
											<option value="3">মেম্বার</option>
											<option value="4">উদ্যোক্তা</option>
											<option value="5">গ্রামপুলিশ</option>
										</select>
									</div>
									<div class="col-sm-3">
										<label class="radio-inline"><input type="radio" name="status" id="status1" value="1">Active</label>
										<label class="radio-inline"><input type="radio" name="status" id="status2" value="0">Inactive <span>*</span></label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Mobile" class="col-sm-3 control-label">মোবাইল    <span>*</span></label>
									<div class="col-sm-6">
										<input type="text" name="mobile" id="mobile" class="form-control medium-font-inupt fixed_test_valid" placeholder="মোবাইল নম্বর  প্রদান করূন" maxlength="11" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="email" class="col-sm-3 control-label">ই-মেইল  </label>
									<div class="col-sm-6">
										<input type="text" name="email" id="email" class="form-control medium-font-inupt" placeholder="ই-মেইল প্রদান করূন" />
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
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Metrial Status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক</label>
									<div class="col-sm-6">
										<label class="radio-inline"><input type="radio" name="mstatus" id="mstatus" value="1">বিবাহিত</label>
										<label class="radio-inline"><input type="radio" name="mstatus" id="mstatus" value="2">অবিবাহিত</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Home District" class="col-sm-3 control-label">নিজ জেলা  <span>*</span></label>
									<div class="col-sm-6">
										<input type="text" name="district" id="district" class="form-control  medium-font-inupt fixed_test_valid" placeholder="জেলা প্রদান করূন" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Education Qualification" class="col-sm-3 control-label">শিক্ষাগত যোগ্যতা</label>
									<div class="col-sm-6">
										<input type="text" name="qualification" id="qualification" class="form-control medium-font-inupt" placeholder="শিক্ষাগত যোগ্যতা প্রদান করুন ।"/>
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Joining Date" class="col-sm-3 control-label">চাকুরীতে যোগদানের  তারিখ</label>
									<div class="col-sm-6">
										<input type='text' name='joindate' id='dofb1' placeholder="01-01-1980 চাকুরীতে যোগদানের  তারিখ প্রদান করুন ।"  class="form-control medium-font-inupt" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font" id="barea_control">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Area name" class="col-sm-3 control-label">নির্বাচনী এলাকার নাম</label>
									<div class="col-sm-6">
										<input type="text" name="barea" id="barea" class="form-control medium-font-inupt" placeholder="নির্বাচনী এলাকার নাম  প্রদান করূন" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font" id="vno_control">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Seat no" class="col-sm-3 control-label">নির্বাচনী ওয়ার্ড নং</label>
									<div class="col-sm-6">
										<input type="text" name="vno" id="vno" class="form-control medium-font-inupt" placeholder="নির্বাচনী ওয়ার্ড নং প্রদান করূন" />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-offset-3 col-sm-1"> 
								<input type='submit' value="যোগ করুন" name='profile_setup' class="btn btn-info btn-sm"/>
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