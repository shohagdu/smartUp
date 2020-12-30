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
				$(".renewTrade").hide();
				$("#inpucompany").hide();

                $('#info').submit(function(e) {
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
					$("#load").empty().append('<img src="library/img/ajaxloader.gif">');
					$.post(
					"index.php/Update/tradelicenseUpdate",
					$("#info").serialize(),
					function(data){
						if(data==1)
						{
							alert('আপনার আবেদনটি সঠিকভাবে পরিবর্তন করা হয়েছে');
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
				
				
			/*=======  Application and Nobayaon hide show function start =========*/	
				$('input:radio[name="app_type"]').change(function(){
					var app_type=$(this).val();
					//alert(app_type);
					if(app_type=='1'){
						$(".newTrade").show();
						$(".renewTrade").hide();
						$("#other_owner").hide();
						$("#inpucompany").hide();
					}
					else{
						$('.renewTrade').show();
						$('.newTrade').hide();
					}
				});
		/*======= Application and Nobayaon hide show function end ==========*/	
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
			var gender=$("#gender:checked").val();
			if(mstatus=='1' && gender=='male'){
				//alert('father id show');
				$("#pitar_nam").show();
				$(".samir_nam input:text").val("");
				$(".samir_nam").hide();
			}
			else if(mstatus=='1' && gender=='female'){
				//alert("husband name show");
				$("#pitar_nam input:text").val("");
				$("#pitar_nam").hide();
				$(".samir_nam").show();
			}
			else if(mstatus=='2' && gender=='female'){
				//alert("Father name show");
				$("#pitar_nam").show();
				$(".samir_nam input:text").val('');
				$(".samir_nam").hide();
			}
			else if(mstatus=='2' && gender=='male'){
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
			var mstatus=$("#mstatus:checked").val();
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
			var bwname=document.getElementById("bwname"+frm).value;
			var ewname=document.getElementById("ewname"+frm).value;
			var gender=document.getElementById("gender"+frm).value;
			var mstatus=document.getElementById("mstatus"+frm).value;
			var esname=document.getElementById("esname"+frm).value;
			var bsname=document.getElementById("bsname"+frm).value;
			var emname=document.getElementById("emname"+frm).value;
			var bmname=document.getElementById("bmname"+frm).value;
			var efname=document.getElementById("efname"+frm).value;
			var bfname=document.getElementById("bfname"+frm).value;
			
			//var gender=$("#gender:checked").val();
			//var mstatus=$("#mstatus:checked").val();
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
					var row='<div class="clear_all" id="rowNum'+rowNum+'"><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Owner-name-english" class="col-sm-3 control-label">মালিকের নাম ( ইংরেজিতে ) </label><div class="col-sm-3"><input type="text" name="ewname[]" value="'+ewname+'" class="form-control" /></div><label for="Owner-name-bangla" class="col-sm-3 control-label">মালিকের নাম ( বাংলায় ) </label><div class="col-sm-3"><input type="text" name="bwname[]" value="'+bwname+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Gender" class="col-sm-3 control-label">লিঙ্গ</label><div class="col-sm-3"><input type="text" name="gender[]" value="'+gender+'" class="form-control" /></div><label for="Marital-status" class="col-sm-3 control-label"> বৈবাহিক সম্পর্ক </label><div class="col-sm-3"><input type="text" name="mstatus[]" value="'+mstatus+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Husband-name-english" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে) </label><div class="col-sm-3"><input type="text" name="esname[]" value="'+esname+'" class="form-control" /></div><label for="Husband-name-bangla" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়) </label><div class="col-sm-3"><input type="text" name="bsname[]" value="'+bsname+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে) </label><div class="col-sm-3"><input type="text" name="emname[]" value="'+emname+'" class="form-control" /></div><label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  </label><div class="col-sm-3"><input type="text" name="bmname[]" value="'+bmname+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><div class="col-sm-3 col-sm-offset-9"><input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="removeRow('+rowNum+');" /></div></div></div></div></div>';
				}
				else{
					var row='<div class="clear_all" id="rowNum'+rowNum+'"><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Owner-name-english" class="col-sm-3 control-label">মালিকের নাম ( ইংরেজিতে ) </label><div class="col-sm-3"><input type="text" name="ewname[]" value="'+ewname+'" class="form-control" /></div><label for="Owner-name-bangla" class="col-sm-3 control-label">মালিকের নাম ( বাংলায় ) </label><div class="col-sm-3"><input type="text" name="bwname[]" value="'+bwname+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Gender" class="col-sm-3 control-label">লিঙ্গ</label><div class="col-sm-3"><input type="text" name="gender[]" value="'+gender+'" class="form-control" /></div><label for="Marital-status" class="col-sm-3 control-label"> বৈবাহিক সম্পর্ক </label><div class="col-sm-3"><input type="text" name="mstatus[]" value="'+mstatus+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Father-name-english" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে) </label><div class="col-sm-3"><input type="text" name="efname[]" value="'+efname+'" class="form-control" /></div><label for="Father-name-bangla" class="col-sm-3 control-label"> পিতার নাম (বাংলায়) </label><div class="col-sm-3"><input type="text" name="bfname[]" value="'+bfname+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে) </label><div class="col-sm-3"><input type="text" name="emname[]" value="'+emname+'" class="form-control" /></div><label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  </label><div class="col-sm-3"><input type="text" name="bmname[]" value="'+bmname+'" class="form-control" /></div></div></div></div><div class="row"><div class="col-sm-12"><div class="form-group"><div class="col-sm-3 col-sm-offset-9"><input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="removeRow('+rowNum+');" /></div></div></div></div></div>';
				}
				jQuery('#itemRows').append(row);
				clear_form_elements("rowNum0"); // this function clear all input 
				
				$(".samir_nam").hide();
				$("#pitar_nam").show();
			}
		}
		function removeRow(rnum){
			jQuery('#rowNum'+rnum).remove();
		}
		/*====== other owner Add row functon end =========*/
		
		/*============ number test function start ===============*/
		function numtest(){
			return event.charCode >= 48 && event.charCode <= 57;
		}
		/*============ number test function end===============*/
	</script>
	
	<!-- some information query -->
	
	<div class="row">
		<div class="col-md-12"> 
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">আপনার তথ্য আপডেট করুন</div>
				<div class="panel-body all-input-form">
					<form action="Update/profile_upload" method="post" enctype="multipart/form-data" class="form-horizontal" name="upform" id="upform">

					</form>
				
					<form action="index.php/Update/tradelicenseUpdate" method="post" id="info" enctype="multipart/form-data" class="form-horizontal">
                        <div class="row"  style="margin-top: 10px;">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="Picture" class="col-sm-3 control-label">ছবি</label>
                                    <div class="col-sm-5" style="margin-top:3px;">
                                        <input type="file" onchange="loadFile(event)" name="file" class="form-control input-file-sm" />
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>
                        </div>
						<div class="row"> 
							<div class=" col-sm-offset-3 col-sm-9" id="UPLOAD">
								<img src="<?php echo $row->profile?>" id="image" width="180" height="170" class="img-thumbnail" />
								<input type='hidden' name='profile' value='<?php echo $row->profile?>'/>
							</div>
						</div>
						<div class="row medium-font"> 
							<div class="col-sm-12" style="margin-bottom:10px;margin-top:10px;"> 
								<div class="form-group">
									<label for="Delivery-type" class="col-sm-3 control-label">সরবরাহের ধরণ  <span>*</span></label>
									<div class="col-sm-9">
										<label class="radio-inline"><input type="radio" name="delivery_type" value="1" <?php if($row->delivery_type==1){echo "Checked";}?>>জরুরী</label>
										<label class="radio-inline"><input type="radio" name="delivery_type" value="2" <?php if($row->delivery_type==2){echo "Checked";}?>>অতি জরুরী  </label>
										<label class="radio-inline"><input type="radio" name="delivery_type" value="3" <?php if($row->delivery_type==3){echo "Checked";}?>> সাধারন</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Owner-type" class="col-sm-3 control-label">প্রতিষ্ঠানের মালিকানার ধরণ <span>*</span></label>
									<div class="col-sm-9">
										<?php $owner=$row->ownertype;?>
										<select name="ownertype" id="type_val" class="form-control medium-font-input" readonly disabled>
											<?php $bY=$this->db->get("cmd");?>
											<?php foreach($bY->result() as $row1):?>
											<option value="<?php echo $row1->id;?>" <?php if($row1->id==$owner){ echo "Selected";} ?>><?php echo $row1->title;?></option>
											<?php endforeach;?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Institute-english-name" class="col-sm-3 control-label">প্রতিষ্ঠানের নাম (ইংরেজিতে )   <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="ecomname" id="ecomname" class="form-control medium-font-input" value="<?php echo $row->ecomname?>" />
									</div>
									<label for="Institute-bangla-name" class="col-sm-3 control-label">প্রতিষ্ঠানের নাম (বাংলায়)   <span>*</span></label>
									<div class="col-sm-3">
										<input type="text" name="bcomname" id="bcomname"  class="form-control medium-font-input" value="<?php echo $row->bcomname?>" />
									</div>
								</div>
								
							</div>
						</div>
						
<!-- ownership member start -->
				<div id="clearall">
					<?php
						// owner name english and bangla.......
						$ownerEng 	= explode(",",$row->ewname);
						$ownerBan	= explode(",",$row->bwname);
						//
						$gender 	= explode(",",$row->gender);
						$mstatus	= explode(",",$row->mstatus); 
						/* echo '<pre>';
						print_r($gender); */
						// mother name english and bangla.........
						$motherEng 	= explode(",",$row->emname);
						$motherBan	 = explode(",",$row->bmane);
						
						// father name
						$f = 0;
						$fatherEn = explode(",",$row->efname);
						$fatherBn = explode(",",$row->bfname);
						
						// husband name
						$h = 0;
						$husEn = explode(",",$row->ehname);
						$husBn = explode(",",$row->bhname);
					
						for($i=0;$i<count($ownerEng);$i++):
					?>

						<div id="rowNum<?php echo $i; ?>">
						<div class="clear_all">
							<div class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Owner-name-english" class="col-sm-3 control-label">মালিকের নাম ( ইংরেজিতে )   <span>*</span></label>
										<div class="col-sm-3">
											<input type="text" name="ewname[]" id="ewname<?php echo $i ?>" class="form-control" placeholder=""  value="<?php echo $ownerEng[$i]; ?>" />
										</div>
										<label for="Owner-name-bangla" class="col-sm-3 control-label">মালিকের নাম ( বাংলায় )  <span>*</span></label>
										<div class="col-sm-3">
											<input type="text" name="bwname[]" id="bwname<?php echo $i; ?>" class="form-control" value="<?php echo $ownerBan[$i];?>"  />
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Gender" class="col-sm-3 control-label">লিঙ্গ   <span>*</span></label>
										<div class="col-sm-3">
											<!--<label class="radio-inline"><input type="radio" name="gender<?php echo $i; ?>[]" id="gender" value="male" <?php if($gender[$i]=='male'){ echo 'Checked';}?> onclick="bybahik_obosthan_show1(this.value);">পুরুষ </label>
											<label class="radio-inline"><input type="radio" name="gender<?php echo $i; ?>[]" id="gender" value="female" <?php if($gender[$i]=='female'){ echo 'Checked';}?> onclick="bybahik_obosthan_show1(this.value);">মহিলা</label>-->
											
											<select name="gender[]" id="gender<?php echo $i; ?>" class="form-control medium-font-input">
												<option value="male" <?php if($gender[$i]=='male'):echo "selected";endif; ?>>Male</option>
												<option value="female" <?php if($gender[$i]=='female'):echo "selected";endif; ?> >Female</option>
											</select>
										</div>
										<label for="Marital-status" class="col-sm-3 control-label">বৈবাহিক সম্পর্ক   <span>*</span></label>
										<div class="col-sm-3">
											<!---<label class="radio-inline"><input type="radio" name="mstatus[]" id="mstatus" value="বিবাহিত" onclick="bybahik_obosthan_show('1');">বিবাহিত </label>
											<label class="radio-inline"><input type="radio" name="mstatus[]" id="mstatus" value="অবিবাহিত" onclick="bybahik_obosthan_show('2');">অবিবাহিত</label>---->
											<select name="mstatus[]" id="mstatus<?php echo $i;?>" class="form-control medium-font-input">
												<option value="বিবাহিত" <?php if($mstatus[$i]=="বিবাহিত"): echo "selected";endif;?>>বিবাহিত</option>
												<option value="অবিবাহিত" <?php if($mstatus[$i]=="অবিবাহিত"): echo "selected";endif;?>>অবিবাহিত</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							
							<?php
								if(($gender[$i]=='female') && ($mstatus[$i]=="বিবাহিত")):
									$fth = "display:none;";
									$hsd = "display:block;";
									
								else:
									$fth = "display:block;";
									$hsd = "display:none;";
									
								endif;
							?>
								
							<div class="row" id="pitar_nam" style="<?php echo $fth; ?>">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Father-name-english" class="col-sm-3 control-label">পিতার নাম (ইংরেজিতে)  <span>*</span></label>
										<div class="col-sm-3">
											<input type="text" name="efname[]" id="efname<?php echo $i; ?>" class="form-control" placeholder="" value="<?php if(!(($gender[$i]=='female') && ($mstatus[$i]=="বিবাহিত"))):if($fatherEn[$f]==''):$f++;endif;echo $fatherEn[$f];endif; ?>" />
										</div>
										<label for="Father-name-bangla" class="col-sm-3 control-label">পিতার নাম (বাংলায়)  <span>*</span></label>
										<div class="col-sm-3">
											<input type="text" name="bfname[]" id="bfname<?php echo $i; ?>" class="form-control" placeholder="" value="<?php if(!(($gender[$i]=='female') && ($mstatus[$i]=="বিবাহিত"))):echo $fatherBn[$f];$f++;endif; ?>" />
										</div>
									</div>
								</div>
							</div>
							
							<div class="row samir_nam" style="<?php echo $hsd; ?>">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Husband-name-english" class="col-sm-3 control-label">স্বামীর নাম (ইংরেজিতে)</label>
										<div class="col-sm-3">
											<input type="text" name="ehname[]" id="ehname<?php echo $i; ?>" class="form-control" placeholder="" value="<?php if((($gender[$i]=='female') && ($mstatus[$i]=="বিবাহিত"))):if($husEn[$h]==''):$h++;endif;echo $husEn[$h];endif; ?>" />
										</div>
										<label for="Husband-name-bangla" class="col-sm-3 control-label"> স্বামী নাম (বাংলায়)</label>
										<div class="col-sm-3">
											<input type="text" name="bhname[]" id="bhname<?php echo $i; ?>" class="form-control" placeholder="" value="<?php if((($gender[$i]=='female') && ($mstatus[$i]=="বিবাহিত"))):echo $husBn[$h];$h++;endif; ?>" />
										</div>
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Mother-name-english" class="col-sm-3 control-label">মাতার নাম (ইংরেজিতে)  <span>*</span></label>
										<div class="col-sm-3">
											<input type="text" name="emname[]" id="emname<?php echo $i; ?>" class="form-control" value="<?php echo $motherEng[$i];?>"/>
										</div>
										<label for="Mother-name-bangla" class="col-sm-3 control-label">মাতার নাম (বাংলায়)  <span>*</span></label>
										<div class="col-sm-3">
											<input type="text" name="bmname[]" id="bmname<?php echo $i; ?>" class="form-control" value="<?php echo $motherBan[$i];?>" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php if( $i > 0 ): ?>
							<div class="row"><div class="col-sm-12"><div class="form-group"><div class="col-sm-3 col-sm-offset-9"><input type="button" class="btn btn-danger btn-xs" value="Remove" onclick="removeRow('<?php echo $i ?>');" /></div></div></div></div>
						<?php endif; ?>
						<?php
							if( $i == 0 ):
								$advl = $i;
								if(( $owner == 2 ) || ( $owner == 3 ) ):
									$wner_style = "display:block;";
								else:
									$wner_style = "display:none;";
								endif;
							else:
								$wner_style = "display:none;";
							endif;
						?>
						<div class="row" id="other_owner" style="<?php echo $wner_style; ?>">
							<div class="col-sm-12"> 
								<div class="form-group">
									<div class="col-sm-3 col-sm-offset-9">
										<input type="button" class="btn btn-primary" id='natun' name="ncompany" onclick="addRow(<?php echo $advl; ?>);" value='অন্যান্য মালিক' />
									</div>
								</div>
							</div>
						</div>
						</div>
						
						
						<?php endfor; ?>
						</div>
						<!-- ownership member end -->
						
						
						
						<div id="itemRows"> 
							
						</div>

						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Vat-id" class="col-sm-3 control-label">ভ্যাট  আইডি (যদি থাকে) </label>
									<div class="col-sm-3">
										<input type="text" name="vatid" id="vatid" class="form-control medium-font-input" maxlength='17' value="<?php echo $row->vatid?>" onkeypress="return numtest();"  />
									</div>
									<label for="Tax-id" class="col-sm-3 control-label">ট্যাক্স আইডি (যদি থাকে)</label>
									<div class="col-sm-3">
										<input type="text" name="taxid" id="taxid" class="form-control medium-font-input" maxlength='17' value="<?php echo $row->taxid?>"  onkeypress="return numtest();" />
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Business-type-bangla" class="col-sm-3 control-label">ব্যবসার ধরন (বাংলায়)  <span>*</span></label>
									<div class="col-sm-9">
										<input type="text" name="btype" id="btypes" class="form-control medium-font-input" value="<?php echo $row->btype;?>" />
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Business-type-English" class="col-sm-3 control-label">ব্যবসার ধরন (ইংরেজিতে)  <span>*</span></label>
									<div class="col-sm-9">
										<input type="text" name="business_type_english" id="btypes_english" class="form-control medium-font-input" value="<?php echo $row->btype_english;?>" />
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="row medium-font" id="inpucompany">
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
						
						<div class="row newTrade">
							<div class="col-sm-12"> 
								<div class="app-heading"> 
									ব্যবসার ঠিকানা
								</div>
							</div>
						</div>
						
						<div class="row newTrade">
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
												<input type="text" name="be_dis" id="be_dis" class="form-control medium-font-input" value="<?php echo $row->be_dis?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="be_thana" id="be_thana" class="form-control medium-font-input" value="<?php echo $row->be_thana?>" />
											</div>
										</div>
									</div>
								</div>
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="be_postof" id="be_postof" class="form-control medium-font-input" value="<?php echo $row->be_postof?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="be_wordno" id="be_wordno" class="form-control medium-font-input" onkeypress="return numtest();"  value="<?php echo $row->be_wordno?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-sector-block" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="be_rbs" id="be_rbs" class="form-control medium-font-input" value="<?php echo $row->be_rbs ?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-english" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="be_gram" id="begram" class="form-control medium-font-input" value="<?php echo $row->be_gram?>" />
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
												<input type="text" name="bb_dis" id="bb_dis" class="form-control medium-font-input" value="<?php echo $row->bb_dis?>"/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Thana-bangla" class="col-sm-6 control-label">উপজেলা/থানা</label>
											<div class="col-sm-6">
												<input type="text" name="bb_thana" id="bb_thana" class="form-control medium-font-input" value="<?php echo $row->bb_thana?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Post-office-bangla" class="col-sm-6 control-label">পোষ্ট অফিস </label>
											<div class="col-sm-6">
												<input type="text" name="bb_postof" id="bb_postof" class="form-control medium-font-input" value="<?php echo $row->bb_postof?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Word-no-bangla" class="col-sm-6 control-label">ওয়ার্ড নং</label>
											<div class="col-sm-6">
												<input type="text" name="bb_wordno" id="bb_wordno" class="form-control medium-font-input" value="<?php echo $row->bb_wordno?>"/>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Road-sector-block-bangla" class="col-sm-6 control-label">রোড/ব্লক/সেক্টর</label>
											<div class="col-sm-6">
												<input type="text" name="bb_rbs" id="bb_rbs" class="form-control medium-font-input" value="<?php echo $row->bb_rbs?>" />
											</div>
										</div>
									</div>
								</div>
								
								<div class="row medium-font">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="Village-bangla" class="col-sm-6 control-label">গ্রাম/মহল্লা </label>
											<div class="col-sm-6">
												<input type="text" name="bb_gram" id="bb_gram" class="form-control medium-font-input" value="<?php echo $row->bb_gram?>" />
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
										<input type="text" name="mob" id="mob" class="form-control medium-font-input" maxlength="11" placeholder="ইংরেজিতে প্রদান করুন" value="<?php echo $row->mobile?>" onkeypress="return numtest();" required />
									</div>
									<label for="Phone" class="col-sm-3 control-label">ফোন (যদি থাকে ) </label>
									<div class="col-sm-3">
										<input type="text" name="phone" id="phone" class="form-control medium-font-input" onkeypress="return numtest();"  value="<?php echo $row->phone?>" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="row medium-font">
							<div class="col-sm-12"> 
								<div class="form-group">
									<label for="Email" class="col-sm-3 control-label">ইমেল</label>
									<div class="col-sm-3">
										<input type="text" name="email" id="email" class="form-control medium-font-input" value="<?php echo $row->email?>" />
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>

						<div class="row newTrade">
							<div class="col-sm-offset-6 col-sm-6 button-style"> 
								<input type='submit' value="আপডেট করুন" name='save' class="btn btn-info btn-sm"/>
								<span id="load"></span>
								<input type='hidden' name='trackid' value='<?php echo $row->trackid?>'/>
								<input type='hidden' name='uid' value='<?php echo $row->id?>'/>
							</div>
						</div>
					</form>
				</div><!-- panel-body-end---->
			</div><!--- end of panel primary--->
		</div><!-- end of col-md-12---->
	</div><!-- row end--->
</div><!--/#content.col-md-10-->
