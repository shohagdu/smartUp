<?php
	$userid=$this->session->userdata('id');
	$Query=$this->db->query("SELECT * FROM admin WHERE id='$userid'");
	$row=$Query->row();

?>
<div id="content" class="col-lg-10 col-sm-10">
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
	<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>
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
		.all-input-form label>span{
			color:red;
		}
	</style>
	
	<!-- some information query -->
	<div class="row">
		<div class="col-md-12"> 
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">এডমিন প্রোফাইল</div>
				<div class="panel-body all-input-form">
					<div class="row" style="margin-bottom: 10px;"> 
						<div class="col-sm-3 pull-right"> 
							<a href="index.php/setup_section/changeProfile">
								<button type="button" class="btn-success btn-sm pull-right">এডমিন প্রোফাইল পরিবর্তন</button>
							</a>
						</div>
					</div>
					<form action="Manage/webSiteUpMemberAdd_action" method="post" onsubmit="return validation();" id="fixedInputTest" enctype="multipart/form-data" class="form-horizontal">
						
						<div class="row"> 
							<div class="col-sm-12"> 
								<div class="form-group"> 
									<div class="col-sm-6 col-sm-offset-3" id="UPLOAD"> 
										<img src="<?php if($row->pic!=''){ echo "img/".$row->pic;}else{ echo "img/default/default.jpg";} ?>" id="image" name="pic" class="img-thumbnail" style="height:180px;width:180px;" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-offset-1 col-sm-10">
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Full Name" class="col-sm-3 control-label">নাম  </label>
										<div class="col-sm-6" style="margin-top:8px;">
											<?php echo $row->fullname?>
										</div>
									</div>
								</div>
							</div>
							
						
							
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="Mobile" class="col-sm-3 control-label">মোবাইল    </label>
										<div class="col-sm-6" style="margin-top:8px;">
											<?php echo $row->mobile;?>
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="email" class="col-sm-3 control-label">ই-মেইল  </label>
										<div class="col-sm-6" style="margin-top:8px;font-size:16px;;">
											<?php echo $row->email?>
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12"> 
									<div class="form-group">
										<label for="email" class="col-sm-3 control-label">পদবী </label>
										<div class="col-sm-6" style="margin-top:8px;">
											<?php echo $row->desig?>
										</div>
									</div>
								</div>
							</div>
							<div class="row medium-font">
								<div class="col-sm-12" style="height:100px;"> 
									
								</div>
							</div>
						</div>
						
						
						
						
					</form>
				</div>
			</div><!--- / panel primary----->
		</div>
	</div><!-- row end--->
</div><!--/#content.col-md-10-->
