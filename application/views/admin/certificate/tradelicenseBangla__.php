<?php 
	// some execution here..............
	
	// for expaire year............
	$expire_date_show = date('Y',strtotime($row->expire_date));
	$expire_full_date_show = date('d-m-Y',strtotime($row->expire_date));
	
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
	}
?>
<html>
	<head>
		<base href="<?php echo base_url() ?>">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="certificate_css/trade.css">
		<title>বাংলা ট্রেড লাইসেন্স সনদপত্র</title>
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
	<body>
		<div id="main">
			<div id="main_second">
				<div id="muri"> 
					<table border="0px" width="100%" height="55px" cellspacing="0"  cellpadding="0" style="border-collapse:collapse;table-layout: fixed;">
						<tr>
							<td <?php if($logo==0) { ?> class="no-print" <?php } ?> style="width: 1.5in; text-align:right;"><img src="logo_images/logo.png" height="50px" width="50px"/></td>
							<td <?php if($header==0) { ?> class="no-print" <?php } ?> style="text-align:center;">
								<div class="headding-main"> 
									<font style="font-size: 96%; font-weight:bold; color:blue;"><?php echo $all_data->full_name;?></font>  <br />
									<font style="font-size: 65%; font-weight:bold;">
										<?php 
											$ch=$this->db->count_all('setup_tbl');
											if($ch!=0):
										?>
										<?php echo $all_data->thana;?>,&nbsp;<?php echo $all_data->district;?>-<?php echo $all_data->postal_code;?> <br />
										ওয়েব সাইট : <?php echo $all_data->web_link;?>
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
								<div class="tradhead"> ট্রেড লাইসেন্স</div>
							</td>
						</tr>
					</table>
					
					<table width="95%" height="186px" border='0px' class="muri_table" style="border-collapse:collapse;margin: 0px auto;table-layout: fixed;"> 
						<tr> 
							<td style="width: 12%;font-size:80%;vertical-align:middle;">ক্রমিক নং</td>
							<td style="width: 59%;" ><p style="">: <?php echo $this->web->banDate($lrow->bno)?></p></td>
							<td style="width: 7%;font-size:80%;vertical-align:middle;">তারিখ</td>
							<td style="width: 22%;"><p> : <?php $payment_date=date('d/m/Y',strtotime($lrow->payment_date));echo $this->web->banDate($payment_date)?></p></td>
						</tr>
						<tr>
							<td style="font-size:80%;vertical-align:middle;">লাইসেন্স নং</td>
							<td><p> : <?php echo $this->web->banDate($row->sno);?></p></td>
							<td style="font-size:80%;vertical-align:middle;"> অর্থ বছর</td>
							<td>
								<p> : <?php echo $this->web->banDate($first_year);?>-<?php echo $this->web->banDate($second_year);?></p>
							</td>
						</tr>
						<tr>
							<td style="font-size:80%;vertical-align:middle;">প্রতিষ্ঠানের নাম</td>
							<td><p> : <?php echo $row->bcomname;?></p></td>
							<td style="font-size:80%;vertical-align:middle;">মেয়াদ</td>
							<td><p> : ৩০ জুন, <?php echo $this->web->banDate($expire_date_show)?> খ্রি:</p></td>
						</tr>
						<tr>
							<td style="font-size:80%;vertical-align:middle;">মালিক</td>
							<td <?php if($row->mobile ==''):?> colspan="3" <?php endif;?>><p> : <?php $malik=explode(',',$row->bwname); if(count($malik)<=4){echo $row->bwname;} else {echo $malik[0].', '.$malik[1].', '.$malik[2].', '.$malik[3];}?></p></td>
							<?php 
								if($row->mobile !=''):
							?>
							<td style="font-size:80%;vertical-align:middle;">মোবাইল</td>
							<td><p> : <?php echo $this->web->banDate($row->mobile);?></p></td>
							<?php endif;?>
						</tr>
						<tr>
							<td style="font-size:80%;vertical-align:middle;">ঠিকানা</td>
							<td colspan="3"><p> : <?php echo $row->bb_gram.','.$row->bb_rbs.','.$row->bb_wordno.','.$row->bb_dis?></p></td>
						</tr>
						<tr>
							<td style="font-size:80%;vertical-align:middle;">ব্যবসার ধরন</td>
							<td colspan="3"><p> : <?php echo $row->btype;?></p></td>
						</tr>
						<tr>
							<td style="font-size:80%;vertical-align:middle;">লাইসেন্স  ফি</td>
							<td colspan="3"><p> : <?php echo $this->web->banDate($lrow->fee);?>&nbsp; &nbsp; &nbsp;
							<span> কথায় </span>
							: <span id="ftaka"><?php echo $this->bnc->bnConvert($lrow->fee);?>&nbsp;টাকা মাত্র </span>,&nbsp; &nbsp; &nbsp;<span> ১৫% ভ্যাট বাবদ</span>: <?php echo $this->web->conArray($lrow->vat)?> টাকা</p></td>
						</tr>
						
						<tr height='50'> 
							
						</tr>
						<tr> 
							<td></td>
							<td style="text-align:left;font-size:80%;"><span  style="border-top: 1px solid black;"> সচিবের স্বাক্ষর</span></td>
							<td colspan="2" style="text-align:center;font-size:80%;"><span  style="border-top: 1px solid black;"> চেয়ারম্যান স্বাক্ষর</span></td>
						</tr>
					</table>
				</div>
				<div id="cert">
					<table border="0px"  width="96%" height='126px' style="border-collapse:collapse;margin:15px auto 10px;" cellspacing="0" cellpadding="0">
						<tr> 
							<td class='' colspan="3" style="text-align:center;font-size: 16px;"> <b> </b></td>
						</tr>
						<tr>
							<td <?php if($logo==0) { ?> class="no-print" <?php } ?>  style="width: 18%; text-align:right;"><img src="logo_images/logo.png"height="80px" width="80px"/></td>
							<td <?php if($header==0) { ?> class="no-print" <?php } ?> style="text-align:center;"><font style="font-size:18px; font-weight:bold; color:blue;"><?php echo $all_data->full_name;?></font>  <br />
								<font style="font-size:14px; font-weight:bold;">
									<?php 
										$ch=$this->db->count_all('setup_tbl');
										if($ch!=0):
									?>
									<?php echo $all_data->thana;?>,&nbsp;<?php echo $all_data->district;?>-<?php echo $all_data->postal_code;?><br />
									ওয়েব সাইট : <?php echo $all_data->web_link;?>
								</font>
									<?php 
										endif;
									?>
							</td>
							<td style="width: 18%; text-align:center;"><img src="<?php echo $row->profile;?>" height="100px" width="100px" style="position:relative;top:-1px;padding: 5px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;" /></td>
						</tr>
					</table>
					
					<table width="99%" height="45px" border="0" style="border-collapse:collapse;margin:0px auto; margin-top: 10px;" cellpadding="0" cellspacing="0">
						<tr>
							<td style=""><div class="cert-heading"> ট্রেড লাইসেন্স</div></td>
							
						</tr>
					</table>
					
					<table width="96%" height="57px" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;table-layout:fixed; margin: 2px auto;" > 
						<tr height="28px"> 
							<td style="width: 72%"></td>
							<td style="width: 13%;font-size: 15px;font-family:solaimanLipi;">ক্রমিক নং</td>
							<td style="width: 15%;font-size: 15px;font-family:solaimanLipi;"> : <?php echo $this->web->banDate($lrow->bno)?></td>
						</tr>
						<tr height="28px"> 
							<td>
								<table border='1' width="60%" height="28px" cellpadding='0' cellspacing='0' style="border-collapse:collapse; table-layout:fixed;"> 
									<tr> 
										<td style="width: 50%;text-indent: 10px;font-size: 15px;font-family:solaimanLipi;">ট্রেড লাইসেন্স  নং :</td>
										<?php 
											$trade_license_no=substr($row->sno,-6);
											$license_no=str_split($trade_license_no);
											for($i=0;$i<strlen($trade_license_no);$i++){?>	
												<td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $this->web->ceb($license_no[$i])?></td>
											<?php }?>
										
									</tr>
								</table>
							</td>
							<td style="font-size: 15px;font-family:solaimanLipi;">ইস্যুকৃত তারিখ  </td>
							<td style="font-size: 15px;font-family:solaimanLipi;"> : <?php  $Sdate=date('d-m-Y',strtotime($row->issue_date)); echo $this->web->banDate($Sdate);?></td>
						</tr>
					</table>
					
					<table width="96%" height="32px;" border="1px" style="border-collapse:collapse;margin:0px auto;margin-top:10px;" cellpadding="0" cellspacing="0">
				         <tr>
							<td style="width:160px;font-size:80%; text-align:center; font-weight:normal;">ট্রেড লাইসেন্স পরিচিতি নং :</td>
							<?php $fsonod=str_split($row->sno);for($i=0;$i<strlen($row->sno);$i++){?>	
							<td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $this->web->ceb($fsonod[$i])?></td>
							<?php }?>
				        </tr>
					</table>
					
					<table width="97%" height="50px" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin: 6px auto;table-layout:fixed; ">
						<tr> 
							<td style="width: 250px;text-indent: 20px;text-align:left; font-size:17px;">ব্যবসা প্রতিষ্ঠানের নাম</td>
							<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $row->bcomname;?></td>
						</tr>		
					</table>

					<?php 
							if($row->ownertype=="1"){
					?>
					<table width="97%" height="77px" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin:0px auto;table-layout:fixed; ">
						<tr>
							<td style="width:250px; text-align:left;text-indent: 20px;font-size:17px;">প্রোপাইটরের নাম</td>
							<td  style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $row->bwname;?></td>
						</tr>
						
						<?php 
							if(($row->gender=='female')&&($row->mstatus=='বিবাহিত')){
							?>
						<tr>
							<td style="text-align:left;text-indent: 20px; font-size:17px;">স্বামীর নাম</td>
							<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo  $row->bhname;//$row->bfname;?></td>
						</tr>
							<?php
							}else{
						?>
						
						<tr>
							<td style="text-align:left;text-indent: 20px; font-size:17px;">পিতার নাম</td>
							<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo  $row->bfname;//$row->bfname;?></td>
						</tr>
						<?php 
							}
						?>
						<?php if($row->bmane !=''):?>
						<tr>
							<td style="text-align:left;text-indent: 20px; font-size:17px;">মাতার নাম</td>
							<td  style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $row->bmane;//$row->bmane;?></td>
						</tr>
						<?php endif;?>
					</table>
					<?php 
							}else{
					?>
					
					
					
					<table width="95%" height="77px" cellpadding="0" cellspacing="0" border="1px" style="border-collapse:collapse;margin:10px auto;table-layout: fixed;height:75px;border:1px solid lightgray;" >
							<tr>
								<th style="padding-left:10px;font-weight:bold;text-align:left;font-size:16px;">প্রোপাইটরের নাম</th>
								<th  style="padding-left:10px;font-weight:bold;text-align:left;font-size:16px;">পিতা/স্বামীর নাম</th>
								<th  style="padding-left:10px;font-weight:bold;text-align:left;font-size:16px;">মাতার নাম</th>
							</tr>
							<?php 
						  $name= $row->bwname;
						  $namef= $row->bfname;
						  $namem= $row->bmane;
						  $bhname1=$row->bhname;
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
								
								<td style="padding-left:10px;font-size:80%;font-weight:normal;text-align:left;"><?php echo $bhname2[$k]." (স্বামী)";  ?></td>
								
								<?php 
									}else{
										if($namef1[$f]==''):$f++;endif;
									?>
								
								<td style="padding-left:10px;font-size:80%;font-weight:normal;text-align:left;"><?php echo $namef1[$f]."  (পিতা)";  ?></td>
								<?php 
									$f++;
									}
								?>
								
								<td style="padding-left:10px;font-size:80%;font-weight:normal;text-align:left;"><?php echo $namem1[$i] ?></td>
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
							<td style="width:250px;text-indent: 20px;text-align:left; font-size:17px;">পরিশোধিত মূলধন (লিঃ কো: ক্ষেত্রে) </td>
							<td style="font-weight:bold; font-size:20px; text-align:left;">:&nbsp;<?php echo $this->web->conArray($row->pay_amount)?></td>
						</tr>
						<?php

							}
							?>
						<tr style="height: 62px;">
							<td valign='top' style="width:250px; text-indent: 20px;text-align:left; font-size:17px;line-height: 30px;">ব্যবসা প্রতিষ্ঠানের ঠিকানা</td>
							<td valign='top' style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $row->bb_gram;if($row->bb_rbs !=''):?>,&nbsp;<?php echo $row->bb_rbs;endif;?>,&nbsp;<?php echo $row->bb_postof;?>,&nbsp;<?php echo $row->bb_thana;?>,&nbsp;<?php echo $row->bb_dis.'।';?>
							</td>
						</tr>
						<tr> 
							<td style="text-indent: 20px; text-align:left; font-size:17px;">ব্যবসার ধরন</td>
							<td  style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $row->btype;?></td>
						</tr>
						<?php if($row->mobile !=''):?>
						<tr>
							<td style="text-indent: 20px;text-align:left; font-size:17px;">মোবাইল </td>
							<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $this->web->banDate($row->mobile);?></td>
						</tr>
						<?php endif;?>
						<?php 
							if($row->email!=''){
						?>
						<tr>
							<td style="text-indent: 20px;text-align:left; font-size:17px;"> ইমেইল (যদি থাকে)</td>
							<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $row->email;?></td>
						</tr>
						<?php 
							}
							?>
						
						<tr>
							<td style="text-indent: 20px;text-align:left; font-size:17px; ">ট্রেড লাইসেন্স ফি(বার্ষিক) </td>
							<td style="font-weight:bold; font-size:18px; text-align:left; ">:&nbsp;<?php echo $this->web->conArray($lrow->fee)?> &nbsp; &nbsp;&nbsp;<?php echo "কথায় : ";?><span id="btaka"></span></td>
						</tr>
						
						
						<tr>
							<td style="text-indent: 20px;text-align:left; font-size:17px;">সাইনবোর্ড কর(বার্ষিক) </td>
							<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $this->web->conArray($lrow->sbfee)?> &nbsp;<?php //echo "( ". $this->web->tkconvert($lrow->sbfee);?>টাকা </td>
						</tr>
						
						<tr>
							<td style="text-indent: 20px;text-align:left; font-size:17px;">১৫ % ভ্যাট বাবদ জমা </td>
							<td style="font-weight:bold; font-size:18px; text-align:left;">:&nbsp;<?php echo $this->web->conArray($lrow->vat)?> &nbsp;<?php //echo "( ". $this->web->tkconvert($lrow->vat);?>টাকা </td>
						</tr>
					</table>
	
					<table width="97%" height="52px"  cellpadding="0" cellspacing="0" border="0px" style="table-layout:fixed; border-collapse:collapse;margin:10px auto;">
						<tr>
							<td style="padding-left:20px;font-size:16px;font-family:solaimanLipi;">উল্লেখিত প্রতিষ্ঠানের অনুকূলে প্রদত্ত লাইসেন্স ফি গ্রহন করিয়া <?php echo $this->web->banDate($first_year);?>-<?php echo $this->web->banDate($second_year);?> সালের জন্য আবশ্যকীয় বাণিজ্য চালাইয়া যাইবার অনুমতি দেওয়া হইল ।  <?php echo $this->web->banDate($expire_full_date_show);?> সন পর্যন্ত এই লাইসেন্স বৈধ বলিয়া বিবেচিত হইবে এবং প্রতি বছর নবায়ন করিতে হইবে ।</td>
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
									<font style='position:relative;float:left;left:0px;border-top: 1px solid black;'>সচিবের স্বাক্ষর</font>
								</div>
								<div style="display:inline;float:right">
									<font style='float:right;right:20px;position:relative;border-top: 1px solid black;'>চেয়ারম্যানের স্বাক্ষর</font>
								</div>
							</td>
							<td  style="width: 22%"></td>
						</tr>
						<?php 
							$a = explode(" ",$all_data->full_name_english);
                            $show = count($a)-2;
						?>
						<tr>
							<td rowspan="2"  style="padding-left:20px;font-size:15px !important;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black;">নির্দেশাবলীঃ <br />১) ট্রেড লাইসেন্সটি online এ verification এর জন্য <font style="color:blue;">http://tctrack.<?php echo strtolower($a[$show-1]);?>up.com</font>  পেজ এ আসুন  এবং ১৭ ডিজিটের পরিচিতি নং টি প্রবেশ করান। অথবা আপনার  Android Mobile থেকে  QR code টি Scan করুন।<br />২) নবায়নের সময় পুরাতন লাইসেন্সটি সঙ্গে নিয়ে আসুন। <br>৩) প্রয়োজনীয় তথ্য জানার জন্য  ইউনিয়ন পরিষদে  যোগাযোগ করূন ।
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
								<p style="text-align:center;font-size: 13px !important;opacity: 0.7;letter-spacing: 2px;">*  প্রথম চার অংক চলতি সালের, পরবর্তী সাত অংক এরিয়া কোড (নিজস্ব) এবং শেষ ছয় অংক ট্রেড লাইসেন্স নং । *</p>
							</td>
						</tr>
					</table>

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
