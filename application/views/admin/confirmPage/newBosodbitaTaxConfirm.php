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
		<script type="text/javascript">
			$(document).ready(function(){
				$('#confirmClientData').submit(function() {
					$("#load").empty().append('<img src="library/img/ajaxloader.gif">');
					$.post(
						   "Admin/newBosotbitaTaxCollection",
							$("#confirmClientData").serialize(),
							function(data){
								if(data==1)
								{
									//$('#save_tlicence').attr('disabled', 'disabled');
									document.getElementById('save_tlicence').type='button';
									$("#globalmsg").show("normal").html('<p class="done">আপনার বসতভিটা কর সঠিকভাবে আদায় হয়েছে,আপনি মানি রিসিট গ্রহণ করুন</p>');
									setTimeout(function() {
									window.location='Admin/taxCollection';	
									window.open('Money_receipt/bosodbitakorMoneyReceipt', '_blank');}, 2000)
									/* old processing............
									alert('আপনার বসত ভিটার কর সঠিকভাবে গৃহীত হয়েছে');
									window.location='Admin/taxCollection';
									window.open('Money_receipt/bosodbitakorMoneyReceipt', '_blank')
									*/
								}
								else{alert(data);}
							});

					return false;
				});
			});
		</script>
		<?php extract($this->session->all_userdata());
			//$sdata=$this->session->all_userdata();
			//print_r($sdata);
		?>
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12"> 
				<button class="btn btn-custom-head btn-block btn-sm" style="font-size:16px;margin-bottom:30px;">Confirm বসতভিটা কর আদায়</button>
			</div>
				<!-- Form -->
			<div class="col-lg-9 col-sm-9 col-lg-offset-3 col-sm-offset-3"> 
				<form action="Admin/newBosotbitaTaxCollection" method="post" id="confirmClientData">
					<div class="inline-form-group">
						<label class="control-label col-sm-3 col-xs-6 big-font">নাম :</label>
						<div class="col-sm-9 col-xs-6">
							<input type="hidden" name="name" id="name" value='<?php echo $name ?>'  readonly />
							<span style="font-size:20px;"><?php echo $name ?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group"> 
						<label for="Dagh No" class="control-label col-sm-3 col-xs-6 big-font"> দাগ নং :</label>
						<div class="col-sm-9 col-xs-6"> 
							<input type="hidden" name="dagNo" id="dagNo" value='<?php echo $dagNo?>'  readonly /> 
							<span class="highlight"><?php echo $dagNo ?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group"> 
						<label for="Mobile No" class="control-label col-sm-3 col-xs-6 big-font">মোবাইল নং :</label>
						<div class="col-sm-9 col-xs-6"> 
							<input type="hidden" name="mobileNo" id="mobileNo" value="<?php echo $mobileNo ?>" readonly />
							<span style="font-size:20px;"><?php echo $mobileNo; ?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group"> 
						<label for="Issu Date" class="control-label col-sm-3 col-xs-6 big-font">ইস্যুকৃত তারিখ :</label>
						<div class="col-sm-9 col-xs-6"> 
							<input type="hidden" value="<?php echo $payment_date;?>" id="dofb" name="payment_date"/> 
							<span class="highlight"><?php echo date("d M, Y",strtotime($payment_date));?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group"> 
						<label for="Taka" class="control-label col-sm-3 col-xs-6 big-font">টাকার পরিমান :</label>
						<div class="col-sm-9 col-xs-6"> 
							<input type="hidden" name="money" id="money" value="<?php echo $money; ?>"/>
							<span class="most_highlight"><?php echo number_format($money);?></span>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group"> 
						<div class="col-sm-10 col-sm-offset-2"> 
							<input type="button" style=""  value="Back" onclick="goBack()" class="btn btn-primary btn-sm" />
							<input type="submit" style="margin-left:5px;" name="save_tlicence" value="Continue" class="btn btn-info btn-sm" id="save_tlicence"/><span id="load"> </span>
							<input type="hidden" name="gentype" value="continue"/>
							<input type="hidden" name='id' value='<?php echo $id;?>'/>
							<input type="hidden" name='fatherName' value='<?php echo $fatherName;?>'/>
							<input type="hidden" name='nid' value='<?php echo $nid;?>'/>
							<input type="hidden" name='bid' value='<?php echo $bid;?>'/>
							<input type="hidden" name='village' value='<?php echo $village;?>'/>
							<input type="hidden" name='payDate' value='<?php echo $payment_date;?>'/>
							<input type="hidden" name='wordNo' value='<?php echo $wordNo;?>'/>
							<input type="hidden" name='holdingNumber' value='<?php echo $holdingNumber;?>'/>
							<input type="hidden" name='holdingType' value='<?php echo $holdingType;?>'/>
							<input type="hidden" name='tax' value='<?php echo $tax;?>'/>
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

