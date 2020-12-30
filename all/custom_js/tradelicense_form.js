	$(document).ready(function() {
		$(".samir_nam").css("display","none");
		$("#other_owner").css("display","none");
		$("#inpucompany").css("display","none");
		
		$('#defaultForm')
		.formValidation({
			message: 'This value is not valid',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				delivery_type: {
					validators: {
						notEmpty: {
							message: 'The delivery type is required.'
						}
					}
				},
				app_type: {
					validators: {
						notEmpty: {
							message: 'The application type is required'
						}
					}
				},
				ownertype: {
					validators: {
						notEmpty: {
							message: 'The field is required.'
						}
					}
				},
				ecomname: {
					verbose: false,
					validators: {
						notEmpty: {
							message: 'The Institution name is required'
						},
						remote: {
							message: 'Oops!!! already exist',
							url: 'index.php/validation/check_uniqueInstituteName?tbl='+"tradelicense",
							type: 'POST'
						}
					}
				},
				bcomname: {
					verbose: false,
					validators: {
						notEmpty: {
							message: 'The Institution name is required'
						},
						remote: {
							message: 'Oops !!! already exist',
							url: 'index.php/validation/check_banglaUniqueInstituteName?tbl='+"tradelicense",
							type: 'POST'
						}
					}
				},
				'ewname[]': {
					validators: {
						notEmpty: {
							message: 'The owner name field is required'
						}
					}
				},
				'bwname[]': {
					validators: {
						notEmpty: {
							message: 'The owner name field is required'
						}
					}
				},
				'gender[]': {
					validators: {
						notEmpty: {
							message: 'The gender is required'
						}
					}
				},
				'mstatus[]': {
					validators: {
						notEmpty: {
							message: 'The Marital Status is required'
						}
					}
				},
				'efname[]': {
					validators: {
						notEmpty: {
							message: 'The Father Name is required'
						}
					}
				},
				'bfname[]': {
					validators: {
						notEmpty: {
							message: 'The Father Name is required'
						}
					}
				},
				'esname[]': {
					validators: {
						notEmpty: {
							message: 'The Husband Name is required'
						}
					}
				},
				'bsname[]': {
					validators: {
						notEmpty: {
							message: 'The Husband Name is required'
						}
					}
				},
				'emname[]': {
					validators: {
						notEmpty: {
							message: 'The Mother Name is required'
						}
					}
				},
				'bmname[]': {
					validators: {
						notEmpty: {
							message: 'The Mother Name is required'
						}
					}
				},
				vatid: {
					validators: {
						stringLength: {
							max: 20,
							min: 4,
							message: 'VAT id number more than 4 and less then 20 character'
						},
						numeric: {
							message: 'Only allowed numeric number'
						},
						remote: {
							message: 'Oops !!! already exist',
							url: 'index.php/validation/check_uniqueVatid',
							type: 'POST'
						}
					}
				},
				taxid: {
					validators: {
						stringLength: {
							max: 20,
							min: 4,
							message: 'TAX id number more than 4 and less then 20 character'
						},
						numeric: {
							message: 'Only allowed numeric number'
						},
						remote: {
							message: 'Oops !!! already exist',
							url: 'index.php/validation/check_uniqueTaxid',
							type: 'POST'
						}
					}
				},
				business_type: {
					validators: {
						notEmpty: {
							message: 'Bangla Business Type field is required'
						},
						stringLength: {
							max: 255,
							message: 'less than 255 character'
						}
					}
				},
				business_type_english: {
					validators: {
						notEmpty: {
							message: 'English Business Type field is required'
						},
						stringLength: {
							max: 255,
							message: 'less than 255 character'
						}
					}
				},
				be_gram: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				bb_gram: {
					validators: {
						stringLength: {
							max: 100,
							message: 'less then 100 character'
						}	
					}
				},
				be_rbs: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				bb_rbs: {
					validators: {
						stringLength: {
							max: 80,
							message: 'less then 80 character'
						}	
					}
				},
				be_wordno: {
					validators: {
						stringLength: {
							max: 3,
							message: 'less then 3 character'
						},
						numeric: {
							message: 'Only allowed numeric number'
						}
					}
				},
				bb_wordno: {
					validators: {
						stringLength: {
							max: 3,
							message: 'less then 3 character'
						}
					}
				},
				be_dis: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				bb_dis: {
					validators: {
						stringLength: {
							max: 100,
							message: 'less then 100 character'
						}	
					}
				},
				be_thana: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				bb_thana: {
					validators: {
						stringLength: {
							max: 100,
							message: 'less then 100 character'
						}	
					}
				},
				be_postof: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				bb_postof: {
					validators: {
						stringLength: {
							max: 100,
							message: 'less then 100 character'
						}	
					}
				},
				mob: {
					verbose: false,
					validators: {
						notEmpty: {
							message: 'The Mobile Number is required'
						},
						regexp: {
							regexp: /^(?:\+?88)?01[13-9]\d{8}$/,
							message: 'Invalid mobile number'
						},
						numeric: {
							message: 'Only allowed numeric mobile number'
						},
						remote: {
							url: 'index.php/validation/check_uniqueMob?tbl='+"tradelicense",
							type: 'POST'
						}
					}
				},
				phone: {
					validators: {
						numeric: {
							message: 'Only allowed numeric mobile number'
						},
						stringLength: {
							min: 7,
							max: 11,
							message : "Phone number more than 7 and less than 11 character"
						}
					}
				},
				email: {
					validators: {
						emailAddress: {
							message: 'The input is not a valid email address'
						}
					}
				}
			}
		})
		 .on('success.validator.fv', function(e, data) {

            if (data.field === 'mob'
                && data.validator === 'remote'
                && (data.result.available === false || data.result.available === 'false'))
            {
                data.element                    // Get the field element
                    .closest('.form-group')     // Get the field parent

                    // Add has-warning class
                    .removeClass('has-success')
                    .addClass('has-warning')

                    // Show message
                    .find('small[data-fv-validator="remote"][data-fv-for="mob"]')
                        .show();
            }
        })
        // This event will be triggered when the field doesn't pass given validator
        .on('err.validator.fv', function(e, data) {
            // We need to remove has-warning class
            // when the field doesn't pass any validator
            if (data.field === 'mob') {
                data.element
                    .closest('.form-group')
                    .removeClass('has-warning');
            }
        })
		
		.on('success.form.fv', function(e) {
			// Prevent form submission
			e.preventDefault();

			var $form = $(e.target),
				fv    = $form.data('formValidation');
			// Use Ajax to submit form data
			// var u=$form.attr('action');
			// var u=$form.serialize();
			var formData = new FormData(this);
			$.ajax({
				url: $form.attr('action'),
				type: 'POST',
				data: formData,
				cache:false,
				contentType: false,
				processData: false,
				beforeSend:function() { alert('sending----'); },
				success: function(data) {
					//var obj = JSON.parse(result);
					// alert(obj.message);
					//alert(result.message);
					if(data==1)
					{
						alert('আপনার আবেদনটি গৃহীত হয়েছে\n Tracking No টি নিয়ে আপনার ইউনিয়ন পরিষদে\n যোগাযোগ করুন');
						window.location='index.php/home/tpreview';
					}
					else{
						alert(data);
					}
				}
			});
		})
	});
	
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

 // clear add row function start
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

	/*======= ready function start ==========*/
		$(document).ready(function(){
			
		/*====== Institie owner type change function start ============*/
			$("#type_val").change(function(){
				var p = $("#type_val").val();
				//alert(p);
				if(p==''){
					$('#inpucompany').css("display","none");
					$("#other_owner").css("display","none");
					$(".clear_all").remove();
				}
				else if(p==1){
					$('#inpucompany').css("display","none");
					$("#other_owner").css("display","none");
					$(".clear_all").remove();
				}
				else if(p==2){
					$('#inpucompany').css("display","block");
					$("#other_owner").css("display","block");
					$(".clear_all").remove();
				}
				else if(p==3){
					$('#inpucompany').css("display","block");
					$("#other_owner").css("display","block");
					$(".clear_all").remove();
				}
				else{
					$(".clear_all").remove();
					$('#inpucompany').css("display","none");
					$("#other_owner").css("display","none");
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
			$("#pitar_nam").css("display","block");
			$(".samir_nam input:text").val("");
			$(".samir_nam").css("display","none");
		}
		else if(mstatus=='বিবাহিত' && gender=='female'){
			//alert("husband name show");
			$("#pitar_nam input:text").val("");
			$("#pitar_nam").css("display","none");
			$(".samir_nam").css("display","block");
		}
		else if(mstatus=='অবিবাহিত' && gender=='female'){
			//alert("Father name show");
			$("#pitar_nam").css("display","block");
			$(".samir_nam input:text").val('');
			$(".samir_nam").css("display","none");
		}
		else if(mstatus=='অবিবাহিত' && gender=='male'){
			//alert('Father name show');
			$("#pitar_nam").css("display","block");
			$(".samir_nam input:text").val('');
			$(".samir_nam").css("display","none");
		}
		else{
			$("#pitar_nam").css("display","block");
			$(".samir_nam input:text").val('');
			$(".samir_nam").css("display","none");
		}
	}
	/*======== 2nd function ======*/
	function bybahik_obosthan_show1(gender){
		var mstatus=$("#mstatus").val();
		if(mstatus=='বিবাহিত' && gender=='male'){
			//alert('Fahter name show');
			$("#pitar_nam").css("display","block");
			$(".samir_nam input:text").val('');
			$(".samir_nam").css("display","none");
		}
		else if(mstatus=='বিবাহিত' && gender=='female'){
			//alert('Husband name show');
			$("#pitar_nam input:text").val('');
			$("#pitar_nam").css("display","none");
			$(".samir_nam").css("display","block");
		}
		else if(mstatus=='অবিবাহিত' && gender=='female'){
			//alert('Father name show');
			$("#pitar_nam").css("display","block");
			$(".samir_nam input:text").val('');
			$(".samir_nam").css("display","none");
		}
		else if(mstatus=='অবিবাহিত' && gender=='male'){
			//alert('Father name show ');
			$("#pitar_nam").css("display","block");
			$(".samir_nam input:text").val('');
			$(".samir_nam").css("display","none");
		}
		else{
			$("#pitar_nam").css("display","block");
			$(".samir_nam input:text").val('');
			$(".samir_nam").css("display","none");
		}
	}
	/*======== bibhahik obstha function end ==========*/

	/*====== other owner Add row functon start =========*/
	var rowNum = 0;
	function addRow(frm){
		var bwname=document.getElementById("bwname").value;
		var ewname=document.getElementById("ewname").value;
		var efname=document.getElementById("efname").value;
		var bfname=document.getElementById("bfname").value;
		var esname=document.getElementById("esname").value;
		var bsname=document.getElementById("bsname").value;
		var emname=document.getElementById("emname").value;
		var bmname=document.getElementById("bmname").value;
		var gender=$("#gender").val();
		var mstatus=$("#mstatus").val();
		var father_block = $("#pitar_nam").css('display');
		var sami_block = $(".samir_nam").css('display');
	
		if(ewname==''){
			alert("নতুন মালিকের নাম ইংরেজিতে প্রদান করুন ");
		}
		else if(bwname==''){
			alert("নতুন মালিকের নাম বাংলায় প্রদান করুন");
		}
		else if(!( ($("#gender").val()==='male')  ||  ($("#gender").val()==='female') )){
			alert("লিঙ্গ সিলেক্ট করুন");
		}
		else if(!( ($("#mstatus").val()==='বিবাহিত')  ||  ($("#mstatus").val()==='অবিবাহিত') )){
			alert("বৈবাহিক অবস্থা সিলেক্ট করুন");
		}
		else if((father_block=='block') && (efname=="")){
			alert("পিতার নাম ইংরেজিতে প্রদান করুন");
		}
		else if((father_block=='block') && (bfname=="")){
			alert('পিতার নাম বাংলায় প্রদান করুন');
		}
		else if((sami_block=='block') && (esname=="")){
			alert("স্বামীর নাম ইংরেজিতে প্রদান করুন");
		}
		else if((sami_block=='block') && (bsname=="")){
			alert("স্বামীর নাম বাংলায় প্রদান করুন");
		}
		else if(emname==""){
			alert("মাতার নাম ইংরেজিতে প্রদান করুন");
		}
		else if(bmname==""){
			alert("মাতার নাম বাংলায় প্রদান করুন");
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
			
			$(".samir_nam").css("display","none");
			$("#pitar_nam").css("display","block");
		}
	}
	function removeRow(rnum){
		jQuery('#rowNum'+rnum).remove();
	}
	/*====== other owner Add row functon end =========*/

	var LoadFile = function (event) {
		var output = document.getElementById("img_id");
		document.getElementById("img_div").style.display = "block";
		output.src = URL.createObjectURL(event.target.files[0]);
	}