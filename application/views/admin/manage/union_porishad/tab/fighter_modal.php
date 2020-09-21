		<script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
		<!--<script>tinymce.init({ selector:'textarea' });</script>--->
		<script>
		tinymce.init({ selector:'textarea',
		fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
		toolbar: "undo redo | sizeselect | bold italic | fontselect |  fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"});

		</script>
		<div class="col-sm-12" style="margin-top:40px;">
			<div class="col-sm-12">
				 <button type="button" class="btn btn-default btn-block" style="background:#eee;">মুক্তিযোদ্ধার তথ্য আপডেট করুন । </button>
			</div>
			<!--<div class="col-sm-1">
				 <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>-->
		</div>
		<!--<div class="col-md-12" style="margin-top:10px;">
				<div class="col-md-12" style="min-height:20px;display:none;" id="hidemessage">
					<div class="alert alert-success alert-sm" >
						<strong>Successfully! Send your SMS</strong>
					</div>
				</div>
			</div>
		--->
		
		<form action="index.php/Manage/updateFighter_action" enctype='multipart/form-data' method="post" id="formid">
			
			<div class="col-sm-12" style="margin-top:5px;margin-bottom:5px;">
				<div class="col-sm-4" style="text-align:right;padding-top:5px;"><b>ন্যাশনাল আইডি </b> </div>
				<div class="col-sm-8">
					<input type="text" name="national_id" id="modal_nid" class="form-control input-text-sm" value="<?php echo $q->national_id;?>" readonly />
				</div>
			</div>
			
			<div class="col-sm-12" style="margin-top:5px;margin-bottom:5px;">
				<div class="col-sm-4" style="text-align:right;padding-top:5px;"><b>নাম </b> </div>
				<div class="col-sm-8">
					<input type="text" name="bangla_name" id=""  class="form-control input-text-sm" value="<?php echo $q->bangla_name;?>" readonly />
				</div>
			</div>
			<div class="col-sm-12" style="margin-top:5px;margin-bottom:5px;">
				<div class="col-sm-4" style="text-align:right;padding-top:5px;"><b>সেক্টর নং </b> </div>
				<div class="col-sm-8">
					<input type="text" name="sector_no" id="modal_sector_no" required class="form-control input-text-sm" placeholder="" value="<?php echo $q->sector_no;?>" />
				</div>
			</div>
			
			<div class="col-sm-12" style="margin-top:5px;margin-bottom:5px;">
				<div class="col-sm-4" style="text-align:right;padding-top:5px;"><b>জীবনবৃত্তান্ত</b> </div>
				<div class="col-sm-8">
					<textarea name="life_history" class="form-control" id=""  rows="" ><?php echo $q->life_history;?></textarea>
				</div>
			</div>
			
			<div class="col-sm-12" style="margin-top:5px;">
				<label class="col-sm-4"></label>
				<div class="col-sm-8">
					<input type="submit" name="fighter_update" value="আপডেট করুন" class="btn btn-success btn-sm">
					 <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>	
		</form>
		<div class="modal-footer">
		</div>