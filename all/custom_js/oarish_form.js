	$(document).ready(function() {
		$('#datePicker')
        .datepicker({
			autoclose: true,
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#defaultForm').formValidation('revalidateField', 'dofb');
        });
		var nameValidators = {
				row: '.col-sm-3',
				validators: {
					notEmpty: {
						message: 'The name field is required'
					}
				}
			},
			relValidators = {
				row: '.col-sm-3',
				validators: {
					notEmpty: {
						message: 'The field is required'
					}
				}
			},
			ageValidators = {
				row: '.col-sm-3',
				validators: {
					notEmpty: {
						message: 'The age field is required'
					},
					numeric: {
						message: 'Only numeric character allowed'
					},
					lessThan: {
						value: 100,
						inclusive: true,
						message: 'The ages has to be less than 100'
					}
				}
			},
			warishIndex = 0;
			
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
							message: 'National id number more than 15 and less then 17 character'
						},
						numeric: {
							message: 'Only allowed numeric number'
						},
						remote: {
							message: 'Oops!!! Already  exist',
							url: 'index.php/validation/check_uniqueNid?tbl='+"tbl_warishesinfo",
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
							message: 'Birth certficate number more than 15 and less then 17 character'
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
							url: 'index.php/validation/check_uniqueBcno?tbl='+"tbl_warishesinfo",
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
							message: 'Passport number more than 13 and less then 17 character'
						},
						remote: {
							message: 'Oops!!! Already  exist',
							url: 'index.php/validation/check_uniquePno?tbl='+"tbl_warishesinfo",
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
				flive: {
					validators: {
						notEmpty: {
							message: 'The field is required'
						}
					}
				},
				fyears: {
					enabled: false,
					validators: {
						notEmpty: {
							message: 'The field is required'
						},
						numeric: {
							message: 'Only allowed numeric number'
						},
						lessThan: {
							value: 100,
							inclusive: true,
							message: 'The ages has to be less than 100'
						},
						greaterThan: {
							value: 21,
							inclusive: false,
							message: 'The ages has to be greater than or equals to 21'
						}
					}
				},
				mlive: {
					validators: {
						notEmpty: {
							message: 'The field is required'
						}
					}
				},
				myears: {
					enabled: false,
					validators: {
						notEmpty: {
							message: 'The field is required'
						},
						numeric: {
							message: 'Only allowed numeric number'
						},
						lessThan: {
							value: 100,
							inclusive: true,
							message: 'The ages has to be less than 100'
						},
						greaterThan: {
							value: 21,
							inclusive: false,
							message: 'The ages has to be greater than or equals to 21'
						}
					}
				},
				ocupt: {
					validators: {
						stringLength: {
							max: 255,
							message: 'Less than 250 characters'
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
				english_applicant_name: {
					validators: {
						notEmpty: {
							message: 'The applicant name field is required'
						}
					}
				},
				bangla_applicant_name: {
					validators: {
						notEmpty: {
							message: 'The applicant name field is required'
						}
					}
				},
				english_applicant_father_name: {
					validators: {
						notEmpty: {
							message: 'The applicant father name field is required'
						}
					}
				},
				bangla_applicant_father_name: {
					validators: {
						notEmpty: {
							message: 'The applicant father name field is required'
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
							url: 'index.php/validation/check_uniqueMob?tbl='+"tbl_warishesinfo",
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
				appNote: {
					validators: {
						stringLength: {
							min: 10,
							max: 350,
							message: 'Note must be written between 10 characters to 350 characters'
						}
					}
				},
				'warishname[0].name': nameValidators,
				'warishrel[0].rel': relValidators,
				'warishage[0].age': ageValidators
			}
		})
		.on('click','.addButton',function() {
			warishIndex++;
			
			var $template = $('#itemRows'),
				$clone    = $template
								.clone()
								.removeClass('hide')
								.removeAttr('id')
								.attr('data-warish-index', warishIndex)
								.insertBefore($template);
			// update the name attributes
			$clone
				.find('[name="name"]').attr('name','warishname['+ warishIndex + '].name').end()
				.find('[name="rel"]').attr('name','warishrel[' + warishIndex + '].rel').end()
				.find('[name="age"]').attr('name','warishage[' + warishIndex + '].age').end();
				
				// Add new fields
				// Note that we also pass the validator rules for new field as the third parameter
				$('#defaultForm')
					.formValidation('addField', 'warishname['+ warishIndex +'].name', nameValidators)
					.formValidation('addField', 'warishrel['+ warishIndex +'].rel', relValidators)
					.formValidation('addField', 'warishage['+ warishIndex +'].age', ageValidators);
		})
		
		// Remove button click handler
		
		.on('click','.removeButton', function() {
			var $row = $(this).parents('.form-group'),
				index = $row.attr('data-warish-index');
			
			// remove fields
			$('#defaultForm')
				.formValidation('removeField', $row.find('[name="warishname['+ index +'].name"]'))
				.formValidation('removeField', $row.find('[name="warishrel['+ index +'].rel"]'))
				.formValidation('removeField', $row.find('[name="warishage['+ index +'].age"]'));
				
				// Remove element containing the fields
				$row.remove();
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
			var u=$form.attr('action');
			var u=$form.serialize();
			$.ajax({
				url: $form.attr('action'),
				type: 'POST',
				data: $form.serialize(),
				beforeSend:function() { alert('sending----'); },
				success: function(data) {
					//var obj = JSON.parse(result);
					// alert(obj.message);
					//alert(result.message);
					if(data==1)
					{
						alert('আপনার আবেদনটি গৃহীত হয়েছে\n Tracking No টি নিয়ে আপনার ইউনিয়ন পরিষদে যোগাযোগ করুন'); 
						window.location='index.php/home/wpreview';
						//window.open('index.php/home/wpreview','_blank');
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
					else{
						alert(data);
					}
				}
			});
		});
		
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
		
		$('input[name="flive"]').on('change',function(){
			var formValidation = $('#defaultForm').data('formValidation'),
			fatherAge	= ($(this).val() == '1');
			
			fatherAge ? $('#father_id').find('.form-control').removeAttr('disabled')
					  : $('#father_id').find('.form-control').attr('disabled','disabled');
			
			formValidation.enableFieldValidators('fyears',fatherAge);
		});
		$('input[name="mlive"]').on('change',function(){
			var formValidation = $('#defaultForm').data('formValidation'),
			motherAge	= ($(this).val() == '1');
			
			motherAge ? $('#mother_id').find('.form-control').removeAttr('disabled')
					  : $('#mother_id').find('.form-control').attr('disabled','disabled');
					  
			formValidation.enableFieldValidators('myears',motherAge);
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
	/*========= onload function start ==========*/
	function onload_hide_fun(){
		$("#wife").hide();
		$("#husband").hide();
		$(".bname").bnKb({
			'switchkey': {"webkit":"k","mozilla":"y","safari":"k","chrome":"k","msie":"y"},
			'driver': phonetic
		});
	}
/*========= onload function end ==========*/
	
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