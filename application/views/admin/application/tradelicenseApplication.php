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
		.all-input-form input[type="text"],
		.all-input-form select{
			color: #0C090A;
			font-size:13px;
			font-weight:500;
		}
		.all-input-form input[type="file"]{
			color: #0C090A;
			font-size:13px;
			font-weight:500;
		}
		/* mozila fire fox file input code start */

		@-moz-document url-prefix() {
			.input-file-sm {
				height: auto;
				padding-top: 2px;
				padding-bottom: 1px;
			}
		}
		/* mozila fire fox file input code end */
		.medium-font{
			font-size: 15px;
			font-weight: normal;
		}
		.medium-font-input{
			font-size: 16px !important;
			letter-spacing: 1px;
			color: #333 !important;
		}

	</style>

	<script type="text/javascript"> // clear add row function start
		function clear_form_elements(id_name) {
			jQuery("#"+id_name).find(':input').each(function() {
				switch(this.type) {
					case 'password':
					case 'text':
					case 'textarea':
					case 'file':
					case 'select-one':       
						jQuery(this).val('');
						break;
					case 'checkbox':
					case 'radio':
						this.checked = false;
				}
			});
		}
	</script>
	<script type="text/javascript"> 
/*======= ready function start ==========*/
	$(document).ready(function(){
		$(".samir_nam").hide();
		$("#other_owner").hide();
		$("#inpucompany").hide();

        $('#info').submit(function(e) {
            document.getElementById('submit_button').disabled = 'disabled';
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
                    if(data !=1){
                        document.getElementById('submit_button').disabled = false;
                    }
                    if(data==1)
                    {
                        alert('আপনার আবেদনটি গৃহীত হয়েছে');
                        setTimeout(function() {
                            window.location='Applicant/tradelicenseapplicant?napply=new';}, 1000)
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
                        alert('দুঃখিত আপানর পাসপোর্ট নং পূর্বে ব্যাবহার করা হয়েছে \nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন পাসপোর্ট নং');
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
                }
            });

            return false;
        });
		/*
		$('#info').submit(function() {
			document.getElementById('submit_button').disabled = 'disabled';
			$.post(
			"index.php/Applicant/tradelicenseapplication_action",
			$("#info").serialize(),
			function(data){
				//alert(data);
				if(data !=1){
					document.getElementById('submit_button').disabled = false;
				}
				if(data==1)
				{
					alert('আপনার আবেদনটি গৃহীত হয়েছে');
					setTimeout(function() {
					window.location='Applicant/tradelicenseapplicant?napply=new';}, 1000)
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
					alert('দুঃখিত আপানর পাসপোর্ট নং পূর্বে ব্যাবহার করা হয়েছে \nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন পাসপোর্ট নং');
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
		*/

/*====== Institie owner type change function start ============*/
		$("#type_val").change(function(){
			var p = $("#type_val").val();
			//alert(p);
			if(p==''){
				$('#inpucompany').hide();
				$("#other_owner").hide();
				//$("#itemRows input:text").val("");
				//$('#itemRows').hide();
				$(".clear_all").remove();
			}
			else if(p==1){
				$('#inpucompany').hide();
				$("#other_owner").hide();
				//$("#itemRows input:text").val("");
				//$('#itemRows').hide();
				$(".clear_all").remove();
			}
			else if(p==2){
				$('#inpucompany').show();
				$("#other_owner").show();
				//$("#itemRows input:text").val("");
				//$('#itemRows').show();
				$(".clear_all").remove();
			}
			else if(p==3){
				$('#inpucompany').show();
				$("#other_owner").show();
				//$("#itemRows input:text").val("");
				//$('#itemRows').show();
				$(".clear_all").remove();
			}
			else{
				//$("#itemRows input:text").val("");
				$(".clear_all").remove();
				$('#inpucompany').hide();
				$("#other_owner").hide();
				
			}
		}); 	
			/*====== Institie owner type change function end ============*/
	});

/*======= ready function end ==========*/

