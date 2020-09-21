<style type="text/css">
	.title-style p{
		font-size:25px;
		text-align:center;
		font-style:normal;
		font-weight:bold;
		color:#993333;
	}
	.title-style p.head_style{
		font-size:20px;
		text-align:center;
		font-style:normal;
		font-weight:normal;
		color:#993333;
	}
	.custom-margin{
		margin-top:8px;
		margin-bottom:5px;
	}
	.panel-body label{
		font-size: 16px;
	}
	.custom-style{
		font-size:20px;
		font-weight:normal;
	}
</style> 
<script type="text/javascript"> 

</script>
<!-- some information query -->
<?php 
 if(isset($_GET['mid'])){
	$id=$_GET['mid'];
	$query = $this->db->select("*")->from("tbl_upmember")->where("md5(id)",$id)->order_by('id','desc')->limit('1')->get()->row();
	}
?>

<div class="main_con"><!--Content Start-->
	<div class="row"><!--- row start--->
		<div class="col-md-9 left_con"><!-- left Content Start-->
			<div class="row">
				<div class="col-md-12"> 
					<div class="panel panel-primary">
						<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;"></div>
						<div class="panel-body" style="min-height:500px;">
							<div class="row">
								<div class="col-sm-12">
									<div class="col-sm-offset-1 col-sm-3"> 
										<img src="library/profile/<?php if($query->pic!=''): echo $query->pic; else:echo "default.jpg"; endif;?>" alt="Image" class="" height="160px" width="160px" />
									</div>
									<div class="col-sm-6 title-style"> 
										<p> <?php echo $all_data->full_name;?></p>
											<?php 
												$dd = $query->designation;
												if($dd=='1'){
													$ddd="ইউপি চেয়ারম্যান";
												}
												else if($dd=='2'){
													$ddd="সচিব";
												}
												else if($dd=='3'){
													$ddd="মেম্বার";
												}
												else if($dd=='4'){
													$ddd='উদ্যোক্তা';
												}
												else if($dd=='5'){
													$ddd='গ্রামপুলিশ';
												}
												else{
													$ddd='';
												}
											?>
										<p class="head_style"> <?php echo $ddd;?> </p>
									</div>
									<div class="col-sm-2 "></div>
								</div>
							</div>
							
							<div class="row custom-margin" style="margin-top:10px;padding-top:10px;border-top:1px solid #ddd;">
								<div class="col-sm-12">
									<label for="" class="col-sm-offset-1 col-sm-4 control-label">নাম </label>
									<div class="col-sm-7 custom-style"> 
										<?php 
											echo $query->full_name;
										?>
									</div>
								</div>
							</div>
							<?php if($query->n_id!=""):?>
							<div class="row custom-margin">
								<div class="col-sm-12">
									<label for="" class="col-sm-offset-1 col-sm-4 control-label">জাতীয় পরিচয় পত্র নং</label>
									<div class="col-sm-7 custom-style"> 
										<?php 
											echo $query->n_id;
										?>
									</div>
								</div>
							</div>
							<?php endif;?>
							<div class="row custom-margin">
								<div class="col-sm-12">
									<label for="" class="col-sm-offset-1 col-sm-4 control-label">পদবী /Designation</label>
									<div class="col-sm-7 custom-style"> 
										<?php 
											echo $ddd;
										?>
									</div>
								</div>
							</div>
				
							<div class="row custom-margin">
								<div class="col-sm-12">
									<label for="" class="col-sm-offset-1 col-sm-4 control-label"> মোবাইল নাম্বার</label>
									<div class="col-sm-7 custom-style"> 
										<?php 
											echo $query->mobile;
										?>
									</div>
								</div>
							</div>
							<?php if($query->email!=''):?>
							<div class="row custom-margin">
								<div class="col-sm-12">
									<label for="" class="col-sm-offset-1 col-sm-4 control-label"> ইমেইল ঠিকানা</label>
									<div class="col-sm-7 custom-style"> 
										<?php 
											echo $query->email;
										?>
									</div>
								</div>
							</div>
							<?php endif;?>
							
							<?php if($query->qualification!=''):?>
							<div class="row custom-margin">
								<div class="col-sm-12">
									<label for="" class="col-sm-offset-1 col-sm-4 control-label">সর্বোচ্চ শিক্ষাগত যোগ্যতা</label>
									<div class="col-sm-7 custom-style"> 
										<?php 
											echo $query->qualification;
										?>
									</div>
								</div>
							</div>
							<?php endif;?>
							
							<?php if($query->dofb!=''):?>
							<div class="row custom-margin">
								<div class="col-sm-12">
									<label for="" class="col-sm-offset-1 col-sm-4 control-label">জন্মতারিখ</label>
									<div class="col-sm-7 custom-style"> 
										<?php 
											echo $query->dofb;
										?>
									</div>
								</div>
							</div>
							<?php endif;?>
							<?php 
								$yy= $query->mstatus;
								if($yy=='1'){
									$yyy="বিবাহিত";
								}
								else if($yy=='2'){
									$yyy="অবিবাহিত";
								}
							?>
							
							<?php if($query->mstatus!=''):?>
							<div class="row custom-margin">
								<div class="col-sm-12">
									<label for="" class="col-sm-offset-1 col-sm-4 control-label"> বৈবাহিক অবস্থা</label>
									<div class="col-sm-7 custom-style"> 
										<?php 
											echo $yyy;
										?>
									</div>
								</div>
							</div>
							<?php endif;?>
							
							<?php if($query->barea!=''):?>
							<div class="row custom-margin">
								<div class="col-sm-12">
									<label for="" class="col-sm-offset-1 col-sm-4 control-label"> নির্বাচনী এলাকার নাম</label>
									<div class="col-sm-7 custom-style"> 
										<?php 
											echo $query->barea;
										?>
									</div>
								</div>
							</div>
							<?php endif;?>
							
							<?php if($query->vno!=''):?>
							<div class="row custom-margin">
								<div class="col-sm-12">
									<label for="" class="col-sm-offset-1 col-sm-4 control-label"> নির্বাচনী আসন নং</label>
									<div class="col-sm-7 custom-style"> 
										<?php 
											echo $query->vno;
										?>
									</div>
								</div>
							</div>
							<?php endif;?>
							
							<?php if($query->district!=''):?>
							<div class="row custom-margin">
								<div class="col-sm-12">
									<label for="" class="col-sm-offset-1 col-sm-4 control-label">নিজ জেলা</label>
									<div class="col-sm-7 custom-style"> 
										<?php 
											echo $query->district;
										?>
									</div>
								</div>
							</div>
							<?php endif;?>
							
							<?php if($query->joindate!=''):?>
							<div class="row custom-margin">
								<div class="col-sm-12">
									<label for="" class="col-sm-offset-1 col-sm-4 control-label">চাকুরীতে যোগদানের তারিখ</label>
									<div class="col-sm-7 custom-style"> 
										<?php 
											echo $query->joindate;
										?>
									</div>
								</div>
							</div>
							<?php endif;?>
						</div><!---- end panel body ----->
					</div>
				</div>
			
			</div><!-- row end--->
		</div><!-- left Content End-->