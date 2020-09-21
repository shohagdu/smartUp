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
		<script>
			$(document).ready(function(){
			$('#tradeLicense').submit(function(){ 
				$("#load").empty().append('<img src="library/img/ajaxloader.gif">');
				$.post(
					"Admin/peshaZibikorTaxCollection",
					$("#tradeLicense").serialize(),  
						function(data){ 
							if(data==1)
							{
								document.getElementById('save_tlicence').type='button';
								$("#globalmsg").show("normal").html('<p class="done">আপনার পেশাজীবি কর সঠিকভাবে আদায় হয়েছে,আপনি মানি রিসিট গ্রহণ করুন</p>');
								setTimeout(function() {
								window.location='Admin/taxCollection';	
								window.open('Money_receipt/peshaMoneyReceipt', '_blank');}, 2000)
							}
							
							
							//else{alert(data);}
						});
					return false;
				});
			});
				
		</script>
	
		<?php extract($this->session->all_userdata());?>
		<div class="row"> 
			<div class="col-lg-12 col-sm-12 col-xs-12"> 
				<button class="btn btn-custom-head btn-block btn-sm" style="font-size:16px;margin-bottom:30px;">Confirm ট্রেড লাইসেন্সধারির পেশাজীবি কর</button>
			</div>
		</div>
		<div class="col-lg-9 col-sm-9 col-lg-offset-3 col-sm-offset-3"> 
		
			<form action="Admin/peshaZibikorTaxCollection" method="post" id="tradeLicense">
				<div class="inline-form-group">
					<label class="control-label col-sm-3 col-xs-6 big-font">প্রতিষ্টানের  নাম :</label>
					<div class="col-sm-9 col-xs-6">
						<input type="hidden" name="tredeName" id="tredeName" value='<?php echo $tredeName?>'  readonly />
						<span style="font-size:20px;"><?php echo $tredeName ?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class="form-group"> 
					<label for="Gram" class="control-label col-sm-3 col-xs-6 big-font"> গ্রাম :</label>
					<div class="col-sm-9 col-xs-6"> 
						<input type="hidden" name="money" id="tredeVillage" value='<?php echo $tredeVillage?>'  readonly />
						<span style="font-size:20px;"><?php echo $tredeVillage ?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<div class="form-group"> 
					<label for="Mobile No" class="control-label col-sm-3 col-xs-6 big-font">মোবাইল নং :</label>
					<div class="col-sm-9 col-xs-6"> 
						<input type="hidden" name="tredeMobile" id="tredeMobile" value="<?php echo $tredeMobile?>" readonly />
						<span style="font-size:20px;"><?php echo $tredeMobile; ?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="form-group"> 
					<label for="Issu Date" class="control-label col-sm-3 col-xs-6 big-font">প্রদানের তারিখ :</label>
					<div class="col-sm-9 col-xs-6"> 
						<input type="hidden"  value="<?php echo $payment_date;?>" id="dofb" name="payment_date"/>
						<span class="highlight"><?php echo date("d M, Y",strtotime($payment_date));?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="form-group"> 
					<label for="Taka" class="control-label col-sm-3 col-xs-6 big-font">টাকার পরিমান :</label>
					<div class="col-sm-9 col-xs-6"> 
						<input type="hidden" name="tredemoney" id="tredemoney" value="<?php echo $tredemoney; ?>"/>
						<span class="most_highlight"><?php echo number_format($tredemoney);?></span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="form-group"> 
					<div class="col-sm-10 col-sm-offset-2"> 
						<input type="button" value="Back" onclick="goBack()" class="btn btn-primary btn-sm" />
						<input type="submit" style="margin-left:5px;" name="save_tlicence" value="Continue" class="btn btn-info btn-sm" id="save_tlicence"/><span id="load"></span>
						<input type="hidden" name="gentype" value="continue"/>
						<input type="hidden" name='id' value='<?php echo $id;?>'/>
						<input type="hidden" name='trackid' value='<?php echo $trackid;?>'/>
						
						<input type="hidden" name='tredeWord' value='<?php echo $tredeWord;?>'/>
						<input type="hidden" name='tredeOwner' value='<?php echo $tredeOwner;?>'/>
						<input type="hidden" name='tradLicenceId' value='<?php echo $tradLicenceId;?>'/>
					</div>
					<div class="clearfix"></div>
				</div>
			</form>
			<div id="globalmsg">Hello</div>
		</div> <!-- /content -->

		<script>
			function goBack() {
				window.history.back();
			}
		</script>
	</div><!--/#content.col-md-0-->