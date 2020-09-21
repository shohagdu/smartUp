<html>
	<head>
		<base href="<?php echo base_url();?>"/>
		<title>ট্রেড লাইসেন্স বসতভিটা  করের মানি রসিদ</title>
		<style>
			body{
			font-family:SolaimanLipi;
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
			font-size:10px;
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
		// some execution here..............
		$payment_date=date('d-m-Y',strtotime($row->payment_date));
		
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
								<td width="100%" align="center"> <font style="font-size:12px; font-weight:normal;text-align:center;"><?php echo $all_data->gram;?></font> </td>
							</tr>
							<?php 
								$ch=$this->db->count_all('setup_tbl');
								if($ch!=0):
							?>
							<tr> 
								<td width="100%" align="center"> <font style="font-size:12px; font-weight:normal;text-align:center;"><?php echo $all_data->thana;?>,&nbsp;<?php echo $all_data->district;?>-<?php echo $all_data->postal_code;?> </font></td>
							</tr>
							<tr> 
								<td width="100%" align="center"> <font style="font-size:12px; font-weight:normal;text-align:center;"> ফোন : <?php echo $all_data->phone;?>,&nbsp;<?php echo $all_data->mobile;?></font></td>
							</tr>
							<?php 
								endif;
							?>
						</table>
					</td>
					<td width="25%"  height='90px' style="padding-top:50px;"><b style="font-weight:normal;">তারিখ</b> :  <?php echo $this->web->banDate($payment_date)?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="pori/print.png" onclick="window.print()" id="hide" height="30" width="30"></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td height='15' colspan="4"></td>
	</tr>
	<tr>
		<td style=""><b>প্রতিষ্ঠানের নাম </b></td>
		<td>
			<font>&nbsp;:&nbsp;<?php echo $nrow->bcomname?></font>
		</td>
		<td align='right'><b>মালিকের নাম </b></td>
		<td>
			<font>&nbsp;:&nbsp;<?php $malik=explode(',',$nrow->bwname);echo $malik['0'];?></font>
		</td>
	</tr>
	<tr>
		<td><b>ঠিকানা </b> </td>
		<td>
			<font>&nbsp;:&nbsp;<?php echo $nrow->bb_gram.','.$nrow->bb_rbs.','.$nrow->bb_postof.','.$nrow->bb_thana?></font>
		</td>
		<td align='right'><b>ওয়ার্ড নং </b> </td>
		<td>
			<font>&nbsp;:&nbsp;<?php echo $nrow->bb_wordno?></font>
		</td>
	</tr>
	<tr> 
		<td><b>ভাউচার নং</b>
		<td colspan="3"><b>&nbsp;:&nbsp; </b>
	    <?php echo $this->web->conArray($voucher_no);?>
		</td>
	</tr>
	<tr>
		<td height='4' colspan="4" height="10">&nbsp;</td>
	</tr>
	<tr> 
		<td colspan="4">
			<table class="tbl_style" width="100%" cellpadding="0" cellspacing="0"> 
				<tr>
					<td height='20'style="width:10%;text-align:center;font-size:14px;"><font>  ক্রমিক নং </font></td>
					<td height='20'style="width:70%;text-align:center;font-size:14px;"><font>  বর্ণনা </font></td>
					<td height='20' style="text-align:center;font-size:14px;width:50%"> পরিমান (টাকা) </td>
				</tr>
				<tr>
					<td style="height:18px;text-align:left; text-indent:25px;border-bottom:1px solid #ddd;padding-top:1px;font-size:13px;" valign='top'>১</td>
					<td style="height:18px;text-align:left; text-indent:25px;border-bottom:1px solid #ddd;padding-top:1px;font-size:13px;" valign='top'>বসত ভিটা কর</td>
					<td valign='top' style="text-align:center;border-bottom:1px solid #ddd;font-size:13px;"><?php echo $this->web->conArray($row->fee);?></td>
				</tr>
				
				
				<tr> 
					<td height='20' style="text-align:right; font-size:13px;" colspan='2'> মোট টাকার পরিমান  &nbsp;&nbsp;</td>
					<td height='20' style="text-align:right;padding-right:20px; font-size:13px;"> <?php echo $this->web->conArray($row->total);?>&nbsp; টাকা। </td>
				</tr>
			</table>
		</td>
	</tr>
	<tr style="height:40px;"> 
		<td colspan="5"><font style="font-size:13px;">  কথায় : &nbsp; &nbsp;  <input type="text" readonly  style="border-bottom:1px dotted black; border-top:none; border-left:none; border-right:none; background:none; width:360px; font-size:13px; text-align:left;" value="<?php echo $this->bnc->bnConvert($row->total);?>&nbsp;টাকা মাত্র" id="ftaka"/></font></td>
	</tr>
	<tr>
		<td colspan="5" style="height:60px;"></td>
	</tr>
	<tr> 
		<td colspan="5"> 
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
<br />

<!----------------second part----------------->
<table  style="font-size:13px;" width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td colspan="4">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td <?php if($logo==0) { ?> class="no-print" <?php } ?> width="25%" height='90px'><img src='logo_images/logo.png' class='logo'/></td>
					<td  <?php if($header==0) { ?> class="no-print" <?php } ?> width="50%"  height='90px'>
						<table width="100%;" border="0" cellpadding="0" cellpadding="0" style="border-collapse:collapse;"> 
							<tr> 
								<td width="100%" align="center"> <h2 style="font-size:16px;font-weight:bold; text-align:center;"><?php echo $all_data->full_name;?> (অফিস কপি ) </h2> </td>
							</tr>
							<tr> 
								<td width="100%" align="center"> <font style="font-size:12px; font-weight:normal;text-align:center;"> <?php echo $all_data->gram;?>  </font> </td>
							</tr>
							<?php 
								$ch=$this->db->count_all('setup_tbl');
								if($ch!=0):
							?>
							<tr> 
								<td width="100%" align="center"> <font style="font-size:12px; font-weight:normal;text-align:center;"> <?php echo $all_data->thana;?>,&nbsp;<?php echo $all_data->district;?>-<?php echo $all_data->postal_code;?></font></td>
							</tr>
							<tr> 
								<td width="100%" align="center"> <font style="font-size:12px; font-weight:normal;text-align:center;"> ফোন :  <?php echo $all_data->phone;?>,&nbsp;<?php echo $all_data->mobile;?></font></td>
							</tr>
							<?php endif;?>
						</table>
					</td>
					<td width="25%"  height='90px' style="padding-top:50px;"><b style="font-weight:normal;">তারিখ</b> :  <?php echo $this->web->banDate($payment_date)?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="pori/print.png" onclick="window.print()" id="hide" height="30" width="30"></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td height='120' colspan="4"></td>
	</tr>
	<tr>
		<td style=""><b>প্রতিষ্ঠানের নাম </b></td>
		<td>
			<font>&nbsp;:&nbsp;<?php echo $nrow->bcomname?></font>
		</td>
		<td align='right'><b>মালিকের নাম </b></td>
		<td>
			<font>&nbsp;:&nbsp;<?php $malik=explode(',',$nrow->bwname);echo $malik['0'];?></font>
		</td>
	</tr>
	<tr>
		<td><b>ঠিকানা </b> </td>
		<td>
			<font>&nbsp;:&nbsp;<?php echo $nrow->bb_gram.','.$nrow->bb_rbs.','.$nrow->bb_postof.','.$nrow->bb_thana?></font>
		</td>
		<td align='right'><b>ওয়ার্ড নং </b> </td>
		<td>
			<font>&nbsp;:&nbsp;<?php echo $nrow->bb_wordno?></font>
		</td>
	</tr>
	<tr> 
		<td><b>ভাউচার নং</b>
		<td colspan="3"><b>&nbsp;:&nbsp; </b>
	    <?php echo $this->web->conArray($voucher_no);?>
		</td>
	</tr>
	<tr>
		<td height='4' colspan="4" height="10">&nbsp;</td>
	</tr>
	<tr> 
		<td colspan="4">
			<table class="tbl_style" width="100%" cellpadding="0" cellspacing="0"> 
				<tr>
					<td height='20'style="width:10%;text-align:center;font-size:14px;"><font>  ক্রমিক নং </font></td>
					<td height='20'style="width:70%;text-align:center;font-size:14px;"><font>  বর্ণনা </font></td>
					<td height='20' style="text-align:center;font-size:14px;"> পরিমান (টাকা) </td>
				</tr>
					<tr>
					<td style="height:18px;text-align:left; text-indent:25px;border-bottom:1px solid #ddd;padding-top:1px;font-size:13px;" valign='top'>১</td>
					<td style="height:18px;text-align:left; text-indent:25px;border-bottom:1px solid #ddd;padding-top:1px;font-size:13px;" valign='top'>বসত ভিটা কর</td>
					<td valign='top' style="text-align:center;border-bottom:1px solid #ddd;font-size:13px;"><?php echo $this->web->conArray($row->fee);?></td>
				</tr>
				
				
				<tr> 
					<td height='20' style="text-align:right; font-size:13px;" colspan='2'> মোট টাকার পরিমান  &nbsp;&nbsp;</td>
					<td height='20' style="text-align:right;padding-right:20px; font-size:13px;"> <?php echo $this->web->conArray($row->total);?>&nbsp; টাকা। </td>
				</tr>
					
			</table>
		</td>
	</tr>
	<tr style="height:40px;"> 
		<td colspan="4"><font style="font-size:13px;">  কথায় : &nbsp; &nbsp;  <input type="text" readonly  style="border-bottom:1px dotted black; border-top:none; border-left:none; border-right:none; background:none; width:360px; font-size:13px; text-align:left;" value="&nbsp;টাকা মাত্র" id="btaka"/></font></td>
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
<script>
function taka(){
var x=document.getElementById("ftaka").value;
document.getElementById("btaka").value=x;
}
taka();
</script>
</body>

<?php 
	$this->session->unset_userdata('tradLicenceId');
?>