	$(document).ready(function() {
		$('#datePicker')
        .datepicker({
			autoclose: true,
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#defaultForm').formValidation('revalidateField', 'dofb');
        })
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
				nationid: {
					verbose: false,
					validators: {
						stringLength: {
							min: 15,
							max: 17,
							message: 'National id number must be between 15 and 17 characters'
						},
						numeric: {
							message: 'Only allowed numeric number'
						},
						remote: {
							message: 'Oops!!! Already  exist',
							url: 'index.php/validation/check_uniqueNid?tbl='+"personalinfo",
							type: 'POST'
						}
					}
				},
				bcno: {
					verbose: false,
					validators: {
						stringLength: {
							min: 15,
							max: 17,
							message: 'Birth certficate number must be between 15 and 17 characters'
						},
						numeric: {
							message: 'Only allowed numeric number'
						},
						different: {
							field: 'nationid',
							message: 'The field cannot be the same as nationid'
						},
						remote: {
							message: 'Oops!!! Already  exist',
							url: 'index.php/validation/check_uniqueBcno?tbl='+"personalinfo",
							type: 'POST'
						}
					}
				},
				pno: {
					verbose: false,
					validators: {
						stringLength: {
							min: 13,
							max: 17,
							message: 'Passport number must be between 13 and 17 characters'
						},
						remote: {
							message: 'Oops!!! Already  exist',
							url: 'index.php/validation/check_uniquePno?tbl='+"personalinfo",
							type: 'POST'
						}
					}
				},
				dofb: {
					validators: {
						notEmpty: {
							message: 'The date is required'
						},
						date: {
							format: 'YYYY-MM-DD',
							message: 'The date is not a valid'
						}
					}
				},
				ename: {
					validators: {
						notEmpty: {
							message: 'The name is required'
						}
					}
				},
				bname: {
					validators: {
						notEmpty: {
							message: 'The name is required'
						}
					}
				},
				gender: {
					validators: {
						notEmpty: {
							message: 'The gender is required'
						}
					}
				},
				mstatus: {
					validators: {
						notEmpty: {
							message: 'The Marital Status is required'
						}
					}
				},
				efname: {
					validators: {
						notEmpty: {
							message: 'The Father Name is required'
						}
					}
				},
				bfname: {
					validators: {
						notEmpty: {
							message: 'The Father Name is required'
						}
					}
				},
				emname: {
					validators: {
						notEmpty: {
							message: 'The Mother Name is required'
						}
					}
				},
				bmane: {
					validators: {
						notEmpty: {
							message: 'The Mother Name is required'
						}
					}
				},
				religion: {
					validators: {
						notEmpty: {
							message: 'The Religion field is required'
						}
					}
				},
				holding_no: {
					verbose: false,
					validators: {
						notEmpty: {
							message: 'The Holding No field is required'
						},
						stringLength: {
							min: 2,
							max: 10,
							message: 'Holding number must be between 2 and 10 characters'
						},
						numeric: {
							message: 'Only allowed numeric number'
						},
						remote: {
							url: 'index.php/validation/check_holding_no',
							type: 'POST'
						}
					}
				},
				bashinda: {
					validators: {
						notEmpty: {
							message: 'The field is required'
						}
					}
				},
				p_gram: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				pb_gram: {
					validators: {
						stringLength: {
							max: 100,
							message: 'less then 100 character'
						}	
					}
				},
				p_rbs: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				pb_rbs: {
					validators: {
						stringLength: {
							max: 80,
							message: 'less then 80 character'
						}	
					}
				},
				p_wordno: {
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
				pb_wordno: {
					validators: {
						stringLength: {
							max: 3,
							message: 'less then 3 character'
						}
					}
				},
				p_dis: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				pb_dis: {
					validators: {
						stringLength: {
							max: 100,
							message: 'less then 100 character'
						}	
					}
				},
				p_thana: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				pb_thana: {
					validators: {
						stringLength: {
							max: 100,
							message: 'less then 100 character'
						}	
					}
				},
				p_postof: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				pb_postof: {
					validators: {
						stringLength: {
							max: 100,
							message: 'less then 100 character'
						}	
					}
				},
				// jh
				per_gram: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				perb_gram: {
					validators: {
						stringLength: {
							max: 100,
							message: 'less then 100 character'
						}	
					}
				},
				per_rbs: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				perb_rbs: {
					validators: {
						stringLength: {
							max: 80,
							message: 'less then 80 character'
						}	
					}
				},
				per_wordno: {
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
				perb_wordno: {
					validators: {
						stringLength: {
							max: 3,
							message: 'less then 3 character'
						}
					}
				},
				per_dis: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				perb_dis: {
					validators: {
						stringLength: {
							max: 100,
							message: 'less then 100 character'
						}	
					}
				},
				per_thana: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				perb_thana: {
					validators: {
						stringLength: {
							max: 100,
							message: 'less then 100 character'
						}	
					}
				},
				per_postof: {
					validators: {
						stringLength: {
							max: 60,
							message: 'less then 60 character'
						}	
					}
				},
				perb_postof: {
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
							url: 'index.php/validation/check_uniqueMob?tbl='+"personalinfo",
							type: 'POST'
						}
					}
				},
				email: {
					validators: {
						emailAddress: {
							message: 'The input is not a valid email address'
						}
					}
				},
				attachment: {
					validators: {
						stringLength: {
							max: 500,
							message: 'less then 500 character'
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
				success: function(result) {
					//var obj = JSON.parse(result);
					// alert(obj.message);
					//alert(result.message);
				   if(result==1)
					{
						alert('আপনার আবেদনটি গৃহীত হয়েছে\n Tracking No টি নিয়ে আপনার ইউনিয়ন পরিষদে যোগাযোগ করুন');
						 //setTimeout(function() {
						window.location='index.php/home/ppreview'; //}, 1000)
						// window.open('index.php/home/ppreview','_blank');
					}
					else if(result == 2){
						alert('দুঃখিত আপানর জাতিয় পরিচয়পত্র নং পূর্বে ব্যাবহার করা হয়েছে \nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন');
					}
					else if(result== 3){
						alert('দুঃখিত আপানর জন্ম নিবধন নং পূর্বে ব্যাবহার করা হয়েছে \nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন');
					}
					else if(result== 4){
						alert('দুঃখিত আপানর পাসপোর্ট নং পূর্বে ব্যাবহার করা হয়েছে \nTracking No এর  জন্য আপনার ইউনিয়ন পরিষদ যোগাযোগ করুন পাসপোর্ট নং');
					}
					else {
						alert(result);
					}
				}
			});
		})
		$('select[name="mstatus"]').on('change', function() {
			
			var mstatus      = $(this).val();
			var gender		 = $("#gender").val();
			
			if('1' == mstatus && gender !=""){
				
				if(gender == 'male' && mstatus == '1'){
					$('#husband').css("display","none");
					$('#wife').css("display","block");
					
					$('#defaultForm').formValidation('addField', 'eWname', {
						validators: {
							notEmpty: {
								message: 'Wife name is required'
							}
						}
					});
					$('#defaultForm').formValidation('addField', 'bWname', {
						validators: {
							notEmpty: {
								message: 'Wife name is required'
							}
						}
					}); 
				}
				else if(gender == 'female' && mstatus == '1'){
					$('#wife').css("display","none");
					$('#husband').css("display","block");
					
					$('#defaultForm').formValidation('addField', 'eHname', {
						validators: {
							notEmpty: {
								message: 'Husband name is required'
							}
						}
					});
					$('#defaultForm').formValidation('addField', 'bHname', {
						validators: {
							notEmpty: {
								message: 'Husband name is required'
							}
						}
					});
				}
				else{
					testshowHide(mstatus);
				}
			}
			else{
				testshowHide(mstatus);
			}
		});
	});

	function testshowHide(v) {
		//alert(v);
		if(v=="1" || v=="male" || v=="female"){
			var gender=$("#gender").val();
			var mstatus=$("#mstatus").val();
			
			if(gender=='male' && mstatus=="1"){
				$('#husband').css("display","none");
				$('#wife').css("display","block");
				$('#defaultForm').formValidation('addField', 'eWname', {
					validators: {
						notEmpty: {
							message: 'Wife name is required'
						}
					}
				});
				$('#defaultForm').formValidation('addField', 'bWname', {
					validators: {
						notEmpty: {
							message: 'Wife name is required'
						}
					}
				});
			}
			else if(gender=='female' && mstatus=="1"){
				$('#wife').css("display","none");
				$('#husband').css("display","block");
				
				$('#defaultForm').formValidation('addField', 'eHname', {
					validators: {
						notEmpty: {
							message: 'Husband name is required'
						}
					}
				});
				$('#defaultForm').formValidation('addField', 'bHname', {
					validators: {
						notEmpty: {
							message: 'Husband name is required'
						}
					}
				});
			}
			else {
				$('#defaultForm').formValidation('removeField', 'eWname');
				$('#defaultForm').formValidation('removeField', 'bWname');
				$('#defaultForm').formValidation('removeField', 'eHname');
				$('#defaultForm').formValidation('removeField', 'bHname');
				$('#wife').css("display","none");	
				$('#husband').css("display","none");	
			}
		}	
		else {
			$('#defaultForm').formValidation('removeField', 'eWname');
			$('#defaultForm').formValidation('removeField', 'bWname');
			$('#defaultForm').formValidation('removeField', 'eHname');
			$('#defaultForm').formValidation('removeField', 'bHname');
			$('#wife').css("display","none");	
			$('#husband').css("display","none");	
		}
	}
	/*================== bashinda hide show function start ==========*/
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
	/*================== bashinda hide show function end ==========*/
	/*=========onload function start=============*/
	function onload_hide_fun(){
		// call this function body onload event
		$("#wife").hide();
		$("#husband").hide();
		$("#print").hide();
		// $(".bname").bnKb({
		// 	'switchkey': {"webkit":"k","mozilla":"y","safari":"k","chrome":"k","msie":"y"},
		// 	'driver': phonetic
		// });
	}
	/*=========onload function end=============*/
	
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

	var LoadFile = function (event) {
		var output = document.getElementById("img_id");
		document.getElementById("img_div").style.display = "block";
		output.src = URL.createObjectURL(event.target.files[0]);
	}