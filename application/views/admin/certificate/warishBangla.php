<html>
	<head>
		<meta charset="utf-8">
		<base href="<?php echo base_url(); ?>">
		<link rel="stylesheet" type="text/css" href="certificate_css/oarish_cer.css">
		<title>বাংলা ওয়ারিশ সনদপত্র</title>
		<style>
			@media print
			{    
				.no-print, .no-print *
				{
					visibility:hidden;
				}
				table{
					background:none !important;
				}
				#main{
					border:0px !important;
				}				
			}
			table.certificate td{line-height:2px;}
		</style>
		<?php
			// some execution here............
			$fsonod=str_split($row->sonodno); 
			
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
	</head>
	<?php 
		//echo'<pre>';
		//print_r($all_data);
	?>
	<?php 
		$main2='style="height:12.2in;width:8.5in;"';
		$main_second2='style="height:12.2in;width:8.5in;"';
		$wrapper2='style="margin-top:3px;height:11.69in;width:8.2in"';
		$cert2='style="height:11.69in;width:8.2in"';
	?>
	<body>
		<div id="main" <?php if($muri==0):echo $main2;endif;?>>
			<div id="main_second" <?php if($muri==0):echo $main_second2;endif;?>>
					<!------header div start here---->
				<?php 
					if($muri==1):
				?>
				<div id="muri"> 
					<table border="0px" width="99%" height="60px" cellspacing="0"  cellpadding="0" style="border-collapse:collapse;margin:0px auto;">
						<tr height="60px">
							<td <?php if($logo==0) { ?> class="no-print" <?php } ?> style="width:1.5in; text-align:right;"><img src="logo_images/logo.png" height="55px" width="55px"/></td>
							<td <?php if($header==0) { ?> class="no-print" <?php } ?> style="text-align:center;height:60px;"><font style="font-size:15px; font-weight:bold; color:blue; width:5.5in;"><?php echo $all_data->full_name;?></font>  <br />
								<font style="font-size:9px; font-weight:bold;">
								<?php $ch=$this->db->count_all('setup_tbl');
									if($ch!=0): ?>
										<?php echo (!empty($all_data->gram) ? $all_data->gram. ', ' : '').(!empty($all_data->postal_code) ? 'পোস্টাল কোড: '. $this->web->banDate($all_data->postal_code). ', ' : '').(!empty($all_data->thana) ? 'উপজেলাঃ ' . $all_data->thana . ', '  : '').(!empty($all_data->district) ? 'জেলাঃ ' . $all_data->district : '');?> <br />
										<?php echo (!empty($all_data->web_link) ? "ওয়েব সাইট :" . $all_data->web_link : '');?>
								<?php endif; ?>
								</font>
							</td>
							<td style="width:1.4in;"></td>
						</tr>
					</table>
					
					<table width="95%" height='240px' border='0' class="muri_table" style="border-collapse:collapse;margin:0px auto;"> 
						<tr> 
							<td colspan="4" width='100%'> 
								<div class="owarishhead">ওয়ারিশ সনদ</div>
							</td>
						</tr>
						<tr> 
							<td style="width: 145px;font-size:15px;vertical-align:middle;">ক্রমিক নং</td>
							<td style="width:330px;" >: <input type="text"  value="<?php echo $this->web->banDate($mrow->applicant_id)?>" style="width:95%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
							<td style="width: 38px;font-size:15px;vertical-align:middle;">তারিখ</td>
							<td style="width:240px;">: <input type="text" value='<?php echo $this->web->banDate($mrow->payment_date)?>' style="width:95%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;">সনদ নং</td>
							<td colspan="3">: <input type="text" value='<?php echo $this->web->banDate($row->sonodno)?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;"> নাম </td>
							<td colspan="3">: <input type="text" value='<?php echo $row->bname?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;"> পিতার নাম </td>
							<td colspan="3">: <input type="text" value='<?php echo $row->bfname?>' style="font-size:13px;width:260px;border-bottom:1px dashed black;" readonly />
							<span style="font-size: 12px;">মাতার নাম</span>
							: <input type="text" value='<?php echo $row->bmane?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;">বর্তমান ঠিকানা</td>
							<td colspan="3">: <input type="text" value='<?php echo "&nbsp;".$row->pb_gram.",&nbsp;".$row->pb_postof.",&nbsp;".$row->pb_thana.",&nbsp;".$row->pb_dis;?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;">স্থায়ী ঠিকানা</td>
							<td colspan="3">: <input type="text" value='<?php echo "&nbsp;".$row->perb_gram.",&nbsp;".$row->perb_postof.",&nbsp;".$row->perb_thana.",&nbsp;".$row->perb_dis; ?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<?php if(isset($row->nationid) && $row->nationid!=''){?>
							<td style="font-size:15px;vertical-align:middle;">ন্যাশনাল আইডি নং</td>
							<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
							<td style="font-size:15px;vertical-align:middle;">জন্ম নিবন্ধন নং </td>
							<?php } else if(isset($row->pno) && $row->pno!=''){?>
							<td style="font-size:15px;vertical-align:middle;">পাসপোর্ট নং </td>
							<?php }else{?>
							<td style="font-size:15px;vertical-align:middle;">ন্যাশনাল আইডি নং</td>
							<?php }?>
							<td colspan="3">:
							<?php if(isset($row->nationid) && $row->nationid!=''){?>
							<input type="text" value='<?php echo $this->web->banDate($row->nationid)?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
							<input type="text" value='<?php echo $this->web->banDate($row->bcno)?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php } else if(isset($row->pno) && $row->pno!=''){?>
							<input type="text" value='<?php echo $this->web->banDate($row->pno)?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php }else{?>
							<input type="text" value='<?php echo $this->web->banDate($row->nationid)?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php }?>
							<span style="font-size: 12px;">ওয়ার্ড নং</span>
							: <input type="text" name="" value="<?php echo $this->web->banDate($row->pb_wordno)?>" id="" style="width:270px;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						
						<tr>
							<td style="font-size:15px;vertical-align:middle;">উত্তরাধিকারীগণের সংখ্যা</td>
							<td style="width:270px;font-size:13px;border-bottom:1px dashed black;"  >: <span id='total'>&nbsp;&nbsp;</span>&nbsp;&nbsp;জন</td>
							<td></td>
							<td></td>
						</tr>
						<tr> 
							<td colspan="3"></td>
							<td style="width:50px;text-align:center;border-top:1px solid black;font-size:15px;">চেয়ারম্যান স্বাক্ষর</td>
						</tr>
					</table>
				</div>
				<?php 
					endif;
				?>
						<!----muri div close here---->

						<!--- certificate div start here --->
				<div class="wrapper jolchap" <?php if($muri==0):echo $wrapper2;endif;?>>
					<div id="cert" <?php if($muri==0):echo $cert2;endif;?>>
						<table border="0px" width="98%" height="105px;" align="center"   style="border-collapse:collapse; margin:2px auto;"  >
							<tr>
								<td <?php if($logo==0) { ?> class="no-print" <?php } ?> style="width:1.5in; text-align:center;"><img src="logo_images/logo.png" height="100px" width="100px"/></td>
								<td <?php if($header==0) { ?> class="no-print" <?php } ?>  style="text-align:center;"><font style="font-size:20px;word-spacing: 4px;letter-spacing: 2px; font-weight:bold; color:blue;"><?php echo $all_data->full_name;?></font>  <br />
									<font style="font-size:12px; font-weight:bold;">
									<?php 
										$ch=$this->db->count_all('setup_tbl');
										if($ch!=0):
									?>
										<?php echo (!empty($all_data->gram) ? $all_data->gram. ', ' : '').(!empty($all_data->postal_code) ? 'পোস্টাল কোড: '. $this->web->banDate($all_data->postal_code). ', ' : '').(!empty($all_data->thana) ? 'উপজেলাঃ ' . $all_data->thana . ', '  : '').(!empty($all_data->district) ? 'জেলাঃ ' . $all_data->district : '');?>
										<br />
										<?php echo (!empty($all_data->mobile) ? 'মোবাইল: '. $this->web->banDate($all_data->mobile) . ', ' : '').(!empty($all_data->phone) ? $this->web->banDate($all_data->phone) : '');?> <br />
										 <?php echo (!empty($all_data->web_link) ? 'ওয়েব সাইট: ' . $all_data->web_link : '');?></font>
									<?php 
										endif;
									?>
								</td>
								<td style="width:1.5in; text-align:center;"></td>
							</tr>
						</table>
						<table border="0px" width="98%" height="30px" style="border-collapse:collapse;margin:2px auto;margin-bottom:5px;" cellspacing="0" cellpadding="0" >
							<tr>
								<td style="text-align:center;"><font style="font-weight:bold; font-size:22px;"><u>ওয়ারিশ সনদপত্র</u></font></td>
							</tr>
						</table>

						<div id="sonod_number" style="margin-bottom: 5px;">
							<table border="1px" align="center" width="96%" align="center" height="30px" style="border-collapse:collapse; " cellspacing="0" cellpadding="0" >
								<tr>
									<td style="width:180px; text-align:center; font-size:17px; ">ওয়ারিশ সনদ  নং :</td>
									<?php for($i=0;$i<strlen($row->sonodno);$i++){?>	
									<td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo 	$this->web->ceb($fsonod[$i])?>
								</td>
							<?php }?>
									
									
									
									
								</tr>
							</table>
						</div>
						<table border="0px" width="99%"  align="center" height="25px" style="border-collapse:collapse; margin:0px auto;" cellspacing="0" cellpadding="0">
							<tr height="18px">
								<td  colspan="4" align="left" style="font-size:17px; text-indent:30px;">এই মর্মে প্রত্যয়ণ  করা যাইতেছে  যে,</td>
							</tr>
						</table>	
						
						
						<table border="0px" width="99%" height="40px"  align="center" style="border-collapse:collapse; margin:1px auto;" cellspacing="0" cellpadding="0">			 
							<tr height="15px">
								<td  style="font-size:15px; text-align:left; text-indent:25px; font-color:black; width:70px; ">নাম   </td>
								<td colspan="3" style="width:360px;"><font style="font-size:15px;font-weight:bold; ">: <?php echo $row->bname?></font></td>
							</tr>
							<tr height="15px" >
								<td  style="font-size:15px; text-align:left; text-indent:25px; width:70px;">পিতা </td>
								<td style="width:260px;"><font style="font-size:15px;font-weight:bold;  ">:  <?php echo $row->bfname?> </font></td>
								<td  style="font-size:15px; text-align:left; width:60px;">মাতা </td>
								<td style="width:260px;"><font style="font-size:15px;font-weight:bold;  ">:   <?php echo $row->bmane?> </font></td>
							</tr>
						</table>
						<table border="0px" height="100px" width="99%"  align="center" style="border-collapse:collapse;margin:0px auto;" cellspacing="0" cellpadding="0" class="certificate">
							<tr height="100px"> 
								<td colspan="2" style="width:38%;">
									<table width="100%" border="0" style="border-collapse:collapse;" cellpadding="0" cellspacing="0">
										<tr> 
											<td colspan="2"><caption style="text-align:left; text-decoration:underline;font-size:16px;padding-left:130px;font-weight:bold;">  বর্তমান ঠিকানা  </caption></td>
										</tr>
										<tr height='20'>
											<td style="width:158px;text-align:right; padding-right:10px; font-size:14px;">গ্রাম</td>
											<td><font style="font-size:14px;">: <?php echo $row->pb_gram?></font></td>
										</tr>
										<tr height='20'>
											<td style="width:158px;text-align:right; padding-right:10px; font-size:14px;">ডাকঘর</td>
											<td> <font style="font-size:14px;">: <?php echo $row->pb_postof?></font></td>
										</tr>
										<tr height='20'>
											<td style="width:158px;text-align:right; padding-right:10px; font-size:14px;">থানা</td>
											<td><font style="font-size:14px;">: <?php echo $row->pb_thana?></font></td>
										</tr>
										<tr height='20'>
											<td style="width:158px;text-align:right; padding-right:10px; font-size:14px;">জেলা</td>
											<td><font style="font-size:14px;">: <?php echo $row->pb_dis?></font> </td>
										</tr>
									</table>
								</td>
								<td colspan="2" style="width:60%;">
									<table width="100%" border="0" style="border-collapse:collapse;" cellpadding="0" cellspacing="0" >
										<tr> 
											<td colspan="2"><caption style="text-align:left; text-decoration:underline;font-size:16px;padding-left:90px;font-weight:bold;"> স্থায়ী ঠিকানা </caption> </td>
										</tr>
										<tr height='20'>
											<td style="width:100px;text-align:right; padding-right:10px; font-size:14px;">গ্রাম</td>
											<td><font style="font-size:14px;">: <?php echo $row->perb_gram?></font></td>
										</tr>
										<tr height='20'>
											<td style="text-align:right; padding-right:10px; font-size:14px;">ডাকঘর </td>
											<td><font style="font-size:14px;">: <?php echo $row->perb_postof?></font></td>
										</tr>
										<tr height='20'>
											<td style="text-align:right; padding-right:10px; font-size:14px;">থানা</td>
											<td><font style="font-size:14px;">: <?php echo $row->perb_thana?></font></td>
										</tr>
										<tr height='20'>
											<td style="text-align:right; padding-right:10px; font-size:14px;">জেলা</td>
											<td><font style="font-size:14px;">: <?php echo $row->perb_dis?></font>  </td>
										</tr>
									</table>
								</td>
							</tr>
						</table >

						<table border="0px" width="99%" height="15px;" align="center" style="border-collapse:collapse;margin:0px auto;" cellspacing="0" cellpadding="0">

							<tr>
								<td  nowrap style="font-size:16px; text-align:left;text-indent: 25px;"><b>ওয়ার্ড নং</b> </td>
								<td colspan="3" style="width:240px;"><font style="font-size:16px;"> :  <?php echo $row->pb_wordno?></font></td>
								<?php if(isset($row->nationid) && $row->nationid!=''){?>
								<td  nowrap style="font-size:16px; text-align:left;text-indent: 5px;"><b>ন্যাশনাল আইডি নং </b></td>
								<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
								<td  nowrap style="font-size:16px; text-align:left;text-indent: 5px;">জন্ম নিবন্ধন নং </td>
								<?php } else if(isset($row->pno) && $row->pno!=''){?>
								<td  nowrap style="font-size:16px; text-align:left;text-indent: 5px;">পাসপোর্ট নং </td>
								<?php }else{?>
								<td  nowrap style="font-size:16px; text-align:left;text-indent: 5px;"><b>ন্যাশনাল আইডি নং </b> </td>
								<?php }?>
								
								<?php if(isset($row->nationid) && $row->nationid!=''){?>
								<td colspan="3" style="width:260px;font-weight:bold;"><font style="font-size:16px; ">: <?php echo $this->web->banDate($row->nationid);?></font></td>
								<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
								<td colspan="3" style="width:260px;font-weight:bold;"><font style="font-size:16px; ">: <?php echo $this->web->banDate($row->bcno);?></font></td>
								<?php } else if(isset($row->pno) && $row->pno!=''){?>
								<td colspan="3" style="width:260px;font-weight:bold;"><font style="font-size:16px; ">: <?php echo $this->web->banDate($row->pno);?></font></td>
								<?php }else{?>
								<td colspan="3" style="width:260px;font-weight:bold;"><font style="font-size:16px; ">: <?php echo $this->web->banDate($row->nationid);?></font></td>
								<?php }?>
								
							</tr>
						</table>
						<table border="0px" width="99%"  align="center" height="24px" style="border-collapse:collapse;margin:4px auto; " cellspacing="0" cellpadding="0">
							<tr>
								<td width="100%"> 
									<font style="font-size:14px; padding-left:30px;"> অত্র ইউনিয়নের <?php if($row->bashinda==2){echo "স্থায়ী";} else{ echo "অস্থায়ী";} ?> অধিবাসী ছিলেন। মৃত্যুকালে তিনি নিম্নলিখিত ওয়ারিশগনকে রাখিয়া মৃত্যু বরণ করেন।</font>
								</td>
							</tr>
						</table>
						<table border="1px" align="center" width="95%" height="310px" align="center" style="border-collapse:collapse; " cellspacing="0" cellpadding="0" >
							<tr height="20px"> 
								<th style="width:5%;font-size:14px;">নং</th>
								<th style="width:62%;font-size:14px;">নাম</th>
								<th style="width:19%;font-size:14px;">সম্পর্ক</th>
								<th style="width:14%;font-size:14px;">বয়স</th>
							</tr>
							<?php for($i=1;$i<=15;$i++):?>
							
							<tr height=''>
								<td style="text-align:center;font-size:11px;"><?php echo $this->web->banDate($i);?></td>
								<td id='wn<?php echo $i?>' style="text-align:left;text-indent:15px;font-size:11px;"></td>
								<td id='wrel<?php echo $i?>' style="text-align:left;text-indent:15px;font-size:11px;"></td>
								<td id='wage<?php echo $i?>' style="text-align:left;text-indent:15px;font-size:11px;"></td>
							</tr>
							
							<?php endfor;?>
							
							<tr height="18px"> 
								
								<td colspan="4" style="text-align:right;font-size:12px; padding-right:60px;">উত্তরাধিকারীর সংখা <span id='intotal'>&nbsp;&nbsp;</span>&nbsp;&nbsp;জন</td>

							</tr>
						</table>

						<table  height="25px" width="98%" border="0" style="padding-top:5px;border-collapse:collapse;margin:0px auto;">
							<tr height='65'>
								<td style="font-size:13px;padding-left: 15px;box-sizing:border-box;">
									<p> আমি মৃতের বিদ্বেহী আত্নার মাগফেরাত এবং উওরাধিকারীগণের মঙ্গল কামনা করি।<br/>
									<?php if(!empty($row->note)){echo $row->note;}?></p>
								</td>
							</tr>
						</table>
						<table border='0' width="98%" height='50px' style="border-collapse:collapse;margin:2px auto;table-layout:fixed;"> 
							<tr height="24px" valign='top'>
								<td style="width:70px;font-size:13px; padding-left:3px;text-indent:4px;"><b>তদন্তকারীঃ</b></td> 
								<td style="vertical-align:top;line-height: 20px;font-size:12px;text-indent: 3px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"><?php echo $row->verifier_name; ?></td>
								<td style="width: 85px; font-size: 13px;"><b>আবেদনকারী :</b></td>
								<td style="font-size: 12px !important;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"><?php echo $row->bangla_applicant_name;?></td>
								<td style="width: 40px; font-size: 13px;"><b>পিতা :</b></td>
								<td style="font-size: 12px !important;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"><?php echo $row->bangla_applicant_father_name;?></td>
							</tr>
							<tr> 
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>

						<table  border='0' width="99%" height="146px" cellspacing="0" cellpadding="0" align="center" style="border-collapse:collapse;margin:0px auto;table-layout:fixed;">
							
							<tr>
								<td style="padding-left:20px;font-size:16px;">
									<div style="float:left;">
										<font style='position:relative;float:left;left:30px;top: 5px;border-top: 1px solid black;font-size: 13px !important;'>সীল</font>
									</div>
									<div style="display:inline;float:right">
										<font style='float:right;position:relative;right:20px;top: 8px;border-top: 1px solid black;font-size: 13px !important;'>চেয়ারম্যানের স্বাক্ষর</font>
									</div>
								</td>
								<td rowspan="2" style="width: 22%;text-align: center; border-left:1px solid black; border-top:1px solid black;"><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F<?php echo $all_data->web_link;?>/index.php/onlinetrack/warish_onosondan?tid=<?php echo $row->sonodno?>%2F&choe=UTF-8" height="140px" width="160px" style="padding:2px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"></td>
								
							</tr>
							
							<?php 
								/* $a = explode(" ",$all_data->full_name_english);
								$show = count($a)-2;
								echo strtolower($a[$show-1]); */
							?>
							
							<tr height="100px">
								<td  style="padding-left:20px;font-size:14px !important;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black;"><b>নির্দেশাবলীঃ </b><br />১) সার্টিফিকেট টি online এ verification এর জন্য <font style="color:blue;">http://<?php echo $this->web->getUrl(); ?>/Wctrack</font>  পেজ এ আসুন  এবং ১৭ ডিজিটের সনদ নং টি প্রবেশ করান। অথবা আপনার  Android Mobile থেকে  QR code টি Scan করুন।<br />
								২) যে কোন ধরনের তথ্য নেয়ার জন্য ফোন করুন অথবা ইমেইল করুন।
								</td>
								
							</tr>
						</table>
						
						<table border='0' width="99%" height="34px" cellpadding='0' cellspacing='0' style="border-collapse: collapse;margin: 2px auto;table-layout:fixed;"> 
							<tr>
								<td style="width: 75%;text-align:center;font-family: Arial;"> <font style="font-size:11px !important;"><?php echo $all_data->web_link;?></font><br>  <font style="font-size:11px !important;"> Email:<?php echo $all_data->email;?></font></td>
								<td style="width: 25%;text-align:center;"><font style="font-size:10px !important;opacity:0.7;">   Developed by Datacenter Bangladesh. </font> <br><font style="font-size:12px !important;opacity:0.7;">www.datacenter.com.bd   </font></td>
				 
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
			<?php $nr=1; foreach ($wQy as $wrow):?>
			document.getElementById('wn<?php echo $nr?>').innerHTML='<?php echo $wrow->w_name?>';
			document.getElementById('wrel<?php echo $nr?>').innerHTML='<?php echo $wrow->w_relation?>';
			document.getElementById('wage<?php echo $nr?>').innerHTML='<?php echo $this->web->conArray($wrow->w_age)?>';
			<?php $nr++;endforeach;?>
			if(document.getElementById('total') !== null){
			   document.getElementById('total').innerHTML='<?php echo $this->web->banDate($nr-1)?>';
			}
			if(document.getElementById('intotal') !== null){
			   document.getElementById('intotal').innerHTML='<?php echo $this->web->banDate($nr-1)?>';
			}
		</script>
	</body>
</html>