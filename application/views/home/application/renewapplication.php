	<style type="text/css"> 
		.button-style{
			margin-bottom:30px;
			margin-top: 10px;
		}
		.all-input-form label{
			color: #413839;
			opacity:0.9;
		}
		.all-input-form label>span{
			color:red;
		}
		.all-input-form input[type="text"],
		.all-input-form select{
			color: #0C090A;
			font-size:13px;
			font-weight:500;
		}
		.all-input-form input[type="file"]{
			color: #0C090A;
			font-size:13px;
			font-weight:500;
		}
	</style>
	<script type="text/javascript">

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
	</script>
	<script type="text/javascript"> 
		//renew request
	   $(document).ready(function(){
			$('#renew').submit(function() {
				$.post(
					"index.php/home/license_renew",
					$("#renew").serialize(),
					function(data){
						if(data==3){
							alert("আপনার আবেদনটি গৃহীত হয়েছে\n সনদের নাম্বারটি  নিয়ে আপনার ইউনিয়ন পরিষদে যোগাযোগ করুন");
							location.reload();
						}
						else{
							alert(data);
						}
					});
					return false;
			});
		});
	</script>
	<!-- some information query -->

<div class="main_con"><!--Content Start-->
	<div class="row"><!--- row start--->
		<div class="col-md-9 left_con"><!-- left Content Start-->
			<div class="row">
				<div class="col-md-12"> 
					<div class="panel panel-primary">
						<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">ট্রেড লাইসেন্স নবায়ন আবেদন ফরম</div>
						<div class="panel-body all-input-form" style="min-height: 608px;">
							<form action="index.php/home/license_renew" method="post" id="renew" enctype="multipart/form-data" class="form-horizontal">
								
								<div class="row"> 
									<div class="col-sm-12" style="margin-bottom:10px;margin-top:10px;"> 
										<div class="form-group">
											<label for="Delivery-type" class="col-sm-3 control-label">সরবরাহের ধরণ  <span>*</span></label>
											<div class="col-sm-4">
												<label class="radio-inline"><input type="radio" name="delivery_type" value="1" />জরুরী</label>
												<label class="radio-inline"><input type="radio" name="delivery_type" value="2" />অতি জরুরী  </label>
												<label class="radio-inline"><input type="radio" name="delivery_type" value="3" checked="checked" /> সাধারন</label>
											</div>
											<label for="Application-type" class="col-sm-2 control-label">আবেদনের ধরণ    <span>*</span></label>
											<div class="col-sm-3">
												<label class="radio-inline"><input type="radio" name="app_type" id="renew_app" value="2" checked="checked" />নবায়ন  </label>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12"> 
										<div class="form-group">
											<label for="tradelicense no" class="col-sm-3 control-label">ট্রেড লাইসেন্স নং <span>*</span></label>
											<div class="col-sm-9">
												<input type="text" name="tradeno" id="tid" class="form-control" placeholder="আপনার  ট্রেড লাইসেন্স সনদের নাম্বারটি ইংরেজিতে প্রবেশ করুন `"  onkeypress="return checkaccnumber(event);" maxlength="17" minlength="17" />
											</div>
										</div>
										
									</div>
								</div>
								<div class="row">
									<div class="col-sm-offset-5 col-sm-6 button-style">
										<button type="submit" class="btn btn-primary" name="renew">দাখিল করুন</button>
									</div>
								</div>
							</form>
						</div><!-- panel-body-end---->
					</div><!--- end of panel primary--->
				</div><!-- end of col-md-12---->
			</div><!-- row end--->
		</div><!-- left Content End-->