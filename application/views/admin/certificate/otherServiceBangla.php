<html>
	<head>
		<base href='<?php echo base_url();?>'/>
		<meta charset="utf-8">
		<title>
			<?php if($listName=="মুক্তিযোদ্ধা সনদ" || $listName=="মুক্তিযোদ্ধা পোষ্য সনদ"){?>
										প্রত্যয়ন পত্র
									<?php } else{ echo $listName; }?>
		</title>
		<link rel="stylesheet" type="text/css" href="certificate_css/nagorik.css">
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
			$listName = $this->certificate->serviceNameShow($row->serviceId)->listName;
			
			
			
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
		$main2='style="height:12.2in;width:8.5in;"';
		$main_second2='style="height:12.2in;width:8.5in;"';
		$wrapper2='style="margin-top:3px;height:11.69in;width:8.2in"';
		$cert2='style="height:11.69in;width:8.2in"';
	?>
	<body>
		<div id="main"  <?php if($muri==0):echo $main2;endif;?>>
			<div id="main_second" <?php if($muri==0):echo $main_second2;endif;?>>
					<!----muri div start here --->
				<?php 
					if($muri==1):
				?>
				<div id="muri"> 
					<table border="0px" height="60px" width="97%"  cellspacing="0"  cellpadding="0" style="border-collapse:collapse;margin:0px auto;">
						<tr height="55px">
							<td <?php if($logo==0) { ?> class="no-print" <?php } ?>  style="width:1.5in; text-align:right;"><img src="logo_images/logo.png" height="55px" width="55px"/></td>
							<td <?php if($header==0) { ?> class="no-print" <?php } ?> style="text-align:center;height:55px;font-family:SolaimanLipi;thoma;"><font style="font-size:15px; font-weight:bold; color:blue; width:5.5in;"><?php echo $all_data->full_name;?></font>  <br />
								<font style="font-size:9px; font-weight:bold;">
								<?php $ch=$this->db->count_all('setup_tbl');
									if($ch!=0): ?>
										<?php echo (!empty($all_data->gram) ? $all_data->gram. ', ' : '').(!empty($all_data->postal_code) ? 'পোস্টাল কোড: '. $this->web->banDate($all_data->postal_code). ', ' : '').(!empty($all_data->thana) ? 'উপজেলাঃ ' . $all_data->thana . ', '  : '').(!empty($all_data->district) ? 'জেলাঃ ' . $all_data->district : '');?> <br />
										<?php echo (!empty($all_data->web_link) ? "ওয়েব সাইট :" . $all_data->web_link : '');?>
								
								</font>
								<?php 
									endif;
								?>
							</td>
							<td style="width:1.5in;"></td>
						</tr>
					</table>
					<table width="97%" height='246px' border='0' class="muri_table" style="border-collapse:collapse;margin:0px auto;"> 
						<tr> 
							<td colspan="4" > 
								<div class="nagorik_head">
									<?php if($listName=="মুক্তিযোদ্ধা সনদ" || $listName=="মুক্তিযোদ্ধা পোষ্য সনদ"){?>
										প্রত্যয়ন পত্র
									<?php } else{ echo $listName; }?>
								</div>
							</td>
						</tr>
						<tr> 
							<td style="font-size:14px;vertical-align:middle;">ক্রমিক নং</td>
							<td style="width:330px;" >: <input type="text"  value="<?php echo $this->web->banDate($row_Seril_Date->applicant_id)?>" style="width:95%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
							<td style="font-size:14px;vertical-align:middle;">তারিখ</td>
							<td style="width:240px;">: <input type="text" value='<?php  $date=$row_Seril_Date->payment_date;$payment_date=date('d-m-Y',strtotime($date));echo $this->web->banDate($payment_date) ?>' style="width:95%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:14px;vertical-align:middle;">সনদ নং</td>
							<td colspan="3">: <input type="text" value='<?php echo $this->web->banDate($row->sonodno)?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:14px;vertical-align:middle;"> নাম </td>
							<td colspan="3">: <input type="text" value='<?php echo $row->name?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:14px;vertical-align:middle;"> পিতার নাম </td>
							<td colspan="3">: <input type="text" value='<?php echo $row->bfname?>' style="font-size:13px;width:260px;border-bottom:1px dashed black;" readonly />
							<span style="font-size: 14px;">মাতার নাম</span>
							: <input type="text" value='<?php echo $row->mname?>' style="width:250px;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:14px;vertical-align:middle;">বর্তমান ঠিকানা</td>
							<td colspan="3">: <input type="text" value='<?php echo $row->pb_gram.",&nbsp;". $row->pb_postof.",&nbsp;". $row->pb_thana.",&nbsp;". $row->pb_dis ?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:14px;vertical-align:middle;">স্থায়ী ঠিকানা</td>
							<td colspan="3">: <input type="text" value='<?php echo $row->perb_gram.",&nbsp;". $row->perb_postof.",&nbsp;". $row->perb_thana.",&nbsp;". $row->perb_dis ?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							
							<?php if(isset($row->nationid) && $row->nationid!=''){?>
							<td style="font-size:14px;vertical-align:middle;">ন্যাশনাল আইডি নং</td>
							
							<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
							
							<td style="font-size:14px;vertical-align:middle;">জন্ম নিবন্ধন নং </td>
							
							<?php } else if(isset($row->pno) && $row->pno!=''){?>
							<td style="font-size:14px;vertical-align:middle;">পাসপোর্ট নং </td>
							
							<?php }else{?>
							<td style="font-size:14px;vertical-align:middle;">ন্যাশনাল আইডি নং</td>
							<?php }?>
							<td colspan="3">:
							
							<?php if(isset($row->nationid) && $row->nationid!=''){?>
							
							<input type="text" value='<?php echo $this->web->banDate($row->nationid)?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
							
							<input type="text" value='<?php echo $this->web->banDate($row->bcno)?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php } else if(isset($row->pno) && $row->pno!=''){?>
							<input type="text" value='<?php echo $this->web->banDate($row->pno)?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php 
							}else{
							?>
							<input type="text" value='<?php echo $this->web->banDate($row->nationid)?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php }?>
							<span style="font-size: 14px;">ওয়ার্ড নং</span>
							: <input type="text" name="" id="" value="<?php echo $row->pb_wordno;?>"style="width:270px;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						
						<tr>
							<td style="font-size:14px;vertical-align:middle;"></td>
							<td><input type="text" value='' style="width:95%;font-size:13px;" readonly /></td>
							<td></td>
							<td></td>
						</tr>
						<tr> 
							<td colspan="3"></td>
							<td style="width:50px;text-align:center;border-top:1px solid black;font-size:14px;">চেয়ারম্যান স্বাক্ষর</td>
						</tr>
					</table>
				</div>
				<?php 
					endif;
				?>
					<!---muri div close here-->
				<div class="wrapper jolchap"  <?php if($muri==0):echo $wrapper2;endif;?>>
					<div id="cert" <?php if($muri==0):echo $cert2;endif;?>>
			 
						<table border="0px" width="98%" height="125px;" align="center"   style="border-collapse:collapse; margin:2px auto;"  >
							<tr>
								<td <?php if($logo==0) { ?> class="no-print" <?php } ?> style="width:1.5in; text-align:center;"><img src="logo_images/logo.png"height="100px" width="100px"/></td>
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
								<td style="width:1.5in; text-align:center;"><img src="<?php echo $row->profile; ?>" height="100px" width="100px" style="position:relative;right:15px;top:2px" /></td>
							</tr>
						</table>

							<!----header div close here---->
			 
						<table border="0px" width="98%" height="38px" style="border-collapse:collapse;margin:2px auto;" cellspacing="0" cellpadding="0" >
							<tr>
								<?php 
									if($listName=="মুক্তিযোদ্ধা সনদ" || $listName=="মুক্তিযোদ্ধা পোষ্য সনদ"){
								?>
								<td style="text-align:center;"><font style="font-weight:bold; font-size:22px;"><u>প্রত্যয়ন পত্র</u></font></td>
								<?php } else{?>
								<td style="text-align:center;"><font style="font-weight:bold; font-size:22px;"><u><?php echo $listName;?></u></font></td>
								<?php }?>
							</tr>
						 </table>
			 
						<div id="sonod_number">
						 
							<table border='1' align="center" height="25px" style="width:96%; border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">
								<tr>
									<td style="width:180px; text-align:center;font-weight:700;font-size:17px; ">সনদ নং :</td>
									<?php for($i=0;$i<strlen($row->sonodno);$i++){?>	
									<td style="text-align:center; font-weight:bold; font-size:20px;"><?php echo $this->web->ceb($fsonod[$i])?></td>
								<?php }?>
								</tr>
							</table>
							
						</div>
			
						<table border="0" height="415px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0px auto;">
							<tr height="55px" style="">
								<?php 
									if($row->serviceId==2){
								?>
								<td colspan="2" align="left" style="font-size:17px; text-indent:50px;">এই মর্মে চারিত্রিক সনদ পত্র প্রদান করা যাইতেছে যে,</td>
								<?php 
									}elseif($row->serviceId==3){
								?>
								<td colspan="2" align="left" style="font-size:17px; text-indent:50px;">এই মর্মে অবিবাহিত সনদ পত্র প্রদান করা যাইতেছে যে,</td>
								<?php 
									}elseif($row->serviceId==4){
								?>
								<td colspan="2" align="left" style="font-size:17px; text-indent:50px;">এই মর্মে  ভূমিহীন সনদ পত্র প্রদান করা যাইতেছে যে,</td>
								<?php 
									}elseif($row->serviceId==10){
								?>
								<td colspan="2" align="left" style="font-size:17px; text-indent:50px;">এই মর্মে  অনুমতি প্রদান করিতেছি যে, </td>
								<?php 
									}else{
								?>
								<td colspan="2" align="left" style="font-size:17px; text-indent:50px;">এই মর্মে প্রত্যয়ন পত্র প্রদান  করা যাইতেছে যে,</td>
								<?php 
									}
								?>
							</tr>
							<tr height="18px">
								<td  style="font-size:17px;text-indent:55px; font-color:black; width:200px; ">নাম  </font>  </td>
								<td><font style="font-size:17px;">:  <?php echo $row->name?></font></td>
							</tr>
							<?php 
								if(($row->gender=='female') && ($row->mstatus==1) && ($row->bhname !="")){
							?>
							<tr height="18px">
								<td style="font-size: 17px; text-indent:55px">স্বামীর নাম</td>
								<td><font style="font-size:17px; ">: <?php echo $row->bhname?></font></td>
							</tr>
							<?php }?>
							
							<tr height="18px">
								<td  style="font-size:17px;text-indent:55px; ">পিতা </td>
								<td><font style="font-size:17px; ">: <?php echo $row->bfname?> </font></td>
							</tr>
							
							
							<tr height="18px">
								<td  style="font-size:17px;text-indent:55px; ">মাতা </td>
								<td><font style="font-size:17px;  ">:  <?php echo $row->mname?> </font></td>
							</tr>
							
							
							<tr height="60px">
								<td nowrap align="left" style="font-size:17px; text-indent:55px; vertical-align:top; ">বর্তমান ঠিকানা </td>
								<td style=" vertical-align:top;"><p style="line-height:25px;font-size:17px; ">
								:  গ্রামঃ <?php echo $row->pb_gram?><br>
												  &nbsp; ডাকঘরঃ <?php echo $row->pb_postof?><br>
												&nbsp;   উপজেলাঃ <?php echo $row->pb_thana?><br>
												&nbsp;   জেলাঃ <?php echo $row->pb_dis?> </p></td> 
							</tr>
							
							
							<tr height="60px">
								<td nowrap align="left" style="font-size:17px;text-indent:55px; vertical-align:top; ">স্থায়ী ঠিকানা </td>
								<td style=" vertical-align:top;"><p style="line-height:25px;font-size:17px;  ">
								:  গ্রামঃ <?php echo $row->perb_gram?><br>
											 &nbsp;   ডাকঘরঃ <?php echo $row->perb_postof?><br>
												 &nbsp;  উপজেলাঃ <?php echo $row->perb_thana?><br>
												 &nbsp;  জেলাঃ <?php echo $row->perb_dis?> </p></td> 
							</tr>
							<tr height="18px">
								<td  nowrap style="font-size:17px; text-indent:55px;">ওয়ার্ড নং </td>
								<td><font style="font-size:17px;  ">:  <?php //echo $this->web->conArray($row->p_wordno)?><?php echo $row->pb_wordno;?></font></td>
							</tr>
							<?php if(isset($row->nationid) && $row->nationid!=''){?>
							
							<tr height="18px">
								<td  nowrap style="font-size:17px; text-indent:55px; ">ন্যাশনাল আইডি নং  </td>
								<td><font style="font-size:17px;">:  <?php echo $this->web->banDate($row->nationid)?></font></td>
							</tr>
							<?php 
							}
							else if(isset($row->bcno) && $row->bcno!=''){
							?>
							<tr height="18px">
								<td  nowrap style="font-size:17px; text-indent:55px; ">জন্ম নিবন্ধন নং  </td>
								<td><font style="font-size:17px;">:  <?php echo $this->web->banDate($row->bcno)?></font></td>
							</tr>
							<?php 
							}
							elseif(isset($row->pno) && $row->pno!=''){
							?>
							
							<tr height="18px">
								<td  nowrap style="font-size:17px; text-indent:55px; ">পাসপোর্ট নং  </td>
								<td><font style="font-size:17px;">:  <?php echo $this->web->banDate($row->pno)?></font></td>
							</tr>
							
							
							<?php }else{?>
							<tr height="18px">
								<td  nowrap style="font-size:17px; text-indent:55px; ">ন্যাশনাল আইডি নং  </td>
								<td><font style="font-size:17px;">:  <?php echo $this->web->banDate($row->nationid)?></font></td>
							</tr>
							<?php }?>
							
						</table>
						<?php 
							if($row->serviceId==1){
						?>
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:17px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp তিনি গত-  <?php  $date=$row->ddfb;$deathDate=date('d-m-Y',strtotime($date));echo $this->web->banDate($deathDate); ?>  ইং তারিখে মৃত্যু বরণ করিয়াছেন। তিনি অত্র ইউনিয়নের <?php echo $row->pb_wordno;?>  নং ওর্য়াডের <font style="font-size:17px;"><?php
								if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
								?></font>   বাসিন্দা ছিলেন ।  </td>
							  </tr>
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি মরহুমের রুহের মাগফেরাত কামনা করি।</td>
							  </tr>
						</table>
						<?php 
							}else if($row->serviceId==2){
						?>
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:17px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp তিনি অত্র <?php echo $all_data->full_name;?> এর <?php echo $row->pb_wordno?> নং ওয়ার্ডের এর একজন <font style="font-size:17px;"><?php
								if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
								?></font>   বাসিন্দা। আমার জানা মতে, সে রাষ্ট্র বা সমাজ বিরোধী কাজের সাথে লিপ্ত নহে। তাহার স্বভাব ও নৈতিক চরিত্র ভাল এবং প্রশংসনীয় ।  </td>
							  </tr>
							  
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
							  </tr>
						</table>
						<?php
							}elseif($row->serviceId==3){
						?>
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:16px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp তিনি অত্র <?php echo $all_data->full_name;?> এর <?php echo $row->pb_wordno;?>নং ওয়ার্ডের <font style="font-size:17px;"><?php
								if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
								?></font>   বাসিন্দা।  আমার জানা মতে, তিনি এখন পর্যন্ত বিবাহ বন্ধনে আবদ্ধ হয়নি এবং সে রাষ্ট্র বা সমাজ বিরোধী কাজের সাথে লিপ্ত নহে। তাহার স্বভাব ও নৈতিক চরিত্র ভাল এবং প্রশংসনীয় । </td>
							  </tr>
							  
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
							  </tr>
						</table>
						<?php 
							}elseif($row->serviceId==4){
						?>
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:17px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp তিনি অত্র <?php echo $all_data->full_name;?> এর  <?php echo $row->pb_wordno;?>  নং ওর্য়াডের উল্লেখিত ঠিকানার একজন ভূমিহীন ব্যাক্তি। আমার জানা মতে, সে রাষ্ট্র বা সমাজ বিরোধী কাজের সাথে লিপ্ত নহে। তাহার স্বভাব ও নৈতিক চরিত্র ভাল এবং প্রশংসনীয় । </td>
							  </tr>
							  
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
							  </tr>
						</table>
						<?php 
							}elseif($row->serviceId==5){
						?>
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:17px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp তিনি অত্র <?php echo $all_data->full_name;?> এর অন্তগত <?php echo $row->pb_wordno;?>  নং ওর্য়াডের <font style="font-size:17px;"><?php
								if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
								?></font>   বাসিন্দা।   আমার জানামতে তাহার স্বামীর মৃত্যুর পর সে অদ্যবদী দ্বিতীয় বিবাহ বন্ধনে আবব্ধ হয় নাই । তাহার নৈতিক চরিত্র ভাল ।</td>
							  </tr>
							  
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
							  </tr>
						</table>
						<?php } elseif($row->serviceId==6){?>
						
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:17px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp তিনি অত্র <?php echo $all_data->full_name;?> এর <?php echo $row->pb_wordno;?> নং ওয়ার্ডের  <font style="font-size:17px;"><?php
								if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
								?></font>   বাসিন্দা।  আমার জানামতে তার বার্ষিক আয়  <?php echo $this->web->banDate($row->incomeAmount);?>/ (<?php echo $this->bnc->bnConvert($row->incomeAmount)?> টাকা মাত্র) । </td>
							  </tr>
							  
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
							  </tr>
						</table>
						
						<?php }elseif($row->serviceId==7){?>
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:17px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp তিনি অত্র <?php echo $all_data->full_name;?> এর  অন্তগত <?php echo $row->pb_wordno;?> নং ওয়ার্ডের  <font style="font-size:17px;"><?php
								if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
								?></font>   বাসিন্দা।  আমার জানা মতে,  <?php echo $row->name;?> প্রকাশে <?php echo $row->publishName;?>  একই ব্যাক্তি উভয় নামে পরিচিত। </td>
							  </tr>
							  
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
							  </tr>
						</table>
						
						<?php }elseif($row->serviceId==8){?>
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:17px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp আমার জানামতে সে,  <?php echo $all_data->full_name;?> এর <?php echo $row->pb_wordno;?>নং ওয়ার্ডের  <font style="font-size:17px;"><?php
								if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
								?></font>   বাসিন্দা ও প্রকৃত বাকঁ ও শ্রবন প্রতিবন্ধী ।</td>
							  </tr>
							  
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
							  </tr>
						</table>
						<?php }elseif($row->serviceId==9){?>
						
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:17px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp আমার জানা মতে, তিনি  অত্র <?php echo $all_data->full_name;?> এর <?php echo $row->pb_wordno;?> নং ওয়ার্ডের সনাতন ধর্ম অবলম্বী একজন <font style="font-size:17px;"><?php
								if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
								?></font>   বাসিন্দা।  </td>
							  </tr>
							  
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
							  </tr>
						</table>
						
						<?php }elseif($row->serviceId==10){?>
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:17px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $row->name;?> কে  <?php echo $row->workPlace;?> যোগদান করার জন্য স্বেচ্ছায় অনুমতি প্রদান করলাম।  </td>
							  </tr>
							  
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
							  </tr>
						</table>
						<?php }elseif($row->serviceId==11){?>
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:17px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp অত্র <?php echo $all_data->full_name;?> এর একজন <font style="font-size:17px;"><?php
								if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
								?></font>   বাসিন্দা।   সে আমার নিকট পরিচিত। তাহার নৈতিক চরিত্র ভাল।</td>
							  </tr>
							  
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
							  </tr>
						</table>
						<?php }elseif($row->serviceId==12){?>
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:17px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp তিনি অত্র <?php echo $all_data->full_name;?> এর <?php echo $row->pb_wordno;?> নং ওয়ার্ডের  <font style="font-size:17px;"><?php
								if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
								?></font>   বাসিন্দা।  আমার জানামতে সে ১৯৭১ সালে  <?php echo $this->web->banDate($row->sector_no);?> নং সেক্টরে যুদ্ধ করেছে । তার মুক্তিবার্তা নং  <?php echo $this->web->banDate($row->mukti_sonod);?> </td>
							  </tr>
							  
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
							  </tr>
						</table>
						<?php }elseif($row->serviceId==13){?>
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							<tr height="50px">
								<td style="font-size:14px;  padding-left:30px;">তিনি অত্র <?php echo $all_data->full_name;?> এর <?php echo $row->pb_wordno;?> নং ওয়ার্ডের  <font style="font-size:14px;"><?php
								if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
								?></font>   বাসিন্দা। তিনি একজন প্রকৃত মুক্তিযোদ্ধার  <?php echo $row->relation; ?> তাহার <?php echo $row->short_rel?>-বীর মুক্তিযোদ্ধা <?php echo $row->mukti_name;?> এর  মুক্তিবার্তা নং  <?php echo $this->web->banDate($row->mukti_sonod);?> এবং গেজেট নং <?php echo $row->gejet_no;?> ও মাননীয় প্রধানমন্ত্রীর স্বাক্ষরীত মুক্তিযোদ্ধা সংসদের সনদ নং  <?php echo $row->m_sonshod_sonod;?> জন্ম সূত্রে সে বাংলাদেশের স্থায়ী নাগরিক । আমার জানামতে সে রাষ্ট্র বিরোধী কোন কাজে লিপ্ত নহে। তাহার নৈতিক চরিত্র ভাল  । </td>
							</tr>
							  
							  <tr height="25px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:14px;"> আমি তাহার জীবনের সার্বিক উন্নতি ও মঙ্গল   কামনা করি।</td>
							  </tr>
						</table>
						<?php }else{?>
						<table border='0' width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
							  <tr height="50px">
								<td style="font-size:17px;  padding-left:30px;">&nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp অত্র <?php echo $all_data->full_name;?> এর একজন <font style="font-size:17px;"><?php
								if($row->bashinda==2){echo "স্থায়ী";}else{echo "অস্থায়ী";}
								?></font>   বাসিন্দা। তিনি জন্মগতভাবে বাংলাদেশী এবং আমার পরিচিত।  </td>
							  </tr>
							  
							  <tr height="30px">
								
								<td colspan="2" align="left" style="padding-left:68px; font-size:17px;"> আমি তাহার সর্বাঙ্গীণ  মঙ্গল ও উন্নতি কামনা করি।</td>
							  </tr>
						</table>
						<?php }?>
						<table border="0px" height="60px" width='99%' style="border-collapse:collapse; margin:5px auto;" cellspacing="0" cellpadding="0" >
							<?php if($row->attachment!=''){ ?>
							<tr height="25px">
								<td style="font-size:17px; text-indent:70px; width:150px; font-weight:bold;"><span style="">সংযুক্তি</span></td>
								<td rowspan="2" style="font-size:18px; vertical-align:top; width:680px; ">:&nbsp; <?php echo $row->attachment; ?> </td>
							</tr>
							<?php 
							}
							?>
							<tr height="35px">
								
								<td></td>
								
							</tr>
						</table>
			
						<table  border='0' height="215px" width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
							<tr>
								<td style="padding-left:20px;font-size:16px;">
									<div style="float:left;">
										
									</div>
									<?php 
										if($row->serviceId==10){
									?>
									<div style="display:inline;float:right">
										<font style='float:right;position:relative;right:40px;border-top: 1px solid black;'>অবিভাবকের স্বাক্ষর</font>
									</div>
									<?php 
										}elseif($row->serviceId==8 || $row->serviceId==2){
									?>
									<div style="display:inline;float:right">
										<font style='float:right;position:relative;right:40px;border-top: 1px solid black;'>ওয়ার্ড সদস্যর স্বাক্ষর</font>
									</div>
									<?php 
										}else{
									?>
									<div style="display:inline;float:right">
										<font style='float:right;position:relative;right:40px;border-top: 1px solid black;'>তথ্য প্রদানকারীর স্বাক্ষর</font>
									</div>
									<?php }?>
								</td>
								<td style="padding-left:20px;font-size:16px;">
									<div style="float:left;">
										
									</div>
									<?php 
										if($row->serviceId==10){
									?>
									<div style="display:inline;float:right">
										<font style='float:right;position:relative;right:40px;border-top: 1px solid black;'></font>
									</div>
										<?php }elseif($row->serviceId==8 || $row->serviceId==2 || $row->serviceId==12 || $row->serviceId==13){?>
									<div style="display:inline;float:right">
										<font style='float:right;position:relative;right:40px;border-top: 1px solid black;'></font>
									</div>	
										<?php }else{?>
									<div style="display:inline;float:right">
										<font style='float:right;position:relative;right:40px;border-top: 1px solid black;'>ওয়ার্ড সদস্যর স্বাক্ষর</font>
									</div>
										<?php }?>
								</td>
								<td style="padding-left:20px;font-size:16px;">
									<div style="float:left;">
										
									</div>
									<div style="display:inline;float:right">
										<font style='float:right;position:relative;right:40px;border-top: 1px solid black;'>চেয়ারম্যানের স্বাক্ষর</font>
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
								<td colspan="3" style="padding-left:20px;font-size:16px !important;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black;"><b>নির্দেশাবলীঃ </b><br /><br />১) সার্টিফিকেট টি online এ verification এর জন্য <font style="color:blue;">http://<?php echo $this->web->getUrl(); ?>/Octrack</font>  পেজ এ আসুন  এবং ১৭ ডিজিটের সনদ নং টি প্রবেশ করান। অথবা আপনার  Android Mobile থেকে  QR code টি Scan করুন। <br />২) যে কোন ধরনের তথ্য নেয়ার জন্য ফোন করুন অথবা ইমেইল করুন।
								</td>
								<td rowspan="1"  style="border-left:1px solid black; border-top:1px solid black;"><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F<?php echo $all_data->web_link;?>/index.php/onlinetrack/otherService_jachai?id=<?php echo sha1($row->sonodno)?>%2F&choe=UTF-8" height="150px" width="170px" style="padding:10px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"></td>
										
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
		
	</body>
</html>