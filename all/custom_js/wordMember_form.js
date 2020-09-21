$(document).ready(function() {
	// datatable for member list show
	$('#example').DataTable({
		"lengthMenu": [[ 30, 50,100, -1], [ 30, 50,100, "All"]]
	});
	
	// for member data insert
	$('#insertWordMember')
	.formValidation({
		message: 'This value is not valid',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			wordNo: {
				verbose: false,
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					numeric: {
						message: 'Only allowed numeric number'
					},
					stringLength: {
						min: 1,
						max: 3,
						message: 'Word number more then 1 and less then 3 characters'
					},
					remote: {
						message: 'Oops!!! Already exist',
						url: 'index.php/validation/check_unique_word_number?tbl='+"word_member",
						type: 'POST'
					}
				}
			},
			memberName: {
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					stringLength: {
						min: 2,
						max: 60,
						message: 'Name more then 2 and less then 60 characters'
					}
				}
			},
			memberFather: {
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					stringLength: {
						min: 2,
						max: 60,
						message: 'Father Name more then 2 and less then 60 characters'
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
						window.location="index.php/setup_section/memberAddForm";
					},1000)
				}else if(obj.status == 'success'){
					$('#successMessage').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#successText').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/memberAddForm";
					},1000)
				}else{
					alert(result);
				}
				
			}
		});
	});
	
	// not necessary
	// unique word member show
	// $("#word_no").keyup(function(){
		// var word_no=$("#word_no").val().trim();
		
		// if(word_no==''){
			// document.getElementById('error1').innerHTML="";
			// document.getElementById('error2').innerHTML="";
			// document.getElementById('error3').innerHTML="দয়া করে ওয়ার্ড নং লিখুন";exit;
		// }
		//alert(word_no);
		// $.ajax({
			// url:"Setup_section/checkWordNo?id=1",
			// data:{word_no:word_no},
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
	
	// member information update
	$('#updateWordMember')
	.formValidation({
		message: 'This value is not valid',
		icon: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			wordNo: {
				verbose: false,
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					numeric: {
						message: 'Only allowed numeric number'
					},
					stringLength: {
						min: 1,
						max: 3,
						message: 'Word number more then 1 and less then 3 characters'
					},
					remote: {
						message: 'Oops!!! Already exist',
						url: 'index.php/validation/check_unique_word_number_for_update?tbl='+"word_member",
						// Send { wordNo: 'its value', hid: 'its value' } to the back-end
						data: function(validator, $field, value) {
							return {
								hid: validator.getFieldElements('hid').val()
							};
						},
						type: 'POST'
					}
				}
			},
			memberName: {
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					stringLength: {
						min: 2,
						max: 60,
						message: 'Name more then 2 and less then 60 characters'
					}
				}
			},
			memberFather: {
				validators: {
					notEmpty: {
						message: 'The field is required cannot be empty.'
					},
					stringLength: {
						min: 2,
						max: 60,
						message: 'Father Name more then 2 and less then 60 characters'
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
						// window.location="index.php/setup_section/memberAddForm";
					// },1000)
				}else if(obj.status == 'success'){
					$('#successMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
					$('#successTextModal').text(obj.message);
					setTimeout(function(){					
						window.location="index.php/setup_section/memberAddForm";
					},1000)
				}else{
					alert(result);
				}
				
			}
		});
	});
	
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
		url:"index.php/setup_section/update_member_info",
		data:{fieldData:fieldData},
		type:"POST",
		success:function(result){
			var obj = JSON.parse(result);
			document.getElementById('wordNoId').value=obj.data.word_no;
			document.getElementById('memberNameId').value=obj.data.member_name;
			document.getElementById('memberFatherNameId').value=obj.data.member_father;
			document.getElementById('hid').value=obj.data.hid;
			if(parseInt(obj.data.status) === 2){
				document.getElementById('statusShow').innerHTML="<option value='2'>Disable</option><option value='1'>Enable</option>";
			}else{
				document.getElementById('statusShow').innerHTML="<option value='1'>Enable</option><option value='2'>Disable</option>";
			}
		}
	});
}