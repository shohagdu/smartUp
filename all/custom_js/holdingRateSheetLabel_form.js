$(document).ready(function() {
	// datatable for member list show
	$('#holdingRateSheetLabelTable').DataTable({
		"lengthMenu": [[ 30, 50,100, -1], [ 30, 50,100, "All"]]
	});
	
	// for member data insert
	$('#holdingRateSheetLevelFormId')
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
					stringLength: {
						min: 2,
						max: 200,
						message: 'Must be more then 2 and less then 200 characters'
					},
					remote: {
						message: 'Oops!!! Already exist',
						url: 'index.php/validation/check_unique_holding_rate_sheet_label?ch='+"holding_rate_sheet_label",
						type: 'POST'
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
					$('#errorMessage').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#errorText').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/holdingRateSheetLevel";
					},1000)
				}else if(obj.status == 'success'){
					$('#successMessage').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#successText').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/holdingRateSheetLevel";
					},1000)
				}else{
					alert(result);
				}
			}
		});
	});
	
	// holding rate sheet information update
	$('#updateHoldingRateSheetLabel')
	.formValidation({
		message: 'This value is not valid',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			holdingRateSheetLabel: {
				//verbose: false,
				enabled: false,
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					stringLength: {
						min: 2,
						max: 200,
						message: 'Must be more then 2 and less then 200 characters'
					},
					remote: {
						message: 'Oops!!! Already exist',
						url: 'index.php/validation/check_unique_holding_rate_sheet_label_for_update?ch='+"holding_rate_sheet_label",
						data: function(validator, $field, value){
							return {
								hid: validator.getFieldElements('hid').val()
							};
						},
						type: 'POST'
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
						// window.location="index.php/setup_section/holdingRateSheetLevel";
					// },1000)
				}else if(obj.status == 'success'){
					$('#successMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#successTextModal').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/holdingRateSheetLevel";
					},1000)
				}else if(obj.status == 'warning'){
					$('#warningMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#warningTextModal').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/holdingRateSheetLevel";
					},1000)
				}else{
					alert(result);
				}
				
			}
		});
	});
	$("#holdingRateSheetLabelId").attr('disabled','disabled');
});


// modal information show...
function holdingRateSheetLabel(fieldData){
	//alert(fieldData);
	
	// first time rest all validation
	$('#holdingRateSheetLabel').on('shown.bs.modal', function () { 
		$(this).find("input:first-child").focus(); })
		.on('hide.bs.modal', function (e) {
			$(this).find("form").formValidation('resetForm', true);
		})

	$.ajax({
		url:"index.php/setup_section/update_holding_rate_sheet_label_info",
		data:{fieldData:fieldData},
		type:"POST",
		success:function(result){
			var obj = JSON.parse(result);
			if(obj.status=='success'){
				document.getElementById('holdingRateSheetLabelId').value=obj.data.rate_sheet_label;
				document.getElementById('hid').value=obj.data.hid;
				if(parseInt(obj.data.status) === 0){
					document.getElementById('statusShow').innerHTML="<option value='0'>Disable</option><option value='1'>Enable</option>";
				}else{
					document.getElementById('statusShow').innerHTML="<option value='1'>Enable</option><option value='0'>Disable</option>";
				}
			}
		}
	});
}