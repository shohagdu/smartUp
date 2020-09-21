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
		.all-input-form input[type="text"]{
			color: #0C090A;
			font-size:13px;
			font-weight:500;
		}
		.all-input-form h3{
			color: black;
			opacity:0.9;
			font-size:16px;
			font-weight:normal;
			font-style:normal;
		}
		.extra-margin{
			margin-top: 5px;
			margin-bottom: 5px;
		}
		.sub-extra-margin{
			margin-top: 2px;
			margin-bottom: 2px;
		}
		.medium-font{
			font-size: 15px;
			font-weight: normal;
		}
		.medium-font-input{
			font-size: 16px !important;
			letter-spacing: 1px;
			color: #333 !important;
		}
		.small-font{
			font-size: 13px;
			font-weight: 600;
			font-style:normal;
			font-family: SolaimanLipi,Georgia, serif;
		}

	</style>
	<script type="text/javascript"> 

		$("document").ready(function(){
			$("#wife").hide();
			$("#husband").hide();
			$("#fyears").hide();
			$("#myears").hide();
			
			$('#info').submit(function() {
				$("#load").empty().append('<img src="library/img/ajaxloader.gif">');
				$.post(
				"index.php/Update/warishUpdate_action",
				$("#info").serialize(),
				function(data){
					if(data==1)
					{
						alert('আপনার আবেদনটি সঠিকভাবে পরিবর্তন করা হয়েছে');
						setTimeout(function() {
						window.location='Applicant/warishapplicant?napply=new';}, 1000)
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
				return false;
			});
		});

		/*========= gender and bybahik obstha hide show function start ========*/
		function bybahik_obosthan_show(mstatus){
			var gender = $("#gender:checked").val();
			if(mstatus=='1' && gender=='male'){
				//alert('wife id show');
				$("#wife").show();
				$("#husband input:text").val('');
				$("#husband").hide();
			}
			else if(mstatus=='1' && gender=='female'){
				//alert('husband id show');
				$("#husband").show();
				$("#wife input:text").val('');
				$("#wife").hide();
			}
			else if(mstatus=='2'&& gender=='female'){
				//alert("father id show");
				$("#husband").hide();
				$("#wife").hide();
			}
			else if(mstatus=='2' && gender=='male'){
				//alert('father id show');
				$("#husband").hide();
				$("#wife").hide();
			}
			else{
				$("#husband").hide();
				$("#wife").hide();
			}
		}
		/*==== 2nd function =====*/
		function bybahik_obosthan_show1(gender){
			var mstatus = $("#mstatus:checked").val();
			if(mstatus=='1' && gender=='male'){
				//alert('wife id show');
				$("#wife").show();
				$("#husband input:text").val('');
				$("#husband").hide();
			}
			else if(mstatus=='1' && gender=='female'){
				//alert('husband id show');
				$("#husband").show();
				$("#wife input:text").val('');
				$("#wife").hide();
			}
			else if(mstatus=='2' && gender=='female'){
				//alert('father id show');
				$("#husband").hide();
				$("#wife").hide();
			}
			else if(mstatus=='2' && gender=='male'){
				//alert('father id show');
				$("#husband").hide();
				$("#wife").hide();
			}
			else{
				$("#husband").hide();
				$("#wife").hide();
			}
		}
		/*========= gender and bybahik obstha hide show function end ========*/
		
		/*======= father mother alive function start=======*/
		function falive(a){
			if(a=='1'){
				$("#fyears").show();
			}
			else if(a=='0'){
				$("#fatheragenull input:text").val('');
				$("#fyears").hide();
				
			}
		}
		
		/*mother*/
		function malive(a){
			if(a=='1'){
				$("#myears").show();
			}
			else if(a=='0'){
				$("#motheragenull input:text").val('')
				$("#myears").hide();
			}
		}

		/*======= father mother alive function end=======*/

		/*====== Resident hide show function start =======*/
		function basinda_show_hide(v){
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
		/*====== Resident hide show function end =======*/

		/*============ number test function start ===============*/
		function numtest(){
			return event.charCode >= 48 && event.charCode <= 57;
		}
		/*============ number test function end===============*/	
	</script>
	<script>
		$(function() {
			$( "#dofb" ).datepicker({ dateFormat: 'dd/mm/yy' });
		});
		
		function checkaccnumber(evt){
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)){
				return false;
			}
			return true;
		}
	</script>
	<!-- some information query -->

	<div class="row">
		<div class="col-md-12"> 
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">আপনার তথ্য আপডেট করুন</div>
				<div class="panel-body all-input-form">
				
					<form action="index.php/Update/warishUpdate_action" method="post" id="info" enctype="multipart/form-data" class="form-horizontal">
						
						<div class="row medium-font"> 
							<div class="col-sm-12" style="margin-bottom:10px;margin-top:10px;"> 
								<div class="form-group">
									<label for="name" class="col-sm-3 control-label">সরবরাহের ধরণ  <span>*</span></label>
									<div class="col-sm-9">
										<label class="radio-inline"><input type="radio" name="delivery_type" value="1" <?php if($row->delivery_type==1){echo "Checked";}?>>জরুরী</label>
										<label class="radio-inline"><input type="radio" name="delivery_type" value="2" <?php if($row->delivery_type==2){echo "Checked";}?>>অতি জরুরী  </label>
										<label class="radio-inline"><input type="radio" name="delivery_type" value="3"  <?php if($row->delivery_type==3){echo "Checked";}?>> সাধারন</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="national_id" class="col-sm-3 control-label">ন্যাশনাল আইডি (ইংরেজিতে)  </label>
									<div class="col-sm-3">
										<input type="text" name="nationid" id="nid" maxlength='17' class="form-control medium-font-input" onkeypress="return numtest();" value="<?php echo $row->nationid?>" />
									</div>
									<label for="bairth_no" class="col-sm-3 control-label">জন্ম নিবন্ধন নং ( ইংরেজিতে ) </label>
									<div class="col-sm-3">
										<input type="text" name="bcno" id="bcno" maxlength='17' class="form-control medium-font-input" onkeypress="return numtest();" value="<?php echo $row->bcno?>" />
									</div>
								</div>
							</div>
						</div>
					
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="passport_no" class="col-sm-3 control-label">পাসপোর্ট নং ( ইংরেজিতে )  </label>
									<div class="col-sm-3">
										<input type="text" name="pno" id="pno" maxlength='17' class="form-control medium-font-input" onkeypress="return numtest();" value="<?php echo $row->pno?>"/>
									</div>
									<label for="birth_day" class="col-sm-3 control-label">জম্ম তারিখ  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="dofb" id="dofb" class="form-control medium-font-input" value='<?php echo $row->dofb;?>' required />
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="death_ename" class="col-sm-3 control-label">মৃত ব্যক্তির নাম ( ইংরেজিতে )  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="ename" id="name" class="form-control medium-font-input"  value="<?php echo $row->ename?>" required />
									</div>
									<label for="death_name" class="col-sm-3 control-label">মৃত ব্যক্তির নাম ( বাংলায় )  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bname" id="bname" class="form-control medium-font-input" value="<?php echo $row->bname?>" required />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="gender" class="col-sm-3 control-label">লিঙ্গ   <span>*</span></label>
									<div class="col-sm-3">
										<label class="radio-inline"><input type="radio" name="gender" id="gender" value="male" <?php if($row->gender=='male'){ echo 'Checked';}?> onclick="bybahik_obosthan_show1(this.value);">পুরুষ </label>
										<label class="radio-inline"><input type="radio" name="gender" id="gender" value="female" <?php if($row->gender=='female'){ echo 'Checked';}?> onclick="bybahik_obosthan_show1(this.value)">মহিলা</label>
									</div>
									<label for="married_status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক   <span>*</span></label>
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
						<div class="row medium-font" id="wife" style="<?php echo @$style1;?>">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="wife-english-name" class="col-sm-3 control-label">স্ত্রীর  নাম (ইংরেজিতে) </label>
									<div class="col-sm-3">
										<input type="text" name="eWname" id="eWname" class="form-control medium-font-input" value="<?php echo @$row->ewname?>" />
									</div>
									<label for="wife-bangla-name" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়)</label>
									<div class="col-sm-3">
										<input type="text" name="bWname" id="bWname" class="form-control medium-font-input" value="<?php echo @$row->bwname?>" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font" id="husband" style="<?php echo @$style2;?>">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="husband-english-name" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
									<div class="col-sm-3">
										<input type="text" name="eHname" id="eHname" class="form-control medium-font-input" value="<?php echo @$row->ehname?>" />
									</div>
									<label for="husband-bangla-name" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়)</label>
									<div class="col-sm-3">
										<input type="text" name="bHname" id="bHname" class="form-control medium-font-input" value="<?php echo @$row->bhname?>" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="father-english-name" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="efname" id="efname" class="form-control medium-font-input" value="<?php echo $row->efname?>" required />
									</div>
									<label for="father-bangla-name" class="col-sm-3 control-label">পিতার নাম (বাংলায়)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bfname" id="bfname" class="form-control medium-font-input" value="<?php echo $row->bfname?>" required />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="mother-english-name" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="emname" id="emname" class="form-control medium-font-input" value="<?php echo $row->emname?>" required />
									</div>
									<label for="mother-bangla-name" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bmane" id="bmane" class="form-control medium-font-input" value="<?php echo $row->bmane?>" required />
									</div>
								</div>
							</div>
						</div>
						<?php //if($row->falive=='1') { $style3 = 'display:block;'; }?>
						<?php //if($row->malive=='1') { $style3 = 'display:block;'; }?>
						<!--<div class="row medium-font"> 
							<div class="col-sm-12" style="margin-bottom:10px;margin-top:10px;"> 
								<div class="form-group">
									<label for="father-alive" class="col-sm-3 control-label">পিতা জীবিত কিনা</label>
									<div class="col-sm-3" id="fatheragenull">
										<label class="radio-inline"><input type="radio" name="flive" id="flive" value="1" <?php if($row->falive=='1'){ echo 'Checked';}?> onclick="falive(this.value)">হ্যাঁ </label>
										<label class="radio-inline"><input type="radio" name="flive" id="flive" value="0" <?php if($row->falive=='0'){ echo 'Checked';}?> onclick="falive(this.value)">না</label>
										<div style="<?php echo @$style3;?>"> 
											<input type="text" name="fyears" id="fyears" class="form-control medium-font-input" value="<?php echo @$row->fyears;?>"  />
										</div>
									</div>
									<label for="mother-alive" class="col-sm-3 control-label">মাতা জীবিত কিনা</label>
									<div class="col-sm-3" id="motheragenull">
										<label class="radio-inline"><input type="radio" name="mlive" id="mlive" value="1" <?php if($row->malive=='1'){ echo 'Checked';}?> onclick="malive(this.value)">হ্যাঁ </label>
										<label class="radio-inline"><input type="radio" name="mlive" id="mlive" value="0" <?php if($row->malive=='0'){ echo 'Checked';}?> onclick="malive(this.value)">না</label>
										<div style="<?php echo @$style3;?>"> 
											<input type="text" name="myears" id="myears" class="form-control medium-font-input" value="<?php echo @$row->myears;?>" />
										</div>
									</div>
								</div>
							</div>
						</div>---->
					
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="profession" class="col-sm-3 control-label">পেশা</label>
									<div class="col-sm-3">
										<input type="text" name="ocupt" id="occupation" class="form-control medium-font-input" value="<?php echo $row->ocupt?>" />
									</div>
									<label for="Resident" class="col-sm-3 control-label">বাসিন্দা    <span>*</span></label>
									<div class="col-sm-3">
										<select name="bashinda" id="bs" class="form-control medium-font-input" onchange="basinda_show_hide(this.value);">
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
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District" class="col-sm-6 control-label">জেলা </label>
											<div class="col-sm-6">
												<input type="text" name="p_dis" id="p_dis" class="form-control medium-font-input" value="<?php echo $row->p_dis?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="p_thana" id="p_thana" class="form-control medium-font-input" value="<?php echo $row->p_thana?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="p_postof" id="p_postof" class="form-control medium-font-input" value="<?php echo $row->p_postof?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="p_wordno" id="p_wordno" onkeypress="return numtest();"  class="form-control medium-font-input" value="<?php echo $row->p_wordno?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-Block-Sector" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="p_rbs" id="p_rbs" class="form-control medium-font-input" value="<?php echo $row->p_rbs?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="p_gram" id="p_gram" class="form-control medium-font-input" value="<?php echo $row->p_gram?>" />
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
												<input type="text" name="pb_dis" id="pb_dis" class="form-control medium-font-input" value="<?php echo $row->pb_dis?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="pb_thana" id="pb_thana" class="form-control medium-font-input" value="<?php echo $row->pb_thana?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="pb_postof" id="pb_postof" class="form-control medium-font-input" value="<?php echo $row->pb_postof?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="pb_wordno" id="pb_wordno" class="form-control medium-font-input" value="<?php echo $row->pb_wordno?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-Block-Sector-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="pb_rbs" id="pb_rbs" class="form-control medium-font-input" value="<?php echo $row->pb_rbs?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="pb_gram" id="pb_gram" class="form-control medium-font-input" value="<?php echo $row->pb_gram?>" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php if($row->bashinda==2) { $style1 = 'display:none;';}else{$style1= 'display: block;';}?>
						<div class="row" id="permaHeading" style="<?php echo $style1;?>">
							<div class="col-sm-12" style="text-align:center;"> 
								<div class="app-heading"> 
									স্থায়ী  ঠিকানা
								</div>
							</div>
						</div>
						
						<div class="row" id="permanentAddress" style="<?php echo $style1;?>">
							<div class="col-sm-6">
								<div class="col-sm-offset-6 col-sm-6">
									<div class="app-sub-heading"> 
										( ইংরেজিতে )
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District" class="col-sm-6 control-label">জেলা </label>
											<div class="col-sm-6">
												<input type="text" name="per_dis" id="per_dis" class="form-control medium-font-input" value="<?php echo $row->per_dis?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="per_thana" id="per_thana" class="form-control medium-font-input" value="<?php echo $row->per_thana?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="per_postof" id="per_postof" class="form-control medium-font-input" value="<?php echo $row->per_postof?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="per_wordno" id="per_wordno" onkeypress="return numtest();"  class="form-control medium-font-input" value="<?php echo $row->per_wordno?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-Block-Sector" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="per_rbs" id="per_rbs" class="form-control medium-font-input" value="<?php echo $row->per_rbs?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="per_gram" id="per_gram" class="form-control medium-font-input" value="<?php echo $row->per_gram?>" />
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
												<input type="text" name="perb_dis" id="perb_dis" class="form-control medium-font-input" value="<?php echo $row->perb_dis?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="perb_thana" id="perb_thana" class="form-control medium-font-input" value="<?php echo $row->perb_thana?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="perb_postof" id="perb_postof" class="form-control medium-font-input"  value="<?php echo $row->perb_postof?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="perb_wordno" id="perb_wordno" class="form-control medium-font-input" value="<?php echo $row->perb_wordno?>"  />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-Block-Sector-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="perb_rbs" id="perb_rbs" class="form-control medium-font-input" value="<?php echo $row->perb_rbs?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="perb_gram" id="perb_gram" class="form-control medium-font-input" value="<?php echo $row->perb_gram?>" />
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
						
						<div class="row  medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="English Applicant Name" class="col-sm-3 control-label small-font"> আবেদনকারীর নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="english_applicant_name" id="" value="<?php echo $row->english_applicant_name;?>" class="form-control" required />
									</div>
									<label for="Bangla Applicant Name" class="col-sm-3 control-label small-font">আবেদনকারীর নাম ( বাংলায় )  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bangla_applicant_name" id="" value="<?php echo $row->bangla_applicant_name;?>" class="form-control" required />
									</div>
								</div>
							</div>
						</div>

						<div class="row  medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="English Applicant Father Name" class="col-sm-3 control-label small-font"> আবেদনকারীর পিতার নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="english_applicant_father_name" id="" value="<?php echo $row->english_applicant_father_name;?>" class="form-control" required />
									</div>
									<label for="Bangla Applicant Father Name" class="col-sm-3 control-label small-font">আবেদনকারীর পিতার নাম ( বাংলায় )  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bangla_applicant_father_name" id="" value="<?php echo $row->bangla_applicant_father_name;?>" class="form-control" required />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Mobile" class="col-sm-3 control-label small-font">মোবাইল    <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="mob" id="mob" class="form-control medium-font-input" maxlength="11" onkeypress="return numtest();" value="<?php echo $row->mobile?>" required />
									</div>
									<label for="Email" class="col-sm-3 control-label small-font">ইমেল </label>
									<div class="col-sm-3">
										<input type="email" name="email" id="email" class="form-control medium-font-input" value="<?php echo $row->email?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Verfication" class="col-sm-3 control-label small-font">তদন্তকারী</label>
									<div class="col-sm-9">
										<textarea name="verifier_name" class="form-control medium-font-inupt" rows="5" id="verifier_name"><?php echo $row->verifier_name; ?></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12" style="text-align:center;"> 
								<div class="app-heading"> 
									ওয়ারিশগনের তালিকা
								</div>
							</div>
						</div>
						<!---- existing warish information section start --------------->
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<div class="col-sm-1">
										<h3 style="font-size: 18px; font-weight: bold; text-align:center;"> নং </h3>
									</div>
									<div class="col-sm-3">
										<h3 style="font-size: 18px; font-weight: bold; text-align:center;"> নাম </h3>
									</div>
									<div class="col-sm-3">
										<h3 style="font-size: 18px; font-weight: bold;text-align:center;"> সম্পর্ক </h3>
									</div>
									<div class="col-sm-3">
										<h3 style="font-size: 18px; font-weight: bold; text-align: center;"> বয়স </h3>
									</div>
									<div class="col-sm-2"></div>
								</div>
							</div>
						</div>
						<?php
							$nr=1;
							foreach ($wQy as $wrow):				
						?>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<div class="col-sm-1 extra-margin">
										<p style="text-align: center;"><?php echo $nr;?></p>
									</div>
									<div class="col-sm-3 extra-margin">
										<input type='text' name='wn' id='wn<?php echo $nr;?>' value='<?php  echo $wrow->w_name;?>' class="form-control"/>
									</div>
									<div class="col-sm-3 extra-margin">
										<input type='text' name='wrel' id='wrel<?php echo $nr;?>' value='<?php echo $wrow->w_relation;?>' class="form-control"/>
									</div>
									<div class="col-sm-3 extra-margin">
										<input type='text' name='wage' id='wage<?php echo $nr;?>' value='<?php echo $wrow->w_age;?>' class="form-control"/>
										<input type='hidden' name='wid' value='<?php echo $wrow->id?>' id='wid<?php echo $nr;?>' class="form-control" />
									</div>
									<div class="col-sm-2 extra-margin"> 
										<a href='javascript:void(0);' value='<?php echo $wrow->id;?>' onclick="upWinfo(<?php echo $wrow->id?>,wn<?php echo $nr?>.value,wrel<?php echo $nr?>.value,wage<?php echo $nr?>.value)" class="btn btn-success  btn-sm">Update</a>
										
										<a href='javascript:void(0);' onclick="changeType(<?php echo $wrow->id?>)" class="btn btn-danger btn-sm">Delete</a>
									</div>
								</div>
							</div>
						</div>
						<?php $nr++;endforeach;?>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-7">
										<p style="font-size: 18px;text-indent: 50px;">উত্তরাধিকারীর সংখ্যা&nbsp; <span style="color: blue;font-size: 20px;font-weight:bolder;"><?php echo $nr-1;?></span>&nbsp;জন</p>
									</div>
								</div>
							</div>
						</div>
						<!---- existing warish information section end --------------->
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<div class="col-sm-3 col-sm-offset-2">
										<h3> নাম </h3>
									</div>
									<div class="col-sm-3">
										<h3> সম্পর্ক </h3>
									</div>
									<div class="col-sm-3">
										<h3> বয়স </h3>
									</div>
									
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<div class="col-sm-3  col-sm-offset-1 extra-margin">
										<input type="text" name="w_name1" id="wname1" class="form-control" />
									</div>
									<div class="col-sm-3 extra-margin">
										<input type="text" name="w_rel1" id="wwrel" class="form-control" />
									</div>
									<div class="col-sm-3 extra-margin">
										<input type="text" name="w_age1" id="wage222" placeholder="ইংরেজিতে" class="form-control" onkeypress="return checkaccnumber(event);" maxlength="2" />
									</div>
									<div class="col-sm-2 extra-margin"> 
										<input type="button" name="nwarish" onclick="addRow(this.form);" value='নতুন ওয়ারিশ' class="btn btn-primary btn-sm"/>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12" id="itemRows"> 
								
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Note" class="col-sm-1 control-label">নোট </label>
									<div class="col-sm-9">
										<textarea maxlength='350' rows="6" class="form-control" id="appNoteId" name="appNote" style="resize:none;"><?php echo $row->note;?></textarea>
										<p id="character_count">Characters left: <?php echo 350 - strlen($row->note)?></p>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-offset-5 col-sm-6 button-style"> 
								<input type='submit' value="আপডেট করুন" name='save'  class="btn btn-info btn-sm"/>
								<span id="load"></span>
								<input type='hidden' name='trackid' value='<?php echo $row->trackid?>'/>
								<input type='hidden' name='uid' value='<?php echo $row->id?>'/>
							</div>
						</div>
					</form>
				</div>
			</div><!---- /panel primary--------->
		</div>
	</div><!-- row end--->
