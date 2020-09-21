<div id="content" class="col-lg-10 col-sm-10">

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
		$('#example').DataTable();
	} );
</script>
	<!-- Content (Right Column)-->
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<!-- Form -->
			<h3 class="tit" style="margin-top:0px;margin-bottom: 30px;background:lightgray;padding:5px;text-align:center;"> ডাইনামিক স্লাইড</h3>
			<?php $status=array('1'=>'Enabel','0'=>'Disable'); ?>
			<div class="panel panel-primary">
				<div class="panel-heading">Slide Settings</div>
				<div class="panel-body" style="min-height:500px;">

				<div class="col-md-offset-1 col-md-10">
					<img src="" name="show" id="show" class="img-thumbnail" height="200" width="900" style="height:200px;width:900px;" >
					<h2 id="sizeTest">200 x 900</h2>
					<h1 id="titleShow">Title</h1>
					<h3 id="descripShow">Description</h3>
				</div>

				<div class="col-md-12" style="position:relative;top:150px;">
					<form action="Admin/slide_upload" class="form-inline" role="form" method="post" enctype="multipart/form-data">
						<table class="table">
							<thead style="background:#99A5A8;">
								<tr>
									<th>Chose Image</th>
									<th>Title</th>
									<th>Description</th>
									<th>Sequence</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="file" name="image" id="image" class="form-control" required onchange="LoadFile( event )" /></td>
									<td><input type="text" name="title" id="title" class="form-control" onkeyup="changeTitle(this.value)" /></td>
									<td>
										<textarea name="description" id="description" style="white-space: nowrap;" class="form-control" onkeyup="changeDescription(this.value)" ></textarea>
									</td>
									<td><input type="text" name="sequence" id="sequence" class="form-control" /></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td></td>
									<td colspan="3">
										<button type="submit" id="upload" name="upload" class="btn btn-primary" style="width:250px;position:relative;left:80px;top:10px;" >Upload</button>
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
	
	<table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

		<thead>
			<tr>
				<th>No</th>
				<th>Image</th>
				<th>Title</th>
				<th>Status</th>
				<th>Sort</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
		<?php 
			$i=1;
			foreach($all_slide as $value){	
		?>
			<tr>
				<td><?php echo $i++; ?></td>
				<td style="text-align:center;">
					<img class="img-thumbnail img-responsive" style="height:50px;width:280px;" src="all/slide/<?php echo $value->image_name; ?>"/>
				</td>
				<td><?php echo $value->title; ?></td>
				<td style="color:<?php if($value->status==0){ echo "red"; } else { echo "green"; } ?>"><?php echo $status[$value->status]; ?></td>
				<td><?php echo $value->sequence; ?></td>
				<td><form action="Admin/slideEdit" method="post"><button class="btn btn-info btn-sm" type="submit" name="submit" value="<?php echo $value->id; ?>">Edit</button></form></td>
			</tr>
		<?php 
			}
		?>	
		</tbody>
	</table>
</div>