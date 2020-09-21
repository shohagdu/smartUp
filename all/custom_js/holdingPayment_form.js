	$(document).ready(function() {
		function test(value) {
			alert(value);
		}
		var yearValidators = {
			row: '.col-sm-4',   // The title is placed inside a <div class="col-sm-4"> element
			validators: {
				notEmpty: {
					message: 'অর্থবছর প্রদান করুন।'
				}
			}
		},
		typeValidators = {
			row: '.col-sm-4',
			validators: {
				notEmpty: {
					message: 'বসতভিটার ধরন প্রদান করুন।'
				}
			}
		},
		amountValidators = {
			row: '.col-sm-3',
			validators: {
				notEmpty: {
					message: 'টাকা প্রদান করুন।'
				},
				numeric: {
					message: 'টাকা ইংরেজিতে প্রদান করুন।'
				}
			}
		},
		rateSheetIndex = 0;
		$('#holdingPaymetFormId')
		.formValidation({
			message: 'This value is not valid',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				paymentDate: {
					validators: {
						notEmpty: {
							message: 'পরিশোধের তারিখ প্রদান করুন।'
						}
					}
				},
				bookNumber: {
					validators: {
						notEmpty: {
							message: 'বই নম্বর প্রদান করুন।'
						},
						numeric: {
							message: 'ইংরেজিতে সংখ্যা প্রদান করুন।'
						},
						remote: {
							message: 'এই বই এর জন্য এই মানি রসিদ একবার ব্যবহার করা হয়েছে! দয়া করে মুছে আবার লিখূন',
							url: 'index.php/validation/check_unique_book_and_money_number?ch='+"payment_log_bosotbita",
							data: function(validator, $field, value) {
								return {
									moneyNumber: validator.getFieldElements('moneyNumber').val()
								};
							},
							type: 'POST'
						}
					}
				},
				moneyNumber: {
					verbose: false,
					validators: {
						notEmpty: {
							message: 'মানি রসিদ নম্বর প্রদান করুন।'
						},
						numeric: {
							message: 'ইংরেজিতে সংখ্যা প্রদান করুন।'
						},
						remote: {
							message: 'এই বই এর জন্য এই মানি রসিদ একবার ব্যবহার করা হয়েছে! দয়া করে মুছে আবার লিখূন',
							url: 'index.php/validation/check_unique_book_and_money_number?ch='+"payment_log_bosotbita",
							data: function(validator, $field, value) {
								return {
									bookNumber: validator.getFieldElements('bookNumber').val()
								};
							},
							type: 'POST'
						}
					}
				},
				totalAmount: {
					validators: {
						notEmpty: {
							message: 'The field is required cannot be empty.'
						}
					}
				},
				discount: {
					validators: {
						notEmpty: {
							message: 'মওকুফ এর টাকা প্রদান করুন অথবা "0" প্রদান করুন।'
						},
						numeric: {
							message: 'টাকা ইংরেজিতে প্রদান করুন।'
						}
					}
				},
				paymentAmount: {
					validators: {
						notEmpty: {
							message: 'The field is required cannot be empty.'
						}
					}
				},
				'fiscalYear[0].year': yearValidators,
				'holdingType[0].type': typeValidators,
				'holdingAmount[0].amount': amountValidators
			}
		})
		// Add button click handler
		.on('click', '.addButton', function() {
			rateSheetIndex++;
			var $template = $('#holdingTemplate'),
				$clone    = $template
								.clone()
								.removeClass('hide')
								.removeAttr('id')
								.attr('data-rateSheet-index', rateSheetIndex)
								.insertBefore($template);

			// Update the name attributes
			$clone
				.find('[name="year"]').attr('name', 'fiscalYear[' + rateSheetIndex + '].year').attr('id', 'fiscalYear_' + rateSheetIndex).end()
				.find('[name="type"]').attr('name', 'holdingType[' + rateSheetIndex + '].type').attr('id', 'holdingType_' + rateSheetIndex).end().end()
				.find('[name="amount"]').attr('name', 'holdingAmount[' + rateSheetIndex + '].amount').attr('id', 'holdingAmount_' + rateSheetIndex).end().end()
				

			// Add new fields
			// Note that we also pass the validator rules for new field as the third parameter
			$('#holdingPaymetFormId')
				.formValidation('addField', 'fiscalYear[' + rateSheetIndex + '].year', yearValidators)
				.formValidation('addField', 'holdingType[' + rateSheetIndex + '].type', typeValidators)
				.formValidation('addField', 'holdingAmount[' + rateSheetIndex + '].amount', amountValidators);
		})
		.on('change','.holdingType', function(){
			// get row 
			var $row = $(this).parents('.form-group'),
				index = $row.attr('data-rateSheet-index');
				
			var holdingTypeId = parseInt($(this).val());
			if(holdingTypeId != ''){
				$.post('index.php/setup_section/get_rate_sheet_amount', { id: holdingTypeId}, 
					function(response){
						var obj = JSON.parse(response);
						if(obj.status == 'success'){
							
							$("#holdingAmount_" + index).val(obj.data.amount);
							findSubTotal(rateSheetIndex);
						}
				}).fail(function(){
					  console.log("error");
				});
			}
		})
		// Remove button click handler
		.on('click', '.removeButton', function() {
			
			var $row  = $(this).parents('.form-group'),
				index = $row.attr('data-rateSheet-index');
				
			// amount calculation
			$("#holdingAmount_" + index).val(0.00); //reset row amount
			findSubTotal(rateSheetIndex);
				
			// Remove fields
			$('#holdingPaymetFormId')
				.formValidation('removeField', $row.find('[name="fiscalYear[' + index + '].year"]'))
				.formValidation('removeField', $row.find('[name=" holdingType[' + index + '].type"]'))
				.formValidation('removeField', $row.find('[name="holdingAmount[' + index + '].amount"]'));

			// Remove element containing the fields
			$row.remove();
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
					//alert(result);
					var obj = JSON.parse(result);
					if(obj.status == 'error'){
						$('#errorMessageModal').fadeIn('slow').delay(1000).fadeOut('slow');
						$('#errorTextModal').text(obj.message);
						setTimeout(function(){					
							window.location="index.php/Admin/taxCollection";
						},1000)
					}else if(obj.status == 'success'){
						document.getElementById('save_tlicence').type='button';
						$("#globalmsg").show("normal").html('<p class="done">আপনার বসতভিটা কর সঠিকভাবে আদায় হয়েছে,আপনি মানি রিসিট গ্রহণ করুন</p>');
						setTimeout(function() {
							window.location='Admin/taxCollection';	
							window.open('Money_receipt/bosodbitakorMoneyReceipt', '_blank');
						}, 2000)
					}else if(obj.status == 'warning'){
						alert(obj.message);
					}
					else{
						alert(result);
					}
				}
			});
		})
		
	});
	$('input[name="discount"]').on('keyup',function(){
		var discountTaka = parseFloat($(this).val());
		var subTotalTaka = parseFloat($("#totalAmount").val());
		
		if(discountTaka > subTotalTaka){
			alert('Discount Amount bigger than Total Amount');
			$("#paymentAmount").val('');
		}else{
			if(!isNaN(discountTaka) && discountTaka != ''){
				var netPayableTaka = subTotalTaka - discountTaka;
				$("#paymentAmount").val(netPayableTaka.toFixed(2));
			}else{
				$("#paymentAmount").val(subTotalTaka.toFixed(2));
			}
		}
	});
	
	function findSubTotal(row){
		
		var subTotal = 0;
		for(i = 0; i<= row; i++){
			if (typeof($("#holdingAmount_" + i).val()) != 'undefined' && $("#holdingAmount_" + i).val() !='') {
				subTotal += parseFloat($("#holdingAmount_" + i).val());
			}
		}
		$("#totalAmount").val(subTotal.toFixed(2));
		
		// check discount and net payable
		var discountAmount = parseFloat($("#discount").val());
		if(!isNaN(discountAmount) && discountAmount != ''){
			var netAmount = subTotal - discountAmount;
			$("#paymentAmount").val(netAmount.toFixed(2));	
		}else{
			$("#paymentAmount").val(subTotal.toFixed(2));
		}
	}
	
	$(function() {
		$( "#paymentDate" ).datepicker({
			changeMonth: true,
			changeYear: true,
			autoSize: true,
			dateFormat: 'yy-mm-dd'
		});
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