</div><!--/#content.col-md-10-->

	<script type="text/javascript"> 
	/*======= warish add row function start ==========*/
		var rowNum = 0;
		function addRow(frm){
			var wname=document.getElementById("wname1").value;
			var wre11=document.getElementById("wwrel").value;
			var wage1=document.getElementById("wage222").value;
			if(wname==''){
				alert("দু:খিত! ওয়ারিশের নাম দিতে হবে");
			}
			else if(wre11==''){
				alert("দু:খিত! ওয়ারিশের সাথে সম্পর্ক দিতে হবে");
			}
			else if(wage1==''){
				alert("দু:খিত! ওয়ারিশের বয়স দিতে হবে");
			}
			else{
				rowNum ++;
				var row = '<div id="rowNum'+rowNum+'" class="form-group"><div class=" col-sm-3  col-sm-offset-1 sub-extra-margin"><input type="text" name="w_name1[]" value="'+frm.wname1.value+'" class="form-control" /></div><div class="col-sm-3 sub-extra-margin"><input type="text" name="w_rel1[]" value="'+frm.wwrel.value+'" class="form-control" /></div><div class="col-sm-3 sub-extra-margin"><input type="text" name="w_age1[]" value="'+frm.wage222.value+'" class="form-control" /> </div> <div class="col-sm-2 sub-extra-margin"><input type="button" value="Remove" class="btn btn-danger btn-sm" onclick="removeRow('+rowNum+');" /></div></div>';
				jQuery('#itemRows').append(row);
				frm.wname1.value = '';
				frm.wwrel.value = '';
				frm.wage222.value = '';
			}
		}
		function removeRow(rnum){
			jQuery('#rowNum'+rnum).remove();
		}
		/*======= warish add row function end==========*/
	</script>

