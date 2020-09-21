<html>
<head>
	<base href="<?php echo base_url();?>"/>
	<title>নাগরিক মানি রসিদ</title>
	<style>
	body{
		font-family:SolaimanLipi;
	}
	font{
		font-size:12px;
		font-style:normal;
		font-weight:normal;
	}
	b{
		font-size:12px;
		font-weight:bold;
		font-style:normal;
	}
	input[type="text"]{font-family:SolaimanLipi;}
	   h3,h5{ margin:0px;padding:0px;}
	   * {
		box-sizing: border-box;
		-moz-box-sizing: border-box;
	}
	.wrapper{
		width: 21cm;
		height: 26.7cm;
		padding:1em;
		margin: 0 auto;
		border: 1px #D3D3D3 solid;
		border-radius: 5px;
		background: white;
	}
	table.tbl_style{
		width:100%;
		border-collapse: collapse;
		
	}
	table.tbl_style tr td{
		border:1px solid black;
	}


	@wrapper{
		size: A4;
		margin: 0;
	}
	@media print {
		body{
			font-family:SolaimanLipi;
		}
		.wrapper{
			margin:0em;
			border: initial;
			border-radius: initial;
			width: initial;
			height: initial;
			box-shadow: initial;
			background: initial;
			page-break-after: none;
			-webkit-print-color-adjust: exact;
			marks:bleed;
		}
	}

	@media screen and projection {
		a {
			display:inline;
		}
	img.logo{
	height:20px;
	}	
	}

	@media print {
		a{display: none;}
		head{display: none;}
		footer{display: none;}
	#bar{display:none;}
	table{ margin:1px; padding:0px; line-height:13px;height: 40%;}
	img#hide{display:none;}

	}
	td img.logo{
	height:90px;
	width:100px;
	position:relative;
	margin-left:50px;
	}
	td h3{
	font-size:13px;
	}
	 .input_style4{
		 border:none;
		 background:none;
		 
	 }
	 
	  @media print
		{    
			.no-print, .no-print *
				{
				visibility:hidden;
				
				}
		}
	 
	 </style>
 </head>
 <body>
	 <?php
		// some execution here..........
		
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
<div class="wrapper" attr="none">
<table  style="font-size:13px;" width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td <?php if($logo==0) { ?> class="no-print" <?php } ?> width="25%" height='90px'><img src='logo_images/logo.png' class='logo'/></td>
					<td <?php if($header==0) { ?> class="no-print" <?php } ?> width="50%"  height='90px'>
						<table width="100%;" border="0" cellpadding="0" cellpadding="0" style="border-collapse:collapse;"> 
							<tr> 
								<td width="100%" align="center"> <h2 style="font-size:16px;font-weight:bold; text-align:center;"><?php echo $all_data->full_name;?> (গ্রাহক কপি) </h2> </td>
							</tr>
							<tr> 
								<td width="100%" align="center"> <font style="font-size:12px; font-weight:normal;text-align:center;"> <?php echo $all_data->gram;?> </font> </td>
							</tr>
							<?php 
								$ch=$this->db->count_all('setup_tbl');
								if($ch!=0):
							?>
							<tr> 
								<td width="100%" align="center"> <font style="font-size:12px; font-weight:normal;text-align:center;"><?php echo $all_data->thana;?>,&nbsp;<?php echo $all_data->district;?>-<?php echo $all_data->postal_code;?></font></td>
							</tr>
							<tr> 
								<td width="100%" align="center"> <font style="font-size:12px; font-weight:normal;text-align:center;"> ফোন : <?php echo $all_data->phone;?>,&nbsp;<?php echo $all_data->mobile;?></font></td>
							</tr>
							<?php 
								endif;
							?>
						</table>
					</td>
					<td width="25%"  height='90px' style="padding-top:50px;"><b style="font-weight:normal;">তারিখ</b> :  <?php $moneyDate=date("d/m/Y",strtotime($mrow->payment_date));echo $this->web->banDate($moneyDate)?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="pori/print.png" onclick="window.print()" id="hide" height="30" width="30"></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td height='15' colspan="4"></td>
	</tr>
	<tr>
		<td style="width:120px;"><b>প্রদানকারীর নাম </b></td>
		<td>
			<font>&nbsp;:&nbsp;<?php echo $nrow->name?></font>
		</td>
		
		<?php 
			if(($nrow->gender=='female') && ($nrow->mstatus==1)){
		?>
		
		<td align='right'><b>স্বামীর নাম</b></td>
		<td>
			<font>&nbsp;:&nbsp; <?php echo $nrow->bhname?></font>
		</td>					
		<?php 
			}else{
		?>	
		<td align='right'><b> পিতার নাম </b></td>
		<td>
			<font>&nbsp;:&nbsp; <?php echo $nrow->bfname?></font>
		</td>

		<?php 
			}
		?>
		<!--<td align='right'><b><?php //if($nrow->guidan=='father'){echo "পিতার";} else {echo "স্বামীর";}?> নাম </b></td>
		<td>
			<font>&nbsp;:&nbsp;<?php //echo $nrow->bfname?></font>
		</td>--->
	</tr>
	<tr>
		<td><b>গ্রাম </b> </td>
		<td>
			<font>&nbsp;:&nbsp;<?php echo $nrow->pb_gram?></font>
		</td>
		<td align='right'><b>ওয়ার্ড নং </b> </td>
		<td>
			<font>&nbsp;:&nbsp;<?php echo $nrow->pb_wordno?></font>
		</td>
	</tr>
	<tr> 
		<td><b>ভাউচার নং</b></td>
		<td colspan="3">
			<font>&nbsp;:&nbsp; <?php echo $this->web->otherServiceVoucherInfo($nrow->trackid);?></font>
		</td>
	</tr>
	<tr>
		<td height='4' colspan="4"></td>
	</tr>
	<tr> 
		<td colspan="4">
			<table class="tbl_style" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;"> 
				<tr>
					<td height='22' style="text-align:center;font-size:12px;padding:5px;">ক্রমিক নং</td>
					<td height='22'style="width:75%;text-align:center;font-size:12px;"><font>  বর্ণনা </font></td>
					<td height='22' style="text-align:center;font-size:12px;"> পরিমান (টাকা) </td>
				</tr>
				<tr>
					<td valign='top' style='font-size:14px;text-align:center;'>১</td>
					<td style="height:90px;text-align:left;text-indent:20px;font-size:14px;padding-top:5px;" valign='top'>
						<?php 
							echo $this->money_receipt->serviceNameShow($nrow->serviceId)->listName;
						?>
					</td>
					<td valign='top' style="text-align:center;"><?php echo $this->web->otherServiceMoneyInfo($nrow->trackid);?></td>
				</tr>
				<tr> 
					<td colspan='2' height='23' style="text-align:right; font-size:12px;"> মোট টাকার পরিমান  &nbsp;&nbsp;</td>
					<td height='23' style="text-align:right;padding-right:20px; font-size:12px;"> <?php echo $this->web->otherServiceMoneyInfo($nrow->trackid);?>&nbsp; টাকা। </td>
				</tr>
			</table>
		</td>
	</tr>
	<tr style="height:40px;"> 
		<td colspan="4"><font style="font-size:12px;">  কথায় : &nbsp; &nbsp;  <input type="text" readonly  style="border-bottom:1px dotted black; border-top:none; border-left:none; border-right:none; background:none; width:360px; font-size:12px; text-align:left;" value="<?php echo $this->bnc->bnConvert($this->web->otherServiceEnmoneyInfo($nrow->trackid));?>&nbsp;টাকা মাত্র" id="ftaka"/></font></td>
	</tr>
	<tr>
		<td colspan="4" style="height:60px;"></td>
	</tr>
	<tr> 
		<td colspan="4"> 
			<table border="0" width="100%" cellpadding="0" cellspacing="0"> 
				<tr>
					<td width="295px" style="text-align:center; font-weight:normal; font-size:12px; color:black;"><hr style="width:150px; align:center; font-weight:normal;">স্বাক্ষর <br />আদায়কারী</td>
					<td width="295px" style="text-align:center; font-weight:normal; font-size:12px; color:black;"><hr style="width:150px; align:center; font-weight:normal;">সীল</td>
					<td width="295px" style="text-align:center; font-weight:normal; font-size:12px; color:black;"><hr style="width:150px; align:center; font-weight:normal;">স্বাক্ষর <br />যাচাইকারী</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<br/>
	<table width="100%" border='0' style="height:2px; border-collapse:collapse;" cellspacing="0" cellpadding="0"> 
		<tr> 
			<td> <div class="no-print" style="width:100%;height:1px;border-top:1px dashed black; "> </div></td>
		</tr>
	</table>
