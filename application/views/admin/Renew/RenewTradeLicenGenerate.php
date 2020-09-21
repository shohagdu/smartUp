	<div id="content" class="col-lg-10 col-sm-10">
		<script type="text/javascript">
			$(document).ready(function(){
				$('#tradelicenseGenarate').submit(function() {
					$.post(
					"RenewTradeLicense/ReNewTradelicenseGenarate_action",
					$("#tradelicenseGenarate").serialize(),
					function(data){
						if(data==1)
						{
							alert('Confirm page problem!!!!!!!!!!!!!!!!!!!');
						}
						if(data==3)
						{
							window.location='Confirm/reNewTradeLicenseConfirm';
						}
						else{alert(data);}
					});

					return false;
				});
				
				// for chackbox empty............
				
				$('#recom').click(function()
				{
					//If checkbox is checked then disable or enable input
					if ($(this).is(':checked'))
					{
						$("#sbfee").removeAttr("disabled"); 
						$("#sbfee").val('');
					}
					//If checkbox is unchecked then disable or enable input
					else
					{
						$("#sbfee").attr("disabled","disabled");
						$("#sbfee").val('0.00');
						$("#scharge").val('');
					}
				});
				// end chackbox empty function ............
				
				
				$('#suparish_chard').click(function()
				{
					//If checkbox is checked then disable or enable input
					if ($(this).is(':checked'))
					{
						$("#discount").removeAttr("disabled"); 
						$("#discount").val('');
					}
					//If checkbox is unchecked then disable or enable input
					else
					{
						var fee = $("#fee").val();
						var due = $("#due").val();
						
						if(fee==''){
							fee=0;
						}
						if(due==''){
							due=0;
						}
						var discount = $("#discount").val();
						
						$("#discount").attr("disabled","disabled");
						
						var sub_total = (parseInt(fee)+parseInt(due))
						var cal_dis = ((sub_total*15)/100);
						$("#vat").val(cal_dis);
						
						$("#discount").val('');
						$("#scharge").val('');
					}
				});
			});
		</script>
		<script>
			$(function() {
				$( "#issue_date" ).datepicker({ 
					changeMonth: true,
					changeYear: true,
					autoSize: true,
					dateFormat: 'dd-mm-yy' 
				});

				$( "#expire_date" ).datepicker({ 
					changeMonth: true,
					changeYear: true,
					autoSize: true,
					dateFormat: 'dd-mm-yy' 
				});

				$( "#payment_date" ).datepicker({ 
					changeMonth: true,
					changeYear: true,
					autoSize: true,
					dateFormat: 'dd-mm-yy' 
				});
			});

			$(function() {
				$( "#dofb" ).datepicker({
					changeMonth: true,
					changeYear: true,
					autoSize: true,
					dateFormat: 'dd-mm-yy'
				});
			});

		</script>
		<script type="text/javascript">
			// for sub_charge input box empty......
			function chack(){
				document.getElementById('scharge').value='';
			}	
		</script>
		<style type="text/css"> 
			.highlisht_font{
				font-size: 16px;
				font-style: normal;
			}
		</style>
		<!-- Content (Right Column)-->
		<?php 
			// some execution here..............
			//print_r($row);
			$dQy=$this->db->select('due')->from('getlicense')->where('trackid',$row->trackid)->order_by('id','DESC')->limit(1)->get();
			$drow=$dQy->row();if(!strlen($drow->due)){$due='0.00';};
			
			// for due taka.......
			// TODO: note: check due_amount_cal_documentation.txt 
			$cYear=date('Y');
			$cMonth = (string)date('m');
			$expire_year=date('Y',strtotime($row->expire_date));
			$issue_year = date('Y', strtotime($row->issue_date));
			
			
			if(($cYear==$expire_year) && ($cMonth>"06")){
				$cal_date=0;
			}
			else if(($expire_year == $issue_year) && $cMonth < "06"){
				$difference_date = $cYear-$expire_year-1;
				$cal_date = $difference_date;
			}
			else if($cMonth <= "06"){
				$difference_date = $cYear-$expire_year-1;
				$cal_date = $difference_date;
			}
			else{
				$difference_date = $cYear-$expire_year;
				$cal_date = $difference_date;
			}
			
		?>
		<div class="row">
			<div class="col-lg-12 col-sm-12">
				<h3 class="tit" style="margin-top:0px;margin-bottom: 20px;background:lightgray;padding:5px;text-align:center;">ট্রেড লাইসেন্স সনদ নবায়ন ফি ফরম </h3>
				<form name="tradeform" action="RenewTradeLicense/ReNewTradelicenseGenarate_action" method="post" id="tradelicenseGenarate" class="form-horizontal" role="form">
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="serial no">ক্রমিক নং :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" name="bno" id="bno" readonly />
						</div>
						<div class="clearfix visible-xs"></div>
						<label class="control-label col-sm-2 highlisht_font" for="traking no">ট্র্যাকিং নং :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" name="trackid" id="trackid" value='<?php echo $row->trackid?>'readonly />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="institute name">প্রতিষ্ঠানের নাম :</label>
						<div class="col-sm-4">
							<input type="text" class="form-control highlisht_font" name="company" id="company" value='<?php echo $row->bcomname?>'  readonly />
						</div>
						<div class="clearfix visible-xs"></div>
						<label class="control-label col-sm-2 highlisht_font" for="business type">ব্যবসার ধরন :</label>
						<div class="col-sm-4">
							<input type='text' class="form-control highlisht_font" value='<?php echo $row->btype?>' name='bype' readonly />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="Payment Type">Payment Type:</label>
						<div class="col-sm-4"> 
							<select name='acno' class="form-control highlisht_font">
								<?php 
									$Qy=$this->db->get("acinfo");
									foreach ($Qy->result() as $arow):
								?>
								<option value='<?php echo $arow->acno?>'><?php echo $arow->acname?>&nbsp;(&nbsp;<?php echo $arow->acno?>&nbsp;)</option>
								<?php endforeach;?>
							</select>
						</div>
						<label class="control-label col-sm-2 highlisht_font" for="issu date">ইস্যুকৃত তারিখ :</label>
						<div class="col-sm-4">
							<input type='text' class="form-control highlisht_font" value='<?php echo date('d-m-Y');?>' name='issue_date' id='issue_date' />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2 highlisht_font" for="expire date">মেয়াদকাল :</label>
						<div class="col-sm-4">
							<?php 
								$cDate=date("Y-m-d").' ';
								$ExpDate=date("Y")."-06-30";
							?>
							<input type='text' class="form-control highlisht_font" value='<?php  if($cDate>= $ExpDate){  echo "30"."-"."06-"; echo date("Y")+1;}else { echo date("d-m-Y",strtotime($ExpDate)); }?>' name='expire_date'  readonly />
						</div>
						<div class="clearfix visible-xs"></div>
						<label class="control-label col-sm-2 highlisht_font" style="color: red;" for="fee">নবায়ন ফি :</label>
						<div class="col-sm-4" style="color: red;">
							<input type='text' class="form-control highlisht_font" name='fee' id='fee' onkeyup="htmlData('Genarate/ctotal','&fee='+this.value+'&due='+due.value+'&ds='+discount.value);chack();" style="color: red;"/>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-2" for="signboard kor">সাইনবোর্ড কর(বার্ষিক) :</label>
						<div class="col-sm-1" style="margin-top: 10px;"> 
							<input type='checkbox' class="" name='sb_fee' id='recom' value='1' />&nbsp;হাঁ
						</div>
						<div class="col-sm-3">
							<input type='text' class="form-control highlisht_font" name='sbfee' value='0.00' id='sbfee' disabled onkeyup="chack();" />
						</div>
						<div class="clearfix visible-xs"></div>
						<?php 
							if($cal_date>0){
								$sty = 'color: red;';
							}
							else{
								$sty = 'color: black;';
							}
						?>
						<label class="control-label col-sm-2" for="due taka" style="<?php echo @$sty;?>">বকেয়া টাকার পরিমান :</label>
						<div class="col-sm-4">
							<input type='text' class="form-control highlisht_font" name='due' id='due' <?php if($cal_date>0):?> required <?php else :?> disabled <?php endif; ?> onkeyup="htmlData('Genarate/ctotal','fee='+fee.value+'&due='+due.value+'&ds='+discount.value);chack();"/>
						</div>
						<div class="clearfix"></div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-2" for="recommendation">সুপারিশ সাপেক্ষে (ছাড়) :</label>
						<div class="col-sm-1" style="margin-top: 10px;">
							<input type='checkbox' name='recom' id='suparish_chard' value='1' onclick="this.form.discount.disabled = !this.checked;" />&nbsp;হাঁ
						</div>
						<div class="col-sm-3">
							<input type='text' class="form-control highlisht_font" name='discount' id='discount' onkeyup="htmlData('Genarate/ctotal','&fee='+fee.value+'&due='+due.value+'&sbf='+sbfee.value+'&ds='+this.value);chack();" disabled />
						</div>
						<div class="clearfix visible-xs"></div>
						<label class="control-label col-sm-2 highlisht_font" for="Vat">ভ্যাট(১৫%) :</label>
						<div class="col-sm-4" id="txtResult">
							<input type='text' class="form-control highlisht_font" name='vat' id='vat' readonly />
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="col-sm-6" style="background: #eee;line-height: 27px;">
						<div style="font-size: 18px;font-weight: normal;padding: 20px;">
							<?php
								$show_issue = date('d M, Y',strtotime($row->issue_date));
								$show_expire = date('d M, Y',strtotime($row->expire_date));
							?>
							<p style="color: #709EFA;">আপনার ট্রেড লাইসেন্সটি <span style="color: red;"><?php echo $show_issue;?></span> তারিখে সর্বশেষ ইস্যু করা হয়েছিল, এবং <span style="color: red;"><?php echo $show_expire;?></span> তারিখে মেয়াদ উত্তীর্ণ হয়েছে। <?php if($cal_date > 0){?><span>আপনাকে এই বছরের নবায়ন ফি সহ গত <span style="font-weight: bolder;font-size: 20px;color: red;"><?php echo $this->web->banDate($cal_date);?></span> বছরের নবায়নের <span style="color: orange;">বকেয়া</span> টাকা প্রদান করতে হবে।</span><?php } else{?><span><p class="text-success">আপনার বকেয়া টাকা নাই, </p><span style="color: #709EFA;">আপনাকে শুধু এই বছরের  নবায়ন ফি প্রদান করতে হবে।</span></span><?php }?></p>
						</div>
					</div>
					<div class="col-sm-6" style="padding: 0px !important; margin: 0px !important;" > 
						<div class="form-group">
							<label class="control-label col-sm-4 highlisht_font" style="color: blue;" for="discount">সাব চার্জ :</label>
							<div class="col-sm-8">
								<input type='text' class="form-control highlisht_font" name='scharge' id='scharge' onkeyup="slip('Genarate/intotal','&sub_charge='+this.value+'&vat='+vat.value+'&fee='+fee.value+'&ds='+discount.value+'&sbf='+sbfee.value+'&due='+due.value)"  style="color: blue;" />
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="form-group" style="color: red;">
							<label class="control-label col-sm-4 highlisht_font" for="total">মোট পরিমান :</label>
							<div class="col-sm-8" id="slip">
								<input type='text' class="form-control highlisht_font" name='total' id='total' disabled  style="color: red;" />
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4 highlisht_font" for="issu date">Payment Date :</label>
							<div class="col-sm-8">
								<input type="text" class="form-control highlisht_font"  value="<?php echo date('d-m-Y');?>"  id="dofb" name="payment_date" />	
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="form-group"> 
						<div class="col-sm-offset-8 col-sm-4">
							<input type="submit" name="save_tlicence" value="GENERATE" class="btn btn-info btn-sm" id="save_tlicence"/>
							<input type="hidden" value="generate" name="gentype"/>
							<input type="hidden" name='id' value='<?php echo $id;?>'/>
							<input type="hidden" name='trackid' value='<?php echo $row->trackid;?>'/>
							<input type="hidden" name='sno' value='<?php echo $row->sno;?>'/>
							<input type="hidden" name='mobile' value='<?php echo $row->mobile;?>'/>
						</div>
					</div>
				</form>
			</div><!--- /col-lg-12 col-sm-12-------->	
		</div> <!-- /row -->
	</div><!--/#content.col-md-10-->
</div><!--/fluid-row-->
<script type="text/javascript">
	<?php 
		$bookno=$this->web->get_book_no();
	?>
	var fee,sbfee,discount;
	document.getElementById("bno").value=<?php echo $bookno;?>;
</script>
