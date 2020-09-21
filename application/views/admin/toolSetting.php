<div id="content" class="col-lg-10 col-sm-10">
	<link href="<?php echo base_url();?>website_tools_controll/toogle_css.css" rel="stylesheet">
	<script src="<?php echo base_url();?>website_tools_controll/toogle_js.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.daily').submit(function() {
				//$("#load").empty().append('<img src="library/img/ajaxloader.gif">');
				$.post(
				"Admin/websiteTools_submit",
				$(".daily").serialize(),
				function(data){
					if(data==1)
					{
						alert('Save Successfully');
					}
				});
				return false;
			});
		});
	</script>
	<style type="text/css"> 
		.big-font{
			font-size: 20px;
			font-weight: bolder;
			color: #B45F04;
		}
	</style>
	<?php 
	
	//echo count($info);
	$name=array('1'=>' এস এম এস নিয়ন্ত্রণ ','2'=>'হেডার প্রিন্ট নিয়ন্ত্রণ','3'=>'লগো প্রিন্ট নিয়ন্ত্রণ','4'=>'সার্টিফিকেট মুরি প্রিন্ট নিয়ন্ত্রণ');
	$info=$this->db->query("select * from tbl_webtools")->result();
	?>
	<!-- Content (Right Column)-->
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<!-- Form -->
			<h3 class="tit" style="margin-top:0px;margin-bottom: 30px;background:lightgray;padding:5px;text-align:center;"> ওয়েব সাইট টুলস ম্যানেজ</h3>
			<form action="Admin/websiteTools_submit" method="post" id="validall" class="daily form-horizontal" style="border: 1px solid #ddd; padding: 10px;box-sizing: border-box;" role="form">
				<?php $array=array(); foreach($info as $value){?>
				<div class="form-group">
					<label class="control-label col-sm-3 col-sm-offset-3 big-font" for="<?php echo $name[$value->item_no]; ?>"><?php echo $name[$value->item_no]; ?></label>
					<div class="col-sm-6">
						<input id="toggle-<?php echo $value->id; ?>" name="input_checked[]" <?php if($value->status==1) {  ?> checked <?php } else {  ?> <?php } ?> type="checkbox" value="<?php echo $value->id; ?>">
					</div>
				</div>
				<?php array_push($array,$value->id); } ?>
				
				<div class="form-group" style="margin-top: 30px;"> 
					<div class="col-sm-offset-6 col-sm-6">
						<button type="submit" name="submit" class="btn btn-info btn-sm">Save</button>
						<input type="hidden" name="hid_text" value="<?php echo implode(",",$array); ?>"/>
					</div>
				</div>
				<script>
				  $(function() {
					<?php foreach($info as $value){ ?>  
					$('#toggle-<?php echo $value->id; ?>').bootstrapToggle();
					<?php } ?>
				  });
				</script>	
			</form>
		</div><!--- /col-lg-12 col-sm-12-------->	
	</div> <!-- /row -->
</div><!--/#content.col-md-0-->