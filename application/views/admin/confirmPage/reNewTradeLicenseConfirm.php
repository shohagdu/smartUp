	<div id="content" class="col-lg-10 col-sm-10">
		<style type="text/css"> 
			label.big-font{
				text-align: right;
				color: #333;
				font-size: 20px;
			}
			span.highlight{
				font-size: 25px;
				color: blue;
				font-weight: bolder;
			}
			span.mark_highlight{
				font-size: 26px;
				color: #e74c3c;
				font-weight: bolder;
			}
			span.sub_mark_highlight{
				font-size: 25px;
				color: #00008B;
				font-weight: bolder;
			}
			span.most_highlight{
				font-size: 30px;
				line-height: 27px;
				color: red;
				font-weight: bolder;
			}
		</style>
		<style>

			#globalmsg{
				width:400px;
				position: absolute;
				background:#000 url(cross.png) no-repeat right top;
				padding:3px 0px;
				left: 10%;
				display:none;
				margin-left: -50px;
				margin-top:-300px;
				border:1px solid #333;
				cursor:pointer;
				z-index:999;
			}

			#globalmsg p{
				padding:5px;
				margin:0px;
				color:#fff;
			}
			#globalmsg p.done, p.done{
				background: url(done.png) no-repeat left center;
				padding-left:30px;
				margin-left:10px;
				line-height:24px;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#confirmTradelicenseGenarate').submit(function() {
					$("#load").empty().append('<img src="library/img/ajaxloader.gif">');
					$.post(
					"RenewTradeLicense/ReNewTradelicenseGenarate_action",
					$("#confirmTradelicenseGenarate").serialize(),
					function(data){
						if(data==1)
						{
							document.getElementById('save_tlicence').type='button';
							$("#globalmsg").show("normal").html('<p class="done">আপনার ট্রেড লাইসেন্সটি নবায়ন হয়েছে মানি রিসিট গ্রহণ করুন</p>');
							setTimeout(function() {
							window.location='Applicant/tradelicenseapplicant?napply=5';}, 2000)	
						}

						else{alert(data);}
					});
					return false;
				});
			});
		</script>
		
		<?php extract($this->session->all_userdata());?>
		
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12"> 
				<button class="btn btn-custom-head btn-block btn-sm" style="font-size:16px;margin-bottom:30px;">Confirm ট্রেড লাইসেন্স নবায়ন আবেদন </button>
			</div>
				<!-- Form -->
			<div class="col-lg-9 col-sm-9 col-lg-offset-3 col-sm-offset-3"> 
				<form name="tradeform" action="RenewTradeLicense/ReNewTradelicenseGenarate_action" method="post" id="confirmTradelicenseGenarate">
					<div class="inline-form-group">
						<label class="control-label col-sm-4 col-xs-6 big-font">প্রতিষ্ঠানের নাম : </label>
						<div class="col-sm-8 col-xs-6">
							<input type="hidden" name="company" id="company" value='<?php echo $company?>'  readonly /> 
							<span class="highlight"><?php echo $company?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group"> 
						<label for="Issu Date" class="control-label col-sm-4 col-xs-6 big-font">প্রদানের তারিখ : </label>
						<div class="col-sm-8 col-xs-6"> 
							<input type="hidden" value="<?php echo date('Y-m-d',strtotime($payment_date));?>" id="payment_date" name="payment_date"/>
							<span class="most_highlight"><?php echo $date=date("d M, Y",strtotime($payment_date));?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group"> 
						<label for="Taka" class="control-label col-sm-4 col-xs-6 big-font">ট্রেড লাইসেন্স ফি : </label>
						<div class="col-sm-8 col-xs-6"> 
							<input type='hidden' value='<?php echo $fee?>' name='fee' id='tradliciensefee'/>
							<span class="mark_highlight"><?php echo $fee?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<?php if($due!=''){?>
					<div class="form-group"> 
						<label for="due Taka" class="control-label col-sm-4 col-xs-6 big-font">বকেয়া টাকার পরিমান : </label>
						<div class="col-sm-8 col-xs-6"> 
							<input type='hidden' value='<?php echo $due?>' name='due' id='duetaka' />
							<span class="sub_mark_highlight"><?php echo $due?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php } ?>
					
					<?php if($discount!=''){?>
					<div class="form-group"> 
						<label for="due Taka" class="control-label col-sm-4 col-xs-6 big-font">সুপারিশ সাপেক্ষে (ছাড়)  : </label>
						<div class="col-sm-8 col-xs-6"> 
							<input type='hidden' name='discount' value="<?php echo $discount; ?>" id='discount' />
							<span class="highlight"><?php echo $discount; ?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php } ?>
					
					<div class="form-group"> 
						<label for="due Taka" class="control-label col-sm-4 col-xs-6 big-font">ভ্যাট(১৫%) : </label>
						<div class="col-sm-8 col-xs-6"> 
							<input type='hidden' name='vat' value="<?php echo $vat?>" id='vat' />
							<span class="mark_highlight" ><?php echo $vat ?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<?php if($sb_fee==1){?>
					<div class="form-group"> 
						<label for="due Taka" class="control-label col-sm-4 col-xs-6 big-font">সাইনবোর্ড কর(বার্ষিক) : </label>
						<div class="col-sm-8 col-xs-6">
							<input type="hidden" name="sb_fee" value="<?php echo $sb_fee;?>" /><!-- checkbox input value--->
							<input type='hidden' name='sbfee' value='<?php echo $sbfee?>' id='sbfee' /><!-- input box value-->
							<span class="highlight"><?php echo $sbfee?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php } ?>
					
					<?php if($scharge>1){ ?>
					<div class="form-group"> 
						<label for="due Taka" class="control-label col-sm-4 col-xs-6 big-font">সাব চার্জ  : </label>
						<div class="col-sm-8 col-xs-6"> 
							<input type='hidden' name='scharge' id='scharge' value="<?php echo $scharge; ?>" />
							<span class="sub_mark_highlight"><?php echo $scharge ?></span>
						</div>
					</div>
					<?php } else{ ?>
						<input type='hidden' name='scharge' id='scharge' value="<?php echo 0; ?>">
					<?php } ?>
					
					<div class="clearfix"></div>
					<div class="form-group"> 
						<label for="due Taka" class="control-label col-sm-4 col-xs-6 big-font">মোট টাকার পরিমান : </label>
						<div class="col-sm-8 col-xs-6"> 
							<input type="hidden" value='<?php echo $total?>' name="total"/>
							<span class="most_highlight" style="font-size: 35px;"><?php echo $total?> </span>
						</div>
						<div class="clearfix"></div>
					</div>
				
					<div class="form-group"> 
						<div class="col-sm-9 col-sm-offset-3">
							<!--<input type="button" value="Back" onclick="goBack()" class="btn btn-primary btn-sm" />-->
							<a href="index.php/RenewTradeLicense/RenewTradeLicenGenerate?id=<?php echo sha1($trackid);?>" class="btn btn-primary btn-sm">
								Back
							</a>
							<input type="submit" style="margin-left:5px;"  name="save_tlicence" value="Continue" class="btn btn-info btn-sm" id="save_tlicence"/><span id="load"></span>
							<input type="hidden" name="gentype" value="continue"/>
							<input type="hidden" name='id' value='<?php echo $id;?>'/>
							<input type="hidden" name='trackid' value='<?php echo $trackid;?>'/>
							<input type="hidden" name="bno" value="<?php echo $bno ?>"/>
							<input type="hidden" name="bype" value="<?php echo $bype ?>"/>
							<input type="hidden" name="acno" value="<?php echo $acno ?>"/>
							<input type="hidden" name="issue_date" value="<?php echo $issue_date ?>"/>
							<input type="hidden" name="expire_date" value="<?php echo $expire_date ?>"/>
							<input type="hidden" name="sonod" value="<?php echo $sno ?>"/>
							<input type="hidden" name="mobile" value="<?php echo $mobile ?>"/>
						</div>
						<div class="clearfix"></div>
					</div>
				</form>
				<div id="globalmsg">Hello</div>
			</div>
		</div> <!-- /row box -->
		<script>
			function goBack() {
				window.history.back();
			}
		</script>
	</div><!--/#content.col-md-0-->