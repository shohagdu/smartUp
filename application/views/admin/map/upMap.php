<script type="text/javascript"> 
	$(document).ready(function() {
		$("#map_form").submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);

			$.ajax({  
				 type: "POST",  
				 url: "Admin/up_map_submit",  
				 data: formData,
				 async: false,
				 cache: false,
				 contentType: false,
				 processData: false,
				 success: function(data) {
					if(data==1)
					 {
						 alert('Save Successfully');
						 location.reload();
					 } 
					 else 
					 {
						 alert('Save Fail');
					 }
				 }
			}); 
			return false;
		});
	} );
</script>
<div id="content" class="col-lg-10 col-sm-10">
	<style type="text/css"> 
		.textarea_style textarea{
			resize:none;
			font-size: 17px;
		}
	</style>
	<div class="row"> 
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<button class="btn btn-custom-head btn-block btn-sm " style="font-size:16px;margin-bottom:20px;">ইউনিয়ন পরিষদ ম্যাপ
			</button>
		</div>
	</div>
	<div class="row textarea_style" style="margin-bottom: 10px;"> 
		<div class="col-sm-offset-1 col-sm-10" style="padding-bottom:50px;min-height:200px;border: 1px solid lightgray;border-radius: 0px 0px 5px 5px;">
			<form action="Admin/up_map_submit" method="post" id="map_form">
				
				<div class="col-sm-12" style="margin-top:10px;">
					<div class="col-sm-3" style="text-align:center;padding-top:50px;"><b>ম্যাপ লিংক</b> </div>
					<div class="col-sm-9">
						<textarea name="link" class="form-control" id=""  rows="10" required><?php echo $map->map_link; ?></textarea>
					</div>
				</div>
				<?php if($row==1) { ?>
				<div class="col-sm-12" style="margin-top:10px;">
					<div class="col-sm-3" style="text-align:center;padding-top:50px;"><b>ম্যাপ</b> </div>
					<div class="col-sm-9">
					  <?php echo $map->map_link; ?>
					</div>
				</div>
				<?php } ?>
				<div class="col-sm-12" style="margin-top:10px;">
					<div class="col-sm-3" ></div>
					<div class="col-sm-9">
						<?php if($row==1) { $value="Update"; } else {  $value="Save"; } ?>
						<input type="submit" name="submit" class="btn btn-info btn-sm" value="<?php echo $value; ?>"/>
					</div>
				</div>
			</form>	
			
		</div>
	</div>
</div><!--/#content.col-md-0-->