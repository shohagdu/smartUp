<?php 
/* for chairman images */
$chack=array(
	'designation'=>1,
	'status'=>1
);
$query = $this->db->select("*")->from("tbl_upmember")->where($chack)->order_by('id','desc')->limit('1')->get()->row();
/* end chairman images*/

$chack=array('1','3');
$query_all = $this->db->select("*")->from("tbl_upmember")->where_in('designation',$chack)->where('status','1')->order_by('id','asc')->get()->result();


$chack=array('1','3');
$qq = $this->db->select("*")->from("tbl_upmember")->where_not_in('designation',$chack)->where('status','1')->order_by('id','asc')->get()->result();

// for news.......
$news = $this->db->select("*")->from("tbl_news")->where("status","1")->order_by('id','desc')->limit("5")->get()->result();
?>	
	
	<div class="scroll_news"><!-- Scrool News Start-->
		<div class="row">
			<div class="col-md-2">
				<p class="text-center">
					<a href="home/all_news" style="text-decoration:none;"><i class="fa fa-newspaper-o"></i>&nbsp; সকল খবর  &nbsp; <i class="fa fa-chevron-right"></i></a>
				</p>

			</div>
			<div class="col-md-10">
				<table width="100%" border="0"> 
					<tr>
						<td width="100%"> 
							<marquee behavior="scroll" align="middle" direction="left" scrollamount="6" onmouseover="this.stop()" onmouseout="this.start()">
								<?php foreach($news as $ne):?>
									<a href="home/bistarito?id=<?php echo md5($ne->id); ?>"><?php echo $ne->title; ?></a><span>&nbsp*** &nbsp;&nbsp;&nbsp;&nbsp; </span>
								<?php endforeach;?>	
							</marquee>
						</td>
						
					</tr>
				</table>
			</div>
		</div>
	</div><!-- Scrool News End-->
	
<!-- some information query -->
<?php 
	$headData=$this->db->query("select * from chairman_message order by id desc limit 1");
	$head=$headData->row();
?>

