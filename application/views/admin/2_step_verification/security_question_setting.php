<?php count($this->sq->check_exist_q());?>
	<div id="content" class="col-lg-10 col-sm-10">
		<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
		<script type="text/javascript">
			$(document).ready(function(){
				$('.sq').submit(function() {
					$.post(
					"Security/update_security_submit",
					$(".sq").serialize(),
					function(data){
						if(data==1)
						{
							alert('Successfully Updated Your Security Setting');
							window.location='Admin';
						}
						else if(data==2)
						{
							alert('Please Select Unique Question.');
						}

						else{
							alert(data);
						}
					});
					return false;
				});
			});
			function chnageQuestion(sid){
				
				$.post(
					"Security/uniqueCheck",
					$(".sq").serialize(),
					function(data){
						//alert(data);
						if(data!='1') {
							alert('Please Select Unique Question.');
							document.getElementById("user_role"+sid).value='';
						}
					});
			}
		</script>
		<style type="text/css"> 
			@-moz-document url-prefix() {
				.input-file-sm {
					height: auto;
					padding-top: 2px;
					padding-bottom: 1px;
				}
			}
			.medium-font{
				font-size: 15px;
				font-weight: normal;
			}
			.medium-font-inupt{
				font-size: 16px !important;
				letter-spacing: 1px;
				color: #333 !important;
			}
			.lb-lg {
  font-size: 20px;
  
}
.q{
    background: #C3BDD6 !important;
    color:#C3BDD6;
    text-shadow:0 1px 0 rgba(0,0,0,1.7);
}
option:not(:checked) { 
    background-color: white; 
    color:#000;
}
		</style>
		<script>
			function verfication(number)
			{
				window.location='Security/mobile_verfication_code/'+number;
			}
		</script>
		
	<?php 
	extract($this->session->all_userdata());
	?>	
		<!-- some information query -->
		<div class="row">
			<div class="col-md-12"> 
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">Security Question Setting</div>
					<div class="panel-body all-input-form">
					<?php ?>
						<form action="javascript:void(0)" method="post"  id="validall" enctype="multipart/form-data" class="sq form-horizontal">
			
							
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="quest_1" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<select name="quest[]" id="user_role1" class="q form-control medium-font-inupt" required onchange="chnageQuestion('1');" >
												<option value="" style="" >Select Question No:01</option>
												<?php foreach ($quest as $q):
														echo "<option  value='$q->question_id'>$q->title</option>";
													endforeach;
													?>
											</select>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Full Name" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<input type="text" name="ans[]" id="full_name" class="form-control medium-font-inupt"placeholder="Write Ans here" required />
										</div>
									</div>
								</div>
							</div>
							
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="quest_1" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<select name="quest[]" id="user_role2" class="q form-control medium-font-inupt" required onchange="chnageQuestion('2');">
												<option value="" style="" >Select Question No:02</option>
												<?php foreach ($quest as $q):
														echo "<option  value='$q->question_id'>$q->title</option>";
													endforeach;
													?>
											</select>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Full Name" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<input type="text" name="ans[]" id="full_name" class="form-control medium-font-inupt"placeholder="Write Ans here" required/>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="quest_1" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<select name="quest[]" id="user_role3" class="q form-control medium-font-inupt" required onchange="chnageQuestion('3');">
												<option value="" style="" >Select Question No:03</option>
												<?php foreach ($quest as $q):
														echo "<option  value='$q->question_id'>$q->title</option>";
													endforeach;
													?>
											</select>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Full Name" class="col-sm-3 control-label"></label>
										<div class="col-sm-6">
											<input type="text" name="ans[]" id="full_name" class="form-control medium-font-inupt"placeholder="Write Ans here" required />
										</div>
									</div>
								</div>
							</div>
	
							<div class="row">
								<div class="col-sm-offset-3 col-sm-1"> 
									<input type='submit' value="আপডেট করুন" name='submit_btn' class="btn btn-info btn-sm"/>
								</div>
								<div class="col-sm-6 pull-left"> 
									<span id="error" style="font-size:18px;font-family:comicsans-ms;color:red;"></span>
								</div>
							</div>
						</form>
					</div>
				</div><!--- / panel primary----->
			</div>
		</div><!-- row end--->
	</div><!--/#content.col-md-10-->
