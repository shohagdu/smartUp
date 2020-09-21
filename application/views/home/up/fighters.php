<style type="text/css"> 
.custom-font-style b{
	font-size: 14px;
}
.custom-font-style p{
	font-size: 14px;
}
.count-fighter{
	margin-bottom: 20px;
}
.count-fighter h4{
	font-size: 18px;
	font-family: SolaimanLipi;
}
.count-fighter span{
	color: green;
	font-weight: bolder;
	font-size: 20px;
	background: lightgray;
	border-radius: 10px;
	padding: 5px;
}
</style>
<!-- some information query -->
<script type="text/javascript"> 
	function fighter_detalies(mid){
		//alert(mid);
		$.ajax({
			url:"index.php/home/fighter_detalies",
			type: "POST",
			data:{mid:mid},
			success:function(data){
				//alert(data);
				var spdata=data.split("|");
				if(spdata[1]!=''){
					document.getElementById('mpic').setAttribute('src',spdata[1]);
				}
				else{
					document.getElementById('mpic').setAttribute('src','library/profile/fighters/default.jpg');
				}
				document.getElementById('m_life_histroy').innerHTML=spdata[2];
			}
			
		})
	}
</script>

<div class="main_con"><!--Content Start-->
	<div class="row"><!--- row start--->
		<div class="col-md-9 left_con"><!-- left Content Start-->
			<div class="row">
				<div class="col-md-12"> 
					<div class="panel panel-primary">
						<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;">মুক্তিযোদ্ধাদের তালিকা  </div>
						<div class="panel-body"  style="min-height:310px;">
							<div class="row"> 
								<div class="col-md-12 col-sm-12 col-xs-12"> 
									<div class="count-fighter"> 
										<h4> <?php echo $all_data->full_name;?> এ মোট <span><?php echo $this->setup->count_fighter();?></span> জন মুক্তিযোদ্ধা রয়েছে ।</h4>
										<p style="font-size: 16px;">তালিকাটি  প্রিন্ট করতে  চাইলে প্রিন্ট বাটনে ক্লিক করুন  
											<a href='Home/printFighterList' target='_blank' class="btn btn-primary btn-sm">Print</a>
										</p>
									</div>
								</div>
							</div>
							<div class="row">
								<?php 
									//print_r($fighters_record);
									foreach($fighters_record as $value):
								?>
								<div class="col-md-6 col-sm-6 col-xs-12" style="min-height: 180px;border: 1px solid #D0D0D0;margin-bottom: 10px;padding-top: 8px;">
									<div class="row"> 
										<div class="col-md-12 col-sm-12 col-xs-12" > 
											<div class="col-md-5 col-sm-5 col-xs-12"> 
												<img src="<?php if($value->pic!=''):echo $value->pic; else:echo"library/profile/fighters/default.jpg"; endif; ?>" alt="Image" height="135px" width="130px" class="img-responsive;" />
											</div>
											<div class="col-md-7 col-sm-7 col-xs-12 custom-font-style">
												<b>মুক্তিযোদ্ধার নাম :  <?php echo $value->bangla_name;?></b>
												<p><b>পিতা/স্বামীর নাম : </b><?php echo $value->father_name;?><br />
												<b>গ্রাম :  </b> <?php echo $value->gram;?> <br />
												<b>ওয়ার্ড নং : </b> <?php echo $value->word_no;?> <br />
												<?php if($value->mobile !=''):?>
												<b>মোবাইল নং : </b><?php echo $value->mobile;?> <br />
												<?php endif;?>
												<a href="" class="btn btn-default"  data-toggle="modal" data-target="#myModal" onclick="fighter_detalies(<?php echo $value->fid;?>);"  style="color:blue;">জীবনবৃত্তান্ত</a></p>
											</div>
										</div>
									</div>
								</div>
								<?php 
									endforeach;
								?>
							</div>
						</div>
					</div>
					
					<div class="container">
						<!-- Modal -->
						<div class="modal fade" id="myModal" role="dialog">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Member Details</h4>
									</div>
									<div class="modal-body modal-global-custom-style">
										<div class="row">
											<div class="col-sm-offset-2 col-sm-2">
												<b>ছবি : </b>
											</div>
											<div class="col-sm-4">
												<img id="mpic" src="" alt="" class="img-thumbnail img-responsive" style="width:180px;height:160px;" alt="" />
											</div>
											
										</div>
										<div class="row"  style="margin-top:10px;">
											<div class="col-sm-12">
												<p><b>জীবনবৃত্তান্ত : </b> <span id="m_life_histroy"></span></p>
											</div>
										</div>			
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					
					
					
				</div><!--- col-md-12 end------->
			</div><!-- row end--->
		</div><!-- left Content End-->
<style type="text/css"> 
	.modal-global-custom-style{
		color:#333333;
		overflow:scroll;
		min-height:300px;
	}
	.modal-global-custom-style p{
		border:1px solid #eee;
		padding:5px;
		margin-bottom:10px;
	}
	a.link-style{
		outline:0;
		text-decoration:none;
	}
	a.link-style:hover{
		text-decoration:underline;
	}

</style>