<div class="main_con"><!--Content Start-->
	<div class="row"><!--- row start--->
		<div class="col-md-9 left_con"><!-- left Content Start-->
			<div class="row">
				<div class="col-md-12"><!-- Welcome Massage Start-->
					<div class="panel panel-primary">
						<div class="panel-heading" style="font-weight:400; font-size:17px; letter-spacing: 1px;background:#004884;">স্বাগতম  <?php echo $all_data->full_name;?></div>
						<div class="panel-body" style="min-height:250px;">
							<p style="text-align: justify;">
								<img style="width: 250px; height: 230px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: 5px 10px 0px 0px;" class="img-thumbnail" src="<?php echo base_url('library/profile/'.$query->pic) ?>" alt="চেয়ারম্যানের ছবি" />
								<div style="text-align:justify;line-height:30px;color:black;" >
									<p style="text-align: justify;font-size:14px;font-style:normal;font-weight:normal;">
										<?php 
											echo $head->message;
										?>
										<!-- <a href="javascript:void(0);" style="font-weight:bold;">....more read</a>-->
									</p>
								</div>
							</p>
						</div>
					</div>
				</div><!-- Welcome Massage End-->	
				
				
				<div class="col-md-12"> 
					<div class="panel panel-primary">
						<div class="panel-heading" style="background:#004884;"><i class="fa fa-picture-o"></i> &nbsp ইউপি চেয়ারম্যান ও ওয়ার্ড মেম্বারদের প্রোপাইল</div>
						<div class="panel-body">
							<div id="demo"> 
								<div id="owl-demo" class="owl-carousel">
									<?php 
										foreach($query_all as $row):
									?>
									<a href="home/profileview?mid=<?php echo md5($row->id);?>">
										<div class="item">
											<img src="library/profile/<?php if($row->pic!=''): echo $row->pic; else:echo "default.jpg"; endif;?>" alt="" style="height: 170px; width: 200px;" />
											<div style="text-align:center;margin-top: 8px;"> 
												<p><?php echo $row->full_name;?> <br />
												<?php 
													$value = $row->designation;
													if($value==1){
														$show = 'ইউপি চেয়ারম্যান';
													}
													else if($value==3){
														$show = 'মেম্বার';
													}
												?>
												<?php echo $show;?>&nbsp;<br />
												<?php echo $row->mobile;?>
												</p>
											</div>
										</div>
									</a>
									<?php endforeach ;?>
								<!--	
									<div class="item"><img src="assets/owl2.jpg" alt="Owl Image">sdfg</div>
									<div class="item"><img src="assets/owl3.jpg" alt="Owl Image">sdf</div>
									<div class="item"><img src="assets/owl4.jpg" alt="Owl Image">sdfg</div>
									<div class="item"><img src="assets/owl5.jpg" alt="Owl Image">dsf</div>
									<div class="item"><img src="assets/owl6.jpg" alt="Owl Image">sdfg</div>
									<div class="item"><img src="assets/owl7.jpg" alt="Owl Image">sdfg</div>
									<div class="item"><img src="assets/owl8.jpg" alt="Owl Image">ssdf</div>
								-->	
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-12"> 
					<div class="photo_gallery"><!--Photo Gallery Start -->
						<div class="panel panel-primary">
							<div class="panel-heading" style="background:#004884;"><i class="fa fa-picture-o"></i> &nbsp ইউনিয়ন কর্মকর্তা ও কর্মচারীবৃন্দ</div>
							<div class="panel-body">
								<marquee behavior="scroll" align="middle" direction="left" scrollamount="4" onmouseover="this.stop()" onmouseout="this.start()">
									<div class="row second-slide">
										<?php 
											foreach($qq as $val):
										?>
										<a href="home/profileview?mid=<?php echo md5($val->id);?>">
											<div style="height:150px;display:inline-block;"> 
												<div style="height:120px;">
													<img src="library/profile/<?php if($val->pic!=''):echo $val->pic; else:echo"default.jpg"; endif; ?>" class="img-responsive img-thumbnail" style="height: 120px; width: 150px;"/>
												</div>
												<div style="height:30px;width:150px;padding:2px;text-align:center;">
													<p style="white-space:normal;"><?php echo $val->full_name;?><br />
														<?php 
															$value = $val->designation;
															if($value==2){
																$show = 'সচিব';
															}
															else if($value==4){
																$show = 'উদ্যোক্তা';
															}
															else if($value==5){
																$show="গ্রামপুলিশ";
															}
														?>
														<?php echo $show;?>&nbsp;
													</p>
												</div>
											</div>
										</a>
										<?php endforeach;?>
										
										<!--<img src="all/sub_slide/daskhin_sodoso1.jpg" class="img-responsive img-thumbnail" style="height: 100px; width: 120px;"/>
										<img src="all/sub_slide/nas.jpg" class="img-responsive img-thumbnail" style="height: 100px; width: 120px;"/>-->
									</div>
								</marquee>
								<div class="modal" id="myModal" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button class="close" type="button" data-dismiss="modal">×</button>
												<h3 class="modal-title"></h3>
											</div>
											<div class="modal-body">
												<div id="modalCarousel" class="carousel">
													<div class="carousel-inner"></div>
														<a class="carousel-control left" href="#modaCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i>
														</a>
														<a class="carousel-control right" href="#modalCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i>
														</a>
												</div>
											</div>
											<div class="modal-footer">
												<button class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!--Photo Gallery End -->
				</div>
			</div><!-- row end--->
		</div><!-- left Content End-->
		
		
		<style>
			#owl-demo .item{
				margin: 3px;
			}
			#owl-demo .item img{
				display: block;
				width: 100%;
				height: auto;
			}
			.owl-carousel a{
				text-decoration:none;
				
			}
			.owl-carousel a:hover{
				text-decoration:none;
				color: #4988BE;
			}
			.second-slide a{
				text-decoration:none;
			}
			.second-slide a:hover{
				text-decoration:none;
				color: #4988BE;
			}
			.p-style p::first-line{
				font-size:20px;
				font-weight:bold;
				color:green;
			}
		</style>


		<script>
			$(document).ready(function() {
			  $("#owl-demo").owlCarousel({
				autoPlay: 3000,
				items : 4,
				itemsDesktop : [1199,3],
				itemsDesktopSmall : [979,3]
			  });

			});
		</script>
		
		<script src="owl-carousel/owl.carousel.js"></script>