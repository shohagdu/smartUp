	<div id="content" class="col-lg-10 col-sm-10">
		<link href="<?php echo base_url();?>website_tools_controll/toogle_css.css" rel="stylesheet">
		<script src="<?php echo base_url();?>website_tools_controll/toogle_js.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.daily').submit(function() {
					//$("#load").empty().append('<img src="library/img/ajaxloader.gif">');
					
					$.post(
					"Security/security_setup_submit",
					$(".daily").serialize(),
					function(data){
						if(data==1)
						{
							alert('Successfully Updated Your Security Setting');
							window.location='Admin';
						}
						else if(data==2)
						{
							alert('Please Choice Minimum Two Security Option\n [ Security Question, Send SMS, Random Picture ] ');
						}
						else if(data==3)
						{
							window.location='Manage/employeeManageUpdate?id=<?php echo md5($this->session->userdata('id'))?>';
						}
						else{
							alert(data);
						}
					});
					return false;
				});
			});
		</script>
		<style type="text/css"> 
			.big-font{
				font-size: 20px;
				font-weight: bolder;
				color: #ffff;
			}
		</style>
	<?php
	
	$user_id=$this->session->userdata('id');
	
		//echo count($info);
		$filed_name=array(
		'two_step_verify'=>'Two Step Verification',
		'security_question_verify'=>'Security Question',
		'trans_pin_code'=>'Transaction Pin Code',
		'mobile_verify'=>'Verify Mobile',
		'email_verify'=>'Verify Email',
		'send_sms_verify'=>'One Time Verification Pin(OTP)',
		'random_picture_verify'=>'Random Picture',
		'password_complexity'=>'Password Complexity',
		'pass_change_45_days'=>'Notify Change Password Within 45 Days'
		);
		$qy=$this->db->get_where("dcb_security_setting",array('user_id'=>$user_id))->row();
		
		// echo $this->db->last_query();
		$field_list=$this->db->list_fields('dcb_security_setting');
		if($this->db->affected_rows()>0):
		// print_r($qy);
		else:
		
		endif;
		?>
		<!-- Content (Right Column)-->
		<div class="row">
			<div class="col-12">
				<!-- Form -->
				<h3 class="tit" style="margin-top:0px;margin-bottom: 30px;background:lightgray;padding:5px;text-align:center;"> Security Setting</h3>
				<form action="Security/security_setup_submit" method="post" id="validall" class="daily form-horizontal" style="border: 1px solid #ddd; padding: 10px;box-sizing: border-box;" role="form">
					<?php $i=1;$array=array();foreach($filed_name as $key=>$val){?>
					<div class="form-group">
						<label class="control-label col-sm-5 col-sm-offset-1" for="<?php echo $val; ?>"><?php echo $val; ?></label>
						<div class="col-sm-6">	
							<input id="toggle-<?php echo $i; ?>" name="<?php echo $key;?>"  type="checkbox" <?php if(in_array($key,$field_list) && $qy->$key=='on'){?> checked /><?php } else{?>
							<input id="toggle-<?php echo $i; ?>" name="<?php echo $key;?>"  type="checkbox" /><?php }?>
							
						</div>
					</div>
					<?php 
					$i++;}
					?>
					<div class="form-group" style="margin-top: 30px;"> 
						<div class="col-sm-offset-6 col-sm-6">
							<input type='hidden' name='user_id' value='<?php echo $user_id;?>'/>
							<button type="submit" name="submit" class="btn btn-info btn-sm">Save</button>	
						</div>
					</div>
					<script>
					  $(function() {
						<?php $id=1;foreach($filed_name as $value){ ?>  
						$('#toggle-<?php echo $id++; ?>').bootstrapToggle();
						<?php } ?>
					  });
					</script>	
				</form>
			</div><!--- /col-lg-12 col-sm-12-------->	
		</div> <!-- /row -->
	</div><!--/#content.col-md-0-->

