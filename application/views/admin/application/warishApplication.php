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
	<script>
	$(function() {
		$( "#dofb" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
</script>
<script type="text/javascript"> 

$("document").ready(function(){
	$('#warish').submit(function() {
		document.getElementById('submit_button').disabled = 'disabled';
		$.post(
			"index.php/Applicant/warishapplication_action",
			$("#warish").serialize(),
			function(data){
				if(data !=1){
					document.getElementById('submit_button').disabled = false;
				}
				if(data==1)
				{
					alert('আপনার আবেদনটি গৃহীত হয়েছে'); 
					setTimeout(function() {
					window.location='Applicant/warishapplicant?napply=new';}, 1000)
				} 
				else if(data==2)
				{
					alert('দুঃখিত আপানর জাতিয় পরিচয়পত্র নং পূর্বে ব্যাবহার করা হয়েছে \nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন');
				}
				else if(data==3)
				{
					alert('দুঃখিত আপানর জন্ম নিবধন নং পূর্বে ব্যাবহার করা হয়েছে \nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন');
				}
				else if(data==4)
				{
					alert('দুঃখিত আপানর পাসপোর্ট নং পূর্বে ব্যাবহার করা হয়েছে \nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন');
				}
				else if(data==6)
				{
					alert('দুঃখিত আপানর মোবাইল নাম্বারটি পূর্বে ব্যাবহার করা হয়েছে.\nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন');
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
	onload_hide_fun();// onload page hide function calling
	
	
});


/*========= gender and bybahik obstha hide show function start ========*/
function bybahik_obosthan_show(mstatus){
	var gender = $("#gender").val();
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
	var mstatus = $("#mstatus").val();
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

/*========= onload function start ==========*/
function onload_hide_fun(){
	$("#wife").hide();
	$("#husband").hide();
	$("#fyears").hide();
	$("#myears").hide();
	/* $(".bname").bnKb({
		'switchkey': {"webkit":"k","mozilla":"y","safari":"k","chrome":"k","msie":"y"},
		'driver': phonetic
	}); */
}

/*========= onload function end ==========*/
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

/*======= warish add row function start ==========*/
var rowNum = 0;
function addRow(frm){
	var wname=document.getElementById("wname").value;
	var wrel=document.getElementById("wrel").value;
	var wage=document.getElementById("wage").value;
	if(wname==''){
		alert("দু:খিত! ওয়ারিশের নাম দিতে হবে");
	}
	else if(wrel==''){
		alert("দু:খিত! ওয়ারিশের সাথে সম্পর্ক দিতে হবে");
	}
	else if(wage==''){
		alert("দু:খিত! ওয়ারিশের বয়স দিতে হবে");
	}
	else{
		rowNum ++;
		var row = '<div id="rowNum'+rowNum+'" class="form-group"><div class=" col-sm-3  col-sm-offset-1 sub-extra-margin"><input type="text" name="winfo[]" value="'+frm.wname.value+'" class="form-control" /></div><div class="col-sm-3 sub-extra-margin"><input type="text" name="wrel[]" value="'+frm.wrel.value+'" class="form-control" /></div><div class="col-sm-3 sub-extra-margin"><input type="text" name="wage[]" value="'+frm.wage.value+'" class="form-control" /> </div> <div class="col-sm-2 sub-extra-margin"><input type="button" value="Remove" class="btn btn-danger btn-sm" onclick="removeRow('+rowNum+');" /></div></div>';
		jQuery('#itemRows').append(row);
		frm.wname.value = '';
		frm.wrel.value = '';
		frm.wage.value = '';
	}
}
function removeRow(rnum){
	jQuery('#rowNum'+rnum).remove();
}
/*======= warish add row function end==========*/

/*============ number test function start ===============*/
function numtest(){
	return event.charCode >= 48 && event.charCode <= 57;
}
function checkaccnumber(evt){
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)){
		return false;
	}
	return true;
}
$("#appNoteId").keyup(function(){
  $("#character_count").text("Characters left: " + (350 - $(this).val().length));
});
/*============ number test function end===============*/
</script>
	<!-- some information query -->

	<div class="row">
		<div class="col-md-12"> 
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">ওয়ারিশ আবেদন ফরম</div>
				<div class="panel-body all-input-form">
				
					<form action="javascript:void(0)" method="post" enctype="multipart/form-data" id="warish" class="form-horizontal">
							
						<div class="row"> 
							<div class="col-sm-12" style="margin-bottom:10px;margin-top:10px;"> 
								<div class="form-group">
									<label for="name" class="col-sm-3 control-label">সরবরাহের ধরণ  <span>*</span></label>
									<div class="col-sm-9">
										<label class="radio-inline"><input type="radio" name="delivery_type" value="1">জরুরী</label>
										<label class="radio-inline"><input type="radio" name="delivery_type" value="2">অতি জরুরী  </label>
										<label class="radio-inline"><input type="radio" name="delivery_type" value="3" checked> সাধারন</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="national_id" class="col-sm-3 control-label">ন্যাশনাল আইডি (ইংরেজিতে)  </label>
									<div class="col-sm-3">
										<input type="text" name="nationid" id="nid" maxlength='17' class="form-control" onkeypress="return checkaccnumber(event);"  placeholder="" />
									</div>
									<label for="bairth_no" class="col-sm-3 control-label">জন্ম নিবন্ধন নং ( ইংরেজিতে ) </label>
									<div class="col-sm-3">
										<input type="text" name="bcno" id="bcno" maxlength='17' class="form-control" onkeypress="return checkaccnumber(event);"  placeholder="" />
									</div>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="passport_no" class="col-sm-3 control-label">পাসপোর্ট নং ( ইংরেজিতে )  </label>
									<div class="col-sm-3">
										<input type="text" name="pno" id="pno" maxlength='17' class="form-control" placeholder=""/>
									</div>
									<label for="birth_day" class="col-sm-3 control-label">জম্ম তারিখ  </label>
									<div class="col-sm-3">
										<input type="text" name="dofb" id="dofb" class="form-control" placeholder="01-01-1980" />
									</div>
								</div>
								
							</div>
						</div>
														
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="death_ename" class="col-sm-3 control-label">মৃত ব্যাক্তির নাম ( ইংরেজিতে )  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="ename" id="name" class="form-control" required />
									</div>
									<label for="death_name" class="col-sm-3 control-label">মৃত ব্যাক্তির নাম ( বাংলায় )  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bname" id="bname" class="form-control" required />
									</div>
								</div>
							</div>
						</div>
						<!---
						<div class="row">
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
						</div>----->
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group"> 
									<label for="Gender" class="col-sm-3 control-label">লিঙ্গ   <span>*</span></label>
									<div class="col-sm-3">
										<select name="gender" id="gender" class="form-control" required onchange="bybahik_obosthan_show1(this.value);" >
											<option value="">চিহ্নিত করুন</option>
											<option value="male">পুরুষ</option>
											<option value="female">মহিলা</option>
											<option value="others">অন্যান্য</option>
										</select>
									</div>
									<label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক  <span>*</span></label>
									<div class="col-sm-3">
										<select name="mstatus" id="mstatus" class="form-control" required onchange="bybahik_obosthan_show(this.value);" >
											<option value="">চিহ্নিত করুন</option>
											<option value="1">বিবাহিত</option>
											<option value="2">অবিবাহিত</option>
											<option value="3">বিপত্নীক / বিধবা</option>
											<option value="4">তালাকপ্রাপ্ত</option>
											<option value="5">দরকার নাই</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row" id="wife">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="wife-english-name" class="col-sm-3 control-label">স্ত্রীর  নাম (ইংরেজিতে) </label>
									<div class="col-sm-3">
										<input type="text" name="eWname" id="eWname" class="form-control" />
									</div>
									<label for="wife-bangla-name" class="col-sm-3 control-label">স্ত্রীর নাম (বাংলায়)</label>
									<div class="col-sm-3">
										<input type="text" name="bWname" id="bWname" class="form-control" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row" id="husband">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="husband-english-name" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
									<div class="col-sm-3">
										<input type="text" name="eHname" id="eHname" class="form-control" />
									</div>
									<label for="husband-bangla-name" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়)</label>
									<div class="col-sm-3">
										<input type="text" name="bHname" id="bHname" class="form-control" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="father-english-name" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="efname" id="efname" class="form-control" required />
									</div>
									<label for="father-bangla-name" class="col-sm-3 control-label">পিতার নাম (বাংলায়)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bfname" id="bfname" class="form-control" required />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="mother-english-name" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="emname" id="emname" class="form-control" required />
									</div>
									<label for="mother-bangla-name" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bmane" id="bmane" class="form-control" required />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row"> 
							<div class="col-sm-12" style="margin-bottom:10px;margin-top:10px;"> 
								<div class="form-group">
									<label for="father-alive" class="col-sm-3 control-label">পিতা জীবিত কিনা</label>
									<div class="col-sm-3" id="fatheragenull">
										<label class="radio-inline"><input type="radio" name="flive" id="flive" value="1" onclick="falive(this.value)">হ্যাঁ </label>
										<label class="radio-inline"><input type="radio" name="flive" id="flive" value="0" onclick="falive(this.value)" checked>না</label>
										<input type="text" name="fyears" id="fyears" class="form-control" placeholder="পিতার বয়স" />
									</div>
									<label for="mother-alive" class="col-sm-3 control-label">মাতা জীবিত কিনা</label>
									<div class="col-sm-3" id="motheragenull">
										<label class="radio-inline"><input type="radio" name="mlive" id="mlive" value="1" onclick="malive(this.value)">হ্যাঁ </label>
										<label class="radio-inline"><input type="radio" name="mlive" id="mlive" value="0" onclick="malive(this.value)" checked>না</label>
										<input type="text" name="myears" id="myears" class="form-control" placeholder="মাতার বয়স" />
									</div>
								</div>
							</div>
						</div>
					
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="profession" class="col-sm-3 control-label">পেশা</label>
									<div class="col-sm-3">
										<input type="text" name="ocupt" id="occupation" class="form-control" />
									</div>
									<label for="Resident" class="col-sm-3 control-label">বাসিন্দা    <span>*</span></label>
									<div class="col-sm-3">
										<select name="bashinda" id="bs" class="form-control" onchange="basinda_show_hide(this.value);">
											<option value=''>চিহ্নিত করুন</option>
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
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District" class="col-sm-6 control-label">জেলা </label>
											<div class="col-sm-6">
												<input type="text" name="p_dis" id="p_dis" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="p_thana" id="p_thana" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="p_postof" id="p_postof" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="p_wordno" id="p_wordno" onkeypress="return numtest();"  class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-Block-Sector" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="p_rbs" id="p_rbs" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="p_gram" id="p_gram" class="form-control" />
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
												<input type="text" name="pb_dis" id="pb_dis" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="pb_thana" id="pb_thana" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="pb_postof" id="pb_postof" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="pb_wordno" id="pb_wordno" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-Block-Sector-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="pb_rbs" id="pb_rbs" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="pb_gram" id="pb_gram" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row" id="permaHeading">
							<div class="col-sm-12" style="text-align:center;"> 
								<div class="app-heading"> 
									স্থায়ী  ঠিকানা
								</div>
							</div>
						</div>
						
						<div class="row" id="permanentAddress">
							<div class="col-sm-6">
								<div class="col-sm-offset-6 col-sm-6">
									<div class="app-sub-heading"> 
										( ইংরেজিতে )
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="District" class="col-sm-6 control-label">জেলা </label>
											<div class="col-sm-6">
												<input type="text" name="per_dis" id="per_dis" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="per_thana" id="per_thana" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="per_postof" id="per_postof" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="per_wordno" id="per_wordno" onkeypress="return numtest();"  class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-Block-Sector" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="per_rbs" id="per_rbs" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="per_gram" id="per_gram" class="form-control" />
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
												<input type="text" name="perb_dis" id="perb_dis" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="perb_thana" id="perb_thana" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="perb_postof" id="perb_postof" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="perb_wordno" id="perb_wordno" class="form-control" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-Block-Sector-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="perb_rbs" id="perb_rbs" class="form-control" placeholder=""/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="perb_gram" id="perb_gram" class="form-control" />
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
									<label for="English Applicant Name" class="col-sm-3 control-label small-font"> আবেদনকারীর নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="english_applicant_name" id="" class="form-control" required />
									</div>
									<label for="Bangla Applicant Name" class="col-sm-3 control-label small-font">আবেদনকারীর নাম ( বাংলায় )  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bangla_applicant_name" id="" class="form-control" required />
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="English Applicant Father Name" class="col-sm-3 control-label small-font"> আবেদনকারীর পিতার নাম (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="english_applicant_father_name" id="" class="form-control" required />
									</div>
									<label for="Bangla Applicant Father Name" class="col-sm-3 control-label small-font">আবেদনকারীর পিতার নাম ( বাংলায় )  <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bangla_applicant_father_name" id="" class="form-control" required />
									</div>
								</div>
							</div>
						</div>

						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Mobile" class="col-sm-3 control-label small-font">মোবাইল    <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" minlength="0"  name="mob" id="mob" class="form-control" maxlength="11" onkeypress="return checkaccnumber(event);"  placeholder="ইংরেজিতে প্রদান করুন" required />
									</div>
									<label for="Email" class="col-sm-3 control-label small-font">ইমেল <span>&nbsp;</span></label>
									<div class="col-sm-3">
										<input type="email" name="email" id="email" class="form-control" style="color: black;font-weight: 500;" />
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
						
						<div class="row">
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
						
						<div class="row">
							<div class="col-sm-12"> 
								<div class="form-group">
									<div class="col-sm-3  col-sm-offset-1 extra-margin">
										<input type="text" name="w_name" id="wname" class="form-control" />
									</div>
									<div class="col-sm-3 extra-margin">
										<input type="text" name="w_relation" id="wrel" class="form-control" />
									</div>
									<div class="col-sm-3 extra-margin">
										<input type="text" name="w_age" minlength="0" maxlength="" id="wage" placeholder="ইংরেজিতে" class="form-control" onkeypress="return checkaccnumber(event);" />
									</div>
									<div class="col-sm-2 extra-margin"> 
										<input type="button" name="nwarish" onclick="addRow(this.form);" value='নতুন ওয়ারিশ' class="btn btn-info"/>
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
										<textarea maxlength='350' rows="6" class="form-control" id="appNoteId" name="appNote" style="resize:none;"></textarea>
										<p id="character_count">Characters left: 350</p>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-offset-6 col-sm-6 button-style"> 
								<button type="submit" name='save' id="submit_button"  class="btn btn-primary">দাখিল করুন</button>
							</div>
						</div>
					</form>
				</div>
			</div><!---- /panel primary--------->
		</div>
	</div><!-- row end--->
</div><!--/#content.col-md-10-->