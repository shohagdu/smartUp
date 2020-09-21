<div id="content" class="col-lg-10 col-sm-10">
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url();?>library/mystyle.css" />
	<script type="text/javascript" src="<?php echo base_url();?>library/custom.js"></script>
	
	
	<style type="text/css">
		#sizeTest{
			text-align: center;
			position: relative;
			color: #d0d0d0;
			top:80px;
			margin-top: 0px !important;
		}

		#titleShow{
			margin-top: 0px !important;
			position: relative;
			top: -20px;
			text-align: center;
			color:lightgray;
		}
		#descripShow{
			margin-top: 0px !important;
			position: relative;
			text-align: center;
			top: 50px;
			color:lightgray;
			
		}

		#show{
			position: absolute;
		}


	</style>

<script type="text/javascript">
	// change imge
	var LoadFile = function( event ){
		var output = document.getElementById("show");
		output.src = URL.createObjectURL(event.target.files[0]);
	}

// descriptio
	function changeDescription( desc ){
		document.getElementById("descripShow").innerHTML = '';
		document.getElementById("descripShow").innerHTML = desc;
	}

// title
function changeTitle( title ){
	document.getElementById("titleShow").innerHTML = '';
	document.getElementById("titleShow").innerHTML = title;
}

</script>
<script type="text/javascript"> 
	$(document).ready(function() {
		$("#update_edit").submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);

			$.ajax({  
				 type: "POST",  
				 url: "Admin/slide_edit_submit",  
				 data: formData,
				 async: false,
				 cache: false,
				 contentType: false,
				 processData: false,
				 success: function(data) {
					if(data==1)
					{
						alert('Update Successfully');
						window.location="index.php/Admin/dynamicSlide";
					} 
					else 
					{
						alert('Update Fail');
					} 
				}
			}); 
			return false;
		});
	} );
</script>
	<!-- Content (Right Column)-->
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<!-- Form -->
			<h3 class="tit" style="margin-top:0px;margin-bottom: 30px;background:lightgray;padding:5px;text-align:center;"> ডাইনামিক স্লাইড আপডেট</h3>
			<?php $status=array('1'=>'Enabel','0'=>'Disable'); ?>
			<div class="panel panel-primary">
				<div class="panel-heading">Slide Settings</div>
				<div class="panel-body" style="min-height:500px;">

				<div class="col-md-offset-1 col-md-10" style="margin-bottom: 20px;">
					<img src="all/slide/<?php echo $slide_info->image_name; ?>" name="show" id="show" class="img-thumbnail" height="200" width="900" style="height:200px;width:900px;" >
					<h2 id="sizeTest">200 x 900</h2>
					<h1 id="titleShow"><?php echo $slide_info->title; ?></h1>
					<h3 id="descripShow"><?php echo $slide_info->description; ?></h3>
				</div>

				<div class="col-md-12" style="position:relative;top:150px;">
					<form action="Admin/slide_edit_submit" class="form-inline" role="form" method="post" enctype="multipart/form-data" id="update_edit">
						<table class="table">
							<thead style="background:#99A5A8;">
								<tr>
									<th>Chose Image</th>
									<th>Title</th>
									<th>Description</th>
									<th>Sequence</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="file" name="image" id="image" class="form-control" onchange="LoadFile( event )" /></td>
									<td><input type="text" name="title" id="title" class="form-control" onkeyup="changeTitle(this.value)" value="<?php echo $slide_info->title; ?>" /></td>
									<td>
										<textarea name="description" id="description" style="white-space: nowrap;" class="form-control" onkeyup="changeDescription(this.value)" ><?php echo $slide_info->description; ?></textarea>
									</td>
									<td><input type="text" name="sequence" value="<?php echo $slide_info->sequence; ?>" id="sequence" class="form-control" /></td>
									<td>
										<select class="form-control" name="status">
											<?php foreach($status as $key=>$value) {
											?>
											<option <?php if($key==$slide_info->status) { echo "selected"; } ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
											<?php } ?>
										</select>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td></td>
									<td colspan="4">
										<input type="hidden" name="uid" value="<?php echo $slide_info->id; ?>"/>
										<input type="hidden" name="hid_img" value="<?php echo $slide_info->image_name; ?>"/>
										<button type="submit" id="upload" name="upload_edit" class="btn btn-primary" style="width:250px;position:relative;left:80px;top:10px;" >Upload</button>
									</td>
								</tr>
							</tfoot>
						</table>
					</form>	
				</div>
				</div>
			</div>			
		</div>
	</div>
</div>

