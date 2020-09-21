<script type="text/javascript"> 
	$(document).ready(function() {
		$('#defaultForm')
		.formValidation({
			message: 'This value is not valid',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				oldPass: {
					message: 'The username is not valid',
					validators: {
						notEmpty: {
							message: 'The field is required and cannot be empty'
						},
						different: {
							field: 'newPass',
							message: 'The field cannot be the same as new password'
						}
					}
				},
				newPass: {
					validators: {
						notEmpty: {
							message: 'The field is required and cannot be empty'
						},
						different: {
							field: 'oldPass',
							message: 'The field cannot be the same as old password'
						},
						callback: {
							callback: function(value, validator) {
								// Check the password strength
								if (value.length < 6) {
									return {
										valid: false,
										message: 'The password must be more than 6 characters'
									}
								}

								if (value === value.toLowerCase()) {
									return {
										valid: false,
										message: 'The password must contain at least one upper case character'
									}
								}
								if (value === value.toUpperCase()) {
									return {
										valid: false,
										message: 'The password must contain at least one lower case character'
									}
								}
								if (value.search(/[0-9]/) < 0) {
									return {
										valid: false,
										message: 'The password must contain at least one digit'
									}
								}

								return true;
							}
						}
					}
				},
				conPass: {
					validators: {
						notEmpty: {
							message: 'The field is required and cannot be empty'
						},
						identical: {
							field: 'newPass',
							message: 'The password and its confirm are not the same'
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
					//alert(result);exit;
					if(result==1){
						$('#hidePassSuccess').fadeIn('slow').delay(1000).fadeOut('slow');
						setTimeout(function(){				
							window.location="Admin";
						},1000)
					}
					else if(result == 2){
						alert("Opps! old password not match..");
					}
					else {
						alert(result);
					}
				}
			});
		})
	});

</script>
<div id="content" class="col-lg-10 col-sm-10">
	<div class="row">
		<div class="col-md-12"> 
			<div class="panel panel-default">
				<div class="panel-heading">Password Change</div>
				<div class="panel-body">
					<div style="min-height:600px;">
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<div class="panel panel-default">
									<div class="panel-heading"><span style="color:#2471A3;font-family:italic;font-size:16px;">Change your password </span> <span class="glyphicon glyphicon-chevron-right" style="color:#2471A3;float:right;font-size:11px;"></span></div>
									<div class="panel-body" style="height:500px;">
										<form action="index.php/Setup_section/changePasswordAction" method="post" class="form-horizontal" id="defaultForm">
											<div class="form-group" style="margin-bottom: 30px;margin-top: 30px;">
												<label class="control-label col-sm-4" for="pwd">Old Password:</label>
												<div class="col-sm-8"> 
													<input type="password" class="form-control" name="oldPass" id="oldPass" placeholder="Enter your old password">
												</div>
											</div>
											<div class="form-group"  style="margin-bottom: 30px;">
												<label class="control-label col-sm-4" for="pwd">New Password:</label>
												<div class="col-sm-8"> 
													<input type="password" class="form-control" name="newPass" id="newPass" placeholder="Exp: Aa1234">
													<span class="pass-hints">The password must contain at least one upper case character, one lower case character and one digit. password must be more than 6 characters.</span>
												</div>
											</div>
											<div class="form-group"  style="margin-bottom: 30px;">
												<label class="control-label col-sm-4" for="pwd">Confirm Password:</label>
												<div class="col-sm-8"> 
													<input type="password" class="form-control" name="conPass" id="conPass" placeholder="Please Re-type your passowrd">
												</div>
											</div>
											<div class="form-group"  style="margin-bottom: 30px;"> 
												<div class="col-sm-offset-4 col-sm-10">
													<button type="submit" class="btn btn-primary">Update</button>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12 pull-right"> 
													<div class="row">
													   <div class="col-md-12" style="min-height:30px;display:none;" id="hidePassSuccess">
															<div class="alert alert-success alert-sm" >
																<strong>Password Change Successfully</strong>
															</div>
													   </div>
													 </div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- row end--->
</div><!--/#content.col-md-10-->

<style type="text/css"> 
	.pass-hints{
		font-size: 11px;
		opacity: 0.7;
	}
</style>




