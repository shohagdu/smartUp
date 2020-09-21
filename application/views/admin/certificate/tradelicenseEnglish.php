<?php 
	// some execution here..............
 
	// for expaire year............
	$expire_date_show = date('Y',strtotime($row->expire_date));
	$expire_full_date_show = date('d.m.Y',strtotime($row->expire_date));
	
	// for Financial year.....
	$second_year=$expire_date_show;
	$first_year=$expire_date_show-1;
	
	// for print hide show control.............
	$status=$this->db->query("select * from tbl_webtools")->result();
	//echo "<pre>";
	foreach($status as $value)
	{
		if($value->item_no==1)
		{
			$sms=$value->status;
		}	
		elseif($value->item_no==2)
		{
			$header=$value->status;
		}
		elseif($value->item_no==3)
		{
			$logo=$value->status;
		}
		elseif($value->item_no==4){
			$muri=$value->status;
		}
	}
 
?>
<html>
	<head>
		<base href="<?php echo base_url() ?>">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="certificate_css/trade.css">
		<title>English Trade license Certificate</title>
		<style type="text/css"> 
			@media print
			{  
				body{
					font-size: 12px !important;
				}
				.no-print, .no-print *
				{
					visibility:hidden;
				}
				table{
					background:none !important;
				}
			}
		</style>
	</head>
	<?php 
		$main2='style="height:12.2in;width:8.5in;"';
		$main_second2='style="height:12.2in;width:8.5in;"';
		$wrapper2='style="margin-top:3px;height:11.69in;width:8.2in"';
		$cert2='style="height:11.69in;width:8.2in"';
	?>
	<body>
		<div id="main" <?php if($muri==0):echo $main2;endif;?>>
			<div id="main_second" <?php if($muri==0):echo $main_second2;endif;?>>
				<?php 
					if($muri==1):
				?>
				<div id="muri"> 
					<table border="0px" width="100%" height="55px" cellspacing="0"  cellpadding="0" style="border-collapse:collapse;table-layout: fixed;">
						<tr>
							<td <?php if($logo==0) { ?> class="no-print" <?php } ?> style="width: 1.5in; text-align:right;"><img src="logo_images/logo.png" height="50px" width="50px"/></td>
							<td <?php if($header==0) { ?> class="no-print" <?php } ?> style="text-align:center;">
								<div class="headding-main"> 
									<font style="font-size: 96%; font-weight:bold; color:blue;"><?php echo (!empty($all_data->full_name_english) ? $all_data->full_name_english : '');?></font>  <br />
									<font style="font-size: 65%; font-weight:bold;">
									<?php 
										$ch=$this->db->count_all('setup_tbl');
										if($ch!=0):
									?>
										<?php echo (!empty($all_data->gram_english) ? $all_data->gram_english . ', ': '').(!empty($all_data->postal_code) ? 'Postal Code: '.$all_data->postal_code. ', ' : ''). (!empty($all_data->thana_english) ? 'Upazila: '.$all_data->thana_english. ', ': ''). (!empty($all_data->district_english) ? 'District: '.$all_data->district_english. '' : '');?> <br />
										Web-site : <?php echo (!empty($all_data->web_link) ? $all_data->web_link : '');?>
									</font>
									<?php 
										endif;
									?>
								</div>
							</td>
							<td style="width: 1.5in;"></td>
						</tr>
					</table>
					
					<table width="95%"  height='25px;' border='0px' class="muri_table" style="border-collapse:collapse;margin: 0px auto;table-layout: fixed;"> 
						<tr> 
							<td> 
								<div class="tradhead" style="font-size: 12px;width:120px;line-height: 21px;">TRADE LICENSE</div>
							</td>
						</tr>
					</table>
					
					<table width="95%" height="186px" border='0px' class="muri_table" style="border-collapse:collapse;margin: 0px auto;table-layout: fixed;"> 
						<tr> 
							<td style="width: 12%;font-size:80%;vertical-align:middle;">Serial Number</td>
							<td style="width: 59%;" ><p style="">: <?php echo $lrow->bno;?></p></td>
							<td style="width: 7%;font-size:80%;vertical-align:middle;">Date</td>
							<td style="width: 22%;"><p> : <?php echo date('d-m-Y',strtotime($lrow->payment_date));?></p></td>
						</tr>
						<tr>
							<td style="font-size:80%;vertical-align:middle;">license No</td>
							<td><p> : <?php echo $row->sno;?></p></td>
							<td style="font-size:65%;vertical-align:middle;">Fiscal year</td>
							<td><p> : <?php echo $first_year;?>-<?php echo $second_year;?></p></td>
						</tr>
						<tr>
							<td style="font-size:80%;vertical-align:middle;">Business Name</td>
							<td><p> : <?php echo $row->ecomname;?></p></td>
							<td style="font-size:80%;vertical-align:middle;">Expire</td>
							<td><p> : 30 June, <?php echo $expire_date_show;?></p></td>
						</tr>
						<tr>
							<td style="font-size:80%;vertical-align:middle;">Owner Name</td>
							<td <?php if($row->mobile ==''):?> colspan="3" <?php endif;?>><p> : <?php $malik=explode(',',$row->ewname); if(count($malik)<=4){echo $row->ewname;} else {echo $malik[0].', '.$malik[1].', '.$malik[2].', '.$malik[3];}?></p></td>
							<?php 
								if($row->mobile !=''):
							?>
							<td style="font-size:80%;vertical-align:middle;">Mobile</td>
							<td><p> : <?php echo $row->mobile;?></p></td>
							<?php endif;?>
						</tr>
						<tr>
							<td style="font-size:80%;vertical-align:middle;">Address</td>
							<td colspan="3"><p> : <?php echo (!empty($row->be_gram) ? $row->be_gram.', ': '').(!empty($row->be_rbs) ? $row->be_rbs. ', ' : '').(!empty($row->be_wordno) ? $row->be_wordno. ', ' : '').(!empty($row->be_postof) ? $row->be_postof. ', ' : '').(!empty($row->be_thana) ? $row->be_thana. ', ' : '').(!empty($row->be_dis) ? $row->be_dis : '')?></p></td>
						</tr>
						<tr>
							<td style="font-size:80%;vertical-align:middle;">Business Type</td>
							<td colspan="3"><p> : <?php echo (!empty($row->btype_english) ? $row->btype_english : '');?></p></td>
						</tr>
						<tr>
							<td style="font-size:80%;vertical-align:middle;">license Fee</td>
							<td colspan="3"><p> : <?php echo $lrow->fee;?>&nbsp; &nbsp; &nbsp;
							<span id='ftaka'>In word 
							: <?php echo $this->bnc->convertToWord($lrow->fee);?>&nbsp;taka only</span>, &nbsp; &nbsp; &nbsp;<span> 15% VAT</span> : <?php echo $lrow->vat?> taka</p></td>
						</tr>
						
						<tr height='45'> 
							
						</tr>
						<tr> 
							<td></td>
							<td style="text-align:left;font-size:80%;"><span  style="border-top: 1px solid black;"> Secretary Signature</span></td>
							<td colspan="2" style="text-align:center;font-size:80%;"><span  style="border-top: 1px solid black;"> Chairman Signature</span></td>
						</tr>
					</table>
				</div>
				<?php 
					endif;
				?>
				<div class="wrapper jolchap" <?php if($muri==0):echo $wrapper2;endif;?>>
					<div id="cert" <?php if($muri==0):echo $cert2;endif;?>>
						<table border="0px"  width="96%" height='126px' style="border-collapse:collapse;margin:15px auto 10px;" cellspacing="0" cellpadding="0">
							<tr> 
								<td class='' colspan="3" style="text-align:center;font-size: 16px;"> <b> </b></td>
							</tr>
							<tr>
								<td <?php if($logo==0) { ?> class="no-print" <?php } ?>  style="width: 18%; text-align:right;"><img src="logo_images/logo.png"height="80px" width="80px"/></td>
								<td <?php if($header==0) { ?> class="no-print" <?php } ?>  style="text-align:center;"><font style="font-size:20px;word-spacing: 4px;letter-spacing: 2px; font-weight:bold; color:blue;"><?php echo (!empty($all_data->full_name_english) ? $all_data->full_name_english : '');?></font>  <br />
									<font style="font-size:12px; font-weight:bold;">
									<?php 
										$ch=$this->db->count_all('setup_tbl');
										if($ch!=0):
									?>
										<?php echo (!empty($all_data->gram_english) ? $all_data->gram_english . ', ': '').(!empty($all_data->postal_code) ? 'Postal Code: '.$all_data->postal_code. ', ' : ''). (!empty($all_data->thana_english) ? 'Upazila: '.$all_data->thana_english. ', ': ''). (!empty($all_data->district_english) ? 'District: '.$all_data->district_english. '' : '');?>
										<br />
										<?php echo (!empty($all_data->mobile) ? 'Mobile: '.$all_data->mobile. ', ' : '').(!empty($all_data->phone) ? $all_data->phone. '.' : '');?> <br />
										<?php echo (!empty($all_data->web_link) ? 'Web-site: '. $all_data->web_link : '');?></font>
									<?php 
										endif;
									?>
								</td>
								<td style="width: 18%; text-align:center;"><img src="<?php echo (!empty($row->profile) ? $row->profile : '');?>" height="100px" width="100px" style="position:relative;top:-1px;padding: 5px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;" /></td>
							</tr>
						</table>
						
						<table width="99%" height="45px" border="0" style="border-collapse:collapse;margin:0px auto; margin-top: 10px;" cellpadding="0" cellspacing="0">
							<tr>
								<td style=""><div class="cert-heading" style="font-size: 18px;width:180px;line-height: 29px;">TRADE LICENSE</div></td>
								
							</tr>
						</table>
						
						<table width="96%" height="57px" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;table-layout:fixed; margin: 2px auto;" > 
							<tr height="28px"> 
								<td style="width: 72%"></td>
								<td style="width: 13%;font-size: 15px;font-family:solaimanLipi;">Serial No</td>
								<td style="width: 15%;font-size: 15px;font-family:solaimanLipi;"> : <?php echo $lrow->bno;?></td>
							</tr>
							<tr height="28px"> 
								<td>
									<table border='1' width="60%" height="28px" cellpadding='0' cellspacing='0' style="border-collapse:collapse; table-layout:fixed;"> 
										<tr> 
											<td style="width: 50%;text-indent: 15px;font-size: 15px;">License No :</td>
											<?php 
												$trade_license_no=substr($row->sno,-6);
												$license_no=str_split($trade_license_no);
												for($i=0;$i<strlen($trade_license_no);$i++){?>	
													<td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $license_no[$i];?></td>
												<?php }?>
											
										</tr>
									</table>
								</td>
								<td style="font-size: 15px;font-family:solaimanLipi;">Issue Date </td>
								<td style="font-size: 15px;font-family:solaimanLipi;"> : <?php  echo date('d-m-Y',strtotime($row->issue_date));?></td>
							</tr>
						</table>
						
						<table width="96%" height="32px;" border="1px" style="border-collapse:collapse;margin:0px auto;margin-top:10px;" cellpadding="0" cellspacing="0">
							 <tr>
								<td style="width:160px;font-size:17px; text-align:center; font-weight:normal;">Trade License No :</td>
								<?php $fsonod=str_split($row->sno);for($i=0;$i<strlen($row->sno);$i++){?>	
								<td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $fsonod[$i];?></td>
								<?php }?>
							</tr>
						</table>
						
						<table width="97%" height="50px" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin: 6px auto;table-layout:fixed; ">
							<tr> 
								<td style="width: 250px;text-indent: 20px;text-align:left; font-size:17px;">Business Name</td>
								<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $row->ecomname;?></td>
							</tr>
							
						</table>

						<?php 
								if($row->ownertype=="1"){
						?>
						<table width="97%" height="77px" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin:0px auto;table-layout:fixed; ">
							<tr>
								<td style="width:250px; text-align:left;text-indent: 20px;font-size:17px;">Owner Name</td>
								<td  style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $row->ewname;?></td>
							</tr>
							
							<?php 
								if(($row->gender=='female')&&($row->mstatus=='বিবাহিত')){
								?>
							<tr>
								<td style="text-align:left;text-indent: 20px; font-size:17px;">Husband Name</td>
								<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo  $row->ehname;//$row->bfname;?></td>
							</tr>
								<?php
								}else{
							?>
							
							<tr>
								<td style="text-align:left;text-indent: 20px; font-size:17px;">Father Name</td>
								<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo  $row->efname;//$row->bfname;?></td>
							</tr>
							<?php 
								}
							?>
							<?php if($row->bmane !=''):?>
							<tr>
								<td style="text-align:left;text-indent: 20px; font-size:17px;">Mother Name</td>
								<td  style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $row->emname;//$row->bmane;?></td>
							</tr>
							<?php endif;?>
						</table>
						<?php 
								}else{
						?>
						
						
						
						<table width="95%" height="77px" cellpadding="0" cellspacing="0" border="1px" style="border-collapse:collapse;margin:10px auto;table-layout: fixed;height:75px;border:1px solid lightgray;" >
								<tr>
									<th style="padding-left:10px;font-weight:bold;text-align:left;font-size:16px;">Owner Name</th>
									<th  style="padding-left:10px;font-weight:bold;text-align:left;font-size:16px;">Father/Husband Name</th>
									<th  style="padding-left:10px;font-weight:bold;text-align:left;font-size:16px;">Mother Name</th>
								</tr>
								<?php 
							  $name= $row->ewname;
							  $namef= $row->efname;
							  $namem= $row->emname;
							  $bhname1=$row->ehname;
							  $gender1=$row->gender;
							  $mstatus1=$row->mstatus;
								  
								$name1=explode(",",$name);
								
								$namef1=explode(",",$namef);
								$namem1=explode(",",$namem);
								$bhname2=explode(",",$bhname1);
								//print_r($bhname2);
								
								$gender2=explode(",",$gender1);
								$mstatus2=explode(",",$mstatus1);
								//print_r($mstatus2);
								//echo "<pre>";
								//print_r($name1);
								 $count=count($name1);
								 $k=0;
								 $f=0;
								for($i=0;$i<$count;$i++){
								
							?>
								
								<tr>
									<td style="padding-left:10px;font-size:80%;font-weight:normal;text-align:left;"><?php echo $name1[$i]; ?></td>
									<?php 
										//print_r($gender2[$i]);
										//print_r($mstatus2[$i]);
										//echo $bhname2[$i]."<br>" ;
										if(($gender2[$i]=='female')&&($mstatus2[$i]=='বিবাহিত')){
											if($bhname2[$k]==''):$k++;endif;
									?>
									
									<td style="padding-left:10px;font-size:80%;font-weight:normal;text-align:left;text-transform:capitalize;"><?php echo $bhname2[$k]." (H)";  ?></td>
									
									<?php 
										}else{
											if($namef1[$f]==''):$f++;endif;
										?>
									
									<td style="padding-left:10px;font-size:80%;font-weight:normal;text-align:left;text-transform:capitalize;"><?php echo $namef1[$f]."  (F)";  ?></td>
									<?php 
										$f++;
										}
									?>
									
									<td style="padding-left:10px;font-size:80%;font-weight:normal;text-align:left;text-transform:capitalize;"><?php echo $namem1[$i] ?></td>
								</tr>
								<?php 
								}
								?>
										
								
						</table>
						
						
						<?php 
							}
						?>
						
						<table width="97%" height="222px" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; margin: 0px auto; ">
							
							<?php 
								if(($row->ownertype=="3") || ($row->ownertype=="2")){
							?>
							<tr>
								<td style="width:250px;text-indent: 20px;text-align:left; font-size:17px;">Capital Invest.(For Company)</td>
								<td style="font-weight:bold; font-size:20px; text-align:left;">:&nbsp;<?php echo (!empty($row->pay_amount) ? $row->pay_amount : '');?></td>
							</tr>
							<?php

								}
								?>
							<tr style="height: 62px;">
								<td valign='top' style="width:250px; text-indent: 20px;text-align:left; font-size:17px;line-height: 30px;">Business Address</td>
								
								<td valign='top' style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo (!empty($row->be_gram) ? $row->be_gram.', ': '').(!empty($row->be_rbs) ? $row->be_rbs. ', ' : '').(!empty($row->be_wordno) ? $row->be_wordno. ', ' : '').(!empty($row->be_postof) ? $row->be_postof. ', ' : '').(!empty($row->be_thana) ? $row->be_thana. ', ' : '').(!empty($row->be_dis) ? $row->be_dis : '')?>
								</td>
							</tr>
							<tr> 
								<td style="text-indent: 20px; text-align:left; font-size:17px;">Type of Business</td>
								<td  style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo (!empty($row->btype_english) ? $row->btype_english : '');?></td>
							</tr>
							<?php if($row->mobile !=''):?>
							<tr>
								<td style="text-indent: 20px;text-align:left; font-size:17px;">Mobile </td>
								<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $row->mobile;?></td>
							</tr>
							<?php endif;?>
							<?php 
								if($row->email!=''){
							?>
							<tr>
								<td style="text-indent: 20px;text-align:left; font-size:17px;"> E-mail (if have)</td>
								<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $row->email;?></td>
							</tr>
							<?php 
								}
								?>
							
							<tr>
								<td style="text-indent: 20px;text-align:left; font-size:17px; ">Trade license Fee (Annual) </td>
								<td style="font-weight:bold; font-size:18px; text-align:left; ">:&nbsp;<?php echo $lrow->fee;?> &nbsp; &nbsp;&nbsp;<span id='btaka'></span></td>
							</tr>
							
							
							<tr>
								<td style="text-indent: 20px;text-align:left; font-size:17px;">Signboard TAX (annual)</td>
								<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $lrow->sbfee;?> &nbsp;<?php //echo "( ". $this->web->tkconvert($lrow->sbfee);?>Taka. </td>
							</tr>
							
							<tr>
								<td style="text-indent: 20px;text-align:left; font-size:17px;">15% VAT</td>
								<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $lrow->vat;?> &nbsp;<?php //echo "( ". $this->web->tkconvert($lrow->vat);?>taka.</td>
							</tr>
						</table>
		
						<table width="97%" height="52px"  cellpadding="0" cellspacing="0" border="0px" style="table-layout:fixed; border-collapse:collapse;margin:10px auto;">
							<tr>
								<td style="padding-left:20px;font-size:18px;font-family:solaimanLipi;">You are permitted to continue your business for <?php echo $first_year;?>-<?php echo $second_year;?> after receiving the license fee on behalf of the mentioned company. This license will be valid till <?php echo $expire_full_date_show;?> and will have to renew every year.</td>
							</tr>	
						</table>
						
						<table width="92%" height="50px" cellpadding="0" cellspacing="0" border="0px" style="border-collapse:collapse;margin: 0px auto;table-layout: fixed;">
							<tr valign='bottom'> 
								<td>
									
								</td>
							</tr>	
						</table>	
						
						<table width="97%" height="188px" border="0" cellpadding="0" cellspacing="0" style="bor	der-collapse:collapse;margin:0px auto;table-layout: fixed;">
							<tr>
								<td style="padding-left:20px;font-size:16px;">
									<div style="float:left;">
										<font style='position:relative;float:left;left:0px;border-top: 1px solid black;'>Secretary Signature</font>
									</div>
									<div style="display:inline;float:right">
										<font style='float:right;right:20px;position:relative;border-top: 1px solid black;'>Chairman Signature</font>
									</div>
								</td>
								<td  style="width: 22%"></td>
							</tr>
							<?php 
								/* $a = explode(" ",$all_data->full_name_english);
								$show = count($a)-2;
								echo strtolower($a[$show-1]); */
							?>
							<tr>
								<td rowspan="2"  style="padding-left:20px;font-size:15px !important;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black;">Instruction: <br />1)To verify the certificate go to the link- <font style="color:blue;">http://<?php echo $this->web->getUrl(); ?>Tctrack</font>  and enter the 17 digits certificate number or Scan the QR code from your android mobile.<br />2) Come up with the old license at renewal time. <br>3) For any information please call or email to.
								</td>
								<td rowspan="2" style="border-left:1px solid black; border-top:1px solid black;"><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F<?php echo $all_data->web_link;?>/index.php/onlinetrack/trade_license_jachai?id=<?php echo sha1($row->sno)?>%2F&choe=UTF-8" height="160px" width="175px" style="border:none;background:none;padding:10px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"></td>
								
							</tr>
						</table>
						
						<table border='0' width="97%" height="34px" cellpadding='0' cellspacing='0' style="border-collapse: collapse;margin: 0px auto;table-layout:fixed;"> 
							<tr>
								<td style="width: 75%;text-align:center;font-family: Arial;"> <font style="font-size:11px !important;"><?php echo $all_data->web_link;?></font><br>  <font style="font-size:11px !important;"> Email:<?php echo $all_data->email;?></font></td>
								<td style="width: 25%;text-align:center;"><font style="font-size:10px !important;opacity:0.7;">   Developed by Datacenter Bangladesh. </font> <br><font style="font-size:12px !important;opacity:0.7;">www.datacenter.com.bd   </font></td>
				 
							</tr>
						</table>
						
						<table border='0' width="97%" height="34px" cellpadding='0' cellspacing='0' style="border-collapse: collapse;margin: 0px auto;table-layout:fixed;"> 
							<tr> 
								<td>
									<p style="text-align:center;font-size: 13px;opacity: 0.7;letter-spacing: 1px;">*  First 4 digits are from running year,next 7 digits are area code and last 6 digits are trade license number.*</p>
								</td>
							</tr>
						</table>

					</div>
				</div>	
			</div>
		</div>
		
		<!--- for print----->
		<div id="print-full-page" class="no-print">
			<div class="print-certificate">
				<a target="" href="javaScript:window.print();" title="প্রিন্ট করুন">
					<img src="<?php echo base_url();?>library/print_big.png" alt="প্রিন্ট করুন" />
				</a>
			</div>
		</div>
		<!--- end for print------>
			<script>
			function taka(){
				var x=document.getElementById("ftaka").textContent ;
				document.getElementById("btaka").textContent=x;
			}
			taka();
		</script>
	</body>
</html>