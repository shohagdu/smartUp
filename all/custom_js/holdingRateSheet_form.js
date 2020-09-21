$(document).ready(function() {
	// datatable for member list show
	$('#example').DataTable({
		"lengthMenu": [[ 30, 50,100, -1], [ 30, 50,100, "All"]]
	});
	
	// for member data insert
	$('#holdingRateSheetFormId')
	.formValidation({
		message: 'This value is not valid',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			holdingRateSheetLabel: {
				verbose: false,
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					remote: {
						message: 'Oops!!! এই বসতভিটার ধরন, পেশা, করের শ্রেনী যোগ করা আছে।',
						url: 'index.php/validation/check_unique_holding_rate_sheet?ch='+"holding_rate_sheet",
						data: function(validator, $field, value) {
							return {
								occupation: validator.getFieldElements('occupation').val(),
								classification: validator.getFieldElements('classification').val()
							};
						},
						type: 'POST'
					}
				}
			},
			occupation: {
				verbose: false,
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					remote: {
						message: 'Oops!!! এই বসতভিটার ধরন, পেশা, করের শ্রেনী যোগ করা আছে।',
						url: 'index.php/validation/check_unique_holding_rate_sheet?ch='+"holding_rate_sheet",
						data: function(validator, $field, value) {
							return {
								holdingRateSheetLabel: validator.getFieldElements('holdingRateSheetLabel').val(),
								classification: validator.getFieldElements('classification').val()
							};
						},
						type: 'POST'
					}
				}
			},
			classification: {
				verbose: false,
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					remote: {
						message: 'Oops!!! এই বসতভিটার ধরন, পেশা, করের শ্রেনী যোগ করা আছে।',
						url: 'index.php/validation/check_unique_holding_rate_sheet?ch='+"holding_rate_sheet",
						data: function(validator, $field, value) {
							return {
								occupation: validator.getFieldElements('occupation').val(),
								holdingRateSheetLabel: validator.getFieldElements('holdingRateSheetLabel').val()
							};
						},
						type: 'POST'
					}
				}
			},
			amount: {
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					numeric: {
						message: 'The value is not a number',
						// The default separators
						thousandsSeparator: '',
						decimalSeparator: '.'
					},
					between: {
						min: 10,
						max: 50000,
						message: 'The number of floors must be between 10 and 50000'
					}
				}
			}
		}
	})
	.on('change', '[name="holdingRateSheetLabel"]', function(e) {
		$('#holdingRateSheetFormId').formValidation('revalidateField', 'occupation');
		$('#holdingRateSheetFormId').formValidation('revalidateField', 'classification');
	})
	.on('change', '[name="occupation"]', function(e) {
		$('#holdingRateSheetFormId').formValidation('revalidateField', 'holdingRateSheetLabel');
		$('#holdingRateSheetFormId').formValidation('revalidateField', 'classification');
	})
	.on('change', '[name="classification"]', function(e) {
		$('#holdingRateSheetFormId').formValidation('revalidateField', 'occupation');
		$('#holdingRateSheetFormId').formValidation('revalidateField', 'holdingRateSheetLabel');
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
					$('#errorMessage').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#errorText').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/holdingRateSheet";
					},1000)
				}else if(obj.status == 'success'){
					$('#successMessage').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#successText').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/holdingRateSheet";
					},1000)
				}else{
					alert(result);
				}
				
			}
		});
	});
	
	// not necessary
	// unique holding type show
	// $("#holdingLicenseType").keyup(function(){
		// var holdingLicenseType=$("#holdingLicenseType").val().trim();
		
		// if(holdingLicenseType==''){
			// document.getElementById('error1').innerHTML="";
			// document.getElementById('error2').innerHTML="";
			// document.getElementById('error3').innerHTML="দয়া করে বসতভিটার ধরন লিখুন";exit;
		// }
		//alert(holdingLicenseType);
		// $.ajax({
			// url:"Setup_section/checkHoldingType?id=1",
			// data:{holdingLicenseType:holdingLicenseType},
			// type:"GET",
			// success:function(hr){
				//alert(hr);exit;
				// if(hr==10){
					// document.getElementById('error1').innerHTML="Opps!! এই ধরনটি যোগ করা হয়েছে ";
					// document.getElementById('error2').innerHTML="";
					// document.getElementById('error3').innerHTML="";
					// document.getElementsByName("submitform")[0].type = "button";
				// }
				// else{
					//return ture
					// document.getElementById('error2').innerHTML="Thanks,Valid .";
					// document.getElementById('error1').innerHTML="";
					// document.getElementById('error3').innerHTML="";
					// document.getElementsByName("submitform")[0].type = "submit";
				// }
				
			// }
		// });
	// });
	
	// holding rate sheet information update
	$('#updateHoldingRateSheet')
	.formValidation({
		message: 'This value is not valid',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			amount: {
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					numeric: {
						message: 'The value is not a number',
						// The default separators
						thousandsSeparator: '',
						decimalSeparator: '.'
					},
					between: {
						min: 10,
						max: 50000,
						message: 'The number of floors must be between 10 and 50000'
					}
				}
			}
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
						window.location="index.php/setup_section/holdingRateSheet";
					},1000)
				}else if(obj.status == 'warning'){
					$('#warningMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#warningTextModal').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/holdingRateSheet";
					},1000)
				}else{
					alert(result);
				}
				
			}
		});
	});
	$("#holdingRateSheetLabelId").attr('disabled','disabled');
	
	$('.deleteClass').on('click', function(event){
		var id = $(this).attr('value');
		var confirmation = confirm("Are you sure you want to remove the member informaiton?");
		if (confirmation) {
			$.ajax({
				url:"Setup_section/deleteMemberInfoRow",
				type:"POST",
				data:{id:id},
				success:function( result ){
					var obj = JSON.parse(result);
					alert(obj.message);
					window.location="index.php/setup_section/memberAddForm";
				}
			});
		}
	})
	
});

// delete confirmation... not use
function delete_function(){
	return confirm('Are you sure delete this?');
}

// modal information show...
function modelStatus(fieldData){
	//alert(fieldData);
	
	// first time rest all validation
	$('#modelStatus').on('shown.bs.modal', function () { 
		$(this).find("input:first-child").focus(); })
		.on('hide.bs.modal', function (e) {
			$(this).find("form").formValidation('resetForm', true);
		})

	$.ajax({
		url:"index.php/setup_section/update_holding_rate_sheet_info",
		data:{fieldData:fieldData},
		type:"POST",
		success:function(result){
			var obj = JSON.parse(result);
			document.getElementById('holdingRateSheetLabelId').value=obj.data.rate_sheet_label;
			document.getElementById('amountId').value=obj.data.amount;
			document.getElementById('hid').value=obj.data.hid;
			if(parseInt(obj.data.status) === 0){
				document.getElementById('statusShow').innerHTML="<option value='0'>Disable</option><option value='1'>Enable</option>";
			}else{
				document.getElementById('statusShow').innerHTML="<option value='1'>Enable</option><option value='0'>Disable</option>";
			}
		}
	});
}