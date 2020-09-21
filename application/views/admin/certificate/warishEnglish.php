<html>
	<head>
		<meta charset="utf-8">
		<base href="<?php echo base_url();?>"/>
		<link rel="stylesheet" type="text/css" href="certificate_css/oarish_cer.css">
		<title>English Oarish certificate</title>
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
		</style>
	</head>
		<?php 
			// some execution here........
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
	<body>
	<?php 
		$main2='style="height:12.2in;width:8.5in;font-family:arial;"';
		$main_second2='style="height:12.2in;width:8.5in;"';
		$wrapper2='style="margin-top:3px;height:11.69in;width:8.2in"';
		$cert2='style="height:11.69in;width:8.2in"';
	?>
		<div id="main" <?php if($muri==0):echo $main2;endif;?>>
			<div id="main_second" <?php if($muri==0):echo $main_second2;endif;?>>
					<!------header div start here---->
				<?php 
					if($muri==1):
				?>
				<div id="muri"> 
					<table border="0px" width="99%"  cellspacing="0"  cellpadding="0" style="border-collapse:collapse;margin:0px auto;">
						<tr height="55px">
							<td <?php if($logo==0) { ?> class="no-print" <?php } ?> style="width:1.5in; text-align:right;"><img src="logo_images/logo.png" height="55px" width="55px"/></td>
							<td <?php if($header==0) { ?> class="no-print" <?php } ?> style="text-align:center;height:60px;"><font style="font-size:15px; font-weight:bold; color:blue; width:5.5in;"><?php echo (!empty($all_data->full_name_english) ? $all_data->full_name_english : '');?></font>  <br />
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
							</td>
							
							<td style="width:1.5in;"></td>
						</tr>
					</table>
					
					<table width="95%" height='240px' border='0' class="muri_table" style="border-collapse:collapse;margin:0px auto;"> 
						<tr> 
							<td colspan="4" width='100%'> 
								<div class="owarishheadEng" style="width: 150px;">Successor Certificate</div>
							</td>
						</tr>
						<tr> 
							<td style="font-size:15px;vertical-align:middle;">Serial Number</td>
							<td style="width:330px;" >: <input type="text"  value="<?php echo $mrow->applicant_id?>" style="width:95%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
							<td style="font-size:15px;vertical-align:middle;">Date</td>
							<td style="width:240px;">: <input type="text" value='<?php echo $mrow->payment_date?>' style="width:95%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;">Certificate No</td>
							<td colspan="3">: <input type="text" value='<?php echo $row->sonodno?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;"> Name </td>
							<td colspan="3">: <input type="text" value='<?php echo $row->ename?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;"> Father Name</td>
							<td colspan="3">: <input type="text" value=' <?php echo $row->efname?>' style="font-size:13px;width:260px;border-bottom:1px dashed black;" readonly />
							<span style="font-size: 15px;">Mother Name </span>
							: <input type="text" value='<?php echo $row->emname?>' style="width:242px;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;">Present Address</td>
							<td colspan="3">: <input type="text" value='<?php echo "&nbsp;".$row->p_gram.",&nbsp;".$row->p_postof.",&nbsp;".$row->p_thana.",&nbsp;".$row->p_dis;?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;">Permanent Address</td>
							<td colspan="3">: <input type="text" value='<?php echo "&nbsp;".$row->per_gram.",&nbsp;".$row->per_postof.",&nbsp;".$row->per_thana.",&nbsp;".$row->per_dis; ?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<?php if(isset($row->nationid) && $row->nationid!=''){?>
							<td style="font-size:15px;vertical-align:middle;">National Id No</td>
							<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
							<td style="font-size:13px;vertical-align:middle;">Birth Certificate No</td>
							<?php } else if(isset($row->pno) && $row->pno!=''){?>
							<td style="font-size:15px;vertical-align:middle;">Passport No</td>
							<?php } else{?>
							<td style="font-size:15px;vertical-align:middle;">National Id No</td>
							<?php }?>
							<td colspan="3">:
							<?php if(isset($row->nationid) && $row->nationid!=''){?>
							<input type="text" value='<?php echo $row->nationid?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
							<input type="text" value='<?php echo $row->bcno?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php } else if(isset($row->pno) && $row->pno!=''){?>
							<input type="text" value='<?php echo $row->pno?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php } else{?>
							<input type="text" value='<?php echo $row->nationid?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php }?>
							<span style="font-size: 15px;">Ward No </span>
							: <input type="text" name="" id="" value="<?php echo $row->p_wordno?>" style="width:270px;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						
						<tr>
							<td nowrap style="font-size:12px;vertical-align:middle;">Number of Successors</td>
							<td style="width:270px;font-size:13px;border-bottom:1px dashed black;"  >: <span id='total'>&nbsp;&nbsp;</span>&nbsp;&nbsp;People</td>
							<td></td>
							<td></td>
						</tr>
						<tr> 
							<td colspan="3"></td>
							<td style="width:50px;text-align:center;border-top:1px solid black;font-size:15px;">Chairman Signature</td>
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
						<table border="0px" width="98%" height="110px;" align="center"   style="border-collapse:collapse; margin:2px auto;"  >
							<tr>
								<td <?php if($logo==0) { ?> class="no-print" <?php } ?> style="width:1.5in; text-align:center;"><img src="logo_images/logo.png" height="100px" width="100px"/></td>
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
								<td style="width:1.5in; text-align:center;"></td>
							</tr>
						</table>
						<table border="0px" width="98%" height="38px" style="border-collapse:collapse;margin:2px auto;" cellspacing="0" cellpadding="0" >
							<tr>
								<td style="text-align:center;"><font style="font-weight:bold; font-size:22px;"><u>Successor Certificate</u></font></td>
							</tr>
						</table>

						<div id="sonod_number">
							<table border="1px" align="center" width="96%" align="center" height="25px" style="border-collapse:collapse; " cellspacing="0" cellpadding="0" >
								<tr>
									<td style="width:180px; text-align:center; font-size:14px; ">Successor Certificate No :</td>
									<?php for($i=0;$i<strlen($row->sonodno);$i++){?>	
									<td style="text-align:center; font-weight:bold; font-size:18px;"><?php echo $fsonod[$i]?></td>
									<?php }?>
									
								</tr>
							</table>
						</div>
						<table border="0px" width="99%"  align="center" height="25px" style="border-collapse:collapse; margin:2px auto;" cellspacing="0" cellpadding="0">
							<tr height="20px">
								<td  colspan="4" align="left" style="font-size:17px; text-indent:30px;">Certification to the effect that going to be,</td>
							</tr>
						</table>	


						<table border="0px" width="99%" height="40px"  align="center" style="border-collapse:collapse; margin:2px auto;" cellspacing="0" cellpadding="0">			 
							<tr height="15px">
								<td  style="font-size:15px; text-align:left; text-indent:25px; font-color:black; width:70px; ">Name   </td>
								<td colspan="3" style="width:360px;"><font style="font-size:15px;font-weight:bold; ">:  <?php echo $row->ename?></font></td>
							</tr>
							<tr height="15px" >
								<td  style="font-size:15px; text-align:left; text-indent:25px; width:70px;">Father </td>
								<td style="width:260px;"><font style="font-size:15px;font-weight:bold;  ">: <?php echo $row->efname?> </font></td>
								<td  style="font-size:15px; text-align:left; width:60px;">Mother </td>
								<td style="width:260px;"><font style="font-size:15px;font-weight:bold;  ">:  <?php echo $row->emname?> </font></td>
							</tr>
						</table>
						<table border="0px" width="99%"  align="center" style="border-collapse:collapse;margin:0px auto; " cellspacing="0" cellpadding="0">
							<tr height="120px"> 
								<td colspan="2" style="width:38%;">
									<table width="100%" border="0" style="border-collapse:collapse;" cellpadding="0" cellspacing="0">
										<tr> 
											<td colspan="2"><caption style="text-align:left; text-decoration:underline;font-size:17px;padding-left:130px;font-weight:bold;"> Present Address </caption></td>
										</tr>
										<tr height='24'>
											<td style="width:158px;text-align:right; padding-right:10px; font-size:16px;">Village</td>
											<td><font style="font-size:16px;">: <?php echo $row->p_gram?></font></td>
										</tr>
										<tr height='24'>
											<td style="width:158px;text-align:right; padding-right:10px; font-size:16px;">Post Office</td>
											<td> <font style="font-size:16px;">: <?php echo $row->p_postof?></font></td>
										</tr>
										<tr height='24'>
											<td style="width:158px;text-align:right; padding-right:10px; font-size:16px;">Thana/Upazila</td>
											<td><font style="font-size:16px;">: <?php echo $row->p_thana?></font></td>
										</tr>
										<tr height='24'>
											<td style="width:158px;text-align:right; padding-right:10px; font-size:16px;">District</td>
											<td><font style="font-size:16px;">: <?php echo $row->p_dis?></font> </td>
										</tr>
									</table>
								</td>
								<td colspan="2" style="width:60%;">
									<table width="100%" border="0" style="border-collapse:collapse;" cellpadding="0" cellspacing="0" >
										<tr> 
											<td colspan="2"><caption style="text-align:left; text-decoration:underline;font-size:17px;padding-left:90px;font-weight:bold;"> Permanent Address</caption> </td>
										</tr>
										<tr height='24'>
											<td style="width:30%;text-align:right; padding-right:10px; font-size:16px;">Village</td>
											<td style="width: 70%;"><font style="font-size:16px;">: <?php echo $row->per_gram?></font></td>
										</tr>
										<tr height='24'>
											<td style="text-align:right; padding-right:10px; font-size:16px;">Post Office </td>
											<td><font style="font-size:16px;">: <?php echo $row->per_postof?></font></td>
										</tr>
										<tr height='24'>
											<td style="text-align:right; padding-right:10px; font-size:16px;">Thana/Upazila</td>
											<td><font style="font-size:16px;">: <?php echo $row->per_thana?></font></td>
										</tr>
										<tr height='24'>
											<td style="text-align:right; padding-right:10px; font-size:16px;">District</td>
											<td><font style="font-size:16px;">: <?php echo $row->per_dis?></font>  </td>
										</tr>
									</table>
								</td>
							</tr>
						</table >

						<table border="0px" width="99%" height="24px;" align="center" style="border-collapse:collapse;margin:0px auto;" cellspacing="0" cellpadding="0">

							<tr>
								<td  nowrap style="font-size:16px; text-align:left;text-indent: 25px;">Ward No</td>
								<td colspan="3" style="width:260px;font-weight:bold;"><font style="font-size:16px;  "> : <?php echo $row->per_wordno?></font></td>
							
								<?php if(isset($row->nationid) && $row->nationid!=''){?>
								<td  nowrap style="font-size:16px; text-align:left; text-indent: 5px; ">National Id No</td>
								<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
								<td  nowrap style="font-size:13px; text-align:left; text-indent: 5px; ">Birth Certificate No</td>
								<?php } else if(isset($row->pno) && $row->pno!=''){?>
								<td  nowrap style="font-size:16px; text-align:left; text-indent: 5px; ">Passport No</td>
								<?php } else{?>
								<td  nowrap style="font-size:16px; text-align:left; text-indent: 5px; ">National Id No</td>
								<?php }?>
								
								<?php if(isset($row->nationid) && $row->nationid!=''){?>
								<td colspan="3" style="width:260px;font-weight:bold;"><font style="font-size:16px; ">:  <?php echo $row->nationid?></font></td>
								<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
								<td colspan="3" style="width:260px;font-weight:bold;"><font style="font-size:16px; ">:  <?php echo $row->bcno?></font></td>
								<?php } else if(isset($row->pno) && $row->pno!=''){?>
								<td colspan="3" style="width:260px;font-weight:bold;"><font style="font-size:16px; ">:  <?php echo $row->pno?></font></td>
								<?php } else{?>
								<td colspan="3" style="width:260px;font-weight:bold;"><font style="font-size:16px; ">:  <?php echo $row->nationid?></font></td>
								<?php }?>
							</tr>
						</table>
						<table border="0px" width="99%"  align="center" height="24px" style="border-collapse:collapse;margin:0px auto; " cellspacing="0" cellpadding="0">
							<tr>
								<td width="100%"> 
									<font style="font-size:16px; padding-left:30px;"><?php if($row->gender=='male'){echo "He";}else{ echo "She";} ?> was a <span><?php if($row->bashinda==1){echo "temporary";} else{ echo "permanent";} ?> </span> resident in this union.
									Below list of successors During <?php if($row->gender=='male'){echo "his";}else{ echo "her";} ?> death time.
									</font>
								</td>
							</tr>
						</table>
						<table border="1px" align="center" width="95%" height="310px" align="center" style="border-collapse:collapse; table-layout:fixed;" cellspacing="0" cellpadding="0" >
							<tr height="20px"> 
								<th style="width:5%;font-size:14px;">No</th>
								<th style="width:62%;font-size:14px;">Name</th>
								<th style="width:19%;font-size:14px;">Relation</th>
								<th style="width:14%;font-size:14px;">Age</th>
							</tr>
							
							
							<?php for($i=1;$i<=15;$i++):?>
							<tr height='15px'>
								<td style="text-align:center;font-size:11px;"><?php echo $i;?></td>
								<td id='wn<?php echo $i?>' style="text-align:left;text-indent:15px;font-size:11px;"></td>
								<td id='wrel<?php echo $i?>' style="text-align:left;text-indent:15px;font-size:11px;"></td>
								<td id='wage<?php echo $i?>' style="text-align:left;text-indent:15px;font-size:11px;"></td>
							</tr>
							<?php endfor;?>
							<tr height="18px"> 
								<td></td>
								<td colspan="3" style="text-align:right;font-size:12px; padding-right:60px;">Number of Successors &nbsp;<font style="font-weight:bold; font-size:12px;"id='intotal'></font>&nbsp;people </td>

							</tr>
							
						</table>

						<table  height="25px" width="98%" border="0" style="padding-top:2px;border-collapse:collapse;margin:0px auto;">
							<tr height='65'>
								<td style="font-size:13px;padding-left: 15px;box-sizing:border-box;">
									<p>I am praying for dead person eternal peace and good wish to <?php if($row->gender=='male'){echo "his";}else{ echo "her";} ?> successors. <br/>
									<?php if(!empty($row->note)){echo $row->note;}?></p>
								</td>
							</tr>
						</table>
						<table border='0' width="98%" height='50px' style="border-collapse:collapse;margin:2px auto;table-layout: fixed;"> 
							<tr height="24px" valign='top'>
								<td style="width:70px;font-size:13px; padding-left:5px;"><b>Investigator:</b></td> 
								<td style="vertical-align:top;font-size:12px !important;text-indent:6px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"><?php echo $row->verifier_name; ?></td>
								<td style="width: 110px; font-size: 13px;"><b>Applicant Name:</b></td>
								<td style="font-size: 12px !important;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"><?php echo $row->english_applicant_name;?></td>
								<td style="width: 90px;font-size: 13px;"><b>Father Name:</b></td>
								<td style="font-size: 12px !important;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"><?php echo $row->english_applicant_father_name;?></td>
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
										<font style='position:relative;float:left;left:30px;top: 5px;border-top: 1px solid black;font-size: 13px !important;'>Seal</font>
									</div>
									<div style="display:inline;float:right">
										<font style='float:right;position:relative;right:20px;top: 8px;border-top: 1px solid black;font-size: 13px !important;'>Chairman Signature</font>
									</div>
								</td>
								
								<td rowspan="2"  style="width: 23%; text-align: center; border-left:1px solid black; border-top:1px solid black;"><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F<?php echo $all_data->web_link;?>/index.php/onlinetrack/warishsonod_jachai?id=<?php echo sha1($row->sonodno)?>%2F&choe=UTF-8" height="140px" width="170px" style="padding: 2px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"></td>
							</tr>
							
							<?php 
								/* $a = explode(" ",$all_data->full_name_english);
								$show = count($a)-2;
								echo strtolower($a[$show-1]); */
							?>
							
							<tr height="100px">
								<td  style="padding-left:20px;font-size:14px !important;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black;"> <b>Instruction:</b> <br /> 1)To verify the certificate, go to the link- <font style="color:blue;"> http://<?php echo $this->web->getUrl(); ?>/Wctrack</font>  and enter the 17 digit certificate number or Scan the QR code from your android mobile. <br />
								2) For any information please call or email to. 
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
			document.getElementById('total').innerHTML='<?php echo $nr-1?>';
			document.getElementById('intotal').innerHTML='<?php echo $nr-1?>';
		</script>

	</body>
	
</html>