/*======== bibhahik obstha function start ==========*/
function bybahik_obosthan_show(mstatus){
	//alert(mstatus);
	var gender=$("#gender").val();
	if(mstatus=='বিবাহিত' && gender=='male'){
		//alert('father id show');
		$("#pitar_nam").show();
		$(".samir_nam input:text").val("");
		$(".samir_nam").hide();
	}
	else if(mstatus=='বিবাহিত' && gender=='female'){
		//alert("husband name show");
		$("#pitar_nam input:text").val("");
		$("#pitar_nam").hide();
		$(".samir_nam").show();
	}
	else if(mstatus=='অবিবাহিত' && gender=='female'){
		//alert("Father name show");
		$("#pitar_nam").show();
		$(".samir_nam input:text").val('');
		$(".samir_nam").hide();
	}
	else if(mstatus=='অবিবাহিত' && gender=='male'){
		//alert('Father name show');
		$("#pitar_nam").show();
		$(".samir_nam input:text").val('');
		$(".samir_nam").hide();
	}
	else{
		
	}
}
/*======== 2nd function ======*/
function bybahik_obosthan_show1(gender){
	var mstatus=$("#mstatus").val();
	if(mstatus=='বিবাহিত' && gender=='male'){
		//alert('Fahter name show');
		$("#pitar_nam").show();
		$(".samir_nam input:text").val('');
		$(".samir_nam").hide();
	}
	else if(mstatus=='বিবাহিত' && gender=='female'){
		//alert('Husband name show');
		$("#pitar_nam input:text").val('');
		$("#pitar_nam").hide();
		$(".samir_nam").show();
	}
	else if(mstatus=='অবিবাহিত' && gender=='female'){
		//alert('Father name show');
		$("#pitar_nam").show();
		$(".samir_nam input:text").val('');
		$(".samir_nam").hide();
	}
	else if(mstatus=='অবিবাহিত' && gender=='male'){
		//alert('Father name show ');
		$("#pitar_nam").show();
		$(".samir_nam input:text").val('');
		$(".samir_nam").hide();
	}
	else{
		
	}
}
/*======== bibhahik obstha function end ==========*/

/*====== other owner Add row functon start =========*/
var rowNum = 0;
function addRow(frm){
	var bwname=document.getElementById("bwname").value;
	var ewname=document.getElementById("ewname").value;
	var gender=$("#gender").val();
	var mstatus=$("#mstatus").val();
	if(bwname==''){
		alert("নতুন মালিকের নাম বাংলায় প্রদান করুন");
	}
	else if(ewname==''){
		alert("নতুন মালিকের নাম ইংরেজিতে প্রদান করুন ");
	}
	else{
		rowNum ++;
		if(gender=='female' && mstatus=='বিবাহিত'){
			//alert(mstatus);
			var row='<div class="clear_all" id="rowNum'+rowNum+'"><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Owner-name-english" class="col-sm-3 control-label">মালিকের নাম ( ইংরেজিতে ) </label><div class="col-sm-3"><input type="text" name="ewname[]" value="'+frm.ewname.value+'" class="form-control" /></div><label for="Owner-name-bangla" class="col-sm-3 control-label">মালিকের নাম ( বাংলায় ) </label><div class="col-sm-3"><input type="text" name="bwname[]" value="'+frm.bwname.value+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Gender" class="col-sm-3 control-label">লিঙ্গ</label><div class="col-sm-3"><input type="text" name="gender[]" value="'+frm.gender.value+'" class="form-control" /></div><label for="Marital-status" class="col-sm-3 control-label"> বৈবাহিক সম্পর্ক </label><div class="col-sm-3"><input type="text" name="mstatus[]" value="'+frm.mstatus.value+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Husband-name-english" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে) </label><div class="col-sm-3"><input type="text" name="esname[]" value="'+frm.esname.value+'" class="form-control" /></div><label for="Husband-name-bangla" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়) </label><div class="col-sm-3"><input type="text" name="bsname[]" value="'+frm.bsname.value+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে) </label><div class="col-sm-3"><input type="text" name="emname[]" value="'+frm.emname.value+'" class="form-control" /></div><label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  </label><div class="col-sm-3"><input type="text" name="bmname[]" value="'+frm.bmname.value+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><div class="col-sm-3 col-sm-offset-9"><input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="removeRow('+rowNum+');" /></div></div></div></div></div>';
		}
		else{
			var row='<div class="clear_all" id="rowNum'+rowNum+'"><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Owner-name-english" class="col-sm-3 control-label">মালিকের নাম ( ইংরেজিতে ) </label><div class="col-sm-3"><input type="text" name="ewname[]" value="'+frm.ewname.value+'" class="form-control" /></div><label for="Owner-name-bangla" class="col-sm-3 control-label">মালিকের নাম ( বাংলায় ) </label><div class="col-sm-3"><input type="text" name="bwname[]" value="'+frm.bwname.value+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Gender" class="col-sm-3 control-label">লিঙ্গ</label><div class="col-sm-3"><input type="text" name="gender[]" value="'+frm.gender.value+'" class="form-control" /></div><label for="Marital-status" class="col-sm-3 control-label"> বৈবাহিক সম্পর্ক </label><div class="col-sm-3"><input type="text" name="mstatus[]" value="'+frm.mstatus.value+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Father-name-english" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে) </label><div class="col-sm-3"><input type="text" name="efname[]" value="'+frm.efname.value+'" class="form-control" /></div><label for="Father-name-bangla" class="col-sm-3 control-label"> পিতার নাম (বাংলায়) </label><div class="col-sm-3"><input type="text" name="bfname[]" value="'+frm.bfname.value+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে) </label><div class="col-sm-3"><input type="text" name="emname[]" value="'+frm.emname.value+'" class="form-control" /></div><label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  </label><div class="col-sm-3"><input type="text" name="bmname[]" value="'+frm.bmname.value+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><div class="col-sm-3 col-sm-offset-9"><input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="removeRow('+rowNum+');" /></div></div></div></div></div>';
		}
		jQuery('#itemRows').append(row);
		clear_form_elements("clearall"); // this function clear all input 
		
		$(".samir_nam").hide();
		$("#pitar_nam").show();
	}
}
function removeRow(rnum){
	jQuery('#rowNum'+rnum).remove();
}
/*====== other owner Add row functon end =========*/

