<html>
	<head>
		<base href='<?php echo base_url();?>'/>
		<meta charset="utf-8">
		<title>মামলার নোটিশ</title>
		<link rel="stylesheet" type="text/css" href="certificate_css/mamla.css">
		<style>
			@media print
			{    
				.no-print, .no-print *
				{
					visibility:hidden;
					
				}
				table{
					background:none;
				}	
			}
		</style>
		<?php 
			// some execution  here 
			$fsonod=str_split($row->sonodno);// nagorikInfo function return value
			
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
	</head>
	<body>
		<div id="main">
			<div id="main_second">
					<!----muri div start here --->
		 
				<div id="muri"> 
					<table border="0px" width="99%" height='65px'  cellspacing="0"  cellpadding="0" style="border-collapse:collapse;margin:0px auto;">
						<tr height="60px">
							<td <?php if($logo==0) { ?> class="no-print" <?php } ?>  style="width:1.5in; text-align:right;"><img src="logo_images/logo.png" height="55px" width="55px"/></td>
							<td <?php if($header==0) { ?> class="no-print" <?php } ?> style="text-align:center;height:60px;font-family:SolaimanLipi;thoma;"><font style="font-size:15px; font-weight:bold; color:blue; width:5.5in;"><?php echo $all_data->full_name;?></font>  <br />
								<font style="font-size:9px; font-weight:bold;">
								<?php 
									$ch=$this->db->count_all('setup_tbl');
									if($ch!=0):
								?>
								<?php echo $all_data->thana;?>,&nbsp;<?php echo $all_data->district;?>-<?php echo $all_data->postal_code;?> <br />
								ওয়েব সাইট : <?php echo $all_data->web_link;?></font>
								<?php 
									endif;
								?>
							</td>
							<td style="width:1.5in;"></td>
						</tr>
					</table>
					<table width="97%" height='240px' border='0' class="muri_table" style="border-collapse:collapse;margin:0px auto;"> 
						<tr> 
							<td colspan="4" > 
								<div class="nagorik_head">নোটিশ</div>
							</td>
						</tr>
						<tr> 
							<td style="font-size:15px;vertical-align:middle;">মামলা নং</td>
							<td style="width:330px;" >: <input type="text"  value="<?php echo $this->web->banDate($mamlaInfo->mamla_no);?>" style="width:96%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
							<td style="font-size:15px;vertical-align:middle;">তারিখ</td>
							<td style="width:240px;">: <input type="text" value='<?php $mamla_date=date('d/m/Y',strtotime($mamlaInfo->mamla_date));echo $this->web->banDate($mamla_date)?>' style="width:95%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						
						<tr>
							<td style="font-size:15px;vertical-align:middle;">স্মারক নং-সি/গৌ/ময়/অভি নং</td>
							<td colspan="3">: <input type="text" value='<?php echo $this->web->banDate($mamlaInfo->mamla_sonod);?>' style="width:97%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;"> বিষয় </td>
							<td colspan="3">: <input type="text" value='<?php
									if(strlen($mamlaInfo->subject)>95){
										echo substr(($mamlaInfo->subject),0,95)."....";
									}else{
										echo substr(($mamlaInfo->subject),0,95);
									}
								?>' style="width:97%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						
						<tr>
							<td style="font-size:15px;vertical-align:middle;">মামলার তারিখ</td>
							<td colspan="3">: <input type="text" value='<?php echo $this->web->banDate($mamla_date) ?>' style="width:97%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;">শুনানীর তারিখ</td>
							<td colspan="3">: <input type="text" value='<?php $sunani_date=date('d/m/Y',strtotime($mamlaInfo->sunani_date));echo $this->web->banDate($sunani_date) ?>' style="width:97%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;"></td>
							<td><input type="text" value='' style="width:95%;font-size:13px;" readonly /></td>
							<td></td>
							<td></td>
						</tr>
						<tr> 
							<td colspan="3"></td>
							<td style="width:50px;text-align:center;border-top:1px solid black;font-size:15px;">চেয়ারম্যান স্বাক্ষর</td>
						</tr>
					</table>
				</div>
		 
					<!---muri div close here-->

				<div id="cert">
		 
					<table border="0px" width="98%" height="125px;" align="center"   style="border-collapse:collapse; margin:2px auto;"  >
						<tr>
							<td <?php if($logo==0) { ?> class="no-print" <?php } ?> style="width:1.6in; text-align:right;"><img src="logo_images/logo.png"height="100px" width="100px"/></td>
							<td <?php if($header==0) { ?> class="no-print" <?php } ?>  style="text-align:center;"><font style="font-size:20px;word-spacing: 4px;letter-spacing: 2px; font-weight:bold; color:blue;"><?php echo $all_data->full_name;?></font>  <br />
									<font style="font-size:12px; font-weight:bold;">
								<?php 
									$ch=$this->db->count_all('setup_tbl');
									if($ch!=0):
								?>
									<?php echo "ডাকঘরঃ ".$all_data->postal_code;?>
									<?php echo 'উপজেলাঃ '.$all_data->thana;?>,&nbsp;<?php echo "জেলাঃ ".$all_data->district;?><br />
									<?php echo "মোবাইল: ".$all_data->mobile.", ".$all_data->phone;?> <br />
									ওয়েব সাইট : <?php echo $all_data->web_link;?></font>
								<?php 
									endif;
								?>
								</td>
							<td style="width:1.6in; text-align:center;"></td>
						</tr>
					</table>

						<!----header div close here---->
		 
					 <table border="0px" width="98%" height="38px" style="border-collapse:collapse;margin:2px auto;" cellspacing="0" cellpadding="0" >
						<tr>
							<td style="text-align:center;"><font style="font-weight:bold; font-size:24px;"><u>নোটিশ</u></font></td>
						</tr>
					 </table>
		 
					<table width="96%" height="58px" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;table-layout:fixed; margin: 2px auto;" > 
						<tr height="28px"> 
							<td style="width: 72%"></td>
							<td style="width: 13%;font-size: 15px;font-family:solaimanLipi;">মামলা নং</td>
							<td style="width: 15%;font-size: 15px;font-family:solaimanLipi;"> : <?php echo $this->web->banDate($mamlaInfo->mamla_no);?></td>
						</tr>
						<tr height="28px"> 
							<td></td>
							<td style="font-size: 15px;font-family:solaimanLipi;">মামলার তারিখ  </td>
							<td style="font-size: 15px;font-family:solaimanLipi;"> : <?php echo $this->web->banDate($mamla_date);?></td>
						</tr>
					</table>
					
					<table width="96%" height="32px;" border="1px" style="border-collapse:collapse;margin:5px auto;" cellpadding="0" cellspacing="0">
				         <tr>
							<td style="width:160px;font-size:80%; text-align:center; font-weight:normal;">স্মারক নং-সি/গৌ/ময়/অভি নং-</td>
							<?php $fsonod=str_split($mamlaInfo->mamla_sonod);for($i=0;$i<strlen($mamlaInfo->mamla_sonod);$i++){?>	
							<td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $this->web->ceb($fsonod[$i])?></td>
							<?php }?>
				        </tr>
					</table>
					
					<table border="0" height="161px" width='98%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0px auto;">
						<tr height="30px" style="">
							<td align="left" style="font-size:20px;font-weight: bold; text-indent:55px;">
								<p>প্রেরক,</p>
							</td>
						</tr>
						<tr height="15px">
							<td  style="font-size:14px;text-indent:55px; font-color:black;">চেয়ারম্যান </font>  </td>
						</tr>
						<tr height="15px">
							<td  style="font-size:14px;text-indent:55px; font-color:black; "><?php echo $all_data->full_name;?></font>  </td>
						</tr>
						<tr height="15px">
							<td  style="font-size:14px;text-indent:55px; font-color:black; "><?php echo $all_data->thana.', '.$all_data->district;?> </font>  </td>
						</tr>
						<tr height="5">
						
						</tr>
						<tr height="50px">
							<td  style="padding-left: 55px;box-sizing:boder-box;font-size:14px;text-indent:4px; font-color:black; width:80%; "><font>বিষয়-</font> <font style="padding-left: 20px;"> <?php echo $mamlaInfo->subject;?></font>  </td>
						</tr>
					</table>
					<div style="width:98%;height: 250px; margin: 5px auto;border: 0px solid red;"> 
						<table border="0px" width="90%" align="center"   style="border-collapse:collapse;">
							<tr height="20px"> 
								<td style="font-size: 16px;font-weight: bold;text-decoration:underline;text-indent: 10px;">বাদীগণ</td>
								<td></td>
								<td style="font-size: 16px;font-weight: bold;text-decoration:underline;">বিবাদীগণ</td>
							</tr>
							<tr>
								<td>
									<table border='0' width="98%" align="center" height="" cellpadding='0' cellspacing='0' style="border-collapse:collapse; table-layout:fixed;"> 
										<?php 
											$no=1;
											foreach($badiInfo as $badi):
										?>
										<tr height='20'> 
											<td style="font-size: 13px;font-weight: normal;">
												<font style="text-indent"><?php echo $this->web->banDate($no);?>. <?php echo $badi->badi_name;?></font>&nbsp;&nbsp;&nbsp;|
												<font><?php echo 'পিতা: ' .$badi->badi_father_name;?></font><br />
												<?php 
													if($mamlaInfo->badi_gram == ""):
												?>
													<font><?php echo 'গ্রাম: ' .$badi->gram;?></font>
												<?php endif;?>	
											</td>
										</tr>
										<?php $no++;endforeach;?>
										<?php 
											if($mamlaInfo->badi_gram != ""):
										?>
											<tr height='20'> 
												<td style="font-size: 13px;font-weight: normal;">
													<?php echo 'সর্বসাং: ' .$mamlaInfo->badi_gram;?>
												</td>
											</tr>
										<?php endif;?>	
									</table>
								</td>
								<td style="width: 0.1in;"></td>
								<td>
									<table border='0' width="98%" height="" cellpadding='0' cellspacing='0' style="border-collapse:collapse; table-layout:fixed;"> 
										<?php 
											$sn=1;
											foreach($bibadiInfo as $bibadi):
										?>
										<tr height='20'> 
											<td style="font-size: 13px;font-weight: normal;">
												<font style="text-indent"><?php echo $this->web->banDate($sn);?>. <?php echo $bibadi->bibadi_name;?></font>&nbsp;&nbsp;&nbsp;|
												<font><?php echo 'পিতা: ' .$bibadi->bibadi_father_name;?></font><br />
												<?php 
													if($mamlaInfo->bibadi_gram == ""):
												?>
													<font><?php echo 'গ্রাম: ' .$bibadi->gram;?></font>
												<?php endif;?>	
											</td>
										</tr>
										<?php $sn++;endforeach;?>
										<?php 
											if($mamlaInfo->bibadi_gram != ""):
										?>
											<tr height='20'> 
												<td style="font-size: 13px;font-weight: normal;">
													<?php echo 'সর্বসাং: ' .$mamlaInfo->bibadi_gram;?>
												</td>
											</tr>
										<?php endif;?>	
									</table>
								</td>
							</tr>
						</table>
					</div>
					<table border='0' width='98%'  height="85px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;">
						  <tr height="85px">
							<td style="font-size:13px;  padding-left:30px;">উপরে উল্লেখিত বিষয়ের আলোকে বিবাদী  গণকে জানানো যাইতেছে যে, বাদী পক্ষ  <?php $mamla_date=date('d/m/Y',strtotime($mamlaInfo->mamla_date));echo $this->web->banDate($mamla_date)?> ইং তারিখ - অ্ত্র  <?php echo $all_data->full_name;?> কার্যালয়ে  <?php
									if(strlen($mamlaInfo->subject)>200){
										echo "উপরোক্ত";
									}else{
										echo substr(($mamlaInfo->subject),0,200);
									}
								?> বিষয়ে আপনাদের বিরোদ্ধে অভিযোগ দাখিল করিয়াছে।  বাদীর অভিযোগের পরিপ্রেক্ষিতে আসছে আগামী <?php $sunani_date=date('d/m/Y',strtotime($mamlaInfo->sunani_date));echo $this->web->banDate($sunani_date)?>  ইং তারিখ- রোজ  <?php echo $this->manageAdmin->barShow($mamlaInfo->sunani_date);?> বার সকাল ১১.০০ ঘটিকায় অত্র  অফিস কার্যালয়ে যথাসময়ে বিবাদীগণ উপস্থিত থাকিয়া অভিযোগ কারীর অভিযোগটির নিষ্পত্তি করার জন্য নোটিশ প্রদান করা হল ।   </td>
						  </tr>
						  
					</table>
		
					<table border="0px" height="40px" width='99%' style="border-collapse:collapse; margin:5px auto;" cellspacing="0" cellpadding="0" >
						
						<tr>
							
							<td></td>
							
						</tr>
					</table>
		
					<table  border='0' height="160px" width="98%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
						<tr>
							<td style="padding-left:20px;font-size:13px;">
								<div style="float:left;">
									
								</div>
								<div style="display:inline;float:right">
									<font style='float:right;position:relative;right:40px;border-top: 1px solid black;'>চেয়ারম্যানের স্বাক্ষর</font>
								</div>
							</td>
							<td  style="width: 18%"></td>
						</tr>
						
						<tr>
							<td  style="padding-left:20px;font-size:13px !important;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black;"><b>নির্দেশাবলীঃ </b><br /><br />১) মামলাটি  online এ verification এর জন্য <font style="color:blue;">http://<?php echo $this->web->getUrl();?>/Mtrack</font>  পেজ এ আসুন  এবং ১৭ ডিজিটের সনদ নং টি প্রবেশ করান। অথবা আপনার  Android Mobile থেকে  QR code টি Scan করুন। <br />২) যে কোন ধরনের তথ্য নেয়ার জন্য ফোন করুন অথবা ইমেইল করুন।
							</td>
							<td rowspan="1"  style="border-left:1px solid black; border-top:1px solid black;"><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F<?php echo $all_data->web_link;?>/index.php/onlinetrack/mamla_jacai?id=<?php echo sha1($mamlaInfo->mamla_sonod)?>%2F&choe=UTF-8" height="140px" width="150px" style="padding:10px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"></td>
									
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
		
		<!--- for print----->
		<div id="print-full-page" class="no-print">
			<div class="print-certificate">
				<a target="" href="javaScript:window.print();" title="প্রিন্ট করুন">
					<img src="<?php echo base_url();?>library/print_big.png" alt="প্রিন্ট করুন" />
				</a>
			</div>
		</div>
		<!--- end for print------>
		
	</body>
</html>
<?php 
	$this->session->unset_userdata('sCode');
?>