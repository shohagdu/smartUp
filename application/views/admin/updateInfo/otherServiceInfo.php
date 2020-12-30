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
            $('#otherServiceInformationUpdate').submit(function(e) {
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
                                alert('আপনার আবেদনটি সঠিকভাবে পরিবর্তন করা হয়েছে');
                                setTimeout(function() {
                                    window.location='Applicant/otherService?napply=new';}, 1000)
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
            /*
			$('#otherServiceInformationUpdate').submit(function() {

				var test = validationForm();
				if(test){
					$("#load").empty().append('<img src="library/img/ajaxloader.gif">');
					$.post(
					"index.php/Update/otherServiceInfo",
					$("#otherServiceInformationUpdate").serialize(),
					function(data){
						if(data==1)
						{
							alert('আপনার আবেদনটি সঠিকভাবে পরিবর্তন করা হয়েছে');
							setTimeout(function() {
							window.location='Applicant/otherService?napply=new';}, 1000)
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
					});
				}
				return false;
			});

             */
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
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;"><?php echo $this->common->serviceNameShow($row->serviceId)->listName?> এর  তথ্য আপডেট করুন</div>
				<div class="panel-body all-input-form">

				
					<form action="index.php/Update/otherServiceInfo" method="post" id="otherServiceInformationUpdate" enctype="multipart/form-data" class="form-horizontal">
                        <div class="row"  style="margin-top: 10px;">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="Picture" class="col-sm-3 control-label">ছবি</label>
                                    <div class="col-sm-5" style="margin-top:3px;">
                                        <input type="file" name="file" onchange="loadFile(event)" class="form-control input-file-sm" />
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="row"> 
							<div class=" col-sm-offset-3 col-sm-9" id="UPLOAD">
								<img src="<?php echo $row->profile?>" id="image" width="180" height="170" class="img-thumbnail" />
								<input type='hidden' name='profile' value='<?php echo $row->profile?>'/>
							</div>
						</div>
						
						<div class="row"> 
							<div class="col-sm-6" style="margin-bottom:10px;margin-top:10px;"> 
								<div class="form-group">
									<label for="Delivery-type" class="col-sm-6 control-label">সরবরাহের ধরণ  <span>*</span></label>
									<div class="col-sm-6">
										<label class="radio-inline"><input type="radio" name="delivery_type" value="1" <?php if($row->delivery_type==1){echo "Checked";}?> >জরুরী</label>
										<label class="radio-inline"><input type="radio" name="delivery_type" value="2" <?php if($row->delivery_type==2){echo "Checked";}?>>অতি জরুরী  </label>
										<label class="radio-inline"><input type="radio" name="delivery_type" value="3" <?php if($row->delivery_type==3){echo "Checked";}?>> সাধারন</label>
									</div>
								</div>
							</div>
						</div>
						<?php 
							if($row->serviceId==13){
								$possoPart='display: block;';
								$otherPart='display: none;';
								$shortPart='display: none;';
							}else if($row->serviceId==12){
								$possoPart='display: none;';
								$shortPart='display: block;';
								$otherPart='display: none;';
							}else{
								$shortPart='display: none;';
								$possoPart='display: none;';
								$otherPart='display: block;';
							}
						?>
						<div id="other_info" style="<?php echo $otherPart;?>" > 
							<div class="row">
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Income Measured" class="col-sm-6 control-label">আয়ের পরিমান( ইংরেজিতে ) </label>
										<div class="col-sm-6">
											<input type="text" name="incomeAmount" id="incomeAmount" value="<?php echo $row->incomeAmount;?>" class="form-control"  onkeypress="return checkaccnumber(event);"  placeholder="" />
											<span class="sub-hints">বি.দ্র. : বার্ষিক আয়ের প্রত্যয়ন পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="Publish Name" class="col-sm-6 control-label">প্রকাশে নাম</label>
										<div class="col-sm-6">
											<input type="text" name="publishName" id="publishName" value="<?php echo $row->publishName;?>" class="form-control"  placeholder="" />
											<span class="sub-hints">বি.দ্র. : একই নামের প্রত্যয়ন পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Work Placed" class="col-sm-6 control-label">কর্ম ক্ষেত্রের নাম</label>
										<div class="col-sm-6">
											<input type="text" name="workPlace" id="workPlace" value="<?php echo $row->workPlace;?>" class="form-control"  placeholder="" />
											<span class="sub-hints">বি.দ্র. : অনুমতি পত্র এর জন্য! যেমন: পুলিশ.</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="Death-date" class="col-sm-6 control-label">মৃত্যু তারিখ </label>
										<div class="col-sm-6 date">
											<div class="input-group input-append date" id="deathPicker">
												<input type="date" class="form-control" name="ddfb" value="<?php echo $row->ddfb;?>" />
												<span class="sub-hints">বি.দ্র. : মৃত্যুর সনদ পত্রের জন্য</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div id="mukti_part_posso" style="<?php echo $possoPart;?>">
							<div class="row">
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="mukti name" class="col-sm-6 control-label">মুক্তিযোদ্ধার নাম</label>
										<div class="col-sm-6">
											<input type="text" name="mukti_name" id="mukti_name" class="form-control"  placeholder="" value="<?php echo $row->mukti_name?>" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="gejet no" class="col-sm-6 control-label">গেজেট নং</label>
										<div class="col-sm-6">
											<input type="text" name="gejet_no" id="gejet_no" class="form-control"  placeholder="ইংরেজিতে প্রদান করুন" value="<?php echo $row->gejet_no?>" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য! </span>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="mukti sonshod sonod no" class="col-sm-3 control-label">মুক্তিযোদ্ধা সংসদের সনদ নং</label>
										<div class="col-sm-9">
											<input type="text" name="m_sonshod_sonod" id="m_sonshod_sonod" class="form-control"  placeholder="" value="<?php echo $row->m_sonshod_sonod?>" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Sector No" class="col-sm-6 control-label">সেক্টর নং </label>
										<div class="col-sm-6">
											<input type="text" name="sector" id="sector" class="form-control"  placeholder="ইংরেজিতে প্রদান করুন" value="<?php echo $row->sector_no;?>" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Mukti sonod" class="col-sm-6 control-label">মুক্তিবার্তা নং </label>
										<div class="col-sm-6">
											<input type="text" name="mukti_sonod" id="mukti_sonod" class="form-control"  placeholder="ইংরেজিতে প্রদান করুন" value="<?php echo $row->mukti_sonod;?>" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য! </span>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="relation" class="col-sm-6 control-label">মুক্তিযোদ্ধার সাথে সম্পর্ক</label>
										<div class="col-sm-6">
											<input type="text" name="relation" id="relation" class="form-control"  placeholder="যেমন: কন্যার পুত্র(নাতিন)" value="<?php echo $row->relation;?>" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Short Relation" class="col-sm-6 control-label">সংক্ষেপে</label>
										<div class="col-sm-6">
											<input type="text" name="short_rel" id="short_rel" class="form-control"  placeholder="যেমন: দাদা/ নানা/" value="<?php echo $row->short_rel;?>" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য! </span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="only_mukti_part" style="<?php echo $shortPart;?>">
							<div class="row">
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Sector No" class="col-sm-6 control-label">সেক্টর নং </label>
										<div class="col-sm-6">
											<input type="text" name="sector2" id="sector2" class="form-control"  placeholder="ইংরেজিতে প্রদান করুন" value="<?php echo $row->sector_no;?>" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য!</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6"> 
									<div class="form-group">
										<label for="Mukti sonod" class="col-sm-6 control-label">মুক্তিবার্তা নং </label>
										<div class="col-sm-6">
											<input type="text" name="mukti_sonod2" id="mukti_sonod2" class="form-control"  placeholder="ইংরেজিতে প্রদান করুন" value="<?php echo $row->mukti_sonod;?>" />
											<span class="sub-hints">বি.দ্র. : মুক্তিযোদ্ধা সনদ পত্র এর জন্য! </span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="National-id-english" class="col-sm-3 control-label">ন্যাশনাল আইডি (ইংরেজিতে)  </label>
									<div class="col-sm-3">
										<input type="text" name="nationid" id="nid" class="form-control medium-font-inupt" maxlength='17' onkeypress="return numtest();" value="<?php echo $row->nationid?>" />
									</div>
									<label for="Birth-no" class="col-sm-3 control-label">জন্ম নিবন্ধন নং ( ইংরেজিতে ) </label>
									<div class="col-sm-3">
										<input type="text" name="bcno" id="bcno" class="form-control medium-font-inupt" maxlength="17" onkeypress="return numtest();" value="<?php echo $row->bcno?>" />
									</div>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Passport-no" class="col-sm-3 control-label">পাসপোর্ট নং ( ইংরেজিতে ) </label>
									<div class="col-sm-3">
										<input type="text" name="pno" id="pno" class="form-control medium-font-inupt" maxlength='17' onkeypress="return numtest();" value="<?php echo $row->pno?>" />
									</div>
									<label for="Birth-date" class="col-sm-3 control-label">জম্ম তারিখ  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="dofb" id="dofb" class="form-control medium-font-inupt" value='<?php echo $row->dofb;?>' required />
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Name-english" class="col-sm-3 control-label">নাম ( ইংরেজিতে )   <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="ename" id="name" class="form-control medium-font-inupt" value="<?php echo $row->ename?>" required />
									</div>
									<label for="Name-bangla" class="col-sm-3 control-label">নাম ( বাংলায় )  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bname" id="bname" class="form-control medium-font-inupt" value="<?php echo $row->name?>" required />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Gender" class="col-sm-3 control-label">লিঙ্গ   <span>*</span></label>
									<div class="col-sm-3">
										<label class="radio-inline"><input type="radio" name="gender" id="gender" value="male" <?php if($row->gender=='male'){ echo 'Checked';}?> onclick="bybahik_obosthan_show1(this.value);" />পুরুষ </label>
										<label class="radio-inline"><input type="radio" name="gender" id="gender" value="female" <?php if($row->gender=='female'){ echo 'Checked';}?> onclick="bybahik_obosthan_show1(this.value);" />মহিলা</label>
									</div>
									<label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক   <span>*</span></label>
									<div class="col-sm-3">
										<label class="radio-inline"><input type="radio" name="mstatus" id="mstatus" value="1" <?php if($row->mstatus=='1'){ echo 'Checked';}?> onclick="bybahik_obosthan_show('1');">বিবাহিত </label>
										<label class="radio-inline"><input type="radio" name="mstatus" id="mstatus" value="2" <?php if($row->mstatus=='2'){ echo 'Checked';}?> onclick="bybahik_obosthan_show('2');">অবিবাহিত</label>
									</div>
								</div>
							</div>
						</div>
						
						<?php if(($row->gender=='male') && ($row->mstatus=='1')) { $style1 = 'display:block;';$style2 = 'display:none;'; }?>
						<?php if(($row->gender=='female') && ($row->mstatus=='1')){ $style1 = 'display:none;';$style2 = 'display:block;'; }?>
						<?php if(($row->gender=='male') && ($row->mstatus=='2')) { $style1 = 'display:none;';$style2 = 'display:none;'; }?>
						
						<div class="row" id="wife" style="<?php echo $style1; ?>">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Wife-name-english" class="col-sm-3 control-label">স্ত্রীর  নাম (ইংরেজিতে) </label>
									<div class="col-sm-3">
										<input type="text" name="eWname" id="eWname" class="form-control medium-font-inupt" value="<?php echo $row->ewname ?>" />
									</div>
									<label for="Wife-name-bangla" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়)</label>
									<div class="col-sm-3">
										<input type="text" name="bWname" id="bWname" class="form-control medium-font-inupt" value="<?php echo $row->bwname ?>" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row" id="husband" style="<?php echo $style2; ?>">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Husband-name-english" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
									<div class="col-sm-3">
										<input type="text" name="eHname" id="eHname" class="form-control medium-font-inupt" value="<?php echo $row->ehname ?>" />
									</div>
									<label for="Husband-name-bangla" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়)</label>
									<div class="col-sm-3">
										<input type="text" name="bHname" id="bHname" class="form-control medium-font-inupt" value="<?php echo $row->bhname ?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Father-name-english" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="efname" id="efname" class="form-control medium-font-inupt" value="<?php echo $row->efname?>" required />
									</div>
									<label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (বাংলায়)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bfname" id="bfname" class="form-control medium-font-inupt" value="<?php echo $row->bfname?>" required />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row ">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="emname" id="mname" class="form-control medium-font-inupt" value="<?php echo $row->emname?>" required />
									</div>
									<label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bmane" id="emane" class="form-control medium-font-inupt" value="<?php echo $row->mname?>" required />
									</div>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="profession" class="col-sm-3 control-label">পেশা</label>
									<div class="col-sm-3">
										<input type="text" name="ocupt" id="occupation" class="form-control medium-font-inupt" value="<?php echo $row->ocupt?>" />
									</div>
									<label for="Education-qualification" class="col-sm-3 control-label">শিক্ষাগত যোগ্যতা</label>
									<div class="col-sm-3">
										<input type="text" name="qualification" id="qualification" class="form-control medium-font-inupt" value="<?php echo $row->edustatus?>" />
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Religion" class="col-sm-3 control-label">ধর্ম    <span>*</span></label>
									<div class="col-sm-3">
										<select name="religion" class="form-control" required >
											<option value='ইসলাম' <?php if($row->religion=='ইসলাম'){ echo "Selected";} ?>>ইসলাম</option>
											<option value='হিন্দু' <?php if($row->religion=='হিন্দু'){ echo "Selected";} ?>>হিন্দু</option>
											<option value='বৌদ্ধ ধর্ম' <?php if($row->religion=='ধর্ম'){ echo "Selected";} ?>>বৌদ্ধ ধর্ম</option>
											<option value='খ্রিস্ট ধর্ম' <?php if($row->religion=='খ্রিস্ট ধর্ম'){ echo "Selected";} ?>>খ্রিস্ট ধর্ম</option>
											<option value='অন্যান্য' <?php if($row->religion=='অন্যান্য'){ echo "Selected";} ?>>অন্যান্য</option>
										</select>
									</div>
									<label for="Resident" class="col-sm-3 control-label">বাসিন্দা    <span>*</span></label>
									<div class="col-sm-3">
										<select name="bashinda" id='bs' class="form-control" onchange="basinda_show_hide(this.value);" required >
											<option value='1' <?php if($row->bashinda==1) echo "Selected";?>>অস্থায়ী</option>
											<option value='2' <?php if($row->bashinda==2) echo "Selected";?>>স্থায়ী</option>
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
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District-english" class="col-sm-6 control-label">জেলা </label>
											<div class="col-sm-6">
												<input type="text" name="p_dis" id="p_dis" class="form-control medium-font-inupt" value="<?php echo $row->p_dis?>"/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-english" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="p_thana" id="p_thana" class="form-control medium-font-inupt" value="<?php echo $row->p_thana?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row ">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-english" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="p_postof" id="p_postof" class="form-control medium-font-inupt" value="<?php echo $row->p_postof?>"/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-english" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="p_wordno" id="p_wordno" class="form-control medium-font-inupt" onkeypress="return numtest();"  value="<?php echo $row->p_wordno?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-block-sector-english" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="p_rbs" id="p_rbs" class="form-control medium-font-inupt" value="<?php echo $row->p_rbs?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-english" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="p_gram" id="p_gram" class="form-control medium-font-inupt" value="<?php echo $row->p_gram?>"/>
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
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District-bangla" class="col-sm-6 control-label">জেলা </label>
											<div class="col-sm-6">
												<input type="text" name="pb_dis" id="pb_dis" class="form-control medium-font-inupt" value="<?php echo $row->pb_dis?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="pb_thana" id="pb_thana" class="form-control medium-font-inupt" value="<?php echo $row->pb_thana?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="pb_postof" id="pb_postof" class="form-control medium-font-inupt" value="<?php echo $row->pb_postof?>"/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="pb_wordno" id="pb_wordno" class="form-control medium-font-inupt" value="<?php echo $row->pb_wordno?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row ">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-block-sector-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="pb_rbs" id="pb_rbs" class="form-control medium-font-inupt" value="<?php echo $row->pb_rbs?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="pb_gram" id="pb_gram" class="form-control medium-font-inupt" value="<?php echo $row->pb_gram?>" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<?php if($row->bashinda==2) { $style1 = 'display:none;';}else{$style1= 'display: block;';}?>
						
						<div class="row" id="permaHeading" style="<?php echo $style1; ?>">
							<div class="col-sm-12" style="text-align:center;"> 
								<div class="app-heading"> 
									স্থায়ী  ঠিকানা
								</div>
							</div>
						</div>
						
						<div class="row" id="permanentAddress" style="<?php echo $style1; ?>">
							<div class="col-sm-6">
								<div class="col-sm-offset-6 col-sm-6">
									<div class="app-sub-heading"> 
										( ইংরেজিতে )
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District-english" class="col-sm-6 control-label">জেলা <span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="per_dis" id="per_dis" class="form-control medium-font-inupt" value="<?php echo $row->per_dis?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-english" class="col-sm-6 control-label">উপজেলা/থানা<span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="per_thana" id="per_thana" class="form-control medium-font-inupt" value="<?php echo $row->per_thana?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-english" class="col-sm-6 control-label">পোষ্ট অফিস  <span>*</span></label>
											<div class="col-sm-6">
												<input type="text" name="per_postof" id="postof" class="form-control medium-font-inupt" value="<?php echo $row->per_postof?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-english" class="col-sm-6 control-label">ওয়ার্ড নং<span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="per_wordno" id="per_wordno" class="form-control medium-font-inupt" onkeypress="return numtest();" value="<?php echo $row->per_wordno?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-block-sector-english" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="per_rbs" id="per_rbs" class="form-control medium-font-inupt" value="<?php echo $row->per_rbs?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-english" class="col-sm-6 control-label">গ্রাম/মহল্লা <span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="per_gram" id="per_gram" class="form-control medium-font-inupt" value="<?php echo $row->per_gram?>" />
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
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District-bangla" class="col-sm-6 control-label">জেলা  <span>*</span></label>
											<div class="col-sm-6">
												<input type="text" name="perb_dis" id="perb_dis" class="form-control medium-font-inupt" value="<?php echo $row->perb_dis?>"/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা<span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="perb_thana" id="perb_thana" class="form-control medium-font-inupt" value="<?php echo $row->perb_thana?>"/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস <span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="perb_postof" id="perb_postof" class="form-control medium-font-inupt" value="<?php echo $row->perb_postof?>"/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং <span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="perb_wordno" id="perb_wordno" class="form-control medium-font-inupt" value="<?php echo $row->perb_wordno?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-block-sector-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="perb_rbs" id="perb_rbs" class="form-control medium-font-inupt" value="<?php echo $row->perb_rbs?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা <span>*</span></label> 
											<div class="col-sm-6">
												<input type="text" name="perb_gram" id="perb_gram" class="form-control medium-font-inupt" value="<?php echo $row->perb_gram?>" />
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
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Mobile" class="col-sm-3 control-label">মোবাইল    <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="mob" id="mob" class="form-control medium-font-inupt" maxlength="11" value="<?php echo $row->mobile?>" onkeypress="return numtest();"  required />
									</div>
									<label for="Email" class="col-sm-3 control-label">ইমেল </label>
									<div class="col-sm-3">
										<input type="text" name="email" id="email" class="form-control medium-font-inupt" value="<?php echo $row->email?>" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Designation" class="col-sm-3 control-label">সংযুক্তি (যদি থাকে)</label>
									<div class="col-sm-9">
										<textarea name="attachment" class="form-control medium-font-inupt" rows="5" id="attachment" placeholder="উদাহরন: মুক্তিযোদ্ধা সন্তান, বিধবা, উপজাতি .....ইত্যাদি"><?php echo $row->attachment; ?></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-offset-6 col-sm-6 button-style"> 
								<input type='submit' value="আপডেট করুন" name='save' class="btn btn-info btn-sm"/>
								<span id="load"></span>
								<input type='hidden' name='trackid' value='<?php echo $row->trackid?>'/>
								<input type='hidden' name='uid' value='<?php echo $row->id?>'/>
								<input type="hidden" name="serviceList" value="<?php echo $row->serviceId;?>" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!-- row end--->
</div><!--/#content.col-md-10-->
<style type="text/css"> 
	.sub-hints{
		font-size: 12px;
		color: red;
		font-style: italic;
	}
</style>