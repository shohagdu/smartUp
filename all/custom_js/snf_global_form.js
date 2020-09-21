$(document).ready(function() {
	
	$('#occupationTableId').DataTable({
		"lengthMenu": [[ 30, 50,100, -1], [ 30, 50,100, "All"]]
	});
	$('#classicificationTableId').DataTable({
		"lengthMenu": [[ 30, 50,100, -1], [ 30, 50,100, "All"]]
	});
	
	$('#occupationFormId')
	.formValidation({
		message: 'This value is not valid',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			occupationName: {
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
						url: 'index.php/validation/check_unique_occupation?ch='+"snf_global_form",
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
						window.location="index.php/setup_section/occupation";
					},1000)
				}else if(obj.status == 'success'){
					$('#successMessage').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#successText').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/occupation";
					},1000)
				}else{
					alert(result);
				}
				
			}
		});
	});
	
	// occupation update form validation
	$('#updateOccupationFormId')
	.formValidation({
		message: 'This value is not valid',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			occupationName: {
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
						url: 'index.php/validation/check_unique_occupation_for_update?ch='+"snf_global_form",
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
						// window.location="index.php/setup_section/occupation";
					// },1000)
				}else if(obj.status == 'success'){
					$('#successMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#successTextModal').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/occupation";
					},1000)
				}else if(obj.status == 'warning'){
					$('#warningMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#warningTextModal').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/occupation";
					},1000)
				}else{
					alert(result);
				}
				
			}
		});
	});
	$("#occupationNameId").attr('disabled','disabled');
	//****************************Classicification ***************************//
	
	$('#classicificationNameFormId')
	.formValidation({
		message: 'This value is not valid',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			classicificationName: {
				verbose: false,
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					stringLength: {
						min: 1,
						max: 200,
						message: 'Must be more then 1 and less then 200 characters'
					},
					remote: {
						message: 'Oops!!! Already exist',
						url: 'index.php/validation/check_unique_classicification?ch='+"snf_global_form",
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
						window.location="index.php/setup_section/classification";
					},1000)
				}else if(obj.status == 'success'){
					$('#successMessage').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#successText').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/classification";
					},1000)
				}else{
					alert(result);
				}
				
			}
		});
	});
	// classification update form validation
	$('#updateClassificationFormId')
	.formValidation({
		message: 'This value is not valid',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			classificationName: {
				//verbose: false,
				enabled: false,
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					stringLength: {
						min: 1,
						max: 200,
						message: 'Must be more then 1 and less then 200 characters'
					},
					remote: {
						message: 'Oops!!! Already exist',
						url: 'index.php/validation/check_unique_classicification_for_update?ch='+"snf_global_form",
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
						// window.location="index.php/setup_section/classification";
					// },1000)
				}else if(obj.status == 'success'){
					$('#successMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#successTextModal').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/classification";
					},1000)
				}else if(obj.status == 'warning'){
					$('#warningMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#warningTextModal').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/classification";
					},1000)
				}else{
					alert(result);
				}
				
			}
		});
	});
	$("#classificationNameId").attr('disabled','disabled');
	
});

// occupation modal
function occupationUpdateWindow(fieldData){
	//alert(fieldData);
	
	// first time rest all validation
	$('#occupationWindow').on('shown.bs.modal', function () { 
		$(this).find("input:first-child").focus(); })
		.on('hide.bs.modal', function (e) {
			$(this).find("form").formValidation('resetForm', true);
		})

	$.ajax({
		url:"index.php/setup_section/update_occupation_info",
		data:{fieldData:fieldData},
		type:"POST",
		success:function(result){
			var obj = JSON.parse(result);
			document.getElementById('occupationNameId').value=obj.data.title;
			document.getElementById('hid').value=obj.data.hid;
			if(parseInt(obj.data.status) === 0){
				document.getElementById('statusShow').innerHTML="<option value='0'>Disable</option><option value='1'>Enable</option>";
			}else{
				document.getElementById('statusShow').innerHTML="<option value='1'>Enable</option><option value='0'>Disable</option>";
			}
		}
	});
}
// classification modal
function classicificationUpdateWindow(fieldData){
	//alert(fieldData);
	
	// first time rest all validation
	$('#classificationWindow').on('shown.bs.modal', function () { 
		$(this).find("input:first-child").focus(); })
		.on('hide.bs.modal', function (e) {
			$(this).find("form").formValidation('resetForm', true);
		})

	$.ajax({
		url:"index.php/setup_section/update_classification_info",
		data:{fieldData:fieldData},
		type:"POST",
		success:function(result){
			var obj = JSON.parse(result);
			document.getElementById('classificationNameId').value=obj.data.title;
			document.getElementById('hid').value=obj.data.hid;
			if(parseInt(obj.data.status) === 0){
				document.getElementById('statusShow').innerHTML="<option value='0'>Disable</option><option value='1'>Enable</option>";
			}else{
				document.getElementById('statusShow').innerHTML="<option value='1'>Enable</option><option value='0'>Disable</option>";
			}
		}
	});
}