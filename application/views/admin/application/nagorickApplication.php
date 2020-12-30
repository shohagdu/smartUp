<div id="content" class="col-lg-10 col-sm-10">
	<style type="text/css"> 
		.app-heading{
			margin-top:20px;
			margin-bottom:20px;
			text-align:center;
			font-weight:900;
			text-decoration:underline;
			font-size:16px;
			font-style:normal;
			padding-left: 10%;
		}
		.app-sub-heading{
			margin-top: 10px;
			margin-bottom: 10px;
			font-size:14px;
			font-style:normal;
			font-weight:700;
			text-align:center;
		}
		#comment{
			resize:none;
		}
		.button-style{
			margin-bottom:30px;
			margin-top: 10px;
		}
		.all-input-form label{
			color: #413839;
			opacity:0.9;
		}
		.all-input-form label>span{
			color:red;
		}
		.all-input-form input[type="text"], input[type="file"]{
			color: #0C090A;
			font-size:13px;
			font-weight:500;
		}
		#attachment{
			resize:none;
			color: #0C090A;
			font-size:14px;
			font-weight:400;
		}
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
		/*========== reday function start ===========*/
		/*============== ajax request function start =========*/
		$(document).ready(function(){
			$("#wife").hide();
			$("#husband").hide();

            $('#nagorickApplicationId').submit(function(e) {
                var test = validationForm();
                if(test) {
                    $("#load").empty().append('<img src="library/img/ajaxloader.gif">');
                    var $form = $(e.target),
                        fv = $form.data('formValidation');
                    var formData = new FormData(this);
                    $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            alert('ধন্যবাদ! তথ্য  আপডেট এর কাজ চলমান....');
                        },
                        success: function (data) {
                            if(data==1)
                            {
                                alert('আপনার আবেদনটি গৃহীত হয়েছে');
                                setTimeout(function() {
                                    window.location='Applicant/nagorickapplicant?napply=new';}, 1000)
                            }
                            else if(data==2)
                            {
                                alert('দুঃখিত আপানর জাতিয় পরিচয়পত্র নং পূর্বে ব্যাবহার করা হয়েছে ');
                            }
                            else if(data==3)
                            {
                                alert('দুঃখিত আপানর জন্ম নিবধন নং পূর্বে ব্যাবহার করা হয়েছে ');
                            }
                            else if(data==4)
                            {
                                alert('দুঃখিত আপানর পাসপোর্ট নং পূর্বে ব্যাবহার করা হয়েছে ');
                            }
                            else if(data==6)
                            {
                                alert('দুঃখিত আপানর মোবাইল নাম্বারটি পূর্বে ব্যাবহার করা হয়েছে.');
                            }
                            else if(data==5)
                            {
                                alert('দয়া করে আপনার সঠিক মোবাইল নাম্বারটি ব্যাবহার করুন');
                            }
                            else{
                                alert(data);
                            }
                        }
                    });
                }
                return false;
            });
            //
			// $('#nagorickApplicationId').submit(function() {
            //
			// 	var test = validationForm();
			// 	if(test){
			// 		$("#load").empty().append('<img src="library/img/ajaxloader.gif">');
			// 		$.post(
			// 		"index.php/Applicant/nagorickapplication_action",
			// 		$("#nagorickApplicationId").serialize(),
			// 		function(data){
			// 			if(data==1)
			// 			{
			// 				alert('আপনার আবেদনটি গৃহীত হয়েছে');
			// 				setTimeout(function() {
			// 				window.location='Applicant/nagorickapplicant?napply=new';}, 1000)
			// 			}
			// 			else if(data==2)
			// 			{
			// 				alert('দুঃখিত আপানর জাতিয় পরিচয়পত্র নং পূর্বে ব্যাবহার করা হয়েছে ');
			// 			}
			// 			else if(data==3)
			// 			{
			// 				alert('দুঃখিত আপানর জন্ম নিবধন নং পূর্বে ব্যাবহার করা হয়েছে ');
			// 			}
			// 			else if(data==4)
			// 			{
			// 				alert('দুঃখিত আপানর পাসপোর্ট নং পূর্বে ব্যাবহার করা হয়েছে ');
			// 			}
			// 			else if(data==6)
			// 			{
			// 				alert('দুঃখিত আপানর মোবাইল নাম্বারটি পূর্বে ব্যাবহার করা হয়েছে.');
			// 			}
			// 			else if(data==5)
			// 			{
			// 				alert('দয়া করে আপনার সঠিক মোবাইল নাম্বারটি ব্যাবহার করুন');
			// 			}
			// 			else{
			// 				alert(data);
			// 			}
			// 		});
			// 	}
			// 	return false;
			// });
		});
		/*============== ajax request function end =========*/
		/*========== reday function  end===========*/
		
		

		
		/*=========onload function start=============*/
		 function onload_hide_fun(){
			  // call this function body onload event
			  $("#wife").hide();
			  $("#husband").hide();
			  $("#print").hide();
			   $(".bname").bnKb({
					'switchkey': {"webkit":"k","mozilla":"y","safari":"k","chrome":"k","msie":"y"},
					'driver': phonetic
				});
			 }
		/*=========onload function end=============*/
		/*================== bashinda hide show function start ==========*/
		function basinda_show_hide(v){
			//alert(v);
			if(v==2){
				$("#permaHeading").hide();
				$("#permanentAddress").hide();
				$("#permanentAddress input:text").val('');
			}
			else{
				$("#permaHeading").show();
				$("#permanentAddress").show();
			}
			
		}
		/*================== bashinda hide show function end ==========*/
		
		/*========  bibhahik obstha hide show function start ============*/
			/* 1st function */
			function bybahik_obosthan_show(mstatus){
				//alert(mstatus);
				var gender=$("#gender:checked").val();
				if(mstatus=='1' && gender=='male'){
					//alert("wife id show");
					$("#wife").show();
					$("#husband input:text").val('');
					$("#husband").hide();
				}
				else if(mstatus=='1' && gender=='female'){
					//alert("husband id show");
					$("#husband").show();
					$("#wife input:text").val('');
					$("#wife").hide();
				}
				else if(mstatus=='2' && gender=='female'){
					//alert("father id show");
					$("#husband").hide();
					$("#wife").hide();
				}
				else if(mstatus=='2' && gender=='male'){
					//alert("father id show");
					$("#husband").hide();
					$("#wife").hide();
				}
				else{
					$("#husband").hide();
					$("#wife").hide();
				}
			}
			/* ===2nd function  ===*/
			function bybahik_obosthan_show1(gender){
				var mstatus= $("#mstatus:checked").val();
				if(mstatus=='1' && gender=='male'){
					//alert("wife id show");
					$("#wife").show();
					$("#husband input:text").val('');
					$("#husband").hide();
				}
				else if(mstatus=='1' && gender=='female'){
					//alert("husband id show");
					$("#husband").show();
					$("#wife input:text").val('');
					$("#wife").hide();
				}
				else if(mstatus=='2' && gender=='female'){
					//alert("father id show");
					$("#husband").hide();
					$("#wife").hide();
				}
				else if(mstatus=='2' && gender=='male'){
					//alert("father id show");
					$("#husband").hide();
					$("#wife").hide();
				}
				else{
					$("#husband").hide();
					$("#wife").hide();
				}
			}
			
		/*========  bibhahik obstha hide show function end ============*/
		
		
		
		/*============ number test function start ===============*/
		function numtest(){
			return event.charCode >= 48 && event.charCode <= 57;
		}
		/*============ number test function end===============*/
	</script>
	<script type="text/javascript"> 
		function validationForm(){
			var v1 = document.getElementById('bs').value;
			if(v1==1){
				var villageEnglish = document.getElementById('per_gram').value;
				var wordnoEnglish = document.getElementById('per_wordno').value;
				var disEnglish = document.getElementById('per_dis').value;
				var thanaEnglish = document.getElementById('per_thana').value;
				var postofficeEnglish = document.getElementById('postof').value;
				
				var villageBangla = document.getElementById('perb_gram').value;
				var wordnoBangla = document.getElementById('perb_wordno').value;
				var disBangla = document.getElementById('perb_dis').value;
				var thanaBangla = document.getElementById('perb_thana').value;
				var postofficeBangla = document.getElementById('perb_postof').value;
				
				if((villageEnglish=="")){
					alert("আপনার স্থায়ী তথ্যগুলো সঠিক ভাবে প্রদান করুন ।");
					return false;
				}
				else { 
					return true;
				}
			}
			else { 
				return true;
			}
		}
	</script>
	
	<script>
		$(function() {
			$( "#dofb" ).datepicker({ dateFormat: 'dd/mm/yy' });
		});
	</script>
	<!-- some information query -->
	<div class="row">
		<div class="col-md-12"> 
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">নাগরিক আবেদন ফরম</div>
				<div class="panel-body all-input-form">

				
					<form action="index.php/Applicant/nagorickapplication_action" method="post" id="nagorickApplicationId" enctype="multipart/form-data" class="form-horizontal">
                        <div class="row"  style="margin-top: 10px;">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="Picture" class="col-sm-3 control-label">ছবি</label>
                                    <div class="col-sm-5" style="margin-top:3px;">
                                        <input type="file" name="file" class="form-control input-file-sm" />
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="row"> 
							<div class=" col-sm-offset-3 col-sm-9" id="UPLOAD">
                                <img src="<?php echo base_url('library/profile/default.jpg') ?>" id="image" width="180"  height="170" class="img-thumbnail" />

							</div>
						</div>
						
						<div class="row medium-font"> 
							<div class="col-sm-12" style="margin-bottom:10px;margin-top:10px;"> 
								<div class="form-group">
									<label for="Delivery-type" class="col-sm-3 control-label">সরবরাহের ধরণ  <span>*</span></label>
									<div class="col-sm-9">
										<label class="radio-inline"><input type="radio" name="delivery_type" value="1">জরুরী</label>
										<label class="radio-inline"><input type="radio" name="delivery_type" value="2">অতি জরুরী  </label>
										<label class="radio-inline"><input type="radio" name="delivery_type" value="3" checked="checked"> সাধারন</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="National-id-english" class="col-sm-3 control-label">ন্যাশনাল আইডি (ইংরেজিতে)  </label>
									<div class="col-sm-3">
										<input type="text" name="nationid" id="nid" class="form-control medium-font-inupt" maxlength='17' onkeypress="return numtest();" value="" />
									</div>
									<label for="Birth-no" class="col-sm-3 control-label">জন্ম নিবন্ধন নং ( ইংরেজিতে ) </label>
									<div class="col-sm-3">
										<input type="text" name="bcno" id="bcno" class="form-control medium-font-inupt" maxlength="17" onkeypress="return numtest();" value="" />
									</div>
								</div>
							</div>
						</div>
					
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Passport-no" class="col-sm-3 control-label">পাসপোর্ট নং ( ইংরেজিতে ) </label>
									<div class="col-sm-3">
										<input type="text" name="pno" id="pno" class="form-control medium-font-inupt" maxlength='17' onkeypress="return numtest();" value="" />
									</div>
									<label for="Birth-date" class="col-sm-3 control-label">জম্ম তারিখ  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="dofb" id="dofb" class="form-control medium-font-inupt" value='' required />
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Name-english" class="col-sm-3 control-label">নাম ( ইংরেজিতে )   <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="ename" id="name" class="form-control medium-font-inupt" value="" required />
									</div>
									<label for="Name-bangla" class="col-sm-3 control-label">নাম ( বাংলায় )  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bname" id="bname" class="form-control medium-font-inupt" value="" required />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Gender" class="col-sm-3 control-label">লিঙ্গ   <span>*</span></label>
									<div class="col-sm-3">
										<label class="radio-inline"><input type="radio" name="gender" id="gender" value="male" onclick="bybahik_obosthan_show1(this.value);" />পুরুষ </label>
										<label class="radio-inline"><input type="radio" name="gender" id="gender" value="female" onclick="bybahik_obosthan_show1(this.value);" />মহিলা</label>
									</div>
									<label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক   <span>*</span></label>
									<div class="col-sm-3">
										<label class="radio-inline"><input type="radio" name="mstatus" id="mstatus" value="1" onclick="bybahik_obosthan_show('1');">বিবাহিত </label>
										<label class="radio-inline"><input type="radio" name="mstatus" id="mstatus" value="2" onclick="bybahik_obosthan_show('2');">অবিবাহিত</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font" id="wife" style="">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Wife-name-english" class="col-sm-3 control-label">স্ত্রীর  নাম (ইংরেজিতে) </label>
									<div class="col-sm-3">
										<input type="text" name="eWname" id="eWname" class="form-control medium-font-inupt" value="" />
									</div>
									<label for="Wife-name-bangla" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়)</label>
									<div class="col-sm-3">
										<input type="text" name="bWname" id="bWname" class="form-control medium-font-inupt" value="" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font" id="husband" style="">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Husband-name-english" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
									<div class="col-sm-3">
										<input type="text" name="eHname" id="eHname" class="form-control medium-font-inupt" value="" />
									</div>
									<label for="Husband-name-bangla" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়)</label>
									<div class="col-sm-3">
										<input type="text" name="bHname" id="bHname" class="form-control medium-font-inupt" value="" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Father-name-english" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="efname" id="efname" class="form-control medium-font-inupt" value="" required />
									</div>
									<label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (বাংলায়)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bfname" id="bfname" class="form-control medium-font-inupt" value="" required />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="emname" id="mname" class="form-control medium-font-inupt" value="" required />
									</div>
									<label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bmane" id="emane" class="form-control medium-font-inupt" value="" required />
									</div>
								</div>
							</div>
						</div>
					
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="profession" class="col-sm-3 control-label">পেশা</label>
									<div class="col-sm-3">
										<input type="text" name="ocupt" id="occupation" class="form-control medium-font-inupt" value="" />
									</div>
									<label for="Education-qualification" class="col-sm-3 control-label">শিক্ষাগত যোগ্যতা</label>
									<div class="col-sm-3">
										<input type="text" name="qualification" id="qualification" class="form-control medium-font-inupt" value="" />
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Religion" class="col-sm-3 control-label">ধর্ম    <span>*</span></label>
									<div class="col-sm-3">
										<select name="religion" class="form-control" required >
											<option value='ইসলাম'>ইসলাম</option>
											<option value='হিন্দু'>হিন্দু</option>
											<option value='বৌদ্ধ ধর্ম'>বৌদ্ধ ধর্ম</option>
											<option value='খ্রিস্ট ধর্ম'>খ্রিস্ট ধর্ম</option>
											<option value='অন্যান্য'>অন্যান্য</option>
										</select>
									</div>
									<label for="Resident" class="col-sm-3 control-label"> হোল্ডিং নম্বর <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="holding_no" id="holding_no" class="form-control" maxlength='10'  onkeypress="return numtest();" placeholder="" required />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Resident" class="col-sm-3 control-label">বাসিন্দা    <span>*</span></label>
									<div class="col-sm-3">
										<select name="bashinda" id='bs' class="form-control" onchange="basinda_show_hide(this.value);" required >
											<option value='1'>অস্থায়ী</option>
											<option value='2'>স্থায়ী</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="app-heading"> 
									বর্তমান ঠিকানা
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-6">
								<div class="col-sm-offset-6 col-sm-6">
									<div class="app-sub-heading"> 
										( ইংরেজিতে )
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District-english" class="col-sm-6 control-label">জেলা </label>
											<div class="col-sm-6">
												<input type="text" name="p_dis" id="p_dis" class="form-control medium-font-inupt" value=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-english" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="p_thana" id="p_thana" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-english" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="p_postof" id="p_postof" class="form-control medium-font-inupt" value=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-english" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="p_wordno" id="p_wordno" class="form-control medium-font-inupt" onkeypress="return numtest();"  value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-block-sector-english" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="p_rbs" id="p_rbs" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-english" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="p_gram" id="p_gram" class="form-control medium-font-inupt" value=""/>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="col-sm-offset-6 col-sm-6">
									<div class="app-sub-heading"> 
										( বাংলায় )
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District-bangla" class="col-sm-6 control-label">জেলা </label>
											<div class="col-sm-6">
												<input type="text" name="pb_dis" id="pb_dis" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="pb_thana" id="pb_thana" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="pb_postof" id="pb_postof" class="form-control medium-font-inupt" value=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="pb_wordno" id="pb_wordno" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-block-sector-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="pb_rbs" id="pb_rbs" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="pb_gram" id="pb_gram" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row" id="permaHeading" style="">
							<div class="col-sm-12" style="text-align:center;"> 
								<div class="app-heading"> 
									স্থায়ী  ঠিকানা
								</div>
							</div>
						</div>
						
						<div class="row" id="permanentAddress" style="">
							<div class="col-sm-6">
								<div class="col-sm-offset-6 col-sm-6">
									<div class="app-sub-heading"> 
										( ইংরেজিতে )
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District-english" class="col-sm-6 control-label">জেলা <span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="per_dis" id="per_dis" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-english" class="col-sm-6 control-label">উপজেলা/থানা<span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="per_thana" id="per_thana" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-english" class="col-sm-6 control-label">পোষ্ট অফিস  <span>*</span></label>
											<div class="col-sm-6">
												<input type="text" name="per_postof" id="postof" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-english" class="col-sm-6 control-label">ওয়ার্ড নং<span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="per_wordno" id="per_wordno" class="form-control medium-font-inupt" onkeypress="return numtest();" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-block-sector-english" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="per_rbs" id="per_rbs" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-english" class="col-sm-6 control-label">গ্রাম/মহল্লা <span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="per_gram" id="per_gram" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="col-sm-offset-6 col-sm-6">
									<div class="app-sub-heading"> 
										( বাংলায় )
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District-bangla" class="col-sm-6 control-label">জেলা  <span>*</span></label>
											<div class="col-sm-6">
												<input type="text" name="perb_dis" id="perb_dis" class="form-control medium-font-inupt" value=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা<span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="perb_thana" id="perb_thana" class="form-control medium-font-inupt" value=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস <span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="perb_postof" id="perb_postof" class="form-control medium-font-inupt" value=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং <span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="perb_wordno" id="perb_wordno" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-block-sector-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="perb_rbs" id="perb_rbs" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা <span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="perb_gram" id="perb_gram" class="form-control medium-font-inupt" value="" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-sm-12" style="text-align:center;"> 
								<div class="app-heading"> 
									যোগাযোগের ঠিকানা
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Mobile" class="col-sm-3 control-label">মোবাইল    <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="mob" id="mob" class="form-control medium-font-inupt" maxlength="11" value="" onkeypress="return numtest();"  required />
									</div>
									<label for="Email" class="col-sm-3 control-label">ইমেল </label>
									<div class="col-sm-3">
										<input type="text" name="email" id="email" class="form-control medium-font-inupt" value="" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Designation" class="col-sm-3 control-label">সংযুক্তি (যদি থাকে)</label>
									<div class="col-sm-9">
										<textarea name="attachment" class="form-control medium-font-inupt" rows="5" id="attachment" placeholder="উদাহরন: মুক্তিযোদ্ধা সন্তান, বিধবা, উপজাতি .....ইত্যাদি"></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-offset-6 col-sm-6 button-style"> 
								<input type='submit' value="দাখিল করুন" name='save' class="btn btn-info btn-sm"/>
								<span id="load"></span>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!-- row end--->
</div><!--/#content.col-md-10-->
