<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="refresh" content="300">
		<title>2-step verification</title>
		<base href="<?php echo base_url();?>" />
		
		<link type="text/css" rel="stylesheet" href="all/assets/css/leapis_font.css">
		<link href="all/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="all/assets/css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="all/assets/css/font-awesome.min.css">
		
		<!-- all script file -->
		<script src="all/assets/js/bootstrap.js"></script>
		<script src="all/assets/js/jquery-1.10.2.js"></script>
		<script src="all/assets/js/bootstrap-hover-dropdown.js"></script>
		<script src="all/assets/js/bootstrap.min.js"></script>
		<script src="all/assets/js/jquery.min.js"></script>
		
		<!--- for ditepicker ----------->
		<link rel="stylesheet" media="screen,projection" type="text/css" href="datepicker/jquery-ui.css" />
		<!--<script src="datepicker/jquery-1.9.1.js"></script>--> 
		<script src="datepicker/jquery-ui.js"></script>
		
		<script type="text/javascript">
			function disableSelection(e){if(typeof e.onselectstart!="undefined")e.onselectstart=function(){return false};else if(typeof e.style.MozUserSelect!="undefined")e.style.MozUserSelect="none";else e.onmousedown=function(){return false};e.style.cursor="default"}window.onload=function(){disableSelection(document.body)}
		</script>

		<script type="text/javascript">
			document.oncontextmenu=function(e){var t=e||window.event;var n=t.target||t.srcElement;if(n.nodeName!="A")return false};
			document.ondragstart=function(){return false};
		</script>

		<script type="text/javascript">
			window.addEventListener("keydown",function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==70||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){e.preventDefault()}});document.keypress=function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==70||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){}return false}
		</script>

		<script type="text/javascript">
			document.onkeydown=function(e){e=e||window.event;if(e.keyCode==123||e.keyCode==18){return false}}
		</script>
		<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
<script>
	$(document).ready(function(){
		$("img").click(function(){
			
			$('.img1').removeClass("main");
			$(this).toggleClass("main");
			$("#imgid").val(this.id);
		});
		// post method
		$("#checkVerification").submit(function() {
			var test=checkselect();
			if(test==false){ return false; }
			$.post(
			"index.php/Security/checkAccount",
			$("#checkVerification").serialize(),
			function(data) {
				if(data==1){
					alert('আপনার প্রশ্নের উত্তরটি সঠিক নয়.....');
					location.reload();
				}
				else if(data==2){
					alert("দুঃখিত আপনার ছবিটি সঠিক নয়");
					location.reload();
				}
				else if(data==10){
					window.location='Admin';
				}
				//alert(data);
			}); 
			return false;
		});
	});
	function checkselect()
	{
		var textans = document.getElementById("textans").value.trim();
		var img_id = document.getElementById("imgid").value;
		
		if(textans==''){
			alert("Please write your ans....");
			return false;
		}
		else if(img_id==''){
			alert("Please select your Image");
			return false;
		}
	}
</script>
<style>
.main {
	border:2px solid #f00 ;/**/
	box-shadow: none !important;
	cursor:pointer;
}
</style>

	<section class="content">
		<div class="col-sm-offset-1 col-sm-10">
			<div class="row">
				<div class="panel panel-primary" style="min-height:700px;">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;text-align:center;color:white;"> 2 Step Verificaiton </div>
					<div class="panel-body">
						<form action="index.php/Security/checkAccount" method="post" id="checkVerification" >
							<div class="col-sm-offset-1 col-sm-10" style="margin-top:20px;"> 
								<div class="row">
									<div class="col-sm-12">
										<?php
											shuffle($rowpic);
										?>
										<h2><?php echo $row->title?></h2>
									</div>
									<div class="col-sm-10">
										<input type='text' class="form-control" name='ans' id="textans" placeholder="Please Enter Your Ans" required/>
										<input type="hidden" name="hidden_que_id" id="hidden_title_id" value="<?php echo $row->question_id;?>" />
										<input type="hidden" name="hidden_img" id="imgid" value="<?php ?>" />
										<input type="hidden" name="user_id" id="" value="<?php echo $row->user_id;?>" />
										
									</div>
									<div class="col-sm-12">
										<h2>Identify Your Picture</h2>
									</div>
									<div class="col-sm-12">
										<?php foreach($rowpic as $value):
										$ex=explode("/",$value);
										
										?>
										<img src="img/<?php echo $ex[0];?>" alt="" style="height: 200px;width: 200px;" class="img1 img-thumbnail" id="<?php echo $ex[1];?>" />
										<?php endforeach;?>
									</div>
								</div>
								<div class="col-sm-12" style="text-align:justify;line-height:35px;">
									<input type="submit" class="btn btn-primary" name="confirm" value="Confirm" />
								</div>
							</div>
						</form>		
					</div><!--- / panel primary----->
				</div>
			</div>
		</div>
	</section>
</body>
</html>



