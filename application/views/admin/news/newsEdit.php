	<script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
		<!--<script>tinymce.init({ selector:'textarea' });</script>--->
		<script>
		tinymce.init({ selector:'textarea',
		fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
		toolbar: "undo redo | sizeselect | bold italic | fontselect |  fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"});

		</script>
	<script type="text/javascript"> 
		$(document).ready(function() {
			$('#example').DataTable();
		});
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
			<button class="btn btn-custom-head btn-block btn-sm " style="font-size:16px;margin-bottom:20px;">নিউজ পাবলিশ
			</button>
		</div>
	</div>
	<?php $status=array('1'=>'Enabel','0'=>'Disable'); ?>
	<div class="row textarea_style" style="margin-bottom: 10px;"> 
		<div class="col-sm-offset-1 col-sm-10" style="padding-bottom:50px;min-height:200px;border: 1px solid lightgray;border-radius: 0px 0px 5px 5px;">
			<form action="Admin/khobor_setting_update" method="post" id="khobor_setup">
				<div class="col-sm-12" style="margin-top:30px;" >
					<div class="col-sm-3" style="text-align:center;padding-top:20px;"><b>নিউজ টাইটেল</b></div>
					<div class="col-sm-9">
						<input type="text" class="form-control" value="<?php echo $khobor->title; ?>" name="title" value="" id="title" required/>
					</div>
				</div>
				<div class="col-sm-12" style="margin-top:10px;">
					<div class="col-sm-3" style="text-align:center;padding-top:200px;"><b>নিউজ</b> </div>
					<div class="col-sm-9">
						<textarea name="msg" class="form-control" id="" required  rows="8" ><?php echo $khobor->descrip; ?></textarea>
						<input type="hidden" name="id" value="<?php echo $khobor->id; ?>"/>
					</div>
				</div>
				
				<div class="col-sm-12" style="margin-top:30px;" >
					<div class="col-sm-3" style="text-align:center;padding-top:20px;"><b>নিউজ স্ট্যটাস</b></div>
					<div class="col-sm-9">
						<select name="status" class="form-control"  required>
							<?php foreach($status as $key=>$value) {  ?>
							<option <?php if($key==$khobor->status) { echo "selected"; } ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<div class="col-sm-12" style="margin-top:10px;">
					<div class="col-sm-3" ></div>
					<div class="col-sm-9">
						<input type="submit" name="update" class="btn btn-info btn-sm" value="Update"/>&nbsp;
						<a href="index.php/Admin/newsManage"><input type="button" class="btn btn-success btn-sm" value="back"/></a>
					</div>
				</div>
			</form>	
			
		</div>
	</div>
</div><!--/#content.col-md-0-->