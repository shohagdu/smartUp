<html>
	<head>
		<meta charset="utf-8">
		<base href='<?php echo base_url();?>'/>
        <title>Citizenship Certificate</title>
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
			//some execution here
			
			$fsonod=str_split($row->sonodno); //nagorikInfo function return value
			
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
		$main2='style="height:12.2in;width:8.5in;font-family:arial;"';
		$main_second2='style="height:12.2in;width:8.5in;"';
		$wrapper2='style="margin-top:3px;height:11.69in;width:8.2in"';
		$cert2='style="height:11.69in;width:8.2in"';
	?>
	<body>
		<div id="main" <?php if($muri==0):echo $main2;endif;?>>
			<div id="main_second" <?php if($muri==0):echo $main_second2;endif;?>>
					<!----muri div start here --->
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
					<table width="97%" height='240px' border='0' class="muri_table" style="border-collapse:collapse;margin:0px auto;"> 
						<tr> 
							<td colspan="4" > 
								<div class="nagorik_head">Citizenship </div>
							</td>
						</tr>
						<tr> 
							<td style="font-size:15px;vertical-align:middle;">Serial No</td>
							<td style="width:330px;" >: <input type="text"  value="<?php echo $row_Seril_Date->applicant_id?>" style="width:95%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
							<td style="font-size:15px;vertical-align:middle;">Date</td>
							<td style="width:240px;">: <input type="text" value='<?php  $date=$row_Seril_Date->payment_date;  echo $payment_date=date('d-m-Y',strtotime($date)); ?>' style="width:95%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;">Certificate No</td>
							<td colspan="3">: <input type="text" value='<?php echo $row->sonodno?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly />	
							</td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;"> Name </td>
							<td colspan="3">: <input type="text" value='<?php echo $row->ename?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;"> Father Name </td>
							<td colspan="3">: <input type="text" value='<?php echo $row->efname?>' style="font-size:13px;width:260px;border-bottom:1px dashed black;" readonly />
							<span style="font-size: 15px;">Mother Name</span>
							: <input type="text" value='<?php echo $row->emname?>' style="width:225px;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;">Present address</td>
							<td colspan="3">: <input type="text" value='<?php echo $row->p_gram.",&nbsp;".$row->p_postof.",&nbsp;".$row->p_thana.",&nbsp;".$row->p_dis?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<td style="font-size:15px;vertical-align:middle;">Permanent address</td>
							<td colspan="3">: <input type="text" value='<?php echo $row->per_gram.",&nbsp;".$row->per_postof.",&nbsp;".$row->per_thana.",&nbsp;".$row->per_dis?>' style="width:98%;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						<tr>
							<?php if(isset($row->nationid) && $row->nationid!=''){?>
							<td style="font-size:15px;vertical-align:middle;">National Id</td>
							
							<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
							
							<td style="font-size:15px;vertical-align:middle;"> Birth Certificate No</td>
							
							<?php } else if(isset($row->pno) && $row->pno!=''){?>
							<td style="font-size:15px;vertical-align:middle;">Passport No </td>
							
							<?php } else{?>
							<td style="font-size:15px;vertical-align:middle;">National Id</td>
							<?php }?>
							<td colspan="3">:
							
							<?php if(isset($row->nationid) && $row->nationid!=''){?>
							
							<input type="text" value='<?php echo $row->nationid?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
							
							<input type="text" value='<?php echo $row->bcno?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php } else if(isset($row->pno) && $row->pno!='0'){?>
							<input type="text" value='<?php echo $row->pno?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php 
							} else{
							?>
							<input type="text" value='<?php echo $row->nationid?>' style="width:265px;font-size:13px;border-bottom:1px dashed black;" readonly />
							<?php }?>
							<span style="font-size: 15px;">Ward No</span>
							: <input type="text" name="" id="" value="<?php echo $row->p_wordno ?>" style="width:250px;font-size:13px;border-bottom:1px dashed black;" readonly /></td>
						</tr>
						
						<tr>
							<td style="font-size:15px;vertical-align:middle;"></td>
							<td> <input type="text" value='' style="width:95%;font-size:13px;<!--border-bottom:1px dashed black;-->" readonly /></td>
							<td></td>
							<td></td>
						</tr>
						<tr> 
							<td colspan="3"></td>
							<td style="width:30px;text-align:center;border-top:1px solid black;font-size:15px;">Chairman Signature</td>
						</tr>
					</table>
				</div>
				<?php 
					endif;
				?>
					<!---muri div close here-->

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
										<?php echo (!empty($all_data->gram_english) ? $all_data->gram_english . ', ': '').(!empty($all_data->postal_code) ? 'Postal Code: '.$all_data->postal_code. ', ' : ''). (!empty($all_data->thana_english) ? 'Upazila: '.$all_data->thana_english. ', ': ''). (!empty($all_data->district_english) ? 'District: '.$all_data->district_english. '' : '');?>
										<br />
										<?php echo (!empty($all_data->mobile) ? 'Mobile: '.$all_data->mobile. ', ' : '').(!empty($all_data->phone) ? $all_data->phone. '.' : '');?> <br />
										<?php echo (!empty($all_data->web_link) ? 'Web-site: '. $all_data->web_link : '');?></font>
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
							<td style="text-align:center;"><font style="font-weight:bold; font-size:22px;"><u>Citizenship Certificate</u></font></td>
						</tr>
					 </table>
		 
					 <div id="sonod_number">
					 
						<table border='1' align="center" height="25px" style="width:96%; border-color:lightgray;border-collapse:collapse;margin-top:10px;" cellpadding="0" cellspacing="0">
							<tr>
								<td style="width:180px; text-align:center;font-weight:700;font-size:17px; ">Certificate No :</td>
								<?php for($i=0;$i<strlen($row->sonodno);$i++){?>
								<td style="width:30px;text-align:center;  font-size:17px;"><?php echo $fsonod[$i]?></td>
								<?php }?>
							</tr>
						</table>
						
					</div>
		
					<table border="0" height="400px" width='99%' cellspacing="0" cellspacing='0' style="border-collapse:collapse;margin:0px auto;">
						<tr height="55px" style="">
							<td  colspan="2" align="left" style="font-size:17px; text-indent:50px;">This is to certify that effect,</td>
							
						</tr>
						<tr height="18px">
							<td width='30%'  style="font-size:17px;text-indent:55px; font-color:black;">Name  </font>  </td>
							<td width='70%'><font style="font-size:17px;">:  <?php echo $row->ename?></font></td>
						</tr>
						<?php if(($row->gender=="female") && ($row->mstatus==1) && ($row->ehname!='')){?>
						<tr height="18px">
							<td  style="font-size:17px;text-indent:55px; ">Husband Name </td>
							<td><font style="font-size:17px; ">: <?php echo $row->ehname?> </font></td>
						</tr>
						<?php }?>
						<tr height="18px">
							<td  style="font-size:17px;text-indent:55px; ">Father Name</td>
							<td><font style="font-size:17px; ">: <?php echo $row->efname?> </font></td>
						</tr>
						
						
						<tr height="18px">
							<td  style="font-size:17px;text-indent:55px; ">Mother Name</td>
							<td><font style="font-size:17px;  ">:  <?php echo $row->emname?></font></td>
						</tr>
						
						
						<tr height="60px">
							<td nowrap align="left" style="font-size:17px; text-indent:55px; vertical-align:top; ">Present address </td>
							<td style=" vertical-align:top;"><p style="line-height:25px;font-size:17px; ">
							:  Village: <?php echo $row->p_gram?><br>
											  &nbsp; Post Office:<?php echo $row->p_postof?><br>
											&nbsp;   Sub-district: <?php echo $row->p_thana?><br>
											&nbsp;   District:<?php echo $row->p_dis?>  </p></td> 
						</tr>
						
						
						<tr height="60px">
							<td nowrap align="left" style="font-size:17px;text-indent:55px; vertical-align:top; ">Permanent address </td>
							<td style=" vertical-align:top;"><p style="line-height:25px;font-size:17px;  ">
							:  Village: <?php echo $row->per_gram?><br>
										 &nbsp;   Post Office:<?php echo $row->per_postof?><br>
											 &nbsp;  Sub-district: <?php echo $row->per_thana?><br>
											 &nbsp; District:<?php echo $row->per_dis ?></p></td> 
						</tr>
						<tr height="18px">
							<td  nowrap style="font-size:17px; text-indent:55px;">Ward No </td>
							<td><font style="font-size:17px;  ">:  <?php echo $row->p_wordno ?></font></td>
						</tr>
						
						<?php if(isset($row->nationid) && $row->nationid!=''){?>
						<tr height="18px">
							<td  nowrap style="font-size:17px; text-indent:55px; ">National Id No </td>
							<td><font nowrap style="font-size:17px;">:  <?php echo $row->nationid?></font></td>
						</tr>	
						<?php } else if(isset($row->bcno) && $row->bcno!=''){?>
						<tr>
							<td  nowrap style="font-size:17px; text-indent:55px; ">Birth Certificate No </td>
							<td><font nowrap style="font-size:17px;">:  <?php echo $row->bcno?></font></td>
						</tr>	
						<?php } else if(isset($row->pno) && $row->pno!=''){?>
						<tr>
							<td  nowrap style="font-size:17px; text-indent:55px; ">Passport No </td>
							<td><font nowrap style="font-size:17px;">:  <?php echo $row->pno?></font></td>
						</tr>
						<?php } else{?>
						<tr height="18px">
							<td  nowrap style="font-size:17px; text-indent:55px; ">National Id No </td>
							<td><font nowrap style="font-size:17px;">:  <?php echo $row->nationid?></font></td>
						</tr>
						<?php }?>
						
					</table>

					<table  width='98%'  height="90px" cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;padding-top:10px;">
						  <tr height="60px">
							<td style="font-size:17px;  padding-left:30px;">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; This is a <font style="font-size:17px;"><?php if($row->bashinda=='2'){echo "permanent";}else{echo "temporary ";} ?></font> resident of the Union. <?php if($row->gender=="male"){echo "He";}else{echo "She";}?> was born in Bangladesh and I know the way.</td>
						  </tr>
						  
						  <tr height="30px">
							
							<td colspan="2" align="left" style="padding-left:68px; font-size:17px;">I wish <?php if($row->gender=='male'){echo "his";}else{echo "her";} ?> ​​overall well-being and progress .</td>
						  </tr>
					</table>
		
					<table border="0px" height="60px" width='99%' style="border-collapse:collapse; border-color:lightgray; margin:5px auto;" cellspacing="0" cellpadding="0" >
						<?php if($row->attachment!=''){ ?>
						<tr height="25px">
							<td style="font-size:17px; text-indent:60px; width:170px; font-weight:bold;"><span style="">Attachments</span></td>
							<td rowspan="2" style="font-size:18px; vertical-align:top; width:680px; ">:&nbsp; <?php echo $row->attachment; ?> </td>
						</tr>
						<?php } ?>
						<tr height="35px">
							
							<td></td>
							
						</tr>
					</table>
		
					<table border='0' height="235px" width="99%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;table-layout:fixed;margin:0px auto;">
						<tr>
							<td style="padding-left:20px;font-size:16px;">
								<div style="float:left;">
									
								</div>
								<div style="display:inline;float:right">
									<font style='float:right;position:relative;right:40px;border-top: 1px solid black;'>Chairman Signature</font>
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
							<td  style="padding-left:20px;font-size: 16px !important;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;border-bottom: 1px solid black;"><b>Instructions:</b><br /><br />1)To verify the certificate, go to the link - <font style="color:blue;">http://<?php echo $this->web->getUrl(); ?>/Octrack</font> and enter the 17 digit certificate number or Scan the QR code from your android mobile. <br />2) For any information please call or email to.
							</td>
							<td rowspan="1"  style="text-align:center;border-left:1px solid black; border-top:1px solid black;"><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2F<?php echo $all_data->web_link;?>/index.php/onlinetrack/nagoriksonod_jachai?id=<?php echo sha1($row->sonodno)?>%2F&choe=UTF-8" height="150px" width="170px" style="padding:10px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"/></td>
									
						</tr>
					</table>
					
					<table border='0' width="98%" height="34px" cellpadding='0' cellspacing='0' style="border-collapse: collapse;margin: 0px auto;table-layout:fixed;"> 
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