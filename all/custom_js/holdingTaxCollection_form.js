	$(document).ready(function() {
		$('#dagNoFormId')
		.formValidation({
			message: 'আমরা এই দাগ নম্বর দিয়ে কোন ব্যক্তিকে খুজে পাই নাই',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				dagNo: {
					verbose: false,
					message: 'আমরা এই দাগ নম্বর দিয়ে কোন ব্যক্তিকে খুজে পাই নাই',
					validators: {
						notEmpty: {
							message: 'দয়া করে দাগ নম্বরটা লিখুন'
						},
						remote: {
							url: 'index.php/validation/check_exists_dag_no?tbl='+"holdingclientinfo",
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
						document.getElementById('informationShow').innerHTML='';
						document.getElementById('error').innerHTML="আপনার দাগ নং টি সঠিক নয়";
						var dagno = document.getElementById('dagNoOld').value;
						$('#oldClientData').trigger('reset');
						document.getElementById('dagNoOld').value=dagno;
					}else if(obj.status == 'success'){
						document.getElementById('error').innerHTML="";
						document.getElementById('informationShow').innerHTML=obj.data;
						//$('#successMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
						//$('#informationShow').text(obj.data);
					}else{
						alert(result);
					}
				}
			});
		});
		
		
		
		
		$('#holdingNoFormId')
		.formValidation({
			message: 'আমরা এই হোল্ডিং নম্বর দিয়ে কোন ব্যক্তিকে খুজে পাই নাই',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				holdingNo: {
					verbose: false,
					message: 'আমরা এই হোল্ডিং নম্বর দিয়ে কোন ব্যক্তিকে খুজে পাই নাই',
					validators: {
						notEmpty: {
							message: 'দয়া করে হোল্ডিং নম্বরটা লিখুন'
						},
						remote: {
							url: 'index.php/validation/check_exists_holding_no?tbl='+"holdingclientinfo",
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
						document.getElementById('informationShow').innerHTML='';
						document.getElementById('error').innerHTML="আপনার দাগ নং টি সঠিক নয়";
						var dagno = document.getElementById('dagNoOld').value;
						$('#oldClientData').trigger('reset');
						document.getElementById('dagNoOld').value=dagno;
					}else if(obj.status == 'success'){
						document.getElementById('error').innerHTML="";
						document.getElementById('informationShow').innerHTML=obj.data;
						//$('#successMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
						//$('#informationShow').text(obj.data);
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
	function refreshPage() {
		location.reload();
	}
	/*============ number test function end===============*/