<br/>

<!----------------second part----------------->
<table  style="font-size:13px;" width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td <?php if($logo==0) { ?> class="no-print" <?php } ?> width="25%" height='90px'><img src='logo_images/logo.png' class='logo'/></td>
					<td <?php if($header==0) { ?> class="no-print" <?php } ?> width="50%"  height='90px'>
						<table width="100%;" border="0" cellpadding="0" cellpadding="0" style="border-collapse:collapse;"> 
							<tr> 
								<td width="100%" align="center"> <h2 style="font-size:16px;font-weight:bold; text-align:center;"><?php echo $all_data->full_name;?> (অফিস কপি ) </h2> </td>
							</tr>
							<tr> 
								<td width="100%" align="center"> <font style="font-size:12px; font-weight:normal;text-align:center;"> <?php echo $all_data->gram;?></font> </td>
							</tr>
							<?php 
								$ch=$this->db->count_all('setup_tbl');
								if($ch!=0):
							?>
							<tr> 
								<td width="100%" align="center"> <font style="font-size:12px; font-weight:normal;text-align:center;"> <?php echo $all_data->thana;?>,&nbsp;<?php echo $all_data->district;?>-<?php echo $all_data->postal_code;?></font></td>
							</tr>
							<tr> 
								<td width="100%" align="center"> <font style="font-size:12px; font-weight:normal;text-align:center;"> ফোন :  <?php echo $all_data->phone;?>,&nbsp;<?php echo $all_data->mobile;?> </font></td>
							</tr>
							<?php 
								endif;
							?>
						</table>
					</td>
					<td width="25%"  height='90px' style="padding-top:50px;"><b style="font-weight:normal;">তারিখ</b> :  <?php $moneyDate=date("d/m/y",strtotime($mrow->payment_date));echo $this->web->banDate($moneyDate)?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="pori/print.png" onclick="window.print()" id="hide" height="30" width="30"></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td height='15' colspan="4"></td>
	</tr>
	<tr>
		<td style="width:120px;"><b>প্রদানকারীর নাম </b></td>
		<td>
			<font>&nbsp;:&nbsp;<?php echo $nrow->name?></font>
		</td>
		<?php 
			if(($nrow->gender=='female') && ($nrow->mstatus==1)){
		?>
		<td align="right"><b>স্বামীর নাম</b></td>
		<td>
			<font> &nbsp;:&nbsp; <?php echo $nrow->bhname?></font>
		</td>
		<?php 
			}else{
		?>
		<td align='right'><b>পিতার নাম </b></td>
		<td>
			<font> &nbsp;:&nbsp;<?php echo $nrow->bfname?></font>
		</td>
		<?php 
			}
		?>
		
	</tr>
	<tr>
		<td><b>গ্রাম </b> </td>
		<td>
			<font>&nbsp;:&nbsp;<?php echo $nrow->pb_gram?></font>
		</td>
		<td align='right'><b>ওয়ার্ড নং </b> </td>
		<td>
			<font>&nbsp;:&nbsp;<?php echo $nrow->pb_wordno?></font>
		</td>
	</tr>
	<tr> 
		<td><b>ভাউচার নং </b></td>
		<td colspan="3">
			<font>&nbsp;:&nbsp; <?php echo $this->web->otherServiceVoucherInfo($nrow->trackid);?></font>
		</td>
	</tr>
	<tr>
		<td height='4' colspan="4"></td>
	</tr>
	<tr> 
		<td colspan="4">
			<table class="tbl_style" width="100%" cellpadding="0" cellspacing="0"> 
				<tr>
					<td height='22' style="text-align:center;font-size:12px;padding:5px;">ক্রমিক নং</td>
					<td height='22'style="width:75%;text-align:center;font-size:12px;"><font>  বর্ণনা </font></td>
					<td height='22' style="text-align:center;font-size:12px;"> পরিমান (টাকা) </td>
				</tr>
				<tr>
					<td valign="top" style="font-size:14px;text-align:center;">১</td>
					<td style="height:90px;text-align:left; text-indent:20px;font-size:14px;padding-top:5px;" valign='top'>
						<?php 
							echo $this->money_receipt->serviceNameShow($nrow->serviceId)->listName;
						?>
					</td>
					<td valign='top' style="text-align:center;"><?php echo $this->web->otherServiceMoneyInfo($nrow->trackid);?></td>
				</tr>
				<tr> 
					<td colspan='2' height='23' style="text-align:right; font-size:12px;"> মোট টাকার পরিমান &nbsp;&nbsp; </td>
					<td height='23' style="text-align:right;padding-right:20px; font-size:12px;"> <?php echo $this->web->otherServiceMoneyInfo($nrow->trackid);?>&nbsp; টাকা। </td>
				</tr>
			</table>
		</td>
	</tr>
	<tr style="height:40px;"> 
		<td colspan="4"><font style="font-size:12px;">  কথায় : &nbsp; &nbsp;  <input type="text" readonly  style="border-bottom:1px dotted black; border-top:none; border-left:none; border-right:none; background:none; width:360px; font-size:12px; text-align:left;" value="&nbsp;টাকা মাত্র" id="btaka"/></font></td>
	</tr>
	<tr>
		<td colspan="4" style="height:60px;"></td>
	</tr>
	<tr> 
		<td colspan="4"> 
			<table border="0" width="100%" cellpadding="0" cellspacing="0"> 
				<tr>
					<td width="295px" style="text-align:center; font-weight:normal; font-size:12px; color:black;"><hr style="width:150px; align:center; font-weight:normal;">স্বাক্ষর <br />আদায়কারী</td>
					<td width="295px" style="text-align:center; font-weight:normal; font-size:12px; color:black;"><hr style="width:150px; align:center; font-weight:normal;">সীল</td>
					<td width="295px" style="text-align:center; font-weight:normal; font-size:12px; color:black;"><hr style="width:150px; align:center; font-weight:normal;">স্বাক্ষর <br />যাচাইকারী</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</div>
</body>
<script>
	function taka(){
	var x=document.getElementById("ftaka").value;
	document.getElementById("btaka").value=x;
	}
	taka();
</script>
