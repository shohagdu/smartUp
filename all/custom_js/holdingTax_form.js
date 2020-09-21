	$(document).ready(function() {
		$('#holdingRegistrationFormId')
		.formValidation({
			message: 'This value is not valid',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				name: {
					validators: {
						notEmpty: {
							message: 'The field is required cannot be empty.'
						}
					}
				},
				fatherName: {
					validators: {
						notEmpty: {
							message: 'The field is required cannot be empty.'
						}
					}
				},
				nationalId: {
					verbose: false,
					validators: {
						stringLength: {
							min: 15,
							max: 17,
							message: 'National id number more than 15 and less then 17 characters'
						},
						numeric: {
							message: 'Only allowed numeric number'
						},
						remote: {
							//message: 'Oops!!! Already  exist',
							//url: 'index.php/validation/check_unique_nid?tbl='+"holdingclientinfo",
							//type: 'POST'
						}
					}
				},
				birthCertificateId: {
					verbose: false,
					validators: {
						stringLength: {
							min: 15,
							max: 17,
							message: 'Birth certficate number more than 15 and less then 17 characters'
						},
						numeric: {
							message: 'Only allowed numeric number'
						},
						different: {
							field: 'nationalId',
							message: 'The field cannot be the same as national id'
						},
						remote: {
							//message: 'Oops!!! Already  exist',
							//url: 'index.php/validation/check_unique_birth_certificate_id?tbl='+"holdingclientinfo",
							//type: 'POST'
						}
					}
				},
				village: {
					validators: {
						notEmpty: {
							message: 'The field is required cannot be empty.'
						}
					}
				},
				wordNo: {
					validators: {
						notEmpty: {
							message: 'The field is required cannot be empty.'
						}
					}
				},
				holdingNumber: {
					validators: {
						notEmpty: {
							message: 'The field is required cannot be empty.'
						}
					}
				},
				dagNo: {
					verbose: false,
					validators: {
						notEmpty: {
							message: 'The field is required cannot be empty.'
						},
						stringLength: {
							min: 4,
							max: 15,
							message: 'Dag number more than 4 and less then 15 characters'
						},
						remote: {
							message: 'Oops!!! Already  exist',
							url: 'index.php/validation/check_unique_dag_no?tbl='+"holdingclientinfo",
							type: 'POST'
						}
					}
				},
				rateSheet: {
					validators: {
						notEmpty: {
							message: 'The field is required cannot be empty.'
						}
					}
				},
				mobileNo: {
					verbose: false,
					validators: {
						regexp: {
							regexp: /^(?:\+?88)?01[15-9]\d{8}$/,
							message: 'Invalid mobile number'
						},
						numeric: {
							message: 'Only allowed numeric mobile number'
						},
						remote: {
							url: 'index.php/validation/check_unique_mobile_number?tbl='+"holdingclientinfo",
							type: 'POST'
						}
					}
				}
			}
		})
		.on('success.validator.fv', function(e, data) {

            if (data.field === 'mobileNo'
                && data.validator === 'remote'
                && (data.result.available === false || data.result.available === 'false'))
            {
                data.element                    // Get the field element
                    .closest('.form-group')     // Get the field parent

                    // Add has-warning class
                    .removeClass('has-success')
                    .addClass('has-warning')

                    // Show message
                    .find('small[data-fv-validator="remote"][data-fv-for="mobileNo"]')
                        .show();
            }
        })
        // This event will be triggered when the field doesn't pass given validator
        .on('err.validator.fv', function(e, data) {
            // We need to remove has-warning class
            // when the field doesn't pass any validator
            if (data.field === 'mobileNo') {
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
				//beforeSend:function() { alert('sending----'); },
				success: function(result) {
					var obj = JSON.parse(result);
					if(obj.status == 'error'){
						$('#errorMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
						$('#errorTextModal').text(obj.message);
						// setTimeout(function(){					
							// window.location="index.php/setup_section/holdingRateSheet";
						// },1000)
					}else if(obj.status == 'success'){
						$('#successMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
						$('#successTextModal').text(obj.message);
						setTimeout(function(){					
							window.location="Admin/taxCollection";
						},1000)
					}else if(obj.status == 'warning'){
						$('#warningMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
						$('#warningTextModal').text(obj.message);
						setTimeout(function(){					
							window.location="Admin/taxCollection";
						},1000)
					}else{
						alert(result);
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