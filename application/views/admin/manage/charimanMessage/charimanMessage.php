<div id="content" class="col-lg-10 col-sm-10">
	<style type="text/css"> 
		.textarea_style textarea{
			resize:none;
			font-size: 17px;
		}
	</style>
	<div class="row"> 
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<button class="btn btn-custom-head btn-block btn-sm " style="font-size:16px;margin-bottom:20px;">ইউনিয়ন চেয়ারম্যান ম্যাসেজ  আপডেট </button>
		</div>
	</div>
	<div class="row textarea_style" style="margin-bottom: 10px;"> 
		<div class="col-sm-offset-1 col-sm-10" style="padding-bottom:50px;min-height:200px;border: 1px solid lightgray;border-radius: 0px 0px 5px 5px;">
			<form action="Manage/chairmanMessageUpdate" method="post">
				<div class="col-sm-12" style="margin-top:30px;" >
					<div class="col-sm-3" style="text-align:center;padding-top:20px;"><b>Message Title</b></div>
					<div class="col-sm-9">
						<textarea name="title" class="form-control"><?php echo $row->title; ?></textarea>
					</div>
				</div>
				<div class="col-sm-12" style="margin-top:10px;">
					<div class="col-sm-3" style="text-align:center;padding-top:200px;"><b>Message</b> </div>
					<div class="col-sm-9">
						<textarea name="msg" class="form-control" rows='25'><?php echo $row->message; ?></textarea>
					</div>
				</div>
				<div class="col-sm-12" style="margin-top:10px;">
					<div class="col-sm-3" ></div>
					<div class="col-sm-9">
						<input type="submit" name="submitBtn" class="btn btn-info btn-sm" value="আপডেট করুন">
					</div>
				</div>
			</form>
		</div>
	</div>
</div><!--/#content.col-md-0-->