<!------ sub warish information list update start  ------>
<script>
	function upWinfo(id,name,relation,age) 
	{
		var conf = confirm("Are you sure to Modify?");
		if(conf == false) return;
		var path = "index.php/Update/wInfo?id="+id+"&w_name="+name+"&w_relation="+relation+"&w_age="+age;
		var xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange = triggered;
		xmlhttp.open("GET", path,true);
		xmlhttp.send(null);
		function triggered()
		{
			if (xmlhttp.readyState == 4){
				alert(xmlhttp.responseText);
				window.location.reload();
			}
			else
			{}
		}
	};
</script>
<!------ sub warish information list update end  ------>
<!----- sub warish information list delete start ------>
<script>
	function changeType(id)
	{
		var conf = confirm("Are you want to Delete?");
		if(conf == false) return;
		var path = "index.php/Update/wdel?id="+id;
		var xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange = triggered;
		xmlhttp.open("GET", path,true);
		xmlhttp.send(null);
		function triggered()
		{
			if (xmlhttp.readyState == 4){
				alert(xmlhttp.responseText);
				window.location.reload();
			}
			else
			{}
		}
	};
	
	$("#appNoteId").keyup(function(){
	  $("#character_count").text("Characters left: " + (350 - $(this).val().length));
	});
</script>
<!----- sub warish information list delete end   ------>
