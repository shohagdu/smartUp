
<!---this is footer part start-->
	<style type="text/stylesheet">
		.thumbnail {margin-bottom:6px;}
		.carousel-control.left,.carousel-control.right{
			background-image:none;
		}
		#list-social{
				background:#fff;			
			}
		#list-social li{
			float:left;
			list-style:none;
			background:#fff;
		}
		#list-social li a{
			float:left;
			list-style:none;
			background:gray;
		}
		#list-social li a:hover{
			float:left;
			list-style:none;
			background:gray;
			opacity:0.5;
		}

		#quickNav li{
			list-style:none;
			padding-top:7px;
		}
		#list-social1 li a{
			float:left;
			list-style:none;
			color:black;
		}

	</style>
	<script type="text/javascript">
		/* copy loaded thumbnails into carousel */
		$('.row .thumbnail').on('load', function() {

		}).each(function(i) {
			if(this.complete) {
				var item = $('<div class="item"></div>');
				var itemDiv = $(this).parents('div');
				var title = $(this).parent('a').attr("title");

				item.attr("title",title);
				$(itemDiv.html()).appendTo(item);
				item.appendTo('.carousel-inner');
				if (i==0){ // set first item active
					item.addClass('active');
				}
			}
		});

		/* activate the carousel */
        // $(document).ready(function() {
		//     $('#modalCarousel').carousel({interval:false});
        // });

		/* change modal title when slide changes */
		$('#modalCarousel').on('slid.bs.carousel', function () {
			$('.modal-title').html($(this).find('.active').attr("title"));
		})

		/* when clicking a thumbnail */
		$('.row .thumbnail').click(function(){
			var idx = $(this).parents('div').index();
			var id = parseInt(idx);
			$('#myModal').modal('show'); // show the modal
			$('#modalCarousel').carousel(id); // slide carousel to selected

		});
	</script>

			<div class="photo_gallery">
				<div class="row">
					
					<div class="col-md-6">
						<div class="panel panel-success">
							<div class="panel-heading" style="background-color:#004884"><!---<i class="fa fa-map-marker"></i> -->&nbsp; Find Us With Google Map</div>
							<div class="panel-body" style="min-height:185px;">
								<div id="googleMap" class="col-lg-12">
									<?php 
										$map=$this->db->query("select map_link from up_map")->row()->map_link;
										$row=$this->db->affected_rows();
										if($row<1)
										{
											echo "<p style='color: red'>Sorry google map problem, please check your net connection!!!</p>";
										}
										else
										{
											echo $map;
											
										}	
										
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-success">
							<div class="panel-heading" style="background-color:#004884">
								<!---<i class="fa fa-map-marker"></i>--> &nbsp; Contact Us
							</div>
							<div class="panel-body" style="min-height:185px;">
								<div>
									<address style="text-align: center;padding-bottom:1px;">
										<h3></h3>
										<p></p>
										<p>
										<?php 
											$ch=$this->db->count_all('setup_tbl');
											if($ch!=0):
										?>
											Mobile :<?php echo $all_data->mobile;?><br/>
											<?php if($all_data->phone !=''){?>
											Phone : <?php echo $all_data->phone;?><br />
											<?php }?>
											E-mail :<?php echo $all_data->email;?><br/>
											Web site : <?php echo $all_data->web_link;?>
										<?php 
											endif;
										?>	
										</p>
									</address>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="footer" style="background-color:#004884;color: #fff;width:100%;margin:0px auto; "><!--Footer Start -->
					<div class="row content">
						<div class="col-md-8">
							<p>&copy; copyright 2020. <a href="#" style="color:#fff;"><?php echo $all_data->full_name_english?></a> </p>
						</div>
						<div class="col-md-4">
							<div>
								<p>
								Design & Developed by : 
								<a href="http://steptechbd.com/" target="_blank" style="color:#fff;">
									Step Technology
								</a>
								</p >
							</div>
						</div>
					</div>
				</div><!--Footer End -->
			</div>
		</div>
	</div><!-- Main Stop-->
</body>
</html>