/*========= rew new settion start ===========*/
 function getType(x)
{
	//alert(x);
	document.getElementById("dtype").value=x;	
}
/*========= rew new settion end ===========*/

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
/*============ number test function end===============*/
</script>
	
	<!-- some information query -->
	
	<div class="row">
		<div class="col-md-12"> 
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">ট্রেড লাইসেন্স আবেদন ফরম</div>
				<div class="panel-body all-input-form">
					<form action="index.php/Applicant/tradelicenseapplication_action" method="post" id="info" enctype="multipart/form-data" class="form-horizontal">
                            <div class="row"  style="margin-top: 10px;">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="Picture" class="col-sm-3 control-label">ছবি</label>
                                        <div class="col-sm-5" style="margin-top:3px;">
                                            <input type="file" name="file" class="form-control input-file-sm" />
                                        </div>
                                        <div class="col-sm-4" id="UPLOAD">
                                            <img src="<?php echo base_url('library/profile/default.jpg') ?>" id="image" width="180"  height="170" class="img-thumbnail" />
                                        </div>

                                    </div>
                                </div>
                            </div>

							<div class="row"> 
								<div class="col-sm-12" style="margin-bottom:10px;margin-top:10px;"> 
									<div class="form-group">
										<label for="Delivery-type" class="col-sm-3 control-label">সরবরাহের ধরণ  <span>*</span></label>
										<div class="col-sm-4">
											<label class="radio-inline"><input type="radio" name="delivery_type" value="1" onclick="getType(this.value)">জরুরী</label>
											<label class="radio-inline"><input type="radio" name="delivery_type" value="2" onclick="getType(this.value)">অতি জরুরী  </label>
											<label class="radio-inline"><input type="radio" name="delivery_type" value="3" onclick="getType(this.value)" checked="checked"> সাধারন</label>
										</div>
										<label for="Application-type" class="col-sm-2 control-label">আবেদনের ধরণ    <span>*</span></label>
										<div class="col-sm-3">
											<label class="radio-inline"><input type="radio" name="app_type" id="new_app" value="1" checked="checked">নতুন আবেদন</label>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Owner-type" class="col-sm-3 control-label">প্রতিষ্ঠানের মালিকানার ধরণ <span>*</span></label>
										<div class="col-sm-9">
											<select name="ownertype" id="type_val" class="form-control">
												<?php $bY=$this->db->get("cmd");?>
												<option value="">চিহ্নিত করুন</option>
												<?php foreach($bY->result() as $row):?>
												<option value="<?php echo $row->id;?>"><?php echo $row->title;?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Institute-english-name" class="col-sm-3 control-label">প্রতিষ্ঠানের নাম (ইংরেজিতে )   <span>*</span></label>
										<div class="col-sm-3">
											<input type="text" name="ecomname" id="ecomname" class="form-control" />
										</div>
										<label for="Institute-bangla-name" class="col-sm-3 control-label">প্রতিষ্ঠানের নাম (বাংলায়)   <span>*</span></label>
										<div class="col-sm-3">
											<input type="text" name="bcomname" id="bcomname" class="form-control" />
										</div>
									</div>
									
								</div>
							</div>
							<div id="clearall">
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Owner-name-english" class="col-sm-3 control-label">মালিকের নাম ( ইংরেজিতে )   <span>*</span></label>
											<div class="col-sm-3">
												<input type="text" name="ewname[]" id="ewname" class="form-control" placeholder=""  />
											</div>
											<label for="Owner-name-bangla" class="col-sm-3 control-label">মালিকের নাম ( বাংলায় )  <span>*</span></label>
											<div class="col-sm-3">
												<input type="text" name="bwname[]" id="bwname" class="form-control" placeholder=""  />
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
												<select name="gender[]" id="gender" class="form-control" required onchange="bybahik_obosthan_show1(this.value);" >
													<option value="">চিহ্নিত করুন</option>
													<option value="male">পুরুষ</option>
													<option value="female">মহিলা</option>
													<option value="others">অন্যান্য</option>
												</select>
											</div>
											<label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক  <span>*</span></label>
											<div class="col-sm-3">
												<select name="mstatus[]" id="mstatus" class="form-control" required onchange="bybahik_obosthan_show(this.value);" >
													<option value="">চিহ্নিত করুন</option>
													<option value="বিবাহিত">বিবাহিত</option>
													<option value="অবিবাহিত">অবিবাহিত</option>
													<option value="বিধবা">বিপত্নীক / বিধবা</option>
													<option value="তালাকপ্রাপ্ত">তালাকপ্রাপ্ত</option>
													<option value="দরকার নাই">দরকার নাই</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								
									
								<div class="row" id="pitar_nam">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Father-name-english" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)  <span>*</span></label>
											<div class="col-sm-3">
												<input type="text" name="efname[]" id="efname" class="form-control" placeholder=""/>
											</div>
											<label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (বাংলায়)  <span>*</span></label>
											<div class="col-sm-3">
												<input type="text" name="bfname[]" id="bfname" class="form-control" placeholder="" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row samir_nam">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Husband-name-english" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
											<div class="col-sm-3">
												<input type="text" name="esname[]" id="esname" class="form-control" placeholder=""/>
											</div>
											<label for="Husband-name-bangla" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়)</label>
											<div class="col-sm-3">
												<input type="text" name="bsname[]" id="bsname" class="form-control" placeholder="" />
											</div>
										</div>
									</div>
								</div>
							
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)  <span>*</span></label>
											<div class="col-sm-3">
												<input type="text" name="emname[]" id="emname" class="form-control" placeholder=""/>
											</div>
											<label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  <span>*</span></label>
											<div class="col-sm-3">
												<input type="text" name="bmname[]" id="bmname" class="form-control" placeholder="" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row" id="other_owner">
								<div class="col-sm-12"> 
									<div class="form-group">
										<div class="col-sm-3 col-sm-offset-9">
											<input type="button" class="btn btn-primary" id='natun' name="ncompany" onclick="addRow(this.form);" value='অন্যান্য মালিক' />
										</div>
									</div>
								</div>
							</div>
							
							<div id="itemRows"> 
								
							</div>

							<div class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Vat-id" class="col-sm-3 control-label">ভ্যাট  আইডি (যদি থাকে) </label>
										<div class="col-sm-3">
											<input type="text" name="vatid" id="vatid" class="form-control" maxlength='17' placeholder="ইংরেজিতে"  onkeypress="return checkaccnumber(event);"  />
										</div>
										<label for="Tax-id" class="col-sm-3 control-label">ট্যাক্স আইডি (যদি থাকে)</label>
										<div class="col-sm-3">
											<input type="text" name="taxid" id="taxid" class="form-control" maxlength='17' placeholder="ইংরেজিতে"  onkeypress="return checkaccnumber(event);" />
										</div>
									</div>
									
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Business-type-bangla" class="col-sm-3 control-label">ব্যবসার ধরন (বাংলায়)  <span>*</span></label>
										<div class="col-sm-9">
											<input type="text" name="business_type" id="btypes" class="form-control" placeholder=""/>
										</div>
									</div>
									
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Business-type-English" class="col-sm-3 control-label">ব্যবসার ধরন (ইংরেজিতে)  <span>*</span></label>
										<div class="col-sm-9">
											<input type="text" name="business_type_english" id="btypes_english" class="form-control" placeholder=""/>
										</div>
									</div>
									
								</div>
							</div>
							
							<div class="row" id="inpucompany">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Paid-up-capital" class="col-sm-3 control-label" style="color:red;">পরিশোধিত মূলধন (লিঃ কোম্পানির ক্ষেত্রে )<span> *</span></label>
										<div class="col-sm-3">
											<input type="text" name="pay_amount" value="0.00" class="form-control" placeholder=""/>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-12"> 
									<div class="app-heading"> 
										ব্যবসার ঠিকানা
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
													<input type="text" name="be_dis" id="be_dis" class="form-control" placeholder=""/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Thana" class="col-sm-6 control-label">উপজেলা/থানা</label>
												<div class="col-sm-6">
													<input type="text" name="be_thana" id="be_thana" class="form-control" placeholder=""/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Post-office" class="col-sm-6 control-label">পোষ্ট অফিস </label>
												<div class="col-sm-6">
													<input type="text" name="be_postof" id="be_postof" class="form-control" placeholder=""/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Word-no" class="col-sm-6 control-label">ওয়ার্ড নং</label>
												<div class="col-sm-6">
													<input type="text" name="be_wordno" id="be_wordno" class="form-control" onkeypress="return checkaccnumber(event);"  placeholder=""/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Road-sector-block" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
												<div class="col-sm-6">
													<input type="text" name="be_rbs" id="be_rbs" class="form-control" placeholder=""/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Village-english" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
												<div class="col-sm-6">
													<input type="text" name="be_gram" id="begram" class="form-control" placeholder=""/>
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
													<input type="text" name="bb_dis" id="bb_dis" class="form-control" placeholder=""/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা</label>
												<div class="col-sm-6">
													<input type="text" name="bb_thana" id="bb_thana" class="form-control" placeholder=""/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস </label>
												<div class="col-sm-6">
													<input type="text" name="bb_postof" id="bb_postof" class="form-control" placeholder=""/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং</label>
												<div class="col-sm-6">
													<input type="text" name="bb_wordno" id="bb_wordno" class="form-control" placeholder=""/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Road-sector-block-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
												<div class="col-sm-6">
													<input type="text" name="bb_rbs" id="bb_rbs" class="form-control" placeholder=""/>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-12"> 
											<div class="form-group">
												<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
												<div class="col-sm-6">
													<input type="text" name="bb_gram" id="bb_gram" class="form-control" placeholder=""/>
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
											<input type="text" name="mob" id="mob" class="form-control" maxlength="11" placeholder="ইংরেজিতে প্রদান করুন"  onkeypress="return checkaccnumber(event);" required />
										</div>
										<label for="Phone" class="col-sm-3 control-label">ফোন (যদি থাকে ) </label>
										<div class="col-sm-3">
											<input type="text" name="phone" id="phone" class="form-control" onkeypress="return checkaccnumber(event);"  placeholder=""/>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Email" class="col-sm-3 control-label">ইমেল</label>
										<div class="col-sm-3">
											<input type="text" name="email" id="email" class="form-control" placeholder=""/>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-offset-6 col-sm-6 button-style"> 
									<button type="submit" name="save" id="submit_button" class="btn btn-primary">দাখিল করুন</button>
								</div>
							</div>
						</form>
				</div><!-- panel-body-end---->
			</div><!--- end of panel primary--->
		</div><!-- end of col-md-12---->
	</div><!-- row end--->
</div><!--/#content.col-md-10-->