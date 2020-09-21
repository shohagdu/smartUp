	<div class="slid_show"><!-- Slide Show Start-->
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<?php
				$image=$this->db->select("*")->from("slide_setting")->where("status","1")->order_by("sequence","asc")->limit("5")->get()->result();
				$row=$this->db->affected_rows();
				
			?>
			<div class="carousel-inner" role="listbox">
				<?php if($row==0){ ?>
				<div class="item active">
					<img src="all/slide/m_mosqe.jpg"  style="width:100%;" class="img-responsive" />
						<div class="carousel-caption"></div>
				</div>
				<div class="item">
					<img src="all/slide/m_shool.jpg" alt="Union Parishad" style="width:100%;" class="img-responsive">
					<div class="carousel-caption"></div>
				</div>
				<?php }
				else {
				?>
				
				<?php 
				$sec=1;	
				foreach($image as $value) {
					if($sec == 1):$cl = "active";else:$cl = "";endif;
				?>
					<div class="item <?php echo $cl; ?>">
						<img src="all/slide/<?php echo $value->image_name; ?>" alt="Malibagh high school" style="width:100%;height:250px;" class="img-responsive">
						<div class="carousel-caption"></div>
					</div>
				<?php $sec++; } } ?>
				
			</div>
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			<div class="main-div hidden-xs hidden-sm visible-md visible-lg">
				<div class="main-div-inner"> 
					<div class="logo">
						<a href=" "><img src="all/logo/logo.png" alt="logo" height="68px" width="70px" /></a>
					</div>
					<div class="site-name-wrapper">
						<span id="sitename"> 
							<a href=""><?php echo $all_data->full_name;?></a>
						</span>
					</div>
				</div>
			</div>	
		</div>
	</div><!-- Slide Show End-->
<style>
	.main-div{
		background-color: rgba(0, 0, 0, 0.5);
		margin-bottom: 0;
		padding: 10px 20px 10px 15px;
		position: absolute;
		left: 20px;
		top: 15px;
		z-index: 100;
	}
	.main-div-inner{
		margin:0px;
		position:relative;
		box-sizing: border-box;
	}
	.main-div-inner a{
		color: #fff;
		text-decoration:none;
	}
	.logo{
		float:left;
		margin-right:10px;
		padding:0px;
	}
	.site-name-wrapper{
		float:left;
		padding-top: 5px;
	}
	#sitename a{
		color: #fff;
		font-size:120%;
		font-weight:400;
	}
	
</style>