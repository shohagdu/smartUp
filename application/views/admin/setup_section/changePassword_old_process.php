<?php
	$userid=$this->session->userdata('id');
	$Query=$this->db->query("SELECT * FROM admin WHERE id='$userid'");
	$row=$Query->row();

?>
<script type="text/javascript">
	
	
$("document").ready(function(){
//alert('test');
$("#validall").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({  
             type: "POST",  
             url: "index.php/setup_section/changePasswordAction",  
             data: formData,
             async: false,
             cache: false,
             contentType: false,
             processData: false,
             success: function(data) {
					 if(data==1){
					$('#hidemessage').fadeIn('slow').delay(10000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/setup_section/changePassword";
					},10000)
					}
					else if(data==10){
						$('#hidePassMatch').fadeIn('slow').delay(10000).fadeOut('slow');
						setTimeout(function(){					
						window.location="index.php/setup_section/changePassword";
						},10000)
					}					
					else if(data==3){
						$('#hidePassSuccess').fadeIn('slow').delay(10000).fadeOut('slow');
						setTimeout(function(){					
						window.location="index.php/setup_section/changePassword";
						},10000)
					}	
             }
        }); 
        return false;
});
});
	
	
	
	
	
	// for images upload........
	var loadFile=function(event){
		var output=document.getElementById("image");
		output.src=URL.createObjectURL(event.target.files[0]);
	};
</script>
<style>
@-moz-document url-prefix() {
	.input-file-sm {
		height: auto;
		padding-top: 2px;
		padding-bottom: 1px;
	}
}
</style>
	
<div id="content" class="col-lg-10 col-sm-10">
		<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
		<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>
		
		<!-- search user name-----------unique-->
		
		<!-- some information query -->
		<div class="row">
			<div class="col-md-12"> 
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">পাসওয়া্র্ড পরিবর্তন করুন</div>
					<div class="panel-body all-input-form">
						<div class="row" style="margin-bottom: 10px;"> 
							<div class="col-sm-3 pull-right"> 
								<a href="setup_section/adminProfile">
									<button type="button" class="btn-success btn-sm pull-right">এডমিন প্রোফাইল</button>
								</a>
							</div>
						</div>
						<form action="index.php/setup_section/changePasswordAction" method="post"  id="validall" enctype="multipart/form-data" class="form-horizontal">
							<div class="row"> 
								<div class="col-sm-12"> 
									<div class="form-group"> 
										<div class="col-sm-6 col-sm-offset-3" id="UPLOAD"> 
											<img src="<?php if($row->pic!=''){ echo "img/".$row->pic;}else{ echo "img/default/default.jpg";} ?>" id="image" name="pic" class="img-thumbnail" style="height:180px;width:180px;" />
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Picture" class="col-sm-3 control-label">ছবি</label>
										<div class="col-sm-6">
											<input type="file" name="picture" id="pic" title="please select images" class="form-control input-file-sm" onchange="loadFile(event)" />
											<input type="hidden" name="image" value="<?php echo $row->pic; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Full Name" class="col-sm-3 control-label">ইউজার নাম</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="username" value="<?php echo $row->username?>" disabled />
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Designation" class="col-sm-3 control-label">নাম</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="fullname" value="<?php echo $row->fullname?>" />
										</div>
									</div>
								</div>
							</div>
						
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Role" class="col-sm-3 control-label"> মোবাইল</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="phone" value="<?php echo $row->mobile;?>" />
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="email" class="col-sm-3 control-label">ই-মেইল  </label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="email" value="<?php echo $row->email?>" />
										</div>
									</div>
								</div>
							</div>
							
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="password" class="col-sm-3 control-label">New Password</label>
										<div class="col-sm-6">
											<input type="password" class="form-control" name="password"/>
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="password" class="col-sm-3 control-label">Confirm Password</label>
										<div class="col-sm-6">
											<input type="password" class="form-control" name="cpassword"/>
										</div>
									</div>
								</div>
							</div>
							
							
							
							<div class="row">
								<div class="col-sm-offset-3 col-sm-1"> 
									<input type="submit" value="Add" class="btn btn-info btn-sm"/>
								</div>
								<div class="col-sm-5 pull-left"> 
									<div class="row">
										<div class="col-md-12" style="min-height:30px;display:none;" id="hidemessage">
											<div class="alert alert-success alert-sm" >
												<strong>Successfully! Update Your Profile.</strong>
											</div>
									   </div>
									   
									   <div class="col-md-12" style="min-height:30px;display:none;" id="hidePassMatch">
											<div class="alert alert-success alert-sm" >
												<strong>Your Password is Not Match</strong>
											</div>
									   </div>
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
				</div><!--- / panel primary----->
			</div>
		</div><!-- row end--->
	</div><!--/#content.col-md-10-->
</div><!--/fluid